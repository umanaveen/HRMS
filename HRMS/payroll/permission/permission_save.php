<?php
require ("../../configuration.php");

$employee_type=$_REQUEST['employee_type'];
$emp_code=$_REQUEST['emp_code'];
$permission_date=$_REQUEST['permission_date'];
$from_time=$_REQUEST['from_time'];
$to_time=$_REQUEST['to_time'];


$sql11=$con->query("INSERT INTO `employee_permission_master`(`employee_type`, `emp_code`, `permission_date`, `from_time`, `to_time`, `approve_status`, `created_by`, `created_on`) VALUES('$employee_type','$emp_code','$permission_date','$from_time','$to_time','1','1',now())");
?>
