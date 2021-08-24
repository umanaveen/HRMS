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
$upd=$con->query("update staff_asset_list set status=2 where asset_request_id='$reqid' and asset_id='$assetid'");
//echo "update staff_asset_list set status=2 where asset_request_id='$reqid' and asset_id='$assetid'";
}
if($cugsta=='Yes')
{
	$sim=$con->query("update sim_mapping set status=1 where id='$simid'");
	echo "update sim_mapping set status=1 where id='$simid'";
}
if($upd)
{
	echo "<script>alert(' Updated Successfully');</script>";
	header("location:/HRMS/index.php");
}
?>