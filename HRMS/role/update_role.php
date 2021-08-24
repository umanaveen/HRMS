<?php
require '../../connect.php';

	$id=$_REQUEST['get_id'];
	$Code=$_REQUEST['Code'];
	$name=$_REQUEST['name'];
	$sql=$con->query("update z_role_detail set code='$Code',role_name='$name' where id='$id'");
	echo "update z_role_detail set code='$Code',role_name='$name' where id='$id'";
	

?>
