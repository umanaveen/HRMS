<?php 
require '../../connect.php';
include("../../user.php");
$userrole=$_SESSION['userrole'];
$candidateid=$_REQUEST['id'];
$reject_remark=$_REQUEST['reject_remark'];
$supdate=$con->query("update candidate_form_details set reject_remark='$reject_remark',status='32' where id='$candidateid'");
echo "update candidate_form_details set reject_remark='$reject_remark',status='32' where id='$candidateid'";
if($supdate)
{
	echo 1;
	
}
else
{
	echo 0;
}
?>