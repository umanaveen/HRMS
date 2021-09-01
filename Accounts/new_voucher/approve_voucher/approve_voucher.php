<?php
require('../../configuration.php');
require('../../user.php');

$user=$_SESSION['user'];
$vou_no=$_REQUEST['vou_no'];

$voucher_mast=mysql_query("update voucher set status='2',modified_by='$user',modified_on=now() where code='$vou_no'");


 if($voucher_mast>0)
 {
	$voucher_det=mysql_query("update voucher_detail set status='2',modified_by='$user',modified_on=now() where voucher_code='$vou_no'");
	if($voucher_det>0)
	{
		 echo 1;
	}
	else
	{
		echo 0;
	}
 }
 else
 {
	 echo 00;
 }







































?>