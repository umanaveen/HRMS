<?php
require '../../user.php';
require '../../connect.php';

$id=$_REQUEST['id'];
$candidate_names=$_REQUEST['candidate_name'];
$present_ctc=$_REQUEST['cctc'];
$expected_ctc=$_REQUEST['ectc'];  
$ctc_offered=$_REQUEST['ctc_offer'];
$offered_take_home=$_REQUEST['take_home'];
$offered_designation=$_REQUEST['designation'];
$dept_head_approval=$_REQUEST['head_approval'];
$dept_director_approval=$_REQUEST['director_approval'];
$cug=$_REQUEST['cug'];
$mail_id=$_REQUEST['mail'];
$system=$_REQUEST['system'];
$seating=$_REQUEST['seating'];
$status=10;
$userid=1;
$today = date("Y-m-d H:i:s"); 
$query1 = $con->query("INSERT INTO ctc_approval_table(candidate_id,candidate_name, present_ctc, expected_ctc, ctc_offered, offered_take_home, offered_designation, dept_head_approval, dept_director_approval, CUG, mail_id, system, seating, status, created_by, created_on) VALUES ('$id','$candidate_names', '$present_ctc', '$expected_ctc', '$ctc_offered', '$offered_take_home', '$offered_designation', '$dept_head_approval', '$dept_director_approval', '$cug', '$mail_id', '$system', '$seating', '$status', '$userid', '$today')");

$query2=$con->query("update recruiter_details set status_recruiter='$status' where candidate_id='$id'");
$query3=$con->query("update technical_team_details set head_status='$status' where candidate_id='$id'");
$query4=$con->query("update candidate_form_details set status='$status' where id='$id'");

if($query4)
{
	echo 1;
}
else
{
	echo 0;
}
?>