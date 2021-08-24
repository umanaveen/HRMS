<?php
require '../../connect.php';

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

$Adhar_filename = $_FILES['adharcard']['name'];
$Adhar_path = '../images/'.$Adhar_filename;
if(!empty($Adhar_filename)){
    move_uploaded_file($_FILES['adharcard']['tmp_name'], '../images/'.$Adhar_filename);	
}

$pannumber=$_REQUEST['pannumber'];

$Pan_filename = $_FILES['pancard']['name'];
$pan_path = '../images/'.$Pan_filename;
if(!empty($Pan_filename)){
    move_uploaded_file($_FILES['pancard']['tmp_name'], '../images/'.$Pan_filename);	
}

$voternumber=$_REQUEST['voternumber'];

$voter_filename = $_FILES['votercard']['name'];
$voter_path = '../images/'.$voter_filename;
if(!empty($voter_filename)){
    move_uploaded_file($_FILES['votercard']['tmp_name'], '../images/'.$voter_filename);	
}

$Resume_filename = $_FILES['resume']['name'];
$resume_path = '../images/'.$Resume_filename;
if(!empty($Resume_filename)){
    move_uploaded_file($_FILES['resume']['tmp_name'], '../images/'.$Resume_filename);	
}

$status=1;
$user_id=1;
$today = date("Y-m-d H:i:s"); 

//echo "call emp_personal_insert ('$id', '$position','$candidate_name','$father_name','$dob','$address','$paddress','$phone','$mail','$adharnumber','$Adhar_filename','$pannumber','$Pan_filename','$voternumber','$voter_filename','$Resume_filename','$status','$user_id','$today')";

$statement = $con->prepare("CALL emp_personal_insert(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");

$statement->bindParam(1, $id, PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 4000); 
$statement->bindParam(2, $position, PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 4000); 
$statement->bindParam(3, $candidate_name, PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 4000); 
$statement->bindParam(4, $father_name, PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 4000); 
$statement->bindParam(5, $dob, PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 4000); 
$statement->bindParam(6, $address, PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 4000); 
$statement->bindParam(7, $paddress, PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 4000); 
$statement->bindParam(8, $phone, PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 4000); 
$statement->bindParam(9, $mail, PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 4000); 
$statement->bindParam(10, $adharnumber, PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 4000); 
$statement->bindParam(11, $Adhar_path, PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 4000); 
$statement->bindParam(12, $pannumber, PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 4000); 
$statement->bindParam(13, $pan_path, PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 4000); 
$statement->bindParam(14, $voternumber, PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 4000); 
$statement->bindParam(15, $voter_path, PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 4000); 
$statement->bindParam(16, $resume_path, PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 4000); 
$statement->bindParam(17, $status, PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 4000); 
$statement->bindParam(18, $user_id, PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 4000); 
$statement->bindParam(19, $today, PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 4000);

// call the stored procedure
$value=$statement->execute();

print "$value";

/*
DELIMITER $$
CREATE PROCEDURE `emp_personal_insert`(IN `id` INT(255),IN posistion VARCHAR(150),  IN `name` VARCHAR(150), IN `fathers_name` VARCHAR(150), IN `DOB` DATE, IN `communication_address` VARCHAR(150), IN `permanent_address` VARCHAR(150), IN `mobile_num` VARCHAR(150), IN `email_id` VARCHAR(150), IN `aadhar_num` VARCHAR(150),IN `adhar_file` VARCHAR(150),
IN `pan_num` VARCHAR(150),IN `pan_file` VARCHAR(150), IN `voter_id` VARCHAR(150),IN `voter_id_file` VARCHAR(150), IN `resume` VARCHAR(150), IN `status` INT(255), IN `created_by` INT(255), IN `created_on` TIMESTAMP)
BEGIN
set @t1=concat("insert into emp_personal_details (posistion,name,fathers_name,DOB,communication_address,permanent_address,mobile_num,email_id,aadhar_num,adhar_file,pan_num,pan_file,voter_id,voter_id_file,resume,status,created_by,created_on)
values('",posistion,"','",name,"','",fathers_name,"','",DOB,"','",communication_address,"','",permanent_address,"','",mobile_num,"','",email_id,"','",aadhar_num,"','",adhar_file,"','",pan_num,"','",pan_file,"','",voter_id,"','",voter_id_file,"','",resume,"','",status,"','",created_by,"','",created_on,"')");
PREPARE stmt1 from @t1; 
EXECUTE stmt1;
DEALLOCATE PREPARE stmt1; 
END$$
DELIMITER ;


call emp_personal_insert ('laxmi','krishna','1996-10-04','chennai','kadapa','8888888','aswini@gmail.com','23477643','rr567788','52432','qwet','1','1','2020-09-09 13:08:52')


$stmt = $dbh->prepare("CALL sp_takes_string_returns_string(?)");
$value = 'hello';
$stmt->bindParam(1, $value, PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 4000); 

// call the stored procedure
$stmt->execute();

print "procedure returned $value\n";
*/