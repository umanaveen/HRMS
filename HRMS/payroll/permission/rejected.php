<?php
require ("../../configuration.php");

$id=$_REQUEST['get_id'];


$status=3;




$sql2= $con->query("Update employee_permission_master set approve_status='$status' where id='$id'");
	


 





?>






