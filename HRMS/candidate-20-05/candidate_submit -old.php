<?php
include('../../connect.php');
include('../../user.php');
$userid=$_SESSION['userid'];
$company=$_REQUEST['companys'];
$position=$_REQUEST['position'];
$tech_department=$_REQUEST['tech_department'];
$first_name=$_REQUEST['first_name'];
$last_name=$_REQUEST['last_name'];
$gender=$_REQUEST['gender'];
$father_name=$_REQUEST['father_name'];
$dob=date('Y-m-d',strtotime($_REQUEST['dob']));
$address=$_REQUEST['address'];
$paddress=$_REQUEST['paddress'];
$phone=$_REQUEST['phone'];
$a_phone=$_REQUEST['a_phone'];
$mail=$_REQUEST['mail'];
$adharnumber=$_REQUEST['adharnumber'];
$educationalDetails=$_REQUEST['educationalDetails'];
$pannumber=$_REQUEST['pannumber'];
$voternumber=$_REQUEST['voternumber'];
$EmployeeStatus=$_REQUEST['EmployeeStatus'];
$qn_type=$_REQUEST['qn_type'];

$status=2;
$date=date('Y-m-d');
if($EmployeeStatus=="new")
{
	$year_of_pass=$_REQUEST['year_of_pass'];
	$inserts=$con->query("INSERT INTO candidate_form_details(qn_name_id,company_name,position, department, first_name, last_name, father_name, gender, dob, address, paddress, phone,alternative_phone, mail, adharnumber, pannumber, voternumber, educationalDetails, EmployeeStatus, year_of_pass, status, created_by, created_on) VALUES ('$qn_type','$company','$position', '$tech_department', '$first_name', '$last_name', '$father_name', '$gender', '$dob', '$address', '$paddress', '$phone', '$a_phone','$mail', '$adharnumber', '$pannumber', '$voternumber', '$educationalDetails', '$EmployeeStatus', '$year_of_pass', '$status','$userid','$date')"); 
	echo "INSERT INTO candidate_form_details(qn_name_id,company_name,position, department, first_name, last_name, father_name, gender, dob, address, paddress, phone,alternative_phone, mail, adharnumber, pannumber, voternumber, educationalDetails, EmployeeStatus, year_of_pass, status, created_by, created_on) VALUES ('$qn_type','$company','$position', '$tech_department', '$first_name', '$last_name', '$father_name', '$gender', '$dob', '$address', '$paddress', '$phone', '$a_phone','$mail', '$adharnumber', '$pannumber', '$voternumber', '$educationalDetails', '$EmployeeStatus', '$year_of_pass', '$status','$userid','$date')";

	$edit_id=$con->query("SELECT id FROM candidate_form_details order by id desc limit 1");
$res = $edit_id->fetch();
 $candidate_id=$res['id']; 
	if($inserts)
	{
	$password=md5("Welcome@123");
		$insert=$con->query("insert into z_user_master(department,candidate_id,user_name,password,full_name,status,email_id,user_group_code,mobile_no,gender,created_by,created_on)values('$tech_department','$candidate_id','$first_name','$password','$first_name','1','$mail','ROLE-006','$phone','$gender',1,'$date')");
	}
}
else
{
$companyname=$_REQUEST['companyname'];
$no_of_year=$_REQUEST['no_of_year'];

$inserts=$con->query("INSERT INTO candidate_form_details(qn_name_id,company_name,position, department, first_name, last_name, father_name, gender, dob, address, paddress, phone, alternative_phone,mail, adharnumber, pannumber, voternumber, educationalDetails, EmployeeStatus,  companyname, no_of_year, status, created_by, created_on) VALUES ('$qn_type','$company','$position',  '$tech_department', '$first_name', '$last_name', '$father_name','$gender',  '$dob', '$address', '$paddress', '$phone','$a_phone', '$mail', '$adharnumber', '$pannumber', '$voternumber','$educationalDetails', '$EmployeeStatus',  '$companyname', '$no_of_year', '$status','$userid','$date')");

echo "INSERT INTO candidate_form_details(qn_name_id,company_name,position, department, first_name, last_name, father_name, gender, dob, address, paddress, phone, alternative_phone,mail, adharnumber, pannumber, voternumber, educationalDetails, EmployeeStatus,  companyname, no_of_year, status, created_by, created_on) VALUES ('$qn_type','$company','$position',  '$tech_department', '$first_name', '$last_name', '$father_name','$gender',  '$dob', '$address', '$paddress', '$phone','$a_phone', '$mail', '$adharnumber', '$pannumber', '$voternumber','$educationalDetails', '$EmployeeStatus',  '$companyname', '$no_of_year', '$status','$userid','$date')";
$edit_id=$con->query("SELECT id FROM candidate_form_details order by id desc limit 1");
$res = $edit_id->fetch();
 $candidate_id=$res['id'];
if($inserts)
	{
	$password=md5("Welcome@123");
		$insert=$con->query("insert into z_user_master(department,candidate_id,user_name,password,full_name,status,email_id,user_group_code,mobile_no,gender,created_by,created_on)values('$tech_department','$candidate_id','$first_name','$password','$first_name','1','$mail','ROLE-006','$phone','$gender',1,'$date')");
	}
}
	/* echo "insert into z_user_master(department,candidate_id,user_name,password,full_name,status,email_id,user_group_code,mobile_no,gender,created_by,created_on)values('$tech_department','$candidate_id','$first_name','$password','$first_name','1','$mail','ROLE-006','$phone','$gender',1,'$date')";
	 */
if($insert)
{
	echo "0";	
}
else
{
	echo "1";
}
?>