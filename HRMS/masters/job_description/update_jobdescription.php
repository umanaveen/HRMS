<?php
require '../../../connect.php';
?>
<?php
if(isset($_REQUEST['submit']))
{
	$id=$_REQUEST['id'];
	$jd_tittle=$_REQUEST['jd_tittle'];
	$status=$_REQUEST['status'];
	$sql=$con->query("update jobdescription_master set tittle='$jd_tittle',status='$status' where id='$id'");
	//echo "update z_department_master set companyname='$company',status='$status' where id='$id'";
	if($sql)
{
	echo "<script>alert(' Updated Successfully');</script>";
	header("location:/HRMS/index.php");
}
}?>
