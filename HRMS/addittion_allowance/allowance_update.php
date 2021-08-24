<?php   

require '../../connect.php';
$id=$_REQUEST['ids'];
	$allowance_name=$_REQUEST['allowance_name'];
	$other_name=$_REQUEST['short_name'];
	$status=1;
	
	
	$data = [
	'allowance_name' => $allowance_name,
	'other_name' => $other_name,
	'status' => $status,
	'now' => $now,
	'id' => $id,
];
$sql = "UPDATE master_addittion_allowance SET allowance_name=:allowance_name, short_name=:other_name, status=:status, modified_on=:now WHERE id=:id";
$stmt= $con->prepare($sql);
$stmt->execute($data); 
if($stmt)
{
	echo 0;
}
else
{
	echo 1;
}
?>