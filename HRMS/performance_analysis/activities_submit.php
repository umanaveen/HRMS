<?php
require '../../connect.php';
include("../../user.php");
$candidateid=$_SESSION['candidateid'];

$emp_name=$_REQUEST['emp_name'];
$type=$_REQUEST['type'];
$course=$_REQUEST['course'];
$conducted_by=$_REQUEST['conducted_by'];
$conducted_date=$_REQUEST['conducted_date'];

$ins=$con->query("insert into additional_activities (staff_id,type,course,conducted_by,conducted_on,status,created_by,created_on)values('$emp_name','$type','$course','$conducted_by','$conducted_date',1,'$candidateid',now())");
echo "insert into additional_activities (staff_id,type,course,conducted_by,conducted_on,status,created_by,created_on)values('$emp_name','$type','$course','$conducted_by','$conducted_date',1,'$candidateid',now())";
if($ins)
{
	echo "<script>alert(' Updated Successfully');</script>";
	header("location:/HRMS/index.php");
}
?>