<?php
require '../../../connect.php';
?>
<?php
if(isset($_REQUEST['submit']))
{
	$id=$_REQUEST['id'];
	echo "222". $dep_id=$_REQUEST['dep_id'];
	$designation_name=$_REQUEST['designation_name'];
	$status=$_REQUEST['status'];
	$sql=$con->query("update designation_master set dep_id='$dep_id',designation_name='$designation_name',status='$status' where id='$id'");
	echo "update designation_master set dep_id='$dep_id',designation_name='$designation_name',status='$status' where id='$id'";
	if($sql)
{
	echo "<script>alert(' Updated Updated');</script>";
	header("location:/HRMS/index.php");
}
}?>
