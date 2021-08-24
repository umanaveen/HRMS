 <?php  
 require '../../../connect.php';



$get_id=$_REQUEST['get_id'];

    $filename = $_FILES["uploadfile"]["name"];
      $tempname = $_FILES["uploadfile"]["tmp_name"];    
     echo $filename;
	  $folder = "image/".$filename;
	  //echo $folder;
	
			
	

 $result = $con->query("INSERT INTO po_upload (enquiry_id,image) VALUES('$get_id','$filename')");
	//mysqli_query($mysqli, $result);
echo "INSERT INTO po_upload(image) VALUES('$filename')";


	
	
	if (move_uploaded_file($tempname, $folder))  {
            $msg = "Image uploaded successfully";
        }else{
            $msg = "Failed to upload image";
      }
	  
	  
 ?> 
 
 
 