<?php
require '../../../connect.php';
include("../../../user.php");
$user_id =$_SESSION['userid'];
//echo "<pre>";print_r($candidate_id);exit();
 $id = $_REQUEST['get_id'];

$txt_vendor_name=$_REQUEST['txt_vendor_name'];
$vendor_type  =$_REQUEST['vendor_type'];
$txt_address1=$_REQUEST['txt_address1'];
$txt_address2=$_REQUEST['txt_address2'];
$txt_area=$_REQUEST['txt_area'];
$txt_town=$_REQUEST['txt_town'];
$txt_pincode=$_REQUEST['txt_pincode'];
$txt_district=$_REQUEST['txt_district'];
$txt_country=$_REQUEST['txt_country'];
$txt_state=$_REQUEST['txt_state'];

$txt_account_name=$_REQUEST['txt_account_name'];
$txt_account_no=$_REQUEST['txt_account_no'];
$txt_swift_code=$_REQUEST['txt_swift_code'];
$txt_ifsc_code=$_REQUEST['txt_ifsc_code'];
$txt_mailid=$_REQUEST['txt_mailid'];
$status=$_REQUEST['status'];


	$sql2= $con->query("Update doller_vendor_mastor set vendor_name='$txt_vendor_name',vendor_type='$vendor_type',
	address1='$txt_address1',address2='$txt_address2',area='$txt_area',town_city='$txt_town',state='$txt_state',district='$txt_district',country='$txt_country',pincode='$txt_pincode',account_name='$txt_account_name',account_no='$txt_account_no',
	swift_code='$txt_swift_code',ifsc_code='$txt_ifsc_code',mail_id='$txt_mailid',status='$status',
	modified_by='$user_id',modified_on=NOW()
	where id='$id'");
	
	echo"Update doller_vendor_mastor set vendor_name='$txt_vendor_name',vendor_type='$vendor_type',
	address1='$txt_address1',address2='$txt_address2',area='$txt_area',town_city='$txt_town',state='$txt_state',district='$txt_district',country='$txt_country',pincode='$txt_pincode',account_name='$txt_account_name',account_no='$txt_account_no',
	swift_code='$txt_swift_code',ifsc_code='$txt_ifsc_code',mail_id='$txt_mailid',status='$status',
	modified_by='$user_id',modified_on=NOW()
	where id='$id'";exit;
	?>