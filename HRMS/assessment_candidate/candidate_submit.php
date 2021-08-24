<?php
include('../../connect.php');
include('../../user.php');
$userid=$_SESSION['userid'];
//$eid=$_REQUEST['id'];
$company=$_REQUEST['companys'];
$tech_department=$_REQUEST['tech_department'];
$first_name=$_REQUEST['first_name'];
$last_name=$_REQUEST['last_name'];
$gender=$_REQUEST['gender'];
$father_name=$_REQUEST['father_name'];
$dob=date('Y-m-d',strtotime($_REQUEST['dob']));
$address=$_REQUEST['address'];
$paddress=$_REQUEST['paddress'];
$phone=$_REQUEST['phone'];
//$qn_type=$_REQUEST['qn_type'];

$status=1;
$date=date('Y-m-d');


	
 	$inserts=$con->query("INSERT INTO emp_assessment_login_detail(company_name, department, first_name, last_name, father_name, gender, dob, address, paddress, phone,status, created_by, created_on) VALUES ('$company', '$tech_department', '$first_name', '$last_name', '$father_name', '$gender', '$dob', '$address', '$paddress', '$phone', '$status','$userid','$date')"); 
	echo "INSERT INTO emp_assessment_login_detail(company_name, department, first_name, last_name, father_name, gender, dob, address, paddress, phone,status, created_by, created_on) VALUES ('$company', '$tech_department', '$first_name', '$last_name', '$father_name', '$gender', '$dob', '$address', '$paddress', '$phone', '$status','$userid','$date')";
	 
	$edit_id=$con->query("SELECT id FROM emp_assessment_login_detail order by id desc limit 1");
$res = $edit_id->fetch();
 $candidate_id=$res['id']; 
	if($inserts)
	{
	$password=md5("Welcome@123");
		$insert=$con->query("insert into z_user_master(department,ass_emp_id,user_name,password,full_name,status,user_group_code,mobile_no,gender,created_by,created_on)values('$tech_department','$candidate_id','$first_name','$password','$first_name','1','ROLE-009','$phone','$gender',1,'$date')");
	} 

if($insert)
{
	echo "0";	
}
else
{
	echo "1";
}
?>