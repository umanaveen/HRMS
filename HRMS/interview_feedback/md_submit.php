<?php
require '../../connect.php';
include("../../user.php"); 
$candidateid=$_REQUEST['id'];
$user_id=$_REQUEST['user_id'];

$md_recruiter=$_REQUEST['md_recruiter'];
$count=$_REQUEST['count'];
$count_name_count= count($count);
 
for($i=0;$i<$count_name_count;$i++)
{
	
$interviewroundids= $_REQUEST['interviewroundid'.$i];
$intername_ids= $_REQUEST['intername_id'.$i];
$section_names= $_REQUEST['section_name'.$i];
$sql1 = $con->query("INSERT INTO `domain_entries_md`(`candids_id`, `hire_id`, `round_id`, `round_name_id`, `feedback`) VALUES ('$candidateid','$user_id','$interviewroundids','$intername_ids','$section_names')");
echo "INSERT INTO `domain_entries`(`candid_id`, `hire_id`, `round_id`, `round_name_id`, `feedback`) VALUES ('$candidateid','$user_id','$interviewroundids','$intername_ids','$section_names')";

} 

 $sql3= $con->query("Update candidate_form_details set status='$md_recruiter' where id='$candidateid'");

$sql4= $con->query("Update candidate_round_details set status='$md_recruiter' where candid_id='$candidateid' and person_id='$user_id'"); 


?>