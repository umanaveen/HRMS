<?php
require '../../connect.php';
include("../../user.php");
$userrole=$_SESSION['userrole'];
$userid=$_SESSION['userid'];

$wid=$_REQUEST['wid'];
$emp_name=$_REQUEST['emp_name'];
$week1=$_REQUEST['week1'];
$week2=$_REQUEST['week2'];
$week3=$_REQUEST['week3'];
$week4=$_REQUEST['week4'];

if($week1!='')
{
	$ins=$con->query("insert into weekly_review(staff_id,week1,week2,week3,week4,status,created_by,created_on) values('$emp_name','$week1','$week2','$week3','$week4','1','$userid',now())");
	
	echo "insert into weekly_review(staff_id,week1,week2,week3,week4,status,created_by,created_on) values('$emp_name','$week1','$week2','$week3','$week4','1','$userid',now())";
}
else
{
	$upd=$con->query("update weekly_review set week1='$week1',week2='week2',week3='week3',week4='week4' where id='$wid' ");
	echo "update weekly_review set week1='$week1',week2='week2',week3='week3',week4='week4' where id='$wid' ";
}


if($ins)
{
	echo "<script>alert(' Inserted Updated');</script>";
	header("location:/HRMS/index.php");
}