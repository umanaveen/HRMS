<?php
require '../../connect.php';

$id=1;
$date=$_REQUEST['date'];

$first_name=$_REQUEST['first_name'];
$email=$_REQUEST['email'];
$mob_num=$_REQUEST['mob_num'];
$Coming_from=$_REQUEST['Coming_from'];
$companys=$_REQUEST['companys'];
$Purpose=$_REQUEST['Purpose'];
$Department=$_REQUEST['Department'];
$employee=$_REQUEST['employee'];
$vehicle=$_REQUEST['vehicle'];
$Vehicle_No=$_REQUEST['Vehicle_No'];

$Remarks=$_REQUEST['Remarks'];

 
 

	


$query=$con->query("INSERT INTO  vms(`Date`, `first_name`, `email`, `mob_num`, `Coming_from`, `companys`, `Purpose`, `Department`, `employee`, `vehicle`,`veh_no`,`Remarks`) VALUES ('$date', '$first_name','$email','$mob_num','$Coming_from','$companys','$Purpose','$Department','$employee','$vehicle','$Vehicle_No','$Remarks')");

echo "INSERT INTO  vms(`Date`, `first_name`, `email`, `mob_num`, `Coming_from`, `companys`, `Purpose`, `Department`, `employee`, `vehicle`, 'veh_no',`Remarks`) VALUES ('$date', '$first_name','$email','$mob_num','$Coming_from','$companys','$Purpose','$Department','$employee','$vehicle','$Vehicle_No','$Remarks')";

if($query)
{
	echo 0;
}
else
{
	echo 1;
} 