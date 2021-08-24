<?php
require '../../../connect.php';
include("../../../user.php");
$userrole=$_SESSION['userrole'];

$reqid=$_REQUEST['reqid'];
$cugsta=$_REQUEST['cugsta'];

$simid=$_REQUEST['simid'];
$assets=$_REQUEST['View'];
//print_r($assets);
$count=count($assets);
for($i=0;$i<$count;$i++)
{
	$assetid=$assets[$i];
$upd=$con->query("update staff_asset_list set status=3 where asset_request_id='$reqid' and asset_id='$assetid'");
	$asset_form=$con->query("update assets_form_detail set status=1 where id='$assetid'");
//echo "update staff_asset_list set status=2 where asset_request_id='$reqid' and asset_id='$assetid'";
}

if($asset_form)
{
	echo "<script>alert(' Updated Successfully');</script>";
	header("location:/HRMS/index.php");
}
?>