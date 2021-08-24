<?php
require '../../../connect.php';
?>
<?php
if(isset($_REQUEST['submit']))
{
	$id=$_REQUEST['id'];
	$company=$_REQUEST['company'];
	$department=$_REQUEST['department'];
	$head=$_REQUEST['head'];
	$status=$_REQUEST['status'];
	$sql=$con->query("update department_mapping set company_name='$company',department_id='$department',department_head='$head',status='$status' where id='$id'");
	//echo "update department_mapping set company_name='$company',department_id='$department',department_head='$head',status='$status' where id='$id'";
	if($sql)
{
	echo "<script>alert(' Updated Updated');</script>";
	header("location:/HRMS/index.php");
}
}?>