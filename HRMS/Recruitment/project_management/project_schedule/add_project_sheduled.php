<?php
require '../../../../connect.php';
include("../../../../user.php");

$client=$_REQUEST['client'];
$project_name=$_REQUEST['project_name'];
$modules=$_REQUEST['modules'];
$employees=$_REQUEST['employees'];
$no_of_working_hours=$_REQUEST['no_of_working_hours'];
$date=$_REQUEST['date'];
$time=$_REQUEST['time'];
$client_count=count($client);




 for($i=0;$i<$client_count;$i++)
{

$clients= $client[$i];
$project_names= $project_name[$i];
 $moduless= $modules[$i];
 $employeess= $employees[$i];
 $no_of_working_hourss= $no_of_working_hours[$i];
 $dates= $date[$i];
  $times= $time[$i];
  
  
 $sql1=$con->query("INSERT INTO `project_schedule`(`client_id`,`project_id`, `modules`, `employees`, `no_of_working_hours`, `date`, `schedule_hours`) VALUES('$clients','$project_names','$moduless','$employeess','$no_of_working_hourss','$dates','$times')");  


echo "INSERT INTO `project_schedule`(`client_id`,`project_id`, `modules`, `employees`, `no_of_working_hours`, `date`, `schedule_hours`) VALUES('$clients','$project_names','$moduless','$employeess','$no_of_working_hourss','$dates','$times')";  
}





?>






