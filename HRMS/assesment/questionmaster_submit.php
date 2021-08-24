<?php
require '../../connect.php';
?>
<?php
if(isset($_REQUEST['submit']))
{
	$name=$_REQUEST['name'];
	$status=$_REQUEST['status'];
	$sql=$con->query("insert into question_name_master(name,status,created_by,created_on)values('$name','$status','2',now())");
	echo "insert into question_name_master(name,status,created_by,created_on)values('$name','$status','2',now())";
	
if($sql)
{
	echo "<script>alert(' Inserted Updated');</script>";
	header("location:/HRMS/index.php");
}
}
?>