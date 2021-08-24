<!--?php
require '../../../connect.php';

?-->
	<!--?php
if(isset($_REQUEST['submit']))
{	 
$id=$_REQUEST['$id'];		
	     $msg="";
    $filename = $_FILES["po_upload"]["name"];
	print_r ($filename);
     $tempname = $_FILES["po_upload"]["tmp_name"];    
			//$fileToUpload=$_REQUEST['fileToUpload'];

	  $folder = "uploads/".$filename;
	  
	 $sql=$con->query("Update quote_generate set po_upload='$po_upload' where id='$id'");
	echo "Update quote_generate set po_upload='$po_upload' where id='$id'";
	
	if (move_uploaded_file($tempname, $folder))  {
            $msg = "Image uploaded successfully";
        }else{
            $msg = "Failed to upload image";
      }

if($sql)
{
	echo 'Image Upload Added Successfully';
}
}

?-->



<?php
// Include the database configuration file
include '../../../connect.php';


//$id=$_REQUEST['id'];


if( isset($_POST['quote_no']) || isset($_POST['quote_date']) || isset($_POST['cost_sheet_no']) || isset($_POST['po_upload']) || isset($_POST['po_date'])){ 

$quote_no = $_POST["quote_no"];
$quote_date = $_POST["quote_date"];
$cost_sheet_no = $_POST["cost_sheet_no"];
$po_upload = $_FILES["po_upload"];
$po_date = $_FILES["po_date"];



// File upload path
$targetDir = "uploads/";
echo "hii".$fileName = basename($_FILES["$po_upload"]["name"]);
$targetFilePath = $targetDir . $fileName;
$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

if(move_uploaded_file($_FILES["$po_upload"]["tmp_name"], $targetFilePath)){
$file=$fileName;
}

/* if(isset($_POST["submit"]) && !empty($_FILES["$po_upload"]["name"])){
    // Allow certain file formats
    $allowTypes = array('jpg','png','jpeg','gif','pdf');
    if (!file_exists($targetFilePath)) {
        if(in_array($fileType, $allowTypes)){
                // Upload file to server
            if(move_uploaded_file($_FILES["$po_upload"]["tmp_name"], $targetFilePath)){
                // Insert image file name into database
                $insert = $db->query("INSERT into quote_generate (po_upload, po_date) VALUES ('".$fileName."', NOW())");
                if($insert){
                    $statusMsg = "The file <b>".$fileName. "</b> has been uploaded successfully." . $backlink;
                }else{
                    $statusMsg = "File upload failed, please try again." . $backlink;
                } 
            }else{
                $statusMsg = "Sorry, there was an error uploading your file." . $backlink;
            }
        }else{
            $statusMsg = "Sorry, only JPG, JPEG, PNG, GIF, & PDF files are allowed to upload." . $backlink;
        }
    }else{
            $statusMsg = "The file <b>".$fileName. "</b> is already exist." . $backlink;
        }
}else{
    $statusMsg = 'Please select a file to upload.' . $backlink;
} */

// Display status message
echo $statusMsg;
}
?>