<?php
require '../../connect.php';
require "../../user.php";
if(isset($_POST['save']))
{
$msg = "";
$candidateid=$_SESSION['candidateid'];
$id=1;
$position=$_REQUEST['position'];
$candidate_name=$_REQUEST['candidate_name'];
$father_name=$_REQUEST['father_name'];
$dob=$_REQUEST['dob'];
$address=$_REQUEST['address'];
$paddress=$_REQUEST['paddress'];
$phone=$_REQUEST['phone'];
$mail=$_REQUEST['mail'];
$adharnumber=$_REQUEST['adharnumber'];
$pannumber=$_REQUEST['pannumber'];
$voternumber=$_REQUEST['voternumber'];

 
	
	
 $Adhar_filename = $_FILES["adharupload"]["name"];
		 $target = "images/".$Adhar_filename;
if (move_uploaded_file($_FILES['adharupload']['tmp_name'], $target)) {
  		$msg = "Image uploaded successfully";
  	}else{
  		$msg = "Failed to upload image";
  	}


$Pan_filename = $_FILES["panupload"]["name"];
		 $target = "images/".$Pan_filename;
if (move_uploaded_file($_FILES['panupload']['tmp_name'], $target)) {
  		$msg = "Image uploaded successfully";
  	}else{
  		$msg = "Failed to upload image";
  	}
	
	




$voter_filename = $_FILES["votercardupload"]["name"];
		 $target = "images/".$voter_filename;
if (move_uploaded_file($_FILES['votercardupload']['tmp_name'], $target)) {
  		$msg = "Image uploaded successfully";
  	}else{
  		$msg = "Failed to upload image";
  	}
	
	


$resume_filename = $_FILES["resume"]["name"];
		 $target = "images/".$resume_filename;
if (move_uploaded_file($_FILES['resume']['tmp_name'], $target)) {
  		$msg = "Image uploaded successfully";
  	}else{
  		$msg = "Failed to upload image";
  	}
	
$status=1;

$today = date("Y-m-d H:i:s"); 

 $sql=$con->query("INSERT INTO `emp_personal_details`(emp_id,position,name,fathers_name,DOB,communication_address,permanent_address,mobile_num, email_id,adharcard_number,pan_number,Voter_no,aadhar_num,pan_num,voter_id,resume,status,created_by,created_on) 
 VALUES ('$candidateid','$position','$candidate_name','$father_name','$dob','$address','$paddress','$phone','$mail','$adharnumber','$pannumber','$voternumber','$Adhar_filename','$Pan_filename','$voter_filename','$resume_filename','$status','$candidateid',now())");
 

 /*echo "INSERT INTO `emp_personal_details`(emp_id,position,name,fathers_name,DOB,communication_address,
 permanent_address,mobile_num, email_id,aadhar_num,pan_num,voter_id,resume,status,created_by,created_on) 
 VALUES ('$candidateid','$position','$candidate_name','$father_name','$dob','$address',
 '$paddress','$phone','$mail','$Adhar_filename','$Pan_filename','$voter_filename','$resume_filename',
 '$status','$candidateid',now())";*/


}
?>

