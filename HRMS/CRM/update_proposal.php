
<?php
require '../../connect.php';
include("../../user.php");



 $id=$_REQUEST['get_id'];
 $product=$_REQUEST['product'];
 
 
 

	$sql2= $con->query("Update enquiry set Product='$product' where id='$id'");
	echo "Update enquiry set Product='$product' where id='$id'";
	
	?>






