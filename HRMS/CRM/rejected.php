<?php
require '../../connect.php';
require '../../user.php';

$id=$_REQUEST['get_id'];


$status=6;




$sql2= $con->query("Update enquiry set status='$status' where id='$id'");
	echo "Update enquiry set status='$status' where id='$id'";


 





?>






