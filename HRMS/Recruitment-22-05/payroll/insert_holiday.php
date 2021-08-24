<!-<?php
require '../../connect.php';


$Year=$_REQUEST['Year'];
$date=$_REQUEST['date'];
$holiday_name=$_REQUEST['holiday_name'];





$sql=$con->query("insert into holiday_master(year,leave_date,leave_name) values('$Year','$date','$holiday_name')");

//echo "insert into holiday_master(year,leave_date,leave_name) values ('$Year','$date','$holiday_name')";

?>