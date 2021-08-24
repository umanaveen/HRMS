<?php
require '../../../connect.php';
include("../../../user.php");
$userid=$_SESSION['userid'];
$asset_name=$_REQUEST['asset_name'];
$staff_id=$_REQUEST['sid'];
$reqid=$_REQUEST['reqid'];
$cug_status=$_REQUEST['cug_sta'];
$sim_id=$_REQUEST['cug'];
$mail_id=$_REQUEST['mail_id'];
$cou=count($asset_name);
for($i=0;$i<$cou;$i++)
{
	$ins=$con->query("insert into staff_asset_list(asset_request_id,staff_id,asset_id,cug,sim_id,mail_id,status,created_by,created_on)values('$reqid','$staff_id','$asset_name[$i]','$cug_status','$sim_id','$mail_id',1,'$userid',now())");
	$upd=$con->query("update assets_form_detail set status='2' where id='$asset_name[$i]'");
	
	//echo "update assets_form_detail set status='2' where id='$asset_name[$i]'";
	/* echo "insert into staff_asset_list(staff_id,asset_id,status,created_by,created_on)values('$staff_id','$asset_name[$i]','$userid',1,now())"; */
}

	$upddate=$con->query("update staff_access_request set status='2' where id='$reqid'");
	$upddate=$con->query("update sim_mapping set status='2' where id='$sim_id'");
if($ins)
{
	echo "<script>alert(' Inserted Updated');</script>";
	header("location:/HRMS/index.php");
}
?>