<?php
require '../../connect.php';


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

$Feedback=$_REQUEST['Feedback'];
$Follup=$_REQUEST['Follup'];

$Department=$_REQUEST['Department'];
$employee=$_REQUEST['employee'];
$Department1=$_REQUEST['Departments_id'];
$employee1=$_REQUEST['employees_id'];




if($Client_type==2){
$sql11=$con->query("insert into Enquiry(`Call_type`, `date`, `Client_type`, `Company_name`, `Location`, `Address`, `Client`, `Designation`, `Mobile`, `mail`, `Product`,`Feedback`, `Follup`,`Department`, `employee`,  `created_by`, `created_on`) values('$Call_type','$date','$Client_type','$Company_name','$Location','$Address','$Client','$Designation','$Number','$mail','$Product','$Feedback','$Follup','$Department','$employee','1',now())"); 

/*  echo "insert into Enquiry(`Call_type`, `date`, `Client_type`, `Company_name`, `Location`, `Address`, `Client`, `Designation`, `Mobile`, `mail`, `Product`,`list`,`Feedback`, `Follup`, `companys`, `Department`, `employee`,  `created_by`, `created_on`) values('$Call_type','$date','$Client_type','$Company_name','$Location','$Address','$Client','$Designation','$Number','$mail','$Product','$list','$Feedback','$Follup','$companys','$Department','$employee','1',now())"; */
} 
else
{
	$sql11=$con->query("insert into Enquiry(`Call_type`, `date`, `Client_type`, `Company_name`, `Location`, `Address`, `Client`, `Designation`, `Mobile`, `mail`, `Product`,`Feedback`, `Follup`, `Department`, `employee`,  `created_by`, `created_on`) values('$Call_type','$date','$Client_type','$Company_name','$Location','$Address','$Client','$Designation','$Number','$mail','$Product','$Feedback','$Follup','$Department1','$employee1','1',now())"); 
}
?>