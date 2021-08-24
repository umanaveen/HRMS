<?php
require '../../connect.php';

//employee_educational_insert.php?pass=10th,12&ins=Gov,Gov&degrees=State%20Board,State%20Board&field=tamil,tamil&passing=2008,2010&percent=83.12,83.12&attach=C:\fakepath\0c5e985268f12147b235d5745a3d438c.jpg,C:\fakepath\0f55c588fc8eaa839f5912c3770464ec.jpg

$id=1;
$examination_passed=explode(",",$_REQUEST['pass']);
$instute=explode(",",$_REQUEST['ins']);
$degree=explode(",",$_REQUEST['degrees']);
$field=explode(",",$_REQUEST['field']);
$passing=explode(",",$_REQUEST['passing']);
$percentage=explode(",",$_REQUEST['percent']);
$attachment=explode(",",$_REQUEST['attach']);

var_dump($attachment);
echo $size_of_attachment=sizeof($attachment);


if($size_of_attachment>1)
{
    for($i=0;$i<sizeof($attachment);$i++)
    {
       $file_name=$attachment[$i];
       
        $education_files = $_FILES['$file_name']['name'];
        $education_path = '/certificates/'.$education_files;
        if(!empty($education_files)){
            move_uploaded_file($_FILES['$file_name']['tmp_name'], '/certificates/'.$Adhar_filename);	
        }
    }
}
else{
    $education_files = $_FILES[$attachment[$i]]['name'];
        $education_path = '/certificates/'.$education_files;
        if(!empty($education_files)){
            move_uploaded_file($_FILES[$attachment[$i]]['tmp_name'], '/certificates/'.$Adhar_filename);	
        }
}

$status=1;
$user_id=1;
$today = date("Y-m-d H:i:s"); 

/*
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


call emp_personal_insert ('aswini','krishna','1996-10-04','chennai','kadapa','8888888','aswini@gmail.com','23477643','rr567788','52432','qwet','1','1','2020-09-09 13:08:52')


$stmt = $dbh->prepare("CALL sp_takes_string_returns_string(?)");
$value = 'hello';
$stmt->bindParam(1, $value, PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 4000); 

// call the stored procedure
$stmt->execute();

print "procedure returned $value\n";
*/