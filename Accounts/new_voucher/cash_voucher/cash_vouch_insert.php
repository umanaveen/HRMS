<?php

	require('../../../connect.php');
	$database = new Database();
	$db = $database->getConnection();
	
	$user_id=1;
	
	require('../main_process.php');
	
	$cashvoucher=new voucher_process($db);	
	$amounts=$_REQUEST['amount'];	
	
	$memsql=$con->query("SELECT concat('VOU-',id+1) as v_code FROM accounts_voucher order by id desc limit 0,1");
	$check = $memsql->fetchColumn();
	if($check>0)
	{
		$mem_res=$memsql->fetch(PDO::FETCH_ASSOC);
		$v_code=$mem_res['v_code'];
	}
	else
	{
		$v_code='VOU-001';
	}
	
	
	
	
	$cashvoucher->code=$v_code;
	$cashvoucher->date=date("Y-m-d",strtotime($_REQUEST['date']));
	$cashvoucher->voucher_category_code=$_REQUEST['cash_cat_code'];	
	$cashvoucher->voucher_purpose_code=$_REQUEST['voucher_purpose_code'];
	$cashvoucher->slip_no=$_REQUEST['slip_no'];
	$cashvoucher->reference_no=$_REQUEST['slip_no'];
	$cashvoucher->ledger_code=$_REQUEST['ledger_code'];
	$cashvoucher->amount=$amounts;
	$cashvoucher->description="Adjustment Slip Against Ledger";
	$cashvoucher->narration="Cash Voucher";	
	$cashvoucher->created_by=$user_id;
	
	$cashvoucher->voucher_entry();
	
	
	

	$ledgers_code=array($_REQUEST['ledger_code']);
	$ledgers_amount=array($amounts);
	$ledgers_type=array('debit');

	$cashvoucher->voucher_details($ledgers_code,$ledgers_amount,$ledgers_type);
	
	


