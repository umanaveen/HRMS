<?php 
require '../../connect.php';
include("../../user.php");
$userrole=$_SESSION['userrole'];
$candidateid=$_REQUEST['cid'];
$staff_type=$_REQUEST['staff_type'];
$supdate=$con->query("update candidate_form_details set staff_type='$staff_type',status='23' where id='$candidateid'");

if($supdate)
{
	echo 1;
	
}
else
{
	echo 0;
}
?>