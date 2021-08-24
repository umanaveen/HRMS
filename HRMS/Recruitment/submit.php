
<?php 
require '../../connect.php';
require "../../user.php";
$uploadDir = 'uploads/'; 
$allowTypes = array('pdf', 'doc', 'docx', 'jpg', 'png', 'jpeg'); 
$response = array( 
    //'status' => 0, 
    //'message' => 'Form submission failed, please try again.' 
); 
 
// If form is submitted 
//$errMsg = ''; 
$valid = 1; 
if( isset($_POST['emp_id']) || isset($_POST['position']) || isset($_POST['name']) || isset($_POST['fathers_name']) || isset($_POST['DOB']) || isset($_POST['communication_address']) || isset($_POST['permanent_address'])
	|| isset($_POST['mobile_num']) || isset($_POST['email_id']) || isset($_POST['adharnumber']) || isset($_POST['pannumber']) || isset($_POST['voternumber']) || isset($_POST['files']) || isset($_POST['files1']) || isset($_POST['files2']) || isset($_POST['files3']) || isset($_POST['emergency_num']) || isset($_POST['emergency_person']) || isset($_POST['relation']) || isset($_POST['acc_number']) || isset($_POST['ifsc']) || isset($_POST['acc_name']))
	{ 
    // Get the submitted form data 
	$candidateid=$_POST['cid'];
$id=1;
    $position = $_POST['position']; 
    $name = $_POST['name']; 
    $fathers_name = $_POST['fathers_name']; 
    $DOB = $_POST['DOB']; 
    $communication_address = $_POST['communication_address']; 
    $permanent_address = $_POST['permanent_address']; 
    $mobile_num = $_POST['mobile_num']; 
    $email_id = $_POST['email_id']; 
	
    $emergency_num = $_POST['emergency_num']; 
    $emergency_person = $_POST['emergency_person']; 
    $relation = $_POST['relation']; 
    $acc_number = $_POST['acc_number']; 
    $ifsc = $_POST['ifsc']; 
    $acc_name = $_POST['acc_name']; 
     
	 $adharnumber=$_POST['adharnumber'];
	 $pannumber=$_POST['pannumber'];
	 $voternumber=$_POST['voternumber'];
    $filesArr = $_FILES["files"];
    $filesArr1 = $_FILES["files1"];
    $filesArr2 = $_FILES["files2"];
    $filesArr3 = $_FILES["files3"];
	
     
   $status=1;
$today = date("Y-m-d H:i:s"); 
     
   
    // Check whether submitted data is not empty 
    if($valid == 1)
	{ 
       // $uploadStatus = 1; 
        $fileNames = array_filter($filesArr['name']); 
         
        // Upload file 
        $uploadedFile = ''; 
        if(!empty($fileNames)){  
            foreach($filesArr['name'] as $key=>$val){  
                // File upload path  
                 $fileName = basename($filesArr['name'][$key]);  
                $targetFilePath = $uploadDir . $fileName;  
                  
                // Check whether file type is valid  
                $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);  
                 
                    // Upload file to server  
                    if(move_uploaded_file($filesArr["tmp_name"][$key], $targetFilePath)){  
                        $uploadedFile .= $fileName.','; 
                    } 
                
            }  
        } 
         
		 
		 
         
		 
		 
            // Include the database config file 
            //include_once 'connect.php'; 
             
            // Insert form data in the database 
            $uploadedFileStr = trim($uploadedFile, ','); 
			
			
			/* pan upload */
			$fileNames = array_filter($filesArr1['name']); 
         
        // Upload file 
        $uploadedFile = ''; 
        if(!empty($fileNames)){  
            foreach($filesArr1['name'] as $key=>$val){  
                // File upload path  
                $fileName = basename($filesArr1['name'][$key]);  
                $targetFilePath = $uploadDir . $fileName;  
                  
                // Check whether file type is valid  
                $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);  
                  
                    // Upload file to server  
                    if(move_uploaded_file($filesArr1["tmp_name"][$key], $targetFilePath)){  
                        $uploadedFile .= $fileName.','; 
                     
                }
            }  
        } 
		
		
		$uploadedFileStr1 = trim($uploadedFile, ','); 
			/* end pan upload */
			
			
			
			
			/* voter upload */
			$fileNames = array_filter($filesArr2['name']); 
         
        // Upload file 
        $uploadedFile = ''; 
        if(!empty($fileNames)){  
            foreach($filesArr2['name'] as $key=>$val){  
                // File upload path  
                $fileName = basename($filesArr2['name'][$key]);  
                $targetFilePath = $uploadDir . $fileName;  
                  
                // Check whether file type is valid  
                $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);  
                
                    // Upload file to server  
                    if(move_uploaded_file($filesArr2["tmp_name"][$key], $targetFilePath)){  
                        $uploadedFile .= $fileName.','; 
                    
                }
            }  
        } 
		
		
		$uploadedFileStr2 = trim($uploadedFile, ','); 
			/* end voter upload */
			
			
			/* Resume upload */
			$fileNames = array_filter($filesArr3['name']); 
         
        // Upload file 
        $uploadedFile = ''; 
        if(!empty($fileNames)){  
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
		
		
		$uploadedFileStr3 = trim($uploadedFile, ','); 
			/* end resume upload */
			//include_once 'connect.php'; 
           $sql=$con->query("INSERT INTO emp_personal_details (emp_id,position,name,fathers_name,DOB,communication_address,permanent_address,mobile_num,email_id,adharcard_number,aadhar_num,pan_number,pan_num,voter_id,Voter_no,resume,emergency_num,contact_person,emergency_contact_relationship,acc_number,ifsc,acc_holder_name,status,created_by,created_on) 
		   VALUES ('".$candidateid."', '".$position."', '".$name."', '".$fathers_name."', '".$DOB."', '".$communication_address."', '".$permanent_address."', '".$mobile_num."', '".$email_id."', '".$adharnumber."','".$uploadedFileStr."','".$pannumber."','".$uploadedFileStr1."','".$uploadedFileStr2."', '".$voternumber."', '".$uploadedFileStr3."', '".$emergency_num."', '".$emergency_person."', '".$relation."', '".$acc_number."', '".$ifsc."', '".$acc_name."', '".$status."', '".$candidateid."', now())"); 
           
/*echo ("INSERT INTO emp_personal_details (emp_id,position,name,fathers_name,DOB,communication_address,permanent_address,mobile_num,email_id,aadhar_num,adharcard_number,pan_number,pan_num,status,created_by,created_on)
 VALUES ('".$candidateid."', '".$position."', '".$name."', '".$fathers_name."', '".$DOB."', '".$communication_address."', '".$permanent_address."', '".$mobile_num."', '".$email_id."', '".$uploadedFileStr."', '".$uploadedFileStr1."', '".$adharnumber."', '".$pannumber."', '".$status."', '".$candidateid."', now())");*/  
            
			
         
    }
	if($sql){
	 echo 0;
 }
} 
 
// Return response 
//echo json_encode($response);