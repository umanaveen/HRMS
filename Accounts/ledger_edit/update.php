<?php
require '../../connect.php';
require('../../user.php');
$user=1;

$id=$_REQUEST['id'];


if($id==1)
{
	$ledger=$_REQUEST['ledger'];
	$date=date('Y-m-d',strtotime($_REQUEST['date']));
	$balance=$_REQUEST['balance'];
	$sql="UPDATE accounts_ledger_opening_balance SET balance='$balance',modified_by='$user',
	modified_on=NOW() WHERE date='$date' and ledger_code='$ledger'";
	
	$up = $con->prepare($sql);	
	if($up->execute())
	{
		echo 1;
	}
	else
	{
		echo 2;
		print_r($up->errorInfo());
	}
}

?>