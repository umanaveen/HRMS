	<?php
require '../../../connect.php';
$scale=$_REQUEST['scale'];
$amount=$_REQUEST['amount'];
$percentage=$_REQUEST['percentage'];
$status=$_REQUEST['status'];
$id=$_REQUEST['id'];

$statement = $con->query("UPDATE payroll_structure set name='$scale', amount='$amount', percentage='$percentage',status='$status' WHERE id='$id'");

if($statement)
{
	echo 1;
}
else
{
	echo 0;
}


?>