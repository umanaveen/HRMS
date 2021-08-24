<?php 
require '../../../connect.php';
require '../../../user.php';
$candidateid=$_SESSION['candidateid'];
$qid=$_REQUEST['id'];
$sel=$con->query("update quote_generate set marketing_status='1',marketing_approved_by='$candidateid' where id='$qid'");
//echo "update quote_generate set finance_status='1',finance_approved_by='$candidateid' where id='$qid'";
if($sel)
{
	echo 1;
}
else
{
	echo 0;
}
?>