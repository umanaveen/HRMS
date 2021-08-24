<?php
require '../../../connect.php';
include("../../../user.php");
$userid=$_SESSION['userid'];
$name=$_REQUEST['feedback'];
$status=$_REQUEST['status'];
$sql=$con->query("insert into feedback_master (name,status,created_by,created_on) values ('$name','$status','$userid',now())");
//echo "insert into feedback_master (name,status,created_by,created_on) values ('$name','$status','$userid',now())";
if($sql)
{
	echo 0;
}
else
{
	echo 1;
}
?>