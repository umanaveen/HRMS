<?php
require '../../connect.php';
include("../../user.php");
$userrole=$_SESSION['userrole'];
$candidateid=$_REQUEST['id'];
$ins=$con->query("update candidate_form_details set status='18' where id='$candidateid'");
if($ins)
{
	echo 0;
}
else
{
	echo 1;
}
?>