<?php
//require '../../user.php';
require '../../../connect.php';

$id=$_REQUEST['sname'];
$name=$_REQUEST['name'];
$from_date=date('Y-m-d',strtotime($_REQUEST['from_date']));
$amount=$_REQUEST['amount'];
$percentage=$_REQUEST['percentage'];
$min_amount=$_REQUEST['min_amount'];
$max_amount=$_REQUEST['max_amount'];
$status=$_REQUEST['status'];


 $sql=$con->query("Update payroll_deduction_master set name='$name',from_date='$from_date',amount='$amount',percentage='$percentage',min_amount='$min_amount',max_amount='$max_amount',status='$status'  where id='$id'");
 echo "Update payroll_deduction_master set name='$name',from_date='$from_date',amount='$amount',percentage='$percentage',min_amount='$min_amount',max_amount='$max_amount',status='$status'  where id='$id'";
 
 
 



 

?>