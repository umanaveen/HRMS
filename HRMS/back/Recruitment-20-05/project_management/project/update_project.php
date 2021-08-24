<?php
require '../../../../connect.php';
?>
<?php
if(isset($_REQUEST['submit']))
{
	$id=$_REQUEST['id'];
	$client_name=$_REQUEST['client_name'];
	$project_name=$_REQUEST['project_name'];
	$department=$_REQUEST['department'];
	$employee=$_REQUEST['employee'];
	$project_timeline=$_REQUEST['project_timeline'];
		$no_of_working_hours=$_REQUEST['no_of_working_hours'];

	$modules=$_REQUEST['modules'];
	$sql=$con->query("update project set client_name='$client_name',project_name='$project_name',department='$department',employee='$employee',project_timeline='$project_timeline',no_of_working_hours='$no_of_working_hours',modules='$modules' where id='$id'");
	
	echo "update project set client_name='$client_name',project_name='$project_name',department='$department',employee='$employee',project_timeline='$project_timeline',no_of_working_hours='$no_of_working_hours',modules='$modules' where id='$id'";
	
	if($sql)
{
	echo "<script>alert(' Updated Updated');</script>";
	header("location:/HRMS/index.php");
}
}?>
