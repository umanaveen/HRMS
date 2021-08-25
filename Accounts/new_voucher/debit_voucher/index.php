<?php
require('../../configuration.php');
require('../../user.php');

	
	
	$memsql=mysql_query("SELECT concat('VOU-',id+1) as v_code FROM voucher order by id desc limit 0,1");
	$check=mysql_num_rows($memsql);	
	if($check>0)
	{
		$mem_res=mysql_fetch_array($memsql);
		$v_code=$mem_res['v_code'];
	}
	else
	{
		$v_code='VOU-001';
	}
	
	require('../main_process.php');
	
	$ledgers_code=$_REQUEST['ledger_code'];
	$amounts=$_REQUEST['amount'];
	$bank_codes=$_REQUEST['bank_code'];
	
    $debitvoucher=new voucher_process();	
	

	$debitvoucher->code=$v_code;	
	
	$debitvoucher->date=date('Y-m-d',strtotime($_REQUEST['voucher_date']));
	$debitvoucher->voucher_category_code=$_REQUEST['cat_id'];	
	$debitvoucher->slip_no=$_REQUEST['slip_no'];	
	$debitvoucher->member_no=$_REQUEST['member_no'];
	$debitvoucher->name=$_REQUEST['name'];
	$debitvoucher->branch_code=$_REQUEST['branch_code'];
	$debitvoucher->ledger_code=$ledgers_code;
	$debitvoucher->amount=$amounts;
	$debitvoucher->bank_code=$bank_codes;
	$debitvoucher->cheque_no=$_REQUEST['cheque_no'];
	$debitvoucher->cheque_date=$_REQUEST['cheque_date'];
	
	
$bank_sql=mysql_query("SELECT ledger_code FROM bank WHERE code='$bank_codes'");
	$bank_res=mysql_fetch_array($bank_sql);
	$ledger_code=$bank_res['ledger_code'];
	$sundrydebit->ledger_code=$ledger_code;
	
	$debitvoucher->voucher_entry();
	
	$ledgers_code=array($ledger_code);
	$ledgers_amount=array($amounts);
	$ledgers_type=array('debit');
	
	$debitvoucher->voucher_details($ledgers_code,$ledgers_amount,$ledgers_type);
	
	

?>