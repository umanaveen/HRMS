<?php
require '../../../connect.php';
?>
<?php
if(isset($_REQUEST['submit']))
{
	$asset=$_REQUEST['asset'];
	
	$sql=$con->query("insert into staff_asset_master(asset,created_by,created_on)values('$asset','2',now())");
	
	echo "insert into staff_asset_master(asset,created_by,created_on)values('$asset','2',now())";
if($sql)
{
	echo "<script>alert(' Inserted Updated');</script>";
	header("location:/HRMS/index.php");
}
}
?>