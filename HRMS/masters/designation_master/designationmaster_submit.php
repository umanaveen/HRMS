<?php
require '../../../connect.php';
?>
<?php
if(isset($_REQUEST['submit']))
{
	$department=$_REQUEST['department'];
	$designation_name=$_REQUEST['designation_name'];
	$status=$_REQUEST['status'];
	$sql=$con->query("insert into designation_master(dep_id,designation_name,status,created_by,created_on,modified_by,modified_on)values('$department','$designation_name','$status','2',now(),'2',now())");
	
	echo "insert into designation_master(dep_id,designation_name,status,created_by,created_on,modified_by,modified_on)values('$department','$designation_name','$status','2',now(),'2',now())";
if($sql)
{
	echo "<script>alert(' Inserted Updated');</script>";
	header("location:/HRMS/index.php");
}
}
?>