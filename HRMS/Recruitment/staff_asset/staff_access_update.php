<?php
require '../../../connect.php';
$aid=$_REQUEST['aid'];
$emp_name=$_REQUEST['emp_name'];
$new_access=$_REQUEST['View'];
$status=$_REQUEST['status'];
$cug=$_REQUEST['cug'];
$access=implode(",",$new_access);

$upd=$con->query("update staff_access_request set asset_master_id='$access',cug_status='$cug',status='$status' where id='$aid'");
//echo "update staff_access_list set access='$access',status='$status' where id='$aid'";
if($upd)
{
	echo "<script>alert(' Inserted Updated');</script>";
	header("location:/HRMS/index.php");
}
?>