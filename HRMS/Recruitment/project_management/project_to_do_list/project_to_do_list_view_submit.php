<?php
require '../../../../connect.php';
$id=$_REQUEST['get_id'];
$ids=$_REQUEST['gets_id'];
$status=$_REQUEST['status'];

$no_of_working_hours1=$_REQUEST['no_of_working_hours1'];
$schedule_hours=$_REQUEST['schedule_hours'];

$sub=$no_of_working_hours1-$schedule_hours;

$sql2= $con->query("Update  project_schedule set status='$status' where id='$id'");
	echo "Update  project_schedule set status='$status' where id='$id'";


 $sql3= $con->query("Update  project_modules set no_of_working_hours1='$sub' where id='$ids'");


echo "Update  project_modules set no_of_working_hours1='$sub' where id='$ids'";


?>