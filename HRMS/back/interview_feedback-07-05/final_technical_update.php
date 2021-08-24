<?php

require '../../connect.php';

$candidate_id=$_REQUEST['id'];
$user_id=$_REQUEST['user_id']; 
//echo "<pre>";print_r($candidate_id);exit();
$status_recruiters=$_REQUEST['status_recruiters'];
 $head_name=$_REQUEST['head_name'];
 $technical_question=$_REQUEST['technical_question'];
 //print_r($technical_question);
$technical_question_count= count($technical_question);
 $technical_answer=$_REQUEST['technical_answer'];
$technical_answer_count= count($technical_answer);
$rating=$_REQUEST['rating'];
$remarks=$_REQUEST['remarks'];

for($i=0;$i<$technical_question_count;$i++)
{
   $id=$_REQUEST['get_ids'.$i];

 $performance=$_REQUEST['performances_'.$i];

$que = $technical_question[$i];
$answer= $technical_answer[$i];
$sql1 = $con->query("Update final_technical_team_commands set skill='$que',rating='$performance',response='$answer' where id='$id'");

//echo "Update technical_team_commands set skill='$que',rating='$performance',response='$answer' where id='$id'";

}  

$sql2= $con->query("Update final_technical_team_details set rating='$rating',remarks='$remarks', head_name='$head_name',head_status='$status_recruiters' where candidate_id='$candidate_id'");
$sql4= $con->query("Update candidate_round_details set status='$status_recruiters' where candid_id='$candidate_id' and person_id='$user_id'");
$sql3= $con->query("Update candidate_form_details set status='$status_recruiters' where id='$candidate_id'");
echo "Update candidate_form_details set status='$status_recruiters' where id='$candidate_id'";


?>