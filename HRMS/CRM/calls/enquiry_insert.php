<?php
require '../../../connect.php';
include("../../../user.php");
$userrole=$_SESSION['userrole'];
$candidateid=$_SESSION['candidateid'];
$id=$_REQUEST['id'];

$Call_type=2;//outgoing
//$date=now();
$Company_name=$_REQUEST['client_org'];
$Location=$_REQUEST['city'];
$Address=$_REQUEST['address'];
$Client=$_REQUEST['client_name'];
$contact=$_REQUEST['contact'];
$email=$_REQUEST['email'];

$sql11=$con->query("insert into Enquiry(`Call_type`, `date`, `Client_type`, `consultant`,`Company_name`, `Location`, `Address`, `Client`, `Designation`, `Mobile`, `mail`, `Product`,`Feedback`, `Follup`,`Department`, `employee`,  `created_by`, `created_on`) values('$Call_type',now(),'','','$Company_name','$Location','$Address','$Client','','$contact','$email','','','','','','$candidateid',now())"); 

echo "insert into Enquiry(`Call_type`, `date`, `Client_type`, `consultant`,`Company_name`, `Location`, `Address`, `Client`, `Designation`, `Mobile`, `mail`, `Product`,`Feedback`, `Follup`,`Department`, `employee`,  `created_by`, `created_on`) values('$Call_type',now(),'','','$Company_name','$Location','$Address','$Client','','$contact','$email','','','','','','$candidateid',now())";
/* $sql11=$con->query("insert into Enquiry(`Call_type`, `date`, `Client_type`, `Company_name`, `Location`, `Address`, `Client`, `Designation`, `Mobile`, `mail`, `Product`,`list`,`Feedback`, `Follup`, `Department`, `employee`,  `created_by`, `created_on`) values('$Call_type','$date','','$Company_name','$Location','$Address','$Client','','$contact','$email','','','','','','$employee','1',now())");  */
?>