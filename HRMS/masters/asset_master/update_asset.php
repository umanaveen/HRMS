<?php
require '../../../connect.php';
?>
<?php
if(isset($_REQUEST['submit']))
{
	$id=$_REQUEST['id'];
	$asset_name=$_REQUEST['asset_name'];
	$asset_type=$_REQUEST['asset_type'];
	$prefix_code=$_REQUEST['prefix_code'];
	$status=$_REQUEST['status'];
	$sql=$con->query("update assets_master set name='$asset_name',type='$asset_type',prefix_code='$prefix_code',status='$status',modified_on=now() where id='$id'");
	//echo "update z_department_master set companyname='$company',status='$status' where id='$id'";
	if($sql)
{
	echo "<script>alert(' Updated Successfully');</script>";
	header("location:/HRMS/index.php");
}
}?>
