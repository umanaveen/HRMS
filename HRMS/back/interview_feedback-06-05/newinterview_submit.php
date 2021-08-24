<?php
require '../../connect.php';
include("../../user.php");
//echo "<pre>";print_r($_POST);exit();
if(isset($_POST['submit']))
{
$candidatename=$_REQUEST['id'];


$position=$_REQUEST['position'];
$tech_department=$_REQUEST['tech_department']; // emp no 
$replacement=$_REQUEST['replacements'];
//$new_candidate=$_REQUEST['new_candidate'];
$replaced_name=$_REQUEST['replaced_name'];
//$new_name=$_REQUEST['new_name'];
/*if($replacement == 'new')
{

}
else if($replacement == 'replace')
{

}*/
$site=$_REQUEST['site'];
$Reason_leave=$_REQUEST['Reason_leave'];
$reference=$_REQUEST['reference'];
$tot_year_exp=$_REQUEST['tot_year_exp'];
$current_ctc=$_REQUEST['current_ctc'];
$exp_ctc=$_REQUEST['exp_ctc'];
$notice_period=$_REQUEST['notice_period'];
$date_of_join=date("Y-m-d",strtotime($_REQUEST['date_of_join']));
$recruiter_name=$_REQUEST['recruiter_name'];
$ratings=$_REQUEST['ratings'];
$remarks=$_REQUEST['remarks'];
$status_recruiter=$_REQUEST['status_recruiter'];
$technical_department=$_REQUEST['tech_department'];
//$tech_dept_ass=$_REQUEST['tech_dept_ass'];
//$created_by = 2;
$recruiter_question=$_REQUEST['recruiter_question'];
$count_recruiter_question= count($recruiter_question);
//$performance=$_REQUEST['performance'];
$recruiter_answer=$_REQUEST['recruiter_answer'];
 $count_recruiter_answer= count($recruiter_answer);
//echo "<pre>";print_r($performance);
$tech_dept_per=$_REQUEST['tech_dept_per'];

if($_REQUEST['replacements']=='new'){

    $sql=$con->query("insert into recruiter_details(candidate_id,position,tech_department,replacement,site,reason_leave,reference,tot_year_exp,current_ctc,exp_ctc,notice_period,date_of_join,recruiter_name,ratings,remarks,status_recruiter,command_technical_person) values('$candidatename','$position','$tech_department','$replacement','$site','$Reason_leave','$reference','$tot_year_exp','$current_ctc','$exp_ctc','$notice_period','$date_of_join','$recruiter_name','$ratings','$remarks','$status_recruiter','$command_technical_person')"); 
	
	echo "insert into recruiter_details(candidate_id,position,tech_department,replacement,site,reason_leave,reference,tot_year_exp,current_ctc,exp_ctc,notice_period,date_of_join,recruiter_name,ratings,remarks,status_recruiter,command_technical_person) values('$candidatename','$position','$tech_department','$replacement','$site','$Reason_leave','$reference','$tot_year_exp','$current_ctc','$exp_ctc','$notice_period','$date_of_join','$recruiter_name','$ratings','$remarks','$status_recruiter','$command_technical_person')";
	
	
}
else {
    $sql=$con->query("insert into recruiter_details(candidate_id,position,tech_department,replacement,replaced_name,site,reason_leave,reference,tot_year_exp,current_ctc,exp_ctc,notice_period,date_of_join,recruiter_name,ratings,remarks,status_recruiter,command_technical_person) 
    values('$candidatename','$position','$tech_department','$replacement','$replaced_name','$site','$Reason_leave','$reference','$tot_year_exp','$current_ctc','$exp_ctc','$notice_period','$date_of_join','$recruiter_name','$ratings','$remarks','$status_recruiter')");  
	
	echo "insert into recruiter_details(candidate_id,position,tech_department,replacement,replaced_name,site,reason_leave,reference,tot_year_exp,current_ctc,exp_ctc,notice_period,date_of_join,recruiter_name,ratings,remarks,status_recruiter,command_technical_person) 
    values('$candidatename','$position','$tech_department','$replacement','$replaced_name','$site','$Reason_leave','$reference','$tot_year_exp','$current_ctc','$exp_ctc','$notice_period','$date_of_join','$recruiter_name','$ratings','$remarks','$status_recruiter')";
}

 for($i=0;$i<$count_recruiter_question;$i++)
{
 $res="performance_$i";
$performance= $_REQUEST[$res];
$que = $recruiter_question[$i];
$answer= $recruiter_answer[$i];


$sql1=$con->query("insert into recruiter_commands(candidate_id,skill_question,rating,response,technical_department,tech_dept_per,created_by,created_on) values('$candidatename','$que','$performance','$answer','$tech_dept_per')");

echo "insert into recruiter_commands(candidate_id,skill_question,rating,response,technical_department,tech_dept_per,created_by,created_on) values('$candidatename','$que','$performance','$answer','$tech_dept_per')";
}  
//echo "<pre>";print_r($sql);exit();
if($status_recruiter == 0)
{
	$updateStatus =0;
	
}
else if($status_recruiter == 1)
{
	$updateStatus =1;
}
else if($status_recruiter == 3)
{
	$updateStatus =3;
} 
if($sql)
{
    echo "<script>alert(' successfully Updated');</script>";
    
}
$sql2= $con->query("Update candidate_form_details set status='$updateStatus' where id='$candidatename'");
	header("location:/HRMS/index.php");
}
?>

