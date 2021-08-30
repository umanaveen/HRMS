<?php
require '../../connect.php';
include("../../user.php");
$userrole=$_SESSION['userrole'];
$candidateid=$_SESSION['candidateid'];

$get_id=$_REQUEST['get_id'];
$Call_type=$_REQUEST['Call_type'];
$date=$_REQUEST['date'];
$Client_type=$_REQUEST['Client_type'];
$Company_name=$_REQUEST['Company_name'];
$Location=$_REQUEST['Location'];
$Address=$_REQUEST['Address'];
$Client=$_REQUEST['Client'];
$Designation=$_REQUEST['Designation'];
$Number=$_REQUEST['Number'];
$mail=$_REQUEST['mail'];
$Product=$_REQUEST['Product'];
$list=$_REQUEST['services'];
$Feedback=$_REQUEST['Feedback'];
$Follup=$_REQUEST['Follup'];

$Department=$_REQUEST['Department'];
$employee=$_REQUEST['employee'];


 $sql11=$con->query("UPDATE `enquiry` SET `Call_type`='$Call_type',`date`='$date',`Client_type`='$Client_type',`Company_name`='$Company_name',`Location`='$Location',`Address`='$Address',`Client`='$Client',`Designation`='$Designation',`Mobile`='$Number',`mail`='$mail',`Product`='$Product',`list`='$list',`Feedback`='$Feedback',`Follup`='$Follup',`Department`='$Department',`employee`='$employee',`Modified_by`='$candidateid',`modified_on`=now() WHERE id='$get_id'"); 

echo "UPDATE `enquiry` SET `Call_type`='$Call_type',`date`='$date',`Client_type`='$Client_type',`Company_name`='$Company_name',`Location`='$Location',`Address`='$Address',`Client`='$Client',`Designation`='$Designation',`Mobile`='$Number',`mail`='$mail',`Product`='$Product',`list`='$list',`Feedback`='$Feedback',`Follup`='$Follup',`Department`='$Department',`employee`='$employee',`Modified_by`='$candidateid',`modified_on`=now() WHERE id='$get_id'";

?>