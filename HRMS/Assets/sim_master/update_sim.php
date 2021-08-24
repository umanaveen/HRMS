<?php
require '../../../connect.php';
?>
<?php
if(isset($_REQUEST['submit']))
{
	$id=$_REQUEST['sid'];
	$provider_name=$_REQUEST['provider_name'];
	$phone_no=$_REQUEST['phone_no'];
	$activation_date=$_REQUEST['activation_date'];
	$status=$_REQUEST['status'];
	$sql=$con->query("update sim_master set provider_name='$provider_name',phone_no='$phone_no',activation_date='$activation_date',status='$status' where id='$id'");
	echo "update sim_master set provider_name='$provider_name',phone_no='$phone_no',activation_date='$activation_date',status='$status' where id='$id'";
	if($sql)
{
	echo "<script>alert(' Updated Successfully');</script>";
	header("location:/HRMS/index.php");
}
}?>
