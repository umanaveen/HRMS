<?php

require '../../../connect.php';
$Earnings=$_REQUEST['Earnings'];
$amount=$_REQUEST['amount'];
$percentage=$_REQUEST['percentage'];
$now=date('Y-m-d');
$status="1";
 

$statement = $con->query("INSERT INTO payroll_structure(name, amount, percentage,status, created_by, created_on) 
	VALUES ('$Earnings', '$amount', '$percentage', '$status', '1', '$now')");	

if($statement)
{
	1;
}
else
{
	0;
}

?>