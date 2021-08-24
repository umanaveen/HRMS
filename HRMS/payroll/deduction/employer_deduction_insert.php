<?php

require '../../../connect.php';
$name=$_REQUEST['name'];
$from_date=date('Y-m-d',strtotime($_REQUEST['from_date']));
$amount=$_REQUEST['amount'];
$percentage=$_REQUEST['percentage'];
$min_amount=$_REQUEST['min_amount'];
$max_amount=$_REQUEST['max_amount'];


$amount = !empty($amount) ? "'$amount'" : "NULL";
$percentage = !empty($percentage) ? "'$percentage'" : "NULL";
$min_amount = !empty($min_amount) ? "'$min_amount'" : "NULL";
$max_amount = !empty($max_amount) ? "'$max_amount'" : "NULL";


$now=date('Y-m-d');
$status="1";
 

$statement = $con->query("INSERT INTO payroll_employer_deduction_master(name,from_date,amount,percentage,min_amount,max_amount,status,created_by,created_on,modified_by,modified_on)
    VALUES ('$name','$from_date',$amount,$percentage,$min_amount,$max_amount,'$status','1','$now','1','$now')");	

?>