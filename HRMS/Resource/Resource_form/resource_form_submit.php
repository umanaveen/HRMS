<?php 
include('../../../connect.php');
include('../../../user.php');
$userid=$_SESSION['userid'];
$uploadDir = 'resume/'; 
$allowTypes = array('pdf', 'doc', 'docx', 'jpg', 'png', 'jpeg'); 
$response = array( 
    //'status' => 0, 
    //'message' => 'Form submission failed, please try again.' 
); 

if(isset($_POST['source']) ||  isset($_POST['code']) ||  isset($_POST['consl_name']) || isset($_POST['referal_type']) || isset($_POST['referal_name']) || isset($_POST['referal_staff']) || isset($_POST['consl_date']) || isset($_POST['position']) || isset($_POST['first_name']) || isset($_POST['last_name']) || isset($_POST['gender']) || isset($_POST['phone']) || isset($_POST['whatsapp']) || isset($_POST['mail']) || isset($_POST['adharnumber']) || isset($_POST['degree']) || isset($_POST['university']) || isset($_POST['year_of_pass']) || isset($_POST['percentage']) || isset($_POST['EmployeeStatus']) || isset($_POST['companyname']) || isset($_POST['no_of_year']) || isset($_POST['total_exp']) || isset($_POST['rel_exp']) || isset($_POST['exp_ctc']) || isset($_POST['current_ctc']) || isset($_POST['cer_status']) || isset($_POST['certificate'])  || isset($_POST['cer_from'])  || isset($_POST['validity'])  || isset($_POST['file3']))
{

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
$exp_ctc=$_REQUEST['exp_ctc'];
$referal_type=$_REQUEST['referal_type'];
$referal_name1=$_REQUEST['referal_name'];
$referal_staff=$_REQUEST['referal_staff'];
$current_ctc=$_REQUEST['current_ctc'];
$total_exp=$_REQUEST['total_exp'];
$rel_exp=$_REQUEST['rel_exp'];
$files3=$_REQUEST['files3'];
$status=1;

   $uploadedFile = ''; 
                   
              // File upload path  
                $fileName = basename($files3['name'][$key]);  
                $targetFilePath = $uploadDir . $fileName;  
                  
                // Check whether file type is valid  
                 $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);  
                
                    // Upload file to server  
                    if(move_uploaded_file($files3["tmp_name"][$key], $targetFilePath)){  
                        $uploadedFile .= $fileName.','; 
                    
                }
			


if($referal_type=="Internal")
{
	$referal_name=$referal_staff;
}
else
{
	$referal_name=$referal_name1;
}

$cer_from=$_REQUEST['cer_from']; 
/* 
echo "insert into resource_form_detail ( `source`, `consultant_name`, `referal_name`, `date`, `position`, `first_name`, `last_name`, `gender`, `mobile`, `whatsapp`,`mail`,`aadhar_no`, `degree`, `university`, `year_of_pass`, `percentage`, `employement_status`, `company_name`, `year_experience`,`certification_status`,`exp_ctc`, `status`, `created_by`, `created_on`)values('$source','$consl_name','$referal_name','$consl_date','$position','$first_name','$last_name','$gender','$phone','$whatsapp','$mail','$adharnumber','$degree','$university','$year_of_pass','$percentage','$EmployeeStatus','$companyname','$no_of_year_exp','$cer_status','$exp_ctc',1,'$userid',now())";  */

if($validity_to=="" and $cer_from=="")
{
	//echo "hii";
	$sql=$con->query("insert into resource_form_detail ( `source`, `consultant_name`, `referal_type`,`referal_name`, `date`, `position`, `first_name`, `last_name`, `gender`, `mobile`, `whatsapp`,`mail`,`aadhar_no`, `degree`, `university`, `year_of_pass`, `percentage`, `employement_status`, `company_name`, `year_experience`,`certification_status`,`exp_ctc`,`total_experience`,`relevant_experience`,`current_ctc`,`resume`, `status`, `created_by`, `created_on`)values('$source','$consl_name','$referal_type','$referal_name','$consl_date','$position','$first_name','$last_name','$gender','$phone','$whatsapp','$mail','$adharnumber','$degree','$university','$year_of_pass','$percentage','$EmployeeStatus','$companyname','$no_of_year_exp','$cer_status','$exp_ctc','$total_exp','$rel_exp','$current_ctc','$fileName',1,'$userid',now())");


}
else
{
	//echo "hello";
	$sql=$con->query("insert into resource_form_detail ( `source`, `consultant_name`, `date`, `position`, `first_name`, `last_name`, `gender`, `mobile`, `whatsapp`,`mail`,`aadhar_no`, `degree`, `university`, `year_of_pass`, `percentage`, `employement_status`, `company_name`, `year_experience`,`certification_status`, `certification`, `validity`, `certified_from`,`exp_ctc`, `total_experience`,`relevant_experience`,`current_ctc`,`resume`,`status`, `created_by`, `created_on`)values('$source','$consl_name','$consl_date','$position','$first_name','$last_name','$gender','$phone','$whatsapp','$mail','$adharnumber','$degree','$university','$year_of_pass','$percentage','$EmployeeStatus','$companyname','$no_of_year_exp','$cer_status','$certificate','$validity_to','$cer_from','$exp_ctc','$total_exp','$rel_exp','$current_ctc','$fileName',1,'$userid',now())");

}

if($sql)
{
	echo 1;
}
else
{
	echo 0;
}
}
?>