<?php
require '../../../../connect.php';
?>
<?php
if(isset($_REQUEST['submit']))
{
	$id=$_REQUEST['id'];
	$client_name=$_REQUEST['client_name'];
	$project_name=$_REQUEST['project_name'];
	$modules=$_REQUEST['modules'];
	$employees=$_REQUEST['employees'];
	$no_of_working_hours=$_REQUEST['no_of_working_hours'];
		$date=$_REQUEST['date'];

	$modules=$_REQUEST['modules'];
	$sql=$con->query("update project_timeline set client_name='$client_name',project_name='$project_name',modules='$modules',employees='$employees',no_of_working_hours='$no_of_working_hours',date='$date' where id='$id'");
	
	echo "update project_timeline set client_name='$client_name',project_name='$project_name',modules='$modules',employees='$employees',no_of_working_hours='$no_of_working_hours',date='$date' where id='$id'";
	
	if($sql)
{
	echo "<script>alert(' Updated Updated');</script>";
	header("location:/HRMS/index.php");
}
}?>
