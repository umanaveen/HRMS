<?php
require '../../../../connect.php';
?>
<?php
if(isset($_REQUEST['submit']))
{
	$client=$_REQUEST['client'];
	$project_name=$_REQUEST['project_name'];
	
	$project_timeline=$_REQUEST['project_timeline'];
	$no_of_working_hours=$_REQUEST['no_of_working_hours'];
		

	$sql=$con->query("insert into project(client,project_name,project_timeline,no_of_working_hours)values('$client','$project_name','$project_timeline','$no_of_working_hours')");
	
	echo "insert into project(client,project_name,project_timeline,no_of_working_hours,modules,no_of_working_hours1)values('$client','$project_name','$project_timeline','$no_of_working_hours')";
	 
	$emp_sql=$con->query("select id from project order by id desc limit 1");
	$i=1;
	$emp_res = $emp_sql->fetch();

$project_id=$emp_res['id'];
$department=$_REQUEST['department'];
$department_count=count($department);
//echo "hii" .$department_count=count($department);

$employee=$_REQUEST['employee'];

 for($i=0;$i<$department_count;$i++)
{

$department= $department[$i];
$employee= $employee[$i];
 
  $sql1=$con->query("insert into `project_department`(`project_id`,`department`, `employee`)  values('$project_id','$department','$employee')");  


echo "insert into `project_department`(`project_id`,`department`, `employee`)  values('$project_id','$department','$employee')";  
}

$modules=$_REQUEST['modules'];
$modules_count=count($modules);
echo "iiii". $modules_count=count($modules);

$no_of_working_hours1=$_REQUEST['no_of_working_hours1'];

 for($i=0;$i<$modules_count;$i++)
{

$modules= $modules[$i];
$no_of_working_hours1= $no_of_working_hours1[$i];
 
  $sql1=$con->query("insert into `project_modules`(`project_id`,`modules`, `no_of_working_hours1`)  values('$project_id','$modules','$no_of_working_hours1')");  


echo "insert into `project_modules`(`project_id`,`modules`, `no_of_working_hours1`)  values('$project_id','$modules','$no_of_working_hours1')";  
}
if($sql)
{
	echo "<script>alert(' Inserted Updated');</script>";
	header("location:/HRMS/index.php");
}
}
?>