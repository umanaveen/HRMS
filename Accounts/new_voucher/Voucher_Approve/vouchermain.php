<?php

	require('../../../connect.php');
	//require('../../user.php');
	$user_id=1;//$_SESSION['user'];

	$voucher_code=$_REQUEST['voucher_code'];

	$voucher_sql  = $con->query("select * from accounts_voucher where code='$voucher_code'");
	$voucher_detail = $voucher_sql->fetch(PDO::FETCH_ASSOC);

	$date=$voucher_detail['date'];
	$member_no=$voucher_detail['member_no'];	
	$branch_code=$voucher_detail['branch_code'];	
	$category_code=$voucher_detail['voucher_category_code'];
	$purpose_code=$voucher_detail['voucher_purpose_code'];
	$total_amount=$voucher_detail['amount'];
	$reference_no=$voucher_detail['reference_no'];
	$reference_voucher=$voucher_detail['reference_voucher'];

	//echo $voucher_code,'<br>',$date,'<br>',$member_no,'<br>',$branch_code,'<br>',$category_code,'<br>',$purpose_code,'<br>',$total_amount,'<br>',$reference_no,'<br>',$reference_voucher;

	$vd_sql= $con->query("select * FROM accounts_voucher_detail WHERE voucher_code='$voucher_code'");

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
	$acc_prepare = $con->prepare($accounts_voucher);
	$acc_prepare->execute();
	//print_r($acc_prepare->errorInfo());
				
	$accounts_voucher_detail="UPDATE accounts_voucher_detail SET status=2 WHERE voucher_code='$voucher_code'";				
	$acc_detail_prepare = $con->prepare($accounts_voucher_detail);
	$acc_detail_prepare->execute();
	//print_r($acc_detail_prepare->errorInfo());
	
	require('main_process.php');
	$vou_obj=new voucher_approve();

	for($i=0;$i<$length;$i++)
	{
		$i;
		$amount[$i];
		$ledger_code[$i];
				
		$memsql=$con->query("SELECT concat('ACC-',id+1) as acc_code FROM account_entry order by id desc limit 0,1");	 
		$mem_res=$memsql->fetch(PDO::FETCH_ASSOC);
		$acc_code=$mem_res['acc_code'];
		
		//echo $category_code;
		
		if($category_code=='CAT-001')
		{
			$sql="INSERT INTO account_entry(code,sequence,main_entity,main_entity_type,reference,search_no,date,ledger_code,amount,type,bank_code,cheque_no,cheque_date,narration,created_by,created_on)VALUES('$acc_code','$i','Cash Voucher','Cash Payment','$voucher_code','$reference[$i]','$date','$ledger_code[$i]','$amount[$i]','debit','','',NULL,'$narration[$i]','$user_id',NOW())";
		}
		else if($category_code=='CAT-002')
		{
			$sql="INSERT INTO account_entry(code,sequence,main_entity,main_entity_type,reference,search_no,date,ledger_code,amount,type,bank_code,cheque_no,cheque_date,narration,created_by,created_on)VALUES('$acc_code','$i','Cash Voucher ','Cash Receipt','$voucher_code','$reference[$i]','$date','$ledger_code[$i]','$amount[$i]','credit','','','','$narration[$i]','$user_id',NOW())";
		}
		
		echo $sql;
		
		$sql_res=$con->query($sql);
		$sth = $con->prepare($sql_res);
		$sth->execute();
		print_r($sth->errorInfo());
		
		
		
		
		if($category_code=='CAT-004' && $purpose_code!='PUR-001') // Check the new member or not 
		{
			if($ledger_code[$i]=='E003') 		//srf data
			{
				$vou_obj->vou_date=$date;
				$vou_obj->srf_member_no=$reference[$i];
				$vou_obj->srf_ledger_code=$ledger_code[$i];
				$vou_obj->srf_type=$type[$i];
				$vou_obj->srf_amount=$amount[$i];
				$vou_obj->voucher_code=$voucher_code;			
				
				if($purpose_code=='PUR-001')
				{				
					$vou_obj->narration='OPN BAL';
				}
				else if($purpose_code=='PUR-004')
				{				
					$vou_obj->narration='BULK. COL';
					
					mysql_query("UPDATE bulk_collection SET srf='$amount[$i]' where reference='$voucher_code'");
				}
				
				$vou_obj->srf_insert(); 
				
				
			}
			else if($ledger_code[$i]=='A003') 	//thrift data
			{
				$vou_obj->vou_date=$date;
				$vou_obj->thrift_member_no=$reference[$i];
				$vou_obj->thrift_ledger_code=$ledger_code[$i];
				$vou_obj->thrift_type=$type[$i];
				$vou_obj->thrift_amount=$amount[$i];
				$vou_obj->voucher_code=$voucher_code;
				
				if($purpose_code=='PUR-001')
				{				
					$vou_obj->narration='OPN BAL';
				}
				else if($purpose_code=='PUR-004')
				{				
					$vou_obj->narration='BULK. COL';
					
					mysql_query("UPDATE bulk_collection SET thrift_deposit='$amount[$i]' where reference_no='$voucher_code'");
				}
				
				$vou_obj->thrift_insert(); 
			}
			else if($ledger_code[$i]=='D001')	//share data
			{
				$vou_obj->vou_date=$date;
				$vou_obj->share_member_no=$reference[$i];
				$vou_obj->share_ledger_code=$ledger_code[$i];
				$vou_obj->share_type=$type[$i];
				$vou_obj->share_amount=$amount[$i];
				$vou_obj->voucher_code=$voucher_code;
				if($purpose_code=='PUR-001')
				{				
					$vou_obj->narration='OPN BAL';
				}			
				
				$vou_obj->share_insert(); 
			}
			else if($ledger_code[$i]=='F001')	//surety_int
			{
				$vou_obj->vou_date=$date;
				$vou_obj->voucher_code=$voucher_code;
				$vou_obj->surety_int_member_no=$reference[$i];
				$vou_obj->surety_int_ledger_code=$ledger_code[$i];
				$vou_obj->surety_int_type=$type[$i];
				$vou_obj->surety_int_amount=$amount[$i];
				
				if($purpose_code=='PUR-003')
				{				
					$vou_obj->narration='ADJ. COL';
					
					mysql_query("UPDATE adjustment_collection SET demand_surety_interest='$amount[$i]',surety_interest='$amount[$i]' where reference_no='$voucher_code'");
					
				}
				else if($purpose_code=='PUR-004')
				{				
					$vou_obj->narration='BULK. COL';
					
					mysql_query("UPDATE bulk_collection SET surety_interest='$amount[$i]' where reference_no='$voucher_code'");
				}
				$vou_obj->surety_int_insert();  
			}
			else if($ledger_code[$i]=='G001')	//surety_pri
			{
				$vou_obj->vou_date=$date;
				$vou_obj->voucher_code=$voucher_code;
				$vou_obj->surety_member_no=$reference[$i];	
				$vou_obj->surety_ledger_code=$ledger_code[$i];
				$vou_obj->surety_type=$type[$i];
				$vou_obj->surety_amount=$amount[$i];
				if($purpose_code=='PUR-003')
				{				
					$vou_obj->narration='ADJ. COL';
					
					mysql_query("UPDATE adjustment_collection SET demand_surety_principal='$amount[$i]',surety_principal='$amount[$i]' where reference_no='$voucher_code'");
				}
				else if($purpose_code=='PUR-004')
				{				
					$vou_obj->narration='BULK. COL';
					mysql_query("UPDATE bulk_collection SET surety_reg_balance='$amount[$i]' where reference_no='$voucher_code'");
				}
				$vou_obj->surety_insert(); 
			}
			
			else if($ledger_code[$i]=='F002')	//fest_int data
			{ 
				$vou_obj->vou_date=$date;
				$vou_obj->voucher_code=$voucher_code;
				$vou_obj->fest_int_type=$type[$i];			
				$vou_obj->fest_int_ledger_code=$ledger_code[$i];			
				$vou_obj->fest_int_member_no=$reference[$i];
				$vou_obj->fest_int_amount=$amount[$i];
				
				if($purpose_code=='PUR-003')
				{				
					$vou_obj->narration='ADJ. COL';
					mysql_query("UPDATE adjustment_collection SET demand_festival_interest='$amount[$i]',festival_interest='$amount[$i]' where reference_no='$voucher_code'");
					
				}
				else if($purpose_code=='PUR-004')
				{				
					$vou_obj->narration='BULK. COL';
					
					mysql_query("UPDATE bulk_collection SET festival_interest='$amount[$i]' where reference_no='$voucher_code'");
				}
				$vou_obj->fest_int_insert(); 
				
			}
			else if($ledger_code[$i]=='G002')	//fest data
			{
				$vou_obj->vou_date=$date;
				$vou_obj->fest_member_no=$reference[$i];
				$vou_obj->fest_ledger_code=$ledger_code[$i];
				$vou_obj->fest_type=$type[$i];
				$vou_obj->fest_amount=$amount[$i];
				$vou_obj->voucher_code=$voucher_code;
				
				if($purpose_code=='PUR-003')
				{				
					$vou_obj->narration='ADJ. COL';
					mysql_query("UPDATE adjustment_collection SET demand_festival_principal='$amount[$i]',festival_principal='$amount[$i]' where reference_no='$voucher_code'");
				}
				else if($purpose_code=='PUR-004')
				{				
					$vou_obj->narration='BULK. COL';
					
					mysql_query("UPDATE bulk_collection SET festival_reg_balance='$amount[$i]' where reference_no='$voucher_code'");
				} 
				$vou_obj->fest_pri_insert(); 
			}
			else if($ledger_code[$i]=='I002')	//scr data
			{
				$vou_obj->vou_date=$date;
				$vou_obj->scr_member_no=$reference[$i];
				$vou_obj->scr_ledger_code=$ledger_code[$i];
				$vou_obj->scr_type=$type[$i];
				$vou_obj->scr_amount=$amount[$i];
				$vou_obj->voucher_code=$voucher_code;
				$vou_obj->narration='SUNDRY CREDITOR';
				
				$vou_obj->scr();
				
				if($purpose_code=='PUR-004')
				{				
					mysql_query("UPDATE bulk_collection SET scr='$amount[$i]' where reference_no='$voucher_code'");
				}
				
			}
			else if($ledger_code[$i]=='I001')	//sdr data
			{
				$vou_obj->vou_date=$date;
				$vou_obj->reference_voucher=$reference_voucher;
				$vou_obj->voucher_code=$voucher_code;
				$vou_obj->branch_code=$branch_code;
				$vou_obj->sdr(); 
			}
			else									//other data
			{
				$other_member_no[]=$reference[$i];
				$other_ledger_code[]=$ledger_code[$i];
				$other_type[]=$type[$i];
				$other_amount[]=$amount[$i];	
				$vou_obj->voucher_code=$voucher_code;
				//$vou_obj->other();	
			}
		} 
		
	}

?>