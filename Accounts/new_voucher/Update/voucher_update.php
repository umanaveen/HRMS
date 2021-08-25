<?php
require('../../../connect.php');
//require('../../user.php');
$user_id=1;//$_SESSION['user'];

$voucher_code=$_REQUEST['voucher_code'];

mysql_query("DELETE FROM voucher_detail WHERE voucher_code='$voucher_code'");

$ledgers_code=$_REQUEST['ledger_code'];
$ledgers_type=$_REQUEST['led_type'];
$ledgers_amount=$_REQUEST['ledger_amount'];

		require('update_process.php');
		$voucher_update=new voucher_update();

		$voucher_update->date=date("Y-m-d",strtotime($_REQUEST['date']));
		$voucher_update->code=$voucher_code;
		$voucher_update->member_no=$_REQUEST['member_no'];
		$voucher_update->name=$_REQUEST['name'];
		$voucher_update->branch_code=$_REQUEST['branch_code'];
		$voucher_update->amount=$_REQUEST['amount'];
		$voucher_update->bank_code=$_REQUEST['bank_code'];
		$voucher_update->cheque_no=$_REQUEST['cheque_no'];
		$voucher_update->cheque_date=$_REQUEST['cheque_date'];
		$voucher_update->description=$_REQUEST['description'];
		$voucher_update->narration=$_REQUEST['narration'];

		$voucher_update->voucher_table();

		$voucher_update->voucher_details($ledgers_code,$ledgers_amount,$ledgers_type); 
		
		
?>