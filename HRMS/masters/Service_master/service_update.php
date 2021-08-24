<?php
require '../../../connect.php';
include("../../../user.php");

//echo "<pre>";print_r($candidate_id);exit();
 $id=$_REQUEST['get_id'];
$service_name=$_REQUEST['service_name'];


	$sql2= $con->query("Update service_master set service_name='$service_name' where service_id='$id'");
	
	
	?>