<?php


require '../../../connect.php';
include("../../../user.php");
$candidateid=$_SESSION['candidateid'];
$get_id=$_REQUEST['get_id'];
$password_name=$_REQUEST['password_name'];
$status=$_REQUEST['status'];
	
	$sql=$con->query("update password_master set name='$password_name',status='$status',modified_by=now(),Modified_on='$candidateid' where password_id='$get_id'");
	echo "update password_master set name='$password_name',status='$status',modified_by=now(),Modified_on='$candidateid' where password_id='$get_id'";


?>