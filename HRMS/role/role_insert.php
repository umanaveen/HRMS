<?php
require '../../connect.php';
include("../../user.php");
$id=1;


$code=$_REQUEST['code'];
$name=$_REQUEST['name'];


 
 

	


$query=$con->query("INSERT INTO  z_role_master(`code`,`role_name`,`created_on`) VALUES ('$code','$name',now())");

echo "INSERT INTO  assets_system(`asset_no`, `asset_name`, `brand_name`, `p_date`, `Serial_no`, `config`, `warranty`) VALUES ('$assets_no', '$asset_name','$brand','$date','$serial','$config','$Warranty')";

if($query)
{
	echo 0;
}
else
{
	echo 1;
} 