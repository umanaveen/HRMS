<?php

	require '../connect.php';
	require '../user.php';
	$candidateid=$_SESSION['candidateid'];
	$userrole=$_SESSION['userrole'];
	$user_id=1;	
	
	// required headers
	header("Access-Control-Allow-Origin: *");
	header("Access-Control-Allow-Headers: access");
	header("Access-Control-Allow-Methods: GET");
	header("Access-Control-Allow-Credentials: true");
	header('Content-Type: application/json');

	$enquiry_id = $_REQUEST['enquiry_id'];	
	
	$sql=$con->query("select id,voucher_category_code,voucher_purpose_code,approve_date, enquiry_id, work_order_no, amount, status 
		from po_approve_unposted_data where enquiry_id='$enquiry_id'");
		
	$fet=$sql->fetch();	
	$enquiry_id=$fet['enquiry_id'];
	$voucher_category_code=$fet['voucher_category_code'];
	$voucher_purpose_code=$fet['voucher_purpose_code'];
	$work_order_no=$fet['work_order_no'];
	$amounts=$fet['amount'];
	
	
	$memrowsql=$con->query("SELECT * FROM accounts_voucher order by id desc limit 0,1");
	$check = $memrowsql->fetchColumn();
	if($check>0)
	{
		$memsql=$con->query("SELECT concat('VOU-00',id+1) as v_code FROM accounts_voucher order by id desc limit 0,1");
		$mem_res=$memsql->fetch(PDO::FETCH_ASSOC);
		$v_code=$mem_res['v_code'];
	}
	else
	{
		$v_code='VOU-001';
	}	
	
	//echo $v_code;
	
	//Add db connection
	
	$database = new Database();
	$db = $database->getConnection();	
	
	//Add voucher_process	
	include_once './po_voucher_creation_class.php';
	$voucher_creation_proess=new voucher_process($db);		
	
	$voucher_creation_proess->code=$v_code;
	$voucher_creation_proess->date=date("Y-m-d");
	$voucher_creation_proess->voucher_category_code=$voucher_category_code;	
	$voucher_creation_proess->voucher_purpose_code=$voucher_purpose_code;
	$voucher_creation_proess->slip_no=$enquiry_id;
	$voucher_creation_proess->reference_voucher=NULL;
	$voucher_creation_proess->reference_no=$work_order_no;
	$voucher_creation_proess->ledger_code='10703000';
	$voucher_creation_proess->amount=$amounts;
	$voucher_creation_proess->bank_code=NULL;
	$voucher_creation_proess->cheque_no=NULL;
	$voucher_creation_proess->cheque_date=NULL;
	$voucher_creation_proess->description="Adjustment Receipt Against Ledger";
	$voucher_creation_proess->narration="This is Purchase order approve voucher creation";	
	$voucher_creation_proess->created_by=$user_id;	
	
	$last_id =$voucher_creation_proess->voucher_entry();
	
	//voucher Details & Account Entry Part

	$ledgers_code=array('10703000','20301700');
	$ledgers_amount=array($amounts,$amounts);
	$ledgers_type=array('credit','debit');
	
	$voucherdet_check = $voucher_creation_proess->voucher_details($ledgers_code,$ledgers_amount,$ledgers_type);
	
	if($last_id)
	{
		
		$voucher_sql  = $db->query("select * from accounts_voucher where id='$last_id'");		
		$voucher_detail = $voucher_sql->fetch(PDO::FETCH_ASSOC);
		$voucher_code=$voucher_detail['code'];
		$date=$voucher_detail['date'];
		$category_code=$voucher_detail['voucher_category_code'];
		$purpose_code=$voucher_detail['voucher_purpose_code'];
		$total_amount=$voucher_detail['amount'];
		$reference_no=$voucher_detail['reference_no'];
		$reference_voucher=$voucher_detail['reference_voucher'];
	
		$vd_sql= $db->query("select * FROM accounts_voucher_detail WHERE voucher_code='$voucher_code'");

		
		while($vd_res=$vd_sql->fetch(PDO::FETCH_ASSOC))
		{
			$ledger_code[]=$vd_res['ledger_code'];
			$amount[]=$vd_res['amount'];
			$type[]=$vd_res['type'];
			$reference[]=$vd_res['reference'];
			$narration[]=$vd_res['narration'];		
		}
				
		$length=count($ledger_code);
		
		$accounts_voucher="UPDATE accounts_voucher SET status=2 WHERE code='$voucher_code'";				
		$acc_prepare = $db->prepare($accounts_voucher);
		$acc_prepare->execute();
		//print_r($acc_prepare->errorInfo());
					
		$accounts_voucher_detail="UPDATE accounts_voucher_detail SET status=2 WHERE voucher_code='$voucher_code'";				
		$acc_detail_prepare = $db->prepare($accounts_voucher_detail);
		$acc_detail_prepare->execute();
		//print_r($acc_detail_prepare->errorInfo());
		 

		for($i=0;$i<$length;$i++)
		{
			/*
			print_r($ledger_code);
			print_r($amount);
			print_r($type);
			print_r($reference);
			print_r($narration);			
			echo $ledger_code[$i];			
			*/
					
			
			$memrowsql=$con->query("SELECT * FROM account_entry order by id desc limit 0,1");
			$check = $memrowsql->fetchColumn();
			if($check>0)
			{
				$memsql=$con->query("SELECT concat('ACC-',id+1) as acc_code FROM account_entry order by id desc limit 0,1");
				$mem_res=$memsql->fetch(PDO::FETCH_ASSOC);
				$acc_code=$mem_res['acc_code'];
			}
			else
			{
				$acc_code='ACC-001';
			}	
			
			
			$sql="INSERT INTO account_entry(code,sequence,main_entity,main_entity_type,reference,search_no,date,ledger_code,amount,type,bank_code,cheque_no,cheque_date,narration,created_by,created_on)VALUES('$acc_code','$i','Cash Voucher ','Cash Receipt','$voucher_code','$reference[$i]','$date','$ledger_code[$i]','$amount[$i]','$type[$i]',NULL,NULL,NULL,'$narration[$i]','$user_id',NOW())";
			
			$sth = $db->prepare($sql);
			$sth->execute();
			//print_r($sth->errorInfo());	
		} 
		
	}
	


	
	
	

