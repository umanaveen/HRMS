<?php
require '../../../connect.php';
?>
<?php
if(isset($_REQUEST['submit']))
{
	$jd_tittle=$_REQUEST['jd_tittle'];
	$status=$_REQUEST['status'];
	$sql=$con->query("insert into jobdescription_master(tittle,status,created_by,created_on)values('$jd_tittle','$status','2',now())");
if($sql)
{
	echo "<script>alert(' Inserted Successfully');</script>";
	header("location:/HRMS/index.php");
}
}
?>