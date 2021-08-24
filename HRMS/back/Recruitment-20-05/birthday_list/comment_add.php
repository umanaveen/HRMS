<?php  
 require '../../../connect.php';
	$first_name=$_REQUEST['first_name'];
	$dob=$_REQUEST['dob'];
	$comments=$_REQUEST['comments'];
	
$statement = $con->prepare("INSERT INTO candidate_form_details (first_name, dob, comments)VALUES ('$first_name','$dob','$comments')");
echo "INSERT INTO candidate_form_details (first_name, dob, comments)VALUES ('$first_name','$dob','$comments')";

?>