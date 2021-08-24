<?php
require '../../../../connect.php';
?>
<?php
if(isset($_REQUEST['submit']))
{
	$client=$_REQUEST['client'];
	$date=$_REQUEST['date'];
		$project=$_REQUEST['project'];
	$module=$_REQUEST['module'];

	$no_of_working_hours=$_REQUEST['no_of_working_hours'];
	$remarks=$_REQUEST['remarks'];
		$status=$_REQUEST['status'];
	$reason=$_REQUEST['reason'];

	$sql=$con->query("insert into modules(client,date,project,module,no_of_working_hours,remarks,status,reason)values('$client','$date','$project','$module','$no_of_working_hours','$remarks','$status','$reason')");
	
	echo "insert into modules(client,date,project,module,no_of_working_hours,remarks,status,reason)values('$client','$date','$project','$module','$no_of_working_hours','$remarks','$status','$reason')";
if($sql)
{
	echo "<script>alert(' Inserted Updated');</script>";
	header("location:/HRMS/index.php");
}
}
?>