<?php
require '../../../connect.php';
include("../../../user.php");

//echo "<pre>";print_r($candidate_id);exit();
 $id=$_REQUEST['get_id'];
$name=$_REQUEST['name'];


	$sql2= $con->query("Update calls_master set name='$name' where id='$id'");
	
	
	?>