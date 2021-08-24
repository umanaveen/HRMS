<?php
require '../../../connect.php';
?>
<?php
if(isset($_REQUEST['submit']))
{
	$company=$_REQUEST['company'];
	$status=$_REQUEST['status'];
	$sql=$con->query("insert into company_master(companyname,status)values('$company','$status')");
	echo "insert into company_master(companyname,status)values('$company','$status')";
if($sql)
{
	echo "<script>alert(' Inserted Updated');</script>";
	header("location:/HRMS/index.php");
}
}
?>