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
	$bank_codes=$_REQUEST['bank_code'];
require('../main_process.php');

$bulkcollection=new voucher_process();

$bulkcollection->voucher_category_code=$_REQUEST['vou_cat'];
$bulkcollection->voucher_purpose_code=$_REQUEST['voucher_purpose_code'];
$bulkcollection->code=$v_code;
$bulkcollection->date=date("Y-m-d",strtotime($_REQUEST['date']));
$bulkcollection->member_no=$_REQUEST['member_no'];
$bulkcollection->reference=$_REQUEST['member_no'];
$bulkcollection->name=$_REQUEST['name'];
$bulkcollection->branch_code=$_REQUEST['branch_code'];
$bulkcollection->amount=$_REQUEST['amount'];
$bulkcollection->bank_code=$bank_codes;

$bank_sql=mysql_query("SELECT ledger_code FROM bank WHERE code='$bank_codes'");
	$bank_res=mysql_fetch_array($bank_sql);
	$ledger_code=$bank_res['ledger_code'];
	$bulkcollection->ledger_code=$ledger_code;
	
$bulkcollection->cheque_no=$_REQUEST['cheque_no'];
$bulkcollection->cheque_date=$_REQUEST['cheque_date'];
$bulkcollection->description=$_REQUEST['description'];
$bulkcollection->narration='BULK COLLECTION';

$bulkcollection->voucher_entry();


$ledgers_amount=array($_REQUEST['srf'],$_REQUEST['thrift_deposit'],$_REQUEST['share_capital'],$_REQUEST['surety_interest'],$_REQUEST['surety_od_interest'],$_REQUEST['surety_od_balance'],$_REQUEST['surety_reg_balance'],$_REQUEST['festival_interest'],$_REQUEST['festival_od_interest'],$_REQUEST['festival_od_balance'],$_REQUEST['festival_reg_balance'],$_REQUEST['scr'],$_REQUEST['amount']);
$ledgers_code=array('E003','A003','D001','F001','F001','G001','G001','F002','F002','G002','G002','I002',$ledger_code);
$ledgers_type=array('credit','credit','credit','credit','credit','credit','credit','credit','credit','credit','credit','credit','debit');


$bulkcollection->voucher_details($ledgers_code,$ledgers_amount,$ledgers_type);

//Bulk Collection insert missed
//Account Entry insert missed



?>