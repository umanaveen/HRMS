<?php 
include('../../../connect.php');
include('../../../user.php');
$userid=$_SESSION['userid'];
$source=$_REQUEST['source'];
$consl_name=$_REQUEST['consl_name'];
$consl_date=$_REQUEST['consl_date'];
$position=$_REQUEST['position'];
$first_name=$_REQUEST['first_name'];
$last_name=$_REQUEST['last_name'];
$gender=$_REQUEST['gender'];
$phone="+91"." ".$_REQUEST['phone'];
$whatsapp="+91"." ".$_REQUEST['whatsapp'];
$mail=$_REQUEST['mail'];
$adharnumber=$_REQUEST['adharnumber'];
$degree=$_REQUEST['degree'];
$university=$_REQUEST['university'];
$year_of_pass=$_REQUEST['year_of_pass'];
$percentage=$_REQUEST['percentage'];
$EmployeeStatus=$_REQUEST['EmployeeStatus'];
$companyname=$_REQUEST['companyname'];
$no_of_year_exp=$_REQUEST['no_of_year'];
$cer_status=$_REQUEST['cer_status'];
$certificate=$_REQUEST['certificate'];
$validity_to=$_REQUEST['validity'];
$cer_from=$_REQUEST['cer_from'];
$status=1;

if($validity_to=="" and $cer_from=="" )
{
	//echo "hii";
	$sql=$con->query("insert into resource_form_detail ( `source`, `consultant_name`, `date`, `position`, `first_name`, `last_name`, `gender`, `mobile`, `whatsapp`,`mail`,`aadhar_no`, `degree`, `university`, `year_of_pass`, `percentage`, `employement_status`, `company_name`, `year_experience`,`certification_status`, `status`, `created_by`, `created_on`)values('$source','$consl_name','$consl_date','$position','$first_name','$last_name','$gender','$phone','$whatsapp','$mail','$adharnumber','$degree','$university','$year_of_pass','$percentage','$EmployeeStatus','$companyname','$no_of_year_exp','$cer_status',1,'$userid',now())");
	/* echo "insert into resource_form_detail ( `source`, `consultant_name`, `date`, `position`, `first_name`, `last_name`, `gender`, `mobile`, `whatsapp`,`mail`,`aadhar_no`, `degree`, `university`, `year_of_pass`, `percentage`, `employement_status`, `company_name`, `year_experience`,`certification_status`, `certification`,  `status`, `created_by`, `created_on`)values('$source','$consl_name','$consl_date','$position','$first_name','$last_name','$gender','$phone','$whatsapp','$mail','$adharnumber','$degree','$university','$year_of_pass','$percentage','$EmployeeStatus','$companyname','$no_of_year_exp','$cer_status',1,'$userid',now())"; */

}
else
{
	//echo "hello";
	$sql=$con->query("insert into resource_form_detail ( `source`, `consultant_name`, `date`, `position`, `first_name`, `last_name`, `gender`, `mobile`, `whatsapp`,`mail`,`aadhar_no`, `degree`, `university`, `year_of_pass`, `percentage`, `employement_status`, `company_name`, `year_experience`,`certification_status`, `certification`, `validity`, `certified_from`, `status`, `created_by`, `created_on`)values('$source','$consl_name','$consl_date','$position','$first_name','$last_name','$gender','$phone','$whatsapp','$mail','$adharnumber','$degree','$university','$year_of_pass','$percentage','$EmployeeStatus','$companyname','$no_of_year_exp','$cer_status','$certificate','$validity_to','$cer_from',1,'$userid',now())");

/* echo "insert into resource_form_detail ( `source`, `consultant_name`, `date`, `position`, `first_name`, `last_name`, `gender`, `mobile`, `whatsapp`,`mail`,`aadhar_no`, `degree`, `university`, `year_of_pass`, `percentage`, `employement_status`, `company_name`, `year_experience`,`certification_status`, `certification`, `validity`, `certified_from`, `status`, `created_by`, `created_on`)values('$source','$consl_name','$consl_date','$position','$first_name','$last_name','$gender','$phone','$whatsapp','$mail','$adharnumber','$degree','$university','$year_of_pass','$percentage','$EmployeeStatus','$companyname','$no_of_year_exp','$cer_status','$certificate','$validity_to','$cer_from',1,'$userid',now())"; */

}





?>