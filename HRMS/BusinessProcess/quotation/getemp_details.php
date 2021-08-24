

<?php
require '../../../connect.php';
include("../../../user.php");
$staff_id=$_REQUEST["emp_id"];

$sql=$con->query("SELECT * FROM `staff_master` 
INNER JOIN candidate_form_details ON staff_master.candid_id= candidate_form_details.id where staff_master.id='$staff_id'");

/* echo "SELECT * FROM `staff_master` 
INNER JOIN candidate_form_details ON staff_master.candid_id= candidate_form_details.id where staff_master.id='$staff_id'"; */


  $row = $sql->fetch(PDO::FETCH_ASSOC);

 $mail=$row['mail'];
$phone=$row['phone'];

echo $mail."=".$phone;
?>