<?php
require '../../connect.php';

$id=1;


$code=$_REQUEST['code'];
$Employee=$_REQUEST['Employee'];

$role_code=$_REQUEST['role_code'];

 
 

	


$query=$con->query("INSERT INTO  user_role_mapping(`rolemaster_id`,`employee_id`) VALUES ('$code','$Employee')");
$sql=$con->query("update z_user_master set user_group_code='$role_code' where candidate_id='$Employee'");
/* echo "INSERT INTO  user_role_mapping(`rolemaster_id`,`employee_id`) VALUES ('$code','$Employee')"; */

if($query)
{
	echo 0;
}
else
{
	echo 1;
} 
?>