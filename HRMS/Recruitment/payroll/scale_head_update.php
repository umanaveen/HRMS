<?php
//require '../../user.php';
require '../../connect.php';

 $id=$_REQUEST['sname'];

//$year=$_REQUEST['Year'];
//$date=$_REQUEST['date'];
$scale=$_REQUEST['scale'];
if($_REQUEST['status']==1)
{
	$status = 1;
}
else
{
	$status = 2;
}



 $sql=$con->query("Update payroll_scale_master set name='$scale',status='$status'  where id='$id'");
 echo "Update payroll_scale_master set name='$scale',status='$status'  where id='$id'";
 
 
 

?>