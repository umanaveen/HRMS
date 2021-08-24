<?php

require '../../connect.php';
$workers=$_REQUEST['workers'];
$leave_type=$_REQUEST['leave_type'];
$status="1";
 

$statement = $con->prepare('INSERT INTO leave_category(type, leave_ids, status)
    VALUES (:workers, :leave_type, :status)');

$statement->execute([
    'workers' => $workers,
    'leave_type' => $leave_type,
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