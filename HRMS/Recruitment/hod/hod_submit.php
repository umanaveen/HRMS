<?php
require '../../../connect.php';
?>
<?php
if(isset($_REQUEST['submit']))
{
	$dept_name=$_REQUEST['dept_name'];
	$emp_name=$_REQUEST['emp_name'];
	$asset=$_REQUEST['asset'];
	$mail_id=$_REQUEST['mail_id'];
	$others=$_REQUEST['others'];
	$sql=$con->query("insert into hod(dept_name,emp_name,asset,mail_id,others,created_by,created_on)values('$dept_name','$emp_name','$asset','$mail_id','$others','2',now())");
	
	echo "insert into hod(dept_name,emp_name,asset,,mail_id,others,created_by,created_on)values('$dept_name','$emp_name','$asset','$mail_id','$others','2',now())";
if($sql)
{
	echo "<script>alert(' Inserted Updated');</script>";
	header("location:/HRMS/index.php");
}
}
?>