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

$adjcollection=new voucher_process();
$amounts=$_REQUEST['amount'];

$banks_code=$_REQUEST['bank_code'];
$adjcollection->voucher_category_code=$_REQUEST['vou_cat'];
$adjcollection->voucher_purpose_code=$_REQUEST['voucher_purpose_code'];
$adjcollection->code=$v_code;
$adjcollection->date=date("Y-m-d",strtotime($_REQUEST['date']));
$adjcollection->member_no=$_REQUEST['member_no'];
$adjcollection->name=$_REQUEST['name'];
$adjcollection->branch_code=$_REQUEST['branch_code'];
$adjcollection->amount=$amounts;
$adjcollection->bank_code=$banks_code;

	$bank_sql=mysql_query("SELECT ledger_code FROM bank WHERE code='$banks_code'");
	//$bank_row=$bank_sql['ledger_code'];
	$bank_res=mysql_fetch_array($bank_sql);
	$ledger_code=$bank_res['ledger_code'];
	$mem_obj->ledger_code=$ledger_code;
	
	
$adjcollection->cheque_no=$_REQUEST['cheque_no'];
$adjcollection->cheque_date=$_REQUEST['cheque_date'];
$adjcollection->description=$_REQUEST['description'];

$adjcollection->voucher_entry();

/* surety_principal='G001';
surety_interest='F001';
festival_principal='G002';
festival_interest='F002';
flood_principal='G004';
flood_interest='F005';
SCR='I002'; */

$ledgers_amount=array($_REQUEST['surety_principal'],$_REQUEST['surety_interest'],$_REQUEST['festival_principal'],$_REQUEST['festival_interest'],$_REQUEST['flood_principal'],$_REQUEST['flood_interest'],$_REQUEST['scr'],$amounts);

$ledgers_code=array('G001','F001','G002','F002','G004','F005','I002',$ledger_code);

$ledgers_type=array('credit','credit','credit','credit','credit','credit','credit','debit');
	
$adjcollection->voucher_details($ledgers_code,$ledgers_amount,$ledgers_type);





?>