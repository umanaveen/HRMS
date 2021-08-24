<?php
require '../../../connect.php';
include("../../../user.php");


$Service_name=$_REQUEST['Service_name'];







$sql11=$con->query("insert into service_master(`service_name`) values('$Service_name')"); 

//echo "insert into products_master(`Product_name`) values('$product_name')";
?>