<?php
require '../../connect.php';
require '../../user.php';

$id=$_REQUEST['get_id'];


$status=2;




$sql2= $con->query("Update enquiry set status='$status' where id='$id'");
	echo "Update enquiry set status='$status' where id='$id'";


 





?>






