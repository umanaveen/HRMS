<?php
require '../../../../connect.php';
?>
<?php
if(isset($_REQUEST['submit']))
{
		$client_name=$_REQUEST['client_name'];
	$project_name=$_REQUEST['project_name'];

	$modules=$_REQUEST['modules'];
	$employees=$_REQUEST['employees'];
	$no_of_working_hours=$_REQUEST['no_of_working_hours'];
	$date=$_REQUEST['date'];
	$sql=$con->query("insert into project_timeline(client_name,project_name,modules,employees,no_of_working_hours,date)values('$client_name','$project_name','$modules','$employees','$no_of_working_hours','$date')");
	
	echo "insert into project_timeline(client_name,project_name,modules,employees,no_of_working_hours,date)values('$client_name','$project_name','$modules','$employees','$no_of_working_hours','$date')";
if($sql)
{
	echo "<script>alert(' Inserted Updated');</script>";
	header("location:/HRMS/index.php");
}
}
?>