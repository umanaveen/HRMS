<?php
require '../../connect.php';
require '../../user.php';

$id=$_REQUEST['get_id'];


$status=3;




$sql2= $con->query("Update client_master set status='$status' where id='$id'");
	echo "Update client_master set status='$status' where id='$id'";


 





?>






