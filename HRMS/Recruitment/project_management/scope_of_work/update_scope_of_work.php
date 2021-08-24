<?php
require '../../../../connect.php';

if(isset($_POST['submit']))
{
	$id=$_POST['pro_id'];
	$scope_of_project=$_POST['scope_of_project'];

	$sql=$con->query("update project_management set scope_of_project='$scope_of_project' where project_id='$id'");
		
	if($sql)
{
	echo "<script>alert(' Updated Updated');</script>";
	header("location:/HRMS/index.php");
}
}?>