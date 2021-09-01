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

$v_code;

require('../main_process.php');

$amounts=$_REQUEST['amount'];
$bank_codes=$_REQUEST['bank_code'];
$member_no=$_REQUEST['member_no'];
 
if($member_no=='')
{
	$member_no='';
	$branch_code=$_REQUEST['branch'];
}
else
{
	$member_no=$member_no;
	$branch_code=$_REQUEST['branch_code'];
}
$category=$_REQUEST['vou_cat'];


$sundrycredit=new voucher_process();
$sundrycredit->member_no=$member_no;
$sundrycredit->reference=$member_no;
$sundrycredit->branch_code=$branch_code;
$sundrycredit->code=$v_code;
$sundrycredit->voucher_category_code=$_REQUEST['vou_cat'];
$sundrycredit->voucher_purpose_code=$_REQUEST['voucher_purpose_code'];
$sundrycredit->date=date('Y-m-d',strtotime($_REQUEST['sund_date']));
$sundrycredit->name=$_REQUEST['name'];
$sundrycredit->amount=$amounts;
$sundrycredit->bank_code=$bank_codes;

$bank_sql=mysql_query("SELECT ledger_code FROM bank WHERE code='$bank_codes'");
$bank_res=mysql_fetch_array($bank_sql);
$ledger_code=$bank_res['ledger_code'];
$sundrycredit->ledger_code=$ledger_code;

$sundrycredit->cheque_no=$_REQUEST['cheque_no'];
$sundrycredit->cheque_date=date('Y-m-d',strtotime($_REQUEST['cheque_date']));
$sundrycredit->description=$_REQUEST['description'];

	
$sundrycredit->voucher_entry();

$ledgers_amount=array($amounts,$amounts);
$ledgers_code=array('I002',$ledger_code);
$ledgers_type=array('credit','debit');
	
$sundrycredit->voucher_details($ledgers_code,$ledgers_amount,$ledgers_type);

?>