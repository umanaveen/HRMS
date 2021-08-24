<?php
require '../../../connect.php';
include("../../../user.php");
$userid=$_SESSION['userid'];
?>
<?php
if(isset($_REQUEST['submit']))
{
	$provider_name=$_REQUEST['provider_name'];
	$phone_no=$_REQUEST['phone_no'];
	$activation_date=$_REQUEST['activation_date'];
	$status=$_REQUEST['status'];
	$sql=$con->query("insert into sim_master(provider_name,phone_no,activation_date,status,created_by,created_on)values('$provider_name','$phone_no','$activation_date','$status','$userid',now())");
if($sql)
{
	echo "<script>alert(' Inserted Successfully');</script>";
	header("location:/HRMS/index.php");
}
}
?>