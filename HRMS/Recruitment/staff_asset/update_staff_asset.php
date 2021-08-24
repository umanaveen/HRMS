<?php
require '../../../connect.php';

	$id=$_REQUEST['pur_dept'];
 $emp_name=$_REQUEST['emp_name'];
		$stationaries=$_REQUEST['stationaries'];
	$system_or_laptop=$_REQUEST['system_or_laptop'];
	//$pur_dept=$_REQUEST['pur_dept'];
	$id_card=$_REQUEST['id_card'];
	$cug=$_REQUEST['cug'];
	$access_card=$_REQUEST['access_card'];
	$erp_access=$_REQUEST['erp_access'];
	$mail_id=$_REQUEST['mail_id'];
	
	$sql=$con->query("update staff_asset set emp_name='$emp_name',stationaries='$stationaries',system_or_laptop='$system_or_laptop',id_card='$id_card',cug='$cug',access_card='$access_card',erp_access='$erp_access',mail_id='$mail_id' where id='$id'");
	
	echo "update staff_asset set emp_name='$emp_name',stationaries='$stationaries',system_or_laptop='$system_or_laptop',id_card='$id_card',cug='$cug',access_card='$access_card',erp_access='$erp_access',mail_id='$mail_id' where id='$id'";
	
	
?>
