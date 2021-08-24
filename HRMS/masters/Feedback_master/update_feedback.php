<?php
require '../../../connect.php';
include("../../../user.php");
$userid=$_SESSION['userid'];
$fid=$_REQUEST['id'];
$name=$_REQUEST['feedback'];
$status=$_REQUEST['status'];
$sql=$con->query("update feedback_master set name='$name',status='$status',modified_by='$userid',modified_on=now() where id='$fid'");
//echo "update feedback_master set name='$name',status='$status',modified_by='$userid',modified_on=now() where id='$fid'";
if($sql)
{
	echo 1;
}
else
{
	echo 0;
}
?>