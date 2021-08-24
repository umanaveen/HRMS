<?php
require '../../connect.php';
?>
<?php
if(isset($_REQUEST['submit']))
{
	$id=$_REQUEST['id'];
	$name=$_REQUEST['name'];
	$status=$_REQUEST['status'];
	$sql=$con->query("update question_name_master set name='$name',status='$status' where id='$id'");
	//echo "update z_department_master set companyname='$company',status='$status' where id='$id'";
	if($sql)
{
	echo "<script>alert(' Updated Updated');</script>";
	header("location:/HRMS/index.php");
}
}?>
