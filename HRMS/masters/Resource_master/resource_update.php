<?php
require '../../../connect.php';
include("../../../user.php");
$userid=$_SESSION['userid'];
$rid=$_REQUEST['id'];
$name=$_REQUEST['resource'];
$status=$_REQUEST['status'];
$sql=$con->query("update source_master set name='$name',status='$status',modified_by='$userid',modified_on=now() where id='$rid'");

if($sql)
{
	echo 1;
}
else
{
	echo 0;
}
?>