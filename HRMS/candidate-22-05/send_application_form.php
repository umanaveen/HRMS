<?php

require '../../connect.php';
include("../../user.php");
$userrole=$_SESSION['userrole'];
$candidateid=$_REQUEST['id'];

$upd=$con->query("update z_user_master set user_group_code='ROLE-013' where candidate_id='$candidateid' and user_group_code='ROLE-011'");
/* echo "update z_user_master set user_group_code='ROLE-013' where candidate_id='$candidateid' and status='16'"; */
$ins=$con->query("update candidate_form_details set status='19' where id='$candidateid'");
//echo "update candidate_form_details set status='19' where id='$candidateid'";
if($ins)
{
	echo 0;
}
else
{
	echo 1;
}
?>
