<?php
require '../../../connect.php';
include("../../../user.php");
$candidateid=$_SESSION['candidateid'];

$password_name=$_REQUEST['password_name'];


 






$sql11=$con->query("INSERT INTO `password_master`(`name`,`created_by`) VALUES ('$password_name','$candidateid')"); 

echo "INSERT INTO `password_master`(`name`,`created_by`) VALUES ('$password_name','$candidateid')";
?>
