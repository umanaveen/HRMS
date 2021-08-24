<?php
require '../../../connect.php';
?>
<?php
if(isset($_REQUEST['submit']))
{
	$id=$_REQUEST['id'];
	$dept_name=$_REQUEST['dept_name'];
	$emp_name=$_REQUEST['emp_name'];
	$asset=$_REQUEST['asset'];
	$mail_id=$_REQUEST['mail_id'];
	$others=$_REQUEST['others'];
	$sql=$con->query("update hod set dept_name='$dept_name',emp_name='$emp_name',asset='$asset',mail_id='$mail_id',others='$others' where id='$id'");
	
	echo "update hod set dept_name='$dept_name',emp_name='$emp_name',asset='$asset',mail_id='$mail_id',others='$others' where id='$id'";
	
	if($sql)
{
	echo "<script>alert(' Updated Updated');</script>";
	header("location:/HRMS/index.php");
}
}?>
