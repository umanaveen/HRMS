<?php
require '../../connect.php';
include("../../user.php");
if(isset($_POST['submit']))
{
	 $get_client_id=$_REQUEST['get_client_id'];
	$project=$_REQUEST['project'];
	$hod=$_REQUEST['hod'];
	$subject=$_REQUEST['subject'];
    $decription=$_REQUEST['decription'];
	 $ahdarpath1=$_REQUEST['attachment'];
    $status=0;
$rolemaster_id=$_SESSION['rolemaster_id'];

		 $image = $_FILES['image']['name'];
		 $target = "uploads/".basename($image);
if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
  		$msg = "Image uploaded successfully";
  	}else{
  		$msg = "Failed to upload image";
  	}
//echo "<pre>";print_r($performance);
 $sql=$con->query("insert into  tickets(client_id,project_id,hod_id,subject,description,attachment,tickets_status,created_by,created_on) values('$get_client_id','$project','$hod','$subject','$decription','$image','$status','$rolemaster_id',now())"); 
/* echo ("insert into  tickets(client_id,project_id,hod_id,subject,description,attachment,tickets_status,created_by,created_on) values('$get_client_id','$project','$hod','$subject','$decription','$image','$status','$rolemaster_id',now())"); */
if($sql)
{
    echo "<script>alert('successfully Updated');</script>";
    
}

	//header("location:/Ticketing_system/index.php");
}
?>