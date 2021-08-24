<?php
include('../../../connect.php');
include('../../../user.php');
$uploadDir = 'uploads/'; 
$allowTypes = array('pdf', 'doc', 'docx', 'jpg', 'png', 'jpeg'); 
$response = array( 
    //'status' => 0, 
    //'message' => 'Form submission failed, please try again.' 
);
if( isset($_POST['get_id']) ||  isset($_POST['quote_no']) || isset($_POST['quote_date']) || isset($_POST['cost_sheet_no']) || isset($_POST['attachment']) || isset($_POST['po_date']))
{ 

$qid=$_POST['get_id'];
$po_date=$_POST['po_date'];
$filesArr3 = $_FILES["attachment"];


/* Resume upload */
		$fileNames = array_filter($filesArr3['name']); 
			 
         
        // Upload file 
        $uploadedFile = ''; 
        if(!empty($fileNames))
		{                          
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
        }
        
		$sql=$con->query("update quote_generate set po='$fileName',status='4',po_date='$po_date',po_upload_status='1' where id='$qid'");
		//echo "update po_generate set po='$fileName',status=4,po_date='$po_date',po_upload_status='1' where id='$qid'";
		if($sql)
		{
			echo 0;
		}
		else
		{
			echo 1;
		}
		}