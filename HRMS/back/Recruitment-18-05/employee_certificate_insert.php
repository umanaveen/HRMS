<?php
require '../../connect.php';
require '../../user.php';
$uploadDir = 'uploads/'; 
$allowTypes = array('pdf', 'doc', 'docx', 'jpg', 'png', 'jpeg'); 
$response = array( 
    //'status' => 0, 
    //'message' => 'Form submission failed, please try again.' 
); 
 
// If form is submitted 
//$errMsg = ''; 
$valid = 1; 

if( isset($_POST['emp_id']) || isset($_POST['certifcatename']) || isset($_POST['certifcatenumber']) || isset($_POST['validityfrom']) || isset($_POST['validityto']) || isset($_POST['certifcatefile'])){ 


$candidateid=$_POST['cid'];
$id=1;
$certifcatename=$_POST['certifcatename'];
$certifcatename_count= count($certifcatename);
$certifcatenumber=$_POST['certifcatenumber'];
$validityfrom=$_POST['validityfrom'];
$validityto=$_POST['validityto'];
$filesArr3 = $_FILES["certifcatefile"];

 //$countfiles = count($_FILES['certifcatefile']['name']);

 for($i=0;$i<$certifcatename_count;$i++)
{

$certifcate= $certifcatename[$i];
$number= $certifcatenumber[$i];
$vfrom= $validityfrom[$i];
$vto= $validityto[$i];
$filesArr3 = $_FILES["certifcatefile"];

 
 $status=1;

$today = date("Y-m-d H:i:s"); 

if($valid == 1){ 
       // $uploadStatus = 1; 
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
                if(in_array($fileType, $allowTypes)){  
                    // Upload file to server  
                    if(move_uploaded_file($filesArr3["tmp_name"][$key], $targetFilePath)){  
                        $uploadedFile .= $fileName.','; 
                    } 
                }
            }  
        } 
         
		 
		 
         
		 
		 
            // Include the database config file 
            //include_once 'connect.php'; 
             
            // Insert form data in the database 
            $uploadedFileStr3 = trim($uploadedFile, ',');
			
			
			
  $sql=$con->query("insert into `emp_certification`(`emp_id`, `certification_name`, `certification_number`, `validity_from`, `validity_to`, `attachment`, `status`,`created_on`,`created_by`)  values('$candidateid','$certifcate','$number','$vfrom','$vto','$fileNames[$i]','$status',now(),'$candidateid')"); 
 
//echo "insert into `emp_certification`(`emp_id`, `certification_name`, `certification_number`, `validity_from`, `validity_to`, `attachment`, `status`,`created_on`,`created_by`)  values('$candidateid','$certifcate','$number','$vfrom','$vto','$fileNames[$i]','$status',now(),'$candidateid')";
  
}

}
if($sql){
	 echo 0;
 }
}



?>






