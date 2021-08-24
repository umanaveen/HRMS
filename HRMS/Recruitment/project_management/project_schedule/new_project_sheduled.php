<?php
require '../../../../connect.php';
include("../../../../user.php");

$id=$_REQUEST['get_id'];
$name=$_REQUEST['name_id'];
$proposal=$_REQUEST['proposal'];
$Hours=$_REQUEST['Hours'];
$date=$_REQUEST['date'];

$sql1=$con->query("INSERT INTO `project_management`(`enqu_id`, `Client`, `Project_Name`, `Total_Man_Hours`, `Project_Deadline_Date`) VALUES ('$id','$name','$proposal','$Hours','$date')");  
echo "INSERT INTO `project_management`(`enqu_id`, `Client`, `Project_Name`, `Total_Man_Hours`, `Project_Deadline_Date`) VALUES ('$id','$name','$proposal','$Hours','$date')";

$modules=$_REQUEST['modules'];
$modules_count=count($modules);
$department_1=$_REQUEST['department'];
$project_name_1=$_REQUEST['project_name'];
$no_of_working_hours=$_REQUEST['no_of_working_hours'];

 for($i=0;$i<$modules_count;$i++)
{

$moduless= $modules[$i];
$departments= $department_1[$i];
 $project_names= $project_name_1[$i];
 $no_of_working_hoursss= $no_of_working_hours[$i];
 
 $sql1=$con->query("INSERT INTO `project_modules`(`client_id`, `modules`, `Department`, `Employee`, `no_of_working_hours1`) VALUES('$name','$moduless','$departments','$project_names','$no_of_working_hoursss')");  


echo "INSERT INTO `project_modules`(`client_id`, `modules`, `Department`, `Employee`, `no_of_working_hours1`) VALUES('$name','$moduless','$departments','$project_names','$no_of_working_hoursss')";  
}





?>






