<!-<?php
require '../../connect.php';


$date=$_REQUEST['date'];
$Employee_name=$_REQUEST['Employee_name'];
$Customer_name=$_REQUEST['Customer_name'];
$Location=$_REQUEST['Location'];
$Purpose=$_REQUEST['Purpose'];





$sql=$con->query("insert into manual_att(emp_id,customer_name,location,date,purpose,created_on) values('$Employee_name','$Customer_name','$Location','$date','$Purpose',now())");

//echo "insert into holiday_master(year,leave_date,leave_name) values ('$Year','$date','$holiday_name')";

?>