<?php
include('../../connect.php');
include('../../user.php');
$uploadDir = 'uploads/'; 
$uploadDir1 = 'photo/'; 
$allowTypes = array('pdf', 'doc', 'docx', 'jpg', 'png', 'jpeg'); 
$response = array( 
    //'status' => 0, 
    //'message' => 'Form submission failed, please try again.' 
); 

if( isset($_POST['position']) ||  isset($_POST['position1']) || isset($_POST['tech_department']) || isset($_POST['tech_department1']) || isset($_POST['first_name']) || isset($_POST['last_name']) || isset($_POST['gender']) || isset($_POST['father_name']) || isset($_POST['dob']) || isset($_POST['address']) || isset($_POST['paddress']) || isset($_POST['phone']) || isset($_POST['a_phone']) || isset($_POST['b_phone']) || isset($_POST['mail']) || isset($_POST['Alternate_mail']) || isset($_POST['adharnumber']) || isset($_POST['pannumber']) || isset($_POST['po_date']) || isset($_POST['educationalDetails']) || isset($_POST['EmployeeStatus']) || isset($_POST['chk']) || isset($_POST['education']) || isset($_POST['course']) || isset($_POST['Passed']) || isset($_POST['university']) || isset($_POST['companynames']) || isset($_POST['Experience']) || isset($_POST['Designation']) || isset($_POST['year_of_pass'])  || isset($_POST['companyname'])  || isset($_POST['no_of_year'])  || isset($_POST['photo'])  || isset($_POST['files3'])){

$resource_id=$_SESSION['resource_id'];
$userid=$_SESSION['resource_id'];
$company='';
$position=$_REQUEST['position'];
$tech_department=$_REQUEST['tech_department'];
$first_name=$_REQUEST['first_name'];
$last_name=$_REQUEST['last_name'];
$gender=$_REQUEST['gender'];
$father_name=$_REQUEST['father_name'];
$dob=date('Y-m-d',strtotime($_REQUEST['dob']));
$address=$_REQUEST['address'];
$paddress=$_REQUEST['paddress'];
$phone=" ".$_REQUEST['phone'];
$phone1 = substr($phone,5);
$a_phone=" ".$_REQUEST['a_phone'];
$b_phone="+91".$_REQUEST['a_phone'];
$mail=$_REQUEST['mail'];
$Alternate_mail=$_REQUEST['Alternate_mail'];
$adharnumber=$_REQUEST['adharnumber'];
$educationalDetails=$_REQUEST['educationalDetails'];
$pannumber=$_REQUEST['pannumber'];
$voternumber=$_REQUEST['voternumber'];
$EmployeeStatus=$_REQUEST['EmployeeStatus'];
$filesArr3 = $_FILES["files3"];
$photo = $_FILES["photo"];
//$qn_type=$_REQUEST['qn_type'];

/* Resume upload */
			$fileNames = array_filter($filesArr3['name']); 
			 $photo1 = array_filter($photo['name']); 
         
        // Upload file 
        $uploadedFile = ''; 
                       foreach($filesArr3['name'] as $key=>$val)
			{         
              // File upload path  
                $fileName = basename($filesArr3['name'][$key]);  
                $targetFilePath = $uploadDir . $fileName;  
                  
                // Check whether file type is valid  
                 $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);  
                
                    // Upload file to server  
                    if(move_uploaded_file($filesArr3["tmp_name"][$key], $targetFilePath)){  
                        $uploadedFile .= $fileName.','; 
                    
                }
			}
        
//photo

                 foreach($photo['name'] as $key=>$val)
			{          
             // File upload path  
                $fileName1 = basename($photo['name'][$key]);  
                $targetFilePath1 = $uploadDir1 . $fileName1;  
                  
                // Check whether file type is valid  
                 $fileType = pathinfo($targetFilePath1, PATHINFO_EXTENSION);  
                
                    // Upload file to server  
                    if(move_uploaded_file($photo["tmp_name"][$key], $targetFilePath1)){  
                        $uploadedFile .= $fileName.','; 
                    
                }
			}



$status=2;
$date=date('Y-m-d');

$education=$_REQUEST['education'];
$course=$_REQUEST['course'];
$Passed=$_REQUEST['Passed'];
$university=$_REQUEST['university'];
$education_count=count($education);


$companynames=$_REQUEST['companynames'];
$Experience=$_REQUEST['Experience'];
$Designation=$_REQUEST['Designation'];
$companynames_count=count($companynames);

if($EmployeeStatus=="Fresher")
{
	 $year_of_pass=$_REQUEST['year_of_pass'];
	 $inserts=$con->query("INSERT INTO candidate_form_details(`resource_id`,`company_name`,`position`,`department`, `first_name`,`last_name`,`father_name`,`gender`,`dob`,`address`,`paddress`,`phone`,`alternative_phone`,`whatsapp_no`, `mail`,`alternate_mailid`,`adharnumber`,`pannumber`,`voternumber`,`educationalDetails`,`EmployeeStatus`,`year_of_pass`, `resume`,`photo`,`status`,`created_by`) VALUES ('$resource_id','$company','$position','$tech_department','$first_name','$last_name','$father_name','$gender','$dob','$address', '$paddress','$phone','$a_phone','$b_phone','$mail','$Alternate_mail','$adharnumber','$pannumber','$voternumber','$educationalDetails','$EmployeeStatus','$year_of_pass','$fileName','$fileName1','$status','$userid')");  
	for($i=0;$i<$education_count;$i++)
{
$educations= $education[$i];
$courses= $course[$i];
 $Passeds= $Passed[$i];
 $universitys= $university[$i];
  $sql1=$con->query("insert into `education_resource`(`res_id`, `Education`, `Course`, `Year_Of_Passed`, `university`, `created_by`) values('$resource_id','$educations','$courses','$Passeds','$universitys','$userid')");  
}

	$edit_id=$con->query("SELECT id FROM candidate_form_details order by id desc limit 1");
$res = $edit_id->fetch();
 $candidate_id=$res['id']; 
	if($inserts)
	{
		$pass="Welcome@123";
		$password=md5($pass);
	    //$password=md5("Welcome@123");
		$full_name=$first_name."".$last_name;
		$insert=$con->query("insert into z_user_master(department,candidate_id,user_name,password,full_name,status,email_id,user_group_code,mobile_no,gender,created_by,created_on)values('$tech_department','$candidate_id','$phone1','$password','$full_name','1','$mail','ROLE-011','$phone','$gender','$userid','$date')");
		
		$upd=$con->query("update interview_schedule_detail set user_role='ROLE-011' where resource_id='$resource_id' and status='2'");
	} 
}
else
{
$companyname=$_REQUEST['companyname'];
$no_of_year=$_REQUEST['no_of_year'];

$inserts=$con->query("INSERT INTO candidate_form_details(resource_id,company_name,position,department,first_name, last_name,father_name,gender,dob,address,paddress,phone,alternative_phone,whatsapp_no,mail,alternate_mailid,adharnumber, pannumber,voternumber,educationalDetails,EmployeeStatus,companyname,no_of_year,resume,photo,status,created_by) VALUES ('$resource_id','$company','$position','$tech_department','$first_name','$last_name','$father_name','$gender','$dob','$address','$paddress','$phone','$a_phone','$b_phone','$mail','$Alternate_mail','$adharnumber','$pannumber','$voternumber','$educationalDetails','$EmployeeStatus','$companyname','$no_of_year','$fileName','$fileName1','$status','$userid')"); 

 for($i=0;$i<$education_count;$i++)
{
$educations= $education[$i];
$courses= $course[$i];
 $Passeds= $Passed[$i];
 $universitys= $university[$i];
  $sql1=$con->query("insert into `education_resource`(`res_id`, `Education`, `Course`, `Year_Of_Passed`, `university`, `created_by`) values('$resource_id','$educations','$courses','$Passeds','$universitys','$userid')");   
}

 for($i=0;$i<$companynames_count;$i++)
{

$companynamess= $companynames[$i];
$Experiences= $Experience[$i];
 $Designations= $Designation[$i];
 
  $sql1=$con->query("insert into `company_resource`(`res_id`, `Company_name`, `Years_Of_Experience`, `Designation`,`created_by`)  values('$resource_id','$companynamess','$Experiences','$Designations','$userid')");  
}
$edit_id=$con->query("SELECT id FROM candidate_form_details order by id desc limit 1");
$res = $edit_id->fetch();
 $candidate_id=$res['id'];
 if($inserts)
	{
	$password=md5("Welcome@123");
	$full_name=$first_name."".$last_name;
		$insert=$con->query("insert into z_user_master(department,candidate_id,user_name,password,full_name,status,email_id,user_group_code,mobile_no,gender,created_by,created_on)values('$tech_department','$candidate_id','$phone1','$password','$full_name','1','$mail','ROLE-011','$phone','$gender','$userid','$date')");
		$upd=$con->query("update interview_schedule_detail set user_role='ROLE-011' where resource_id='$resource_id' and status='2'");
	} 
}

if($upd)
{
	echo 0;	

}
else
{
	echo 1;

}
}

?>