<?php
require '../../../connect.php';

	$round_id=$_REQUEST['round_id'];
	$Department=$_REQUEST['Department'];
	$employee=$_REQUEST['employee'];
	$status=$_REQUEST['status'];
	$sql=$con->query("insert into `interview_rounds_mapping`(`round_id`,`dep`,`person_name`,`status`) values('$round_id','$Department','$employee','$status')");
	

?>