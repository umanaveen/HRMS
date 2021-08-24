<?php
require '../../connect.php';
include("../../user.php"); 
$candidateid=$_REQUEST['id'];
$user_id=$_REQUEST['user_id'];
$remarks_md=$_REQUEST['remarks_md'];
$md_recruiter=$_REQUEST['md_recruiter'];
$status=1;
$date=date('Y-m-d');
$userid=$_SESSION['userid'];
 $query=$con->query("update md_commands set  md_commands='$remarks_md', md_status='$md_recruiter', status='$status', modified_by='$userid', modified_on='$date' where candidate_id='$candidateid'");
 /* 
echo "update md_commands set  md_commands='$remarks_md', md_status='$md_recruiter', status='$status', modified_by='$userid', modified_on='$date' where candidate_id='$candidateid'"; */
$sql2= $con->query("Update technical_team_details set head_status='$md_recruiter' where candidate_id='$candidateid'");

$sql1= $con->query("Update final_technical_team_details set status_recruiter='$md_recruiter' where candidate_id='$candidateid'");

$sql3= $con->query("Update candidate_form_details set status='$md_recruiter' where id='$candidateid'");
//$sql4= $con->query("Update ctc_approval_table set status='$md_recruiter' where candidate_id='$candidateid'");
$sql4= $con->query("Update candidate_round_details set status='$md_recruiter' where candid_id='$candidateid' and person_id='$user_id'");
/* echo "Update candidate_round_details set status='$md_recruiter' where candid_id='$candidateid' and person_id='$user_id'"; */
if($sql4)
{
    echo "<script>alert('Successfully Updated');</script>";
    header("location:/HRMS/index.php");
}
?>