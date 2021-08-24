 <?php  
 require '../../../connect.php';
require '../../../user.php';
//$candidateid=$_SESSION['candidateid'];


//$get_id=$_REQUEST['get_id'];
if( isset($_POST['uploadfile']) ) 
{	 
    $filename = $_FILES["uploadfile"]["name"];
      $tempname = $_FILES["uploadfile"]["tmp_name"];    
     
	  $folder = "image/".$filename;
	  //echo $folder;
	
			
	

 $result = $con->query("INSERT INTO po_upload (image) VALUES('$filename')");
	//mysqli_query($mysqli, $result);
echo "INSERT INTO po_upload(image) VALUES('$filename')";


		//printf ("New Record has id %d.\n", mysqli_insert_id($mysqli));

		/* drop table */
		//mysqli_query($mysqli, "DROP TABLE myCity");
	
	if (move_uploaded_file($tempname, $folder))  {
            $msg = "Image uploaded successfully";
        }else{
            $msg = "Failed to upload image";
      }
	  
	  
	  


 

 
 //echo "Data Inserted";  
 
 //echo "Data Inserted";  
 
 
  
	


}

else  
 {  
      //echo "Please Enter Name";  
 }  



 
 

 ?> 
 
 
 