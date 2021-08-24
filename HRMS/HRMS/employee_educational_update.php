<?php
require '../../connect.php';
require '../../user.php';
$userid=$_SESSION['userid'];
$uploadDir = 'uploads/'; 
$allowTypes = array('pdf', 'doc', 'docx', 'jpg', 'png', 'jpeg'); 
$response = array( 
    //'status' => 0, 
    //'message' => 'Form submission failed, please try again.' 
); 
 
// If form is submitted 
//$errMsg = ''; 
$valid = 1; 
$status=1;

if( isset($_POST['emp_id']) || isset($_POST['examination_passed']) || isset($_POST['instute']) || isset($_POST['degree']) || isset($_POST['field']) || isset($_POST['passing'])  || isset($_POST['percentage']) || isset($_POST['attachment']) ){ 

$candidateid=$_POST['cid'];
$id=1;
$examination_passed=$_POST['examination_passed'];
$examination_passed_count= count($examination_passed);
$instute=$_POST['instute'];
$degree=$_POST['degree'];
$field=$_POST['field'];
$passing=$_POST['passing'];
$percentage=$_POST['percentage'];
//$attachment=$_POST['attachment'];
$filesArr3 = $_FILES["attachment"];
 

 for($i=0;$i<$examination_passed_count;$i++)
{

$examination= $examination_passed[$i];
$college= $instute[$i];
$course= $degree[$i];
$fields= $field[$i];
$passings= $passing[$i];
$percentages= $percentage[$i];
//$filesArr3 = $_FILES["attachment"];
$status=1;
$today = date("Y-m-d H:i:s"); 
     
    // Check whether submitted data is not empty 
    if($valid == 1){ 
       // $uploadStatus = 1; 
        $fileNames = array_filter($filesArr3['name']); 
         //print_r($fileNames);
		// echo $fileNames[$i];
        // Upload file 
        $uploadedFile = ''; 
        if(!empty($fileNames))
		{  
            foreach($filesArr3['name'] as $key=>$val){  
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
        } 
         
            // Include the database config file 
            //include_once 'connect.php'; 
             
            // Insert form data in the database 
            $uploadedFileStr3 = $fileName;
			
			
			
 /* 
 $sql=$con->query("insert into `emp_qualification`(`emp_id`, `education`, `institution_name`, `degree`, `field_of_specialization`, `year_of_passing`, `percentage`,`attachment`,`created_on`,`created_by`)  values('$candidateid','$examination','$college','$course','$fields','$passings','$percentages','$uploadedFileStr3',now(),'$candidateid')"); */
 /*  $sql=$con->query("insert into `emp_qualification`(`emp_id`, `education`, `institution_name`, `degree`, `field_of_specialization`, `year_of_passing`, `percentage`,`attachment`,`status`,`created_on`,`created_by`)  values('$candidateid','$examination','$college','$course','$fields','$passings','$percentages','$fileNames[$i]','$status',now(),'$candidateid')"); */
 
 $upd=$con->query("update emp_qualification set attachment='$fileNames[$i]',modified_by='$userid',modified_on=now() where emp_id='$candidateid' and education='$examination' ");
	 		
 // $upd=$con->query("update candidate_form_details set status=20 where id='$candidateid'");
  
/* echo "insert into `emp_qualification`(`emp_id`, `education`, `institution_name`, `degree`, `field_of_specialization`, `year_of_passing`, `percentage`,`attachment`,`created_on`,`created_by`)  values('$candidateid','$examination','$college','$course','$fields','$passings','$percentages','$fileNames[$i]',now(),'$candidateid')"; 
 */

}

}
if($sql)
{
	 echo 0;
}
else
{
	echo 1;
}

}



?>


