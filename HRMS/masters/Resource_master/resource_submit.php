<?php
require '../../../connect.php';
include("../../../user.php");
$userid=$_SESSION['userid'];
$name=$_REQUEST['resource'];
$status=$_REQUEST['status'];
$sql=$con->query("insert into source_master (name,status,created_by,created_on) values ('$name','$status','$userid',now())");
if($sql)
{
	echo 0;
}
else
{
	echo 1;
}
?>