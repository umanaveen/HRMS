<?php
//require '../../user.php';
require '../../connect.php';

 $id=$_REQUEST['sid'];

$year=$_REQUEST['Year'];
$date=$_REQUEST['date'];
$holiday_name=$_REQUEST['holiday_name'];
if($_REQUEST['status']==1)
{
	$status = 1;
}
else
{
	$status = 2;
}



 $sql=$con->query("Update holiday_master set year='$year',leave_date='$date',leave_name='$holiday_name',status='$status'  where id='$id'");
 
 
 
 

?>