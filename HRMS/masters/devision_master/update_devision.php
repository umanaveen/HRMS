<?php
require '../../../connect.php';
?>
<?php
if(isset($_REQUEST['submit']))
{
	$id=$_REQUEST['id'];
	echo "222". $dep_id=$_REQUEST['dep_id'];
	$div_name=$_REQUEST['div_name'];
	$status=$_REQUEST['status'];
	$sql=$con->query("update division_master set dep_id='$dep_id',div_name='$div_name',status='$status' where id='$id'");
	echo "update division_master set dep_id='$dep_id',div_name='$div_name',status='$status' where id='$id'";
	if($sql)
{
	echo "<script>alert(' Updated Updated');</script>";
	header("location:/HRMS/index.php");
}
}?>
