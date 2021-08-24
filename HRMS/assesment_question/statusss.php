<?php
require '../../connect.php';

 $id=$_REQUEST['id'];

$status = 12;
 
$sql=$con->query("Update candidate_form_details set status='$status' where id='$id'");
 if($sql)
 {
	 echo 1;
 }
else 
{
	echo 0;
}	


?>