<?php
require '../../connect.php';
$id=$_REQUEST['payroll_master_id'];
$status=3;
$sql2= $con->query("Update payroll_master set flag='$status' where id='$id'");
	//echo "Update payroll_master set flag='$status' where id='$id'";
	
?>


