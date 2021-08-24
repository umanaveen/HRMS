<?php 
require '../../../connect.php';
require '../../../user.php';
$user=$_SESSION['userid'];
$candidateid=$_SESSION['candidateid'];


$confirm=$_REQUEST['confirm'];
$remarks=$_REQUEST['remarks'];
$cid=$_REQUEST['cid'];
$resignid=$_REQUEST['resignid'];
if($confirm=="Yes")
{
	$status=4;
}
else
{
	$status=5;
}

$upd=$con->query("update resignation_form_details set hr_accept_status='$confirm',hr_rejoin_remark='$remarks',status='$status' where id='$resignid'");
// echo "update resignation_form_details set hr_accept_status='$confirm',hr_rejoin_remark='$remarks',status='$status' where id='$resignid'"; 
if($upd)
{
	echo 1;
}
else
{
	echo 0;
}
?>