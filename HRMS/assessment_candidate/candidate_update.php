<?php 
include('../../connect.php');
include('../../user.php');
$userid=$_SESSION['userid'];
$empid=$_REQUEST['empid'];
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
$qn_type=$_REQUEST['qn_type'];

$date=date('Y-m-d');

 	$Update=$con->query("update emp_assessment_login_detail set qn_name_id='$qn_type',company_name='$company', department='$tech_department', first_name='$first_name', last_name='$last_name', father_name='$father_name', gender='$gender', dob='$dob', address='$address', paddress='$paddress', phone='$phone', modified_by='$userid', modified_on='$date' where id='$empid'");
	
	if($Update)
{
	echo "0";	
}
else
{
	echo "1";
}
?>