<?php   require '../../connect.php';
	$allowance_name=$_REQUEST['allowance_name'];
	$other_name=$_REQUEST['other_name'];
	$now=date('Y-m-d');
	$status=1;
 
$statement = $con->prepare("INSERT INTO master_addittion_allowance (allowance_name, short_name, status, created_on)VALUES (?, ?, ?, ?)");
$statement->execute([$allowance_name,$other_name,1,$now]);  
if($statement)
{
	echo 0;
}
else
{
	echo 1;
}
?>