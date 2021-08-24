<?php
require '../../../connect.php';
include("../../../user.php");
$userid=$_SESSION['userid'];
?>
<?php
if(isset($_REQUEST['submit']))
{
	$emp_name=$_REQUEST['emp_name'];
	$cug=$_REQUEST['cug'];
	$view=$_REQUEST['View'];
	$imp=implode(",",$view);
	
	$sql=$con->query("insert into staff_access_request(staff_id,asset_master_id,cug_status,status,created_by,created_on)values('$emp_name','$imp','$cug','1','$userid',now())");	
	echo "insert into staff_access_list(staff_id,access,status,created_by,created_on)values('$emp_name','$imp','1','$userid',now())";
	/* $sql=$con->query("insert into staff_asset(emp_name,stationaries,system_or_laptop,pur_dept,id_card,cug,access_card,erp_access,mail_id,created_by,created_on,modified_by,modified_on)values('$emp_name','$stationaries','$system_or_laptop','$pur_dept','$id_card','$cug','$access_card','$erp_access','$mail_id','2',now(),'2',now())");
	
	echo "insert into staff_asset(emp_name,stationaries,system_or_laptop,pur_dept,id_card,cug,access_card,erp_access,mail_id,created_by,created_on,modified_by,modified_on)values('$emp_name','$stationaries','$system_or_laptop','$pur_dept','$id_card','$cug','$access_card','$erp_access','$mail_id','2',now(),'2',now())"; */
if($sql)
{
	echo "<script>alert(' Inserted Updated');</script>";
	header("location:/HRMS/index.php");
}
}
?>