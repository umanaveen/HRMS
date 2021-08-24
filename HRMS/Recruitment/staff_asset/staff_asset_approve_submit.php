<?php
require '../../../connect.php';
$reqid=$_REQUEST['reqid'];
$upd=$con->query("update staff_access_request set status=4 where id='$reqid'");
if($upd)
{
	echo "<script>alert('Updated Successfully');</script>";
	header("location:/HRMS/index.php");
}
?>