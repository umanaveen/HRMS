<?php

require '../../connect.php';
$Leave=$_REQUEST['Leave'];
$no_of_days=$_REQUEST['no_of_days'];
$status="1";
 

$statement = $con->prepare('INSERT INTO master_leave(leave_name, no_of_days, status)
    VALUES (:Leave, :no_of_days, :status)');

$statement->execute([
    'Leave' => $Leave,
    'no_of_days' => $no_of_days,
    'status' => $status
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