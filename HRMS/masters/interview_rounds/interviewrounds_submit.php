<?php
require '../../../connect.php';


	$name=$_REQUEST['name'];
	

	$status=$_REQUEST['status'];
	$sql=$con->query("INSERT INTO `interview_rounds`(`name`,`status`) VALUES('$name','$status')");
	



?>