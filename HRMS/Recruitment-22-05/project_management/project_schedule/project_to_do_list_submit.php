<?php
require '../../../../connect.php';
?>
<?php
if(isset($_REQUEST['submit']))
{
	$project_name=$_REQUEST['project_name'];

	$employees=$_REQUEST['employees'];
	$sql=$con->query("insert into project_schedule(project_name,employees)values('$project_name','$employees')");
	
	echo "insert into project_schedule(project_name,employees)values('$project_name','$employees')";
if($sql)
{
	echo "<script>alert(' Inserted Updated');</script>";
	header("location:/HRMS/index.php");
}
}
?>