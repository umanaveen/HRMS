<?php
require '../../../connect.php';
require '../../../user.php';

$id=$_REQUEST['get_id'];


$status=3;




$sql2= $con->query("Update  po_upload set po_status='$status' where Po_id='$id'");
	echo "Update  po_upload set po_status='$status' where Po_id='$id'";


 





?>






