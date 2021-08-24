<?php

require '../../connect.php';
$ids=$_REQUEST['ids'];
$workers=$_REQUEST['workers'];
$leave_type=$_REQUEST['leave_type'];
$status="1";
 

$statement = $con->prepare('UPDATE leave_category set type=:workers, leave_ids=:leave_type, status=:status WHERE id=:id');

$statement->execute([
    'workers' => $workers,
    'leave_type' => $leave_type,
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