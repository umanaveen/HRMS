<?php
require '../../../connect.php';
?>
<?php
if(isset($_REQUEST['submit']))
{
	$asset_name=$_REQUEST['asset_name'];
	$asset_type=$_REQUEST['asset_type'];
	$prefix_code=$_REQUEST['prefix_code'];
	$status=$_REQUEST['status'];
	$sql=$con->query("insert into assets_master(name,type,prefix_code,status,created_on)values('$asset_name','$asset_type','$prefix_code','$status',now())");
	echo "insert into assets_master(name,status,created_on)values('$asset_name','$status',now())";
if($sql)
{
	echo "<script>alert(' Inserted Successfully');</script>";
	header("location:/HRMS/index.php");
}
}
?>