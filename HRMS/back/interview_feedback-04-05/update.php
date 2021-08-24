<?php

require '../../connect.php';

$candidate_id=$_REQUEST['get_ids'];
//echo "<pre>";print_r($candidate_id);exit();
$status_recruiters=$_REQUEST['status_recruiters'];
$recruiter_question=$_REQUEST['recruiter_question'];
$count_recruiter_question= count($recruiter_question);
$recruiter_answer=$_REQUEST['recruiter_answer'];
$count_recruiter_answer= count($recruiter_answer);


for($i=0;$i<$count_recruiter_question;$i++)
{
    $id=$_REQUEST['get_id'.$i];

$performance=$_REQUEST['performance_'.$i];

$que = $recruiter_question[$i];
$answer= $recruiter_answer[$i];
$sql1 = $con->query("Update recruiter_commands set skill_question='$que',rating='$performance',response='$answer' where id='$id'");


} 

$sql2= $con->query("Update recruiter_details set status_recruiter='$status_recruiters' where candidate_id='$candidate_id'");

$sql3= $con->query("Update candidate_form_details set status='$status_recruiters' where id='$candidate_id'");
?>