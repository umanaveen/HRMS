<?php
//require '../../user.php';
require '../../connect.php';

$id=$_REQUEST['sname'];
$scale_name=$_REQUEST['scale_name'];
$from_date=date('Y-m-d',strtotime($_REQUEST['from_date']));
$basic_pay=$_REQUEST['basic_pay'];
$spl_pay=$_REQUEST['spl_pay'];
$grade_pay=$_REQUEST['grade_pay'];
$da=$_REQUEST['da'];
$hra=$_REQUEST['hra'];
$cca=$_REQUEST['cca'];
$bonus=$_REQUEST['bonus'];
$addition_allowance=$_REQUEST['addition_allowance'];
$others=$_REQUEST['others'];
$now=date('Y-m-d');
//$status="1";
if($_REQUEST['status']==1)
{
	$status = 1;
}
else
{
	$status = 2;
}



 $sql=$con->query("Update master_scale_master set scale_name='$scale_name',from_date='$from_date',basic_pay='$basic_pay',spl_pay='$spl_pay',grade_pay='$grade_pay',da='$da',hra='$hra',cca='$cca',bonus='$bonus',addition_allowance='$addition_allowance',others='$others',status='$status'  where id='$id'");
 echo "Update master_scale_master set scale_name='$scale_name',from_date='$from_date',basic_pay='$basic_pay',spl_pay='$spl_pay',grade_pay='$grade_pay',da='$da',hra='$hra',cca='$cca',bonus='$bonus',addition_allowance='$addition_allowance',others='$others',status='$status'  where id='$id'";
 
 
 

?>