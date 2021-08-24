<?php
require '../../../../connect.php';
?>
<?php
if(isset($_REQUEST['submit']))
{
	$client_name=$_REQUEST['client_name'];
	$project_name=$_REQUEST['project_name'];
	$department=$_REQUEST['department'];
	$employee=$_REQUEST['employee'];
	$project_timeline=$_REQUEST['project_timeline'];
	$no_of_working_hours=$_REQUEST['no_of_working_hours'];
		$modules=$_REQUEST['modules'];

	$sql=$con->query("insert into project(client_name,project_name,department,employee,project_timeline,no_of_working_hours,modules)values('$client_name','$project_name','$department','$employee','$project_timeline','$no_of_working_hours','$modules')");
	
	echo "insert into project(client_name,project_name,department,employee,project_timeline,no_of_working_hours,modules)values('$client_name','$project_name','$department','$employee','$project_timeline','$no_of_working_hours','$modules')";
if($sql)
{
	echo "<script>alert(' Inserted Updated');</script>";
	header("location:/HRMS/index.php");
}
}
?>