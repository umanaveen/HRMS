<?php
require '../../connect.php';




$con_id=$_REQUEST['con_id'];
$C_name=$_REQUEST['C_name'];
$org_name=$_REQUEST['org_name'];

$phone=$_REQUEST['phone'];
$whatsapp=$_REQUEST['whatsapp'];
$mail=$_REQUEST['mail'];
$alt_mail=$_REQUEST['alt_mail'];
$Percentage=$_REQUEST['Percentage'];
$cer_status=$_REQUEST['cer_status'];


$query=$con->query("update `consultant_master`set `consultant_name`='$C_name', `con_org`='$org_name', `phn_no`='$phone', `alt_phno`='$whatsapp', `email`='$mail', `alt_email`='$alt_mail', `percentage`='$Percentage', `status`='$cer_status' where consultani_id='$con_id'");

echo "update `consultant_master`set `consultant_name`='$C_name', `con_org`='$org_name', `phn_no`='$phone', `alt_phno`='$whatsapp', `email`='$mail', `alt_email`='$alt_mail', `percentage`='$Percentage', `status`='$cer_status' where consultani_id='$con_id'";
if($query)
{
	echo 0;
}
else
{
	echo 1;
} 
?>