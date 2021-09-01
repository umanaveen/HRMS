<?php

require('../../configuration.php');
require('../../user.php');
$user_id=$_SESSION['user'];

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

$bank_codes=$_REQUEST['bank_code'];

			$sundrydebit=new voucher_process();

$sundrydebit->voucher_category_code=$_REQUEST['vou_cat'];
$sundrydebit->voucher_purpose_code=$_REQUEST['voucher_purpose_code'];
$sundrydebit->code=$v_code;
$sundrydebit->date=date("Y-m-d",strtotime($_REQUEST['sund_date']));
$sundrydebit->member_no=$_REQUEST['member_no'];
$sundrydebit->reference=$_REQUEST['member_no'];
$sundrydebit->reference_voucher=$_REQUEST['reference'];
$sundrydebit->name=$_REQUEST['name'];
$sundrydebit->branch_code=$_REQUEST['branch_code'];
$sundrydebit->amount=$_REQUEST['sdr_amount'];
$sundrydebit->created_by=$user_id;

$sundrydebit->bank_code=$bank_codes;

$bank_sql=mysql_query("SELECT ledger_code FROM bank WHERE code='$bank_codes'");
	$bank_res=mysql_fetch_array($bank_sql);
	$ledger_code=$bank_res['ledger_code'];
	$sundrydebit->ledger_code=$ledger_code;
	
$sundrydebit->sdr_amount=$_REQUEST['sdr_amount'];
$against_l=$_REQUEST['against'];
$sundrydebit->against=$against_l;

$sundrydebit->voucher_entry();

$ledgers_code=array($ledger_code,$against_l);
$ledgers_amount=array($_REQUEST['sdr_amount'],$_REQUEST['sdr_amount']);
$ledgers_type=array('debit','credit');

$sundrydebit->voucher_details($ledgers_code,$ledgers_amount,$ledgers_type); 
?>