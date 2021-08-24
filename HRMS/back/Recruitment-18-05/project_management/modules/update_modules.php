<?php
require '../../../../connect.php';
?>
<?php
if(isset($_REQUEST['submit']))
{
	$id=$_REQUEST['id'];
	$client=$_REQUEST['client'];
			$date=$_REQUEST['date'];

	$project=$_REQUEST['project'];
	$module=$_REQUEST['module'];
	$no_of_working_hours=$_REQUEST['no_of_working_hours'];
	$remarks=$_REQUEST['remarks'];
	$status=$_REQUEST['status'];

	$reason=$_REQUEST['reason'];
	$sql=$con->query("update modules set client='$client',date='$date',project='$project',module='$module',no_of_working_hours='$no_of_working_hours',remarks='$remarks',status='$status',reason='$reason' where id='$id'");
	
	echo "update modules set client='$client',date='$date',project='$project',module='$module',no_of_working_hours='$no_of_working_hours',remarks='$remarks',status='$status',reason='$reason' where id='$id'";
	
	if($sql)
{
	echo "<script>alert(' Updated Updated');</script>";
	header("location:/HRMS/index.php");
}
}?>
