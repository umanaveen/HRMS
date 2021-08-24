<?php
require '../../connect.php';

$id=1;


$assets_no=$_REQUEST['assets_no'];
$asset_name=$_REQUEST['asset_name'];
$brand=$_REQUEST['brand'];
$date=$_REQUEST['date'];
$serial=$_REQUEST['serial'];
$config=$_REQUEST['config'];
$Warranty=$_REQUEST['Warranty'];
$in_hand=$_REQUEST['in_hand'];
$new=$_REQUEST['new'];
$invoice_no=$_REQUEST['invoice_no'];
$invoice=$_REQUEST['invoice'];


 
 

	


$query=$con->query("INSERT INTO  non_it_assets(`asset_no`, `asset_name`, `brand_name`, `p_date`, `Serial_no`, `config`, `warranty`) VALUES ('$assets_no', '$asset_name','$brand','$date','$serial','$config','$Warranty')");

echo "INSERT INTO  assets_system(`asset_no`, `asset_name`, `brand_name`, `p_date`, `Serial_no`, `config`, `warranty`, `stock_in_hand`, `new_stock`, `invoice_no`, `invoice`, `status`, `created_by`, `created_on`) VALUES ('$assets_no', '$asset_name','$brand','$date','$serial','$config','$Warranty')";

if($query)
{
	echo 0;
}
else
{
	echo 1;
} 