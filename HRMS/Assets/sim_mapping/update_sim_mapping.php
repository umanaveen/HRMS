<?php
require '../../../connect.php';
?>
<?php
if(isset($_REQUEST['submit']))
{
	$id=$_REQUEST['sid'];
	$department=$_REQUEST['department'];
	$sim_id=$_REQUEST['phone_no'];
	$status=$_REQUEST['status'];
	$sql=$con->query("update sim_mapping set sim_id='$sim_id',department_id='$department',status='$status' where id='$id'");
	//echo "update sim_mapping set sim_id='$sim_id',department_id='$department',status='$status' where id='$id'";
{
	echo "<script>alert(' Updated Successfully');</script>";
	header("location:/HRMS/index.php");
}
}?>
