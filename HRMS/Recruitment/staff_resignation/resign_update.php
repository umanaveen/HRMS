<?php 
require '../../../connect.php';
require '../../../user.php';
$user=$_SESSION['userid'];
$candidateid=$_SESSION['candidateid'];

$reason=$_REQUEST['reason'];
$notice_period=$_REQUEST['notice_period'];
$projects=$_REQUEST['projects'];
$confirm=$_REQUEST['confirm'];
$remarks=$_REQUEST['remarks'];
$cid=$_REQUEST['cid'];
$resignid=$_REQUEST['resignid'];
if($confirm=="Yes")
{
	$status=2;
}
else
{
	$status=3;
}

$upd=$con->query("update resignation_form_details set hod_reason='$reason',notice_period='$notice_period',handling_projects='$projects',hod_accept_status='$confirm',hod_rejoin_remark='$remarks',hod='$candidateid',status='$status' where id='$resignid'");
/* echo "update resignation_form_details set hod_reason='$reason',notice_period='$notice_period',handling_projects='$projects',accept_status='$confirm',hod_rejoin_remark='$remarks',hod='$candidateid' where id='$resignid'"; */
if($upd)
{
	echo 1;
}
else
{
	echo 0;
}
?>