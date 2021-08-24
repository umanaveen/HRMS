<?php
require '../../connect.php';
?>
<?php
if(isset($_REQUEST['submit']))
{
	$section=$_REQUEST['section'];
	$status=$_REQUEST['status'];
	$sql=$con->query("insert into section_master(name,status,created_by,created_on)values('$section','$status','2',now())");
	
if($sql)
{
	echo "<script>alert(' Inserted Updated');</script>";
	header("location:/HRMS/index.php");
}
}
?>