<?php
require '../../connect.php';

$id=1;
$candidateid=$_REQUEST['cid'];
echo "fff".$candidateid;
$candidate_name=$_REQUEST['candidate_name'];
$father_name=$_REQUEST['father_name'];
$position=$_REQUEST['position'];
$dob=$_REQUEST['dob'];
$address=$_REQUEST['address'];
$paddress=$_REQUEST['paddress'];
$phone=$_REQUEST['phone'];
$mail=$_REQUEST['mail'];

if (!file_exists("uploads/" . $candidateid)) {
	mkdir("uploads/" . $emp_name);
}
		$target_Path_aggrement="uploads/$candidateid/";
		$filepath="uploads/$candidateid/".basename( $_FILES[$fileName]['name']);
		$target_Path_aggrement=$target_Path_aggrement.basename( $_FILES[$fileName]['name']);
		
							/******File Upload***/
		move_uploaded_file( $_FILES[$fileName]['tmp_name'],$target_Path_aggrement);
		
		
$adharnumber=$_REQUEST['adharnumber'];

$ahdarpath="uploads/$candidateid/".basename( $_FILES['adharcard']['name']);
$target_Path_aggrement=$target_Path_aggrement.basename( $_FILES['adharcard']['name']);
		/******File Upload***/
move_uploaded_file( $_FILES['adharcard']['tmp_name'],$target_Path_aggrement);
	

$pannumber=$_REQUEST['pannumber'];

$panpath="uploads/$candidateid/".basename( $_FILES['pancard']['name']);
$target_Path_aggrement=$target_Path_aggrement.basename( $_FILES['pancard']['name']);
		/******File Upload***/
move_uploaded_file( $_FILES['pancard']['tmp_name'],$target_Path_aggrement);

$voternumber=$_REQUEST['voternumber'];

$voterpath="uploads/$candidateid/".basename( $_FILES['votercard']['name']);
$target_Path_aggrement=$target_Path_aggrement.basename( $_FILES['votercard']['name']);
		/******File Upload***/
move_uploaded_file( $_FILES['votercard']['tmp_name'],$target_Path_aggrement);
 
 
echo $resumepath="uploads/$candidateid/".basename( $_FILES['resume']['name']);
$target_Path_aggrement=$target_Path_aggrement.basename( $_FILES['resume']['name']);
		/******File Upload***/
move_uploaded_file( $_FILES['resume']['tmp_name'],$target_Path_aggrement);
 
	
	
$status=1;
$user_id=1;
$today = date("Y-m-d H:i:s"); 

$query=$con->query("INSERT INTO emp_personal_details(emp_id, name, fathers_name, DOB, communication_address, permanent_address, mobile_num, email_id, aadhar_num, pan_num, voter_id, resume, status, created_by, created_on, modified_by, modified_on, position, adhar_card, pan_card, voter_card) VALUES 
('$candidateid', '$','$candidate_name','$father_name','$dob','$address','$paddress','$phone','$mail','$adharnumber','$Adhar_filename','$pannumber','$Pan_filename','$voternumber','$voter_filename','$Resume_filename','$status','$user_id','$today')");
/* echo "INSERT INTO emp_personal_details(emp_id, name, fathers_name, DOB, communication_address, permanent_address, mobile_num, email_id, aadhar_num, pan_num, voter_id, resume, status, created_by, created_on, modified_by, modified_on, position, adhar_card, pan_card, voter_card) VALUES ('$candidateid', '$position','$candidate_name','$father_name','$dob','$address','$paddress','$phone','$mail','$adharnumber','$Adhar_filename','$pannumber','$Pan_filename','$voternumber','$voter_filename','$Resume_filename','$status','$user_id','$today')";
 */
//$upd=$con->query("update candidate_form_details set status=20 where id='$candidateid'");
if($query)
{
	echo 0;
}
else
{
	echo 1;
} 
/* $query=$con->query("INSERT INTO `emp_personal_details`(`emp_id`, `position`, `name`, `fathers_name`, `DOB`, `communication_address`, `permanent_address`, `mobile_num`, `email_id`, `adharcard_number`, `pan_number`, `Voter_no`, `aadhar_num`, `pan_num`, `voter_id`, `resume`, `status`, `created_by`, `created_on`)
 VALUES 
('$candidateid', '$position','$candidate_name','$father_name','$dob','$address','$paddress','$phone','$mail','$adharnumber','$Adhar_filename','$pannumber','$Pan_filename','$voternumber','$voter_filename','$Resume_filename','$status','$user_id','$today')"); */