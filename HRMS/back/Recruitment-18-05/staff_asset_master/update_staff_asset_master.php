<?php
require '../../../connect.php';
?>
<?php
if(isset($_REQUEST['submit']))
{
	$id=$_REQUEST['id'];
	$asset=$_REQUEST['asset'];
	echo "iii". $asset=$_REQUEST['asset'];
	$sql=$con->query("update staff_asset_master set asset='$asset' where id='$id'");
	
	echo "update staff_asset_master set asset='$asset' where id='$id'";
	
	if($sql)
{
	echo "<script>alert(' Updated Updated');</script>";
	header("location:/HRMS/index.php");
}
}?>
