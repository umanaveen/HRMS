<?php
require '../../../connect.php';
include("../../../user.php");
$userid=$_SESSION['userid'];
?>
<?php
if(isset($_REQUEST['submit']))
{
	$department=$_REQUEST['department'];
	$sim_id=$_REQUEST['phone_no'];
	$status=$_REQUEST['status'];
	$sql=$con->query("insert into sim_mapping(sim_id,department_id,status,created_by,created_on)values('$sim_id','$department','$status','$userid',now())");
	echo "insert into sim_mapping(sim_id,department_id,status,created_by,created_on)values('$sim_id','$department','$status','$userid',now())";
if($sql)
{
	echo "<script>alert(' Inserted Successfully');</script>";
	header("location:/HRMS/index.php");
}
}
?>