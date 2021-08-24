<!--?php  
 require '../../../connect.php';
	$first_name=$_REQUEST['first_name'];
	$dob=$_REQUEST['dob'];
	$comments=$_REQUEST['comments'];
	
$statement = $con->prepare("INSERT INTO candidate_form_details (first_name, dob, comments)VALUES ('$first_name','$dob','$comments')");
echo "INSERT INTO candidate_form_details (first_name, dob, comments)VALUES ('$first_name','$dob','$comments')";

?-->

<?php
require '../../../connect.php';
?>
<?php
if(isset($_REQUEST['submit']))
{
		
	$comments=$_REQUEST['comments'];
	
$statement = $con->prepare("INSERT INTO birthday (comments)VALUES ('$comments')");
echo "INSERT INTO birthday (comments)VALUES ('$comments')";
/*if($sql)
{
	echo "<script>alert('Inserted Updated');</script>";
	header("location:/HRMS/index.php");
}*/
}
?>