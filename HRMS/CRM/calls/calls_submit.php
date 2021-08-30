<?php
require '../../../connect.php';
include("../../../user.php");
$user=$_SESSION['userid'];

$client_org=$_REQUEST['client_org'];
$client_name=$_REQUEST['client_name'];
$contact=$_REQUEST['contact'];
$email=$_REQUEST['email'];
$website=$_REQUEST['website'];
$address=$_REQUEST['address'];
$city=$_REQUEST['city'];
$state=$_REQUEST['state'];
$country=$_REQUEST['country'];

$sql11=$con->query("insert into crm_calls(client_org,client_name,contact,email,website,address,city,state,country,created_by,created_on,status) values('$client_org','$client_name','$contact','$email','$website','$address','$city','$state','$country','$user',now(),1)"); 

//echo "insert into products_master(`Product_name`) values('$product_name')";
?>