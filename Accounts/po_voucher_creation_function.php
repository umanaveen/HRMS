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
	
	$sql=$con->query("select id, approve_date, enquiry_id, quote_cost_sheet_no, amount, status 
		from po_approve_unposted_data where enquiry_id='$enquiry_id'");		
	$fet=$sql->fetch();	
	$enquiry_id=$fet['enquiry_id'];	
	$quote_cost_sheet_no=$fet['quote_cost_sheet_no'];	
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

	include_once '../connect.php';
	$database = new Database();
	$db = $database->getConnection();	
	
	//Add voucher_process	
	include_once './po_voucher_creation_class.php';
	$voucher_creation_proess=new voucher_process($db);		
	
	$voucher_creation_proess->code=$v_code;
	$voucher_creation_proess->date=date("Y-m-d");
	$voucher_creation_proess->voucher_category_code='CAT-002';	
	$voucher_creation_proess->voucher_purpose_code='PUR-002';
	$voucher_creation_proess->slip_no=$enquiry_id;
	$voucher_creation_proess->reference_voucher=NULL;
	$voucher_creation_proess->reference_no=$quote_cost_sheet_no;
	$voucher_creation_proess->ledger_code='10703000';
	$voucher_creation_proess->amount=$amounts;
	$voucher_creation_proess->bank_code=NULL;
	$voucher_creation_proess->cheque_no=NULL;
	$voucher_creation_proess->cheque_date=NULL;
	$voucher_creation_proess->description="Adjustment Receipt Against Ledger";
	$voucher_creation_proess->narration="This is Purchase order approve voucher creation";	
	$voucher_creation_proess->created_by=$user_id;	
	
	$voucher_creation_proess->voucher_entry();	
	
	
	
	//voucher Details & Account Entry Part

	$ledgers_code=array('10703000','20301700');
	$ledgers_amount=array($amounts,$amounts);
	$ledgers_type=array('credit','debit');
	
	$voucher_creation_proess->voucher_details($ledgers_code,$ledgers_amount,$ledgers_type);
	
	
	//Account Entry Start here
	$voucher_creation_proess->account_entry_insert($v_code);
	
	

	