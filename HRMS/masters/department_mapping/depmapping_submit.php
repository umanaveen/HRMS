<?php
require '../../../connect.php';
?>
<?php
if(isset($_REQUEST['submit']))
{
	$company=$_REQUEST['company'];
	$department=$_REQUEST['department'];
	$head=$_REQUEST['head'];
	$status=$_REQUEST['status'];
	$sql=$con->query("insert into department_mapping(company_name,department_id,department_head,status,created_by,created_on)values('$company','$department','$head','$status','2',now())");
if($sql)
{
	echo "<script>alert(' Inserted Updated');</script>";
	header("location:/HRMS/index.php");
}
}
?>