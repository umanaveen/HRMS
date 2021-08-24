<?php
require '../../connect.php';

$id=1;


$assets_no=$_REQUEST['assets_no'];
$asset_name=$_REQUEST['asset_name'];
$brand=$_REQUEST['brand'];
$vendor=$_REQUEST['vendor'];
$date=$_REQUEST['date'];
$serial=$_REQUEST['serial'];
$config=$_REQUEST['config'];
$Warranty=$_REQUEST['Warranty'];


 
 

	


$query=$con->query("INSERT INTO  assets_system(`asset_no`, `asset_name`, `brand_name`,`vendor_name`, `p_date`, `Serial_no`, `config`, `warranty`) VALUES ('$assets_no', '$asset_name','$brand','$vendor','$date','$serial','$config','$Warranty')");

echo "INSERT INTO  assets_system(`asset_no`, `asset_name`, `brand_name`, `p_date`, `Serial_no`, `config`, `warranty`) VALUES ('$assets_no', '$asset_name','$brand','$date','$serial','$config','$Warranty')";

if($query)
{
	echo 0;
}
else
{
	echo 1;
} 