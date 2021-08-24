<?php
//require '../../user.php';
require '../../connect.php';

$id=$_REQUEST['get_id'];
$Employee_name=$_REQUEST['Employee_name'];
$date=$_REQUEST['date'];
$Customer_name=$_REQUEST['Customer_name'];
$Location=$_REQUEST['Location'];
$Purpose=$_REQUEST['Purpose'];
$sql=$con->query("Update manual_att set emp_id='$Employee_name',customer_name='$Customer_name',location='$Location',date='$date',purpose='$Purpose' where id='$id'"); 

/* echo "Update manual_att set emp_id='$Employee_name',customer_name='$Customer_name',location='$Location',date='$date',purpose='$Purpose' where id='$id'";
 */
?>