<?php
require '../../connect.php';



	$id=$_REQUEST['get_id'];
	$emp_id=$_REQUEST['emp_id'];
	$role=$_REQUEST['code'];
	$user_name=$_REQUEST['user_name'];
	$password=md5($_REQUEST['password']);
	$role_code=$_REQUEST['role_code'];
	
	$sql=$con->query("update user_role_mapping set rolemaster_id='$role' where id='$id'");
	$sql1=$con->query("update z_user_master set user_name='$user_name',password='$password',user_group_code='$role_code' where candidate_id='$emp_id'");
	
	//echo "update z_user_master set user_name='$user_name',password='$password', where candidate_id='$emp_id'";
	

?>
