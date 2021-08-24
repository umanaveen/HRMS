<?php
require '../../../connect.php';
$id=$_REQUEST['earnings_id'];

$isql=$con->query("SELECT id,name, amount, percentage,status FROM payroll_structure where id='$id'");			
$payroll_structure = $isql->fetch(PDO::FETCH_ASSOC);

echo $payroll_structure['amount']."=".$payroll_structure['percentage']."=".$payroll_structure['name'];