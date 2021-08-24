<?php

require '../../connect.php';
$ids=$_REQUEST['ids'];
$Leave=$_REQUEST['Leave'];
$no_of_days=$_REQUEST['no_of_days'];
$status="1";
 

$statement = $con->prepare('UPDATE master_leave set leave_name=:Leave, no_of_days=:no_of_days, status=:status WHERE id=:id');

$statement->execute([
    'Leave' => $Leave,
    'no_of_days' => $no_of_days,
    'status' => $status,
    'id' => $ids,
]);


if($statement)
{
	0;
}
else
{
	1;
}

?>