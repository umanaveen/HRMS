<?php
require '../../../connect.php';
include("../../../user.php");
$user=$_SESSION['userid'];

$feedback=$_REQUEST['feedback'];
$fed_date=$_REQUEST['fed_date'];
$id=$_REQUEST['id'];

$sql11=$con->query("insert into crm_calls_feedback(calls_id,feedback,date,created_by,created_on) values('$id','$feedback','$fed_date','$user',now())"); 
echo "insert into crm_calls_feedback(calls_id,feedback,date,created_by,created_on) values('$feedback','$fed_date','$user',now())";
//echo "insert into products_master(`Product_name`) values('$product_name')";
?>