<?php
require '../../../../connect.php';
?>
<?php
if(isset($_REQUEST['submit']))
{
	$client=$_REQUEST['client'];
	$project_name=$_REQUEST['project_name'];
	$modules=$_REQUEST['modules'];
	$employees=$_REQUEST['employees'];
	$no_of_working_hours=$_REQUEST['no_of_working_hours'];
		$date=$_REQUEST['date'];
		$status=$_REQUEST['status'];

	$sql=$con->query("insert into project_schedule(client,project_name,modules,employees,no_of_working_hours,date)values('$client','$project_name','$modules','$employees','$no_of_working_hours','$date')");
	
	echo "insert into project_schedule(client,project_name,modules,employees,no_of_working_hours,date)values('$client','$project_name','$modules','$employees','$no_of_working_hours','$date')";
if($sql)
{
	echo "<script>alert(' Inserted Updated');</script>";
	header("location:/HRMS/index.php");
}
}
?>