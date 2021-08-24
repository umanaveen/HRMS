<?php
require '../../connect.php';
include("../../user.php");

if(isset($_POST['submit']))
{
$candidatename=$_REQUEST['id'];
//echo $candidatename;
$command_technical_person=$_REQUEST['command_technical_person'];
$rating=$_REQUEST['rating']; 
$recruiter_name=$_REQUEST['recruiter_name'];
$status_recruiter=$_REQUEST['status_recruiter'];
$technical_question=$_REQUEST['technical_question'];
$technical_question1=$_REQUEST['technical_question1'];

$count_technical_question= count($technical_question);

//$performance=$_REQUEST['performance'];
$technical_answer=$_REQUEST['technical_answer'];
 $count_technical_answer= count($technical_answer);

//echo "<pre>";print_r($performance);



    $sql=$con->query("insert into final_technical_team_details(candidate_id,head_name,rating,remarks,head_status) values('$candidatename','$command_technical_person','$rating','$recruiter_name','$status_recruiter')"); 


for($i=0;$i<$count_technical_question;$i++)
{
 $res="performance_$i";
$performance= $_REQUEST[$res];
 
$que = $technical_question[$i];
$answer= $technical_answer[$i];


$sql1=$con->query("insert into  final_technical_team_commands(technical_id,skill,rating,response) values('$candidatename','$que','$performance','$answer')");
}  
/* 
if($status_recruiter == 4)
{
	$update_status=4;
}
else if($status_recruiter == 6)
{
	$update_status=6;
}
else if($status_recruiter == 5)
{
	$update_status=5;
} */
$sql2 = $con->query("Update candidate_round_details set status='$status_recruiter' where candid_id='$candidatename'");
$sql12 = $con->query("Update technical_team_details set head_status='$status_recruiter' where candidate_id='$candidatename'");
$sql3 = $con->query("Update candidate_form_details set status='$status_recruiter' where id='$candidatename'");
//echo "Update candidate_form_details set status='$update_status' where id='$candidatename'";
if($sql)
{
    echo "<script>alert('successfully Updated');</script>";
    
}

	header("location:/HRMS/index.php");
}
?>

