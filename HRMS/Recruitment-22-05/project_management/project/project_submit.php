<?php
require '../../../../connect.php';
?>
<?php
if(isset($_REQUEST['submit']))
{
	$client_name=$_REQUEST['client_name'];
	$project_name=$_REQUEST['project_name'];
	$department_id=$_REQUEST['department_id'];
	$employee=$_REQUEST['employee'];
	$project_timeline=$_REQUEST['project_timeline'];
	$no_of_working_hours=$_REQUEST['no_of_working_hours'];
		$modules=$_REQUEST['modules'];
	$no_of_working_hours1=$_REQUEST['no_of_working_hours1'];

	$sql=$con->query("insert into project(client_name,project_name,department,employee,project_timeline,no_of_working_hours,modules,no_of_working_hours1)values('$client_name','$project_name','$department','$employee','$project_timeline','$no_of_working_hours','$modules','$no_of_working_hours1')");
	
	echo "insert into project(client_name,project_name,department,employee,project_timeline,no_of_working_hours,modules,no_of_working_hours1)values('$client_name','$project_name','$department','$employee','$project_timeline','$no_of_working_hours','$modules',	'$no_of_working_hours1')";
if($sql)
{
	echo "<script>alert(' Inserted Updated');</script>";
	header("location:/HRMS/index.php");
}
}
?>