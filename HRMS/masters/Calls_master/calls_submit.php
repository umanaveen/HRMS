<?php
require '../../../connect.php';
include("../../../user.php");


$calls=$_REQUEST['calls'];







$sql11=$con->query("insert into calls_master(`name`) values('$calls')"); 

//echo "insert into products_master(`Product_name`) values('$product_name')";
?>