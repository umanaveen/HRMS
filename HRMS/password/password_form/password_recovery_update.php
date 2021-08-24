<?php


require '../../../connect.php';
include("../../../user.php");


$password_master_id=$_REQUEST['password_master_id'];
if($password_master_id==1 ||$password_master_id==6 ||$password_master_id==7||$password_master_id==8||
$password_master_id==9||
$password_master_id==10 ){


$candidateid=$_SESSION['candidateid'];
$get_id=$_REQUEST['get_id'];
$org1=$_REQUEST['org1'];
$Link1=$_REQUEST['Link1'];
$Username1=$_REQUEST['Username1'];
$password1=$_REQUEST['password1'];
$R_mailid=$_REQUEST['R_mailid'];
$Re_number=$_REQUEST['Re_number'];

	$sql=$con->query("update password_recovery set organization='$org1',link='$Link1',
	username='$Username1',Password='$password1',recovery_mailid='$R_mailid',
	phone_number='$Re_number',Modified_by=now(),modified_on='$candidateid' where id='$get_id'");

	echo "update password_recovery set organization='$org1',link='$Link1',
	username='$Username1',Password='$password1',recovery_mailid='$R_mailid',
	phone_number='$Re_number',Modified_by=now(),modified_on='$candidateid' where id='$get_id'";
 
} 
else if ($password_master_id==2 ||$password_master_id==3 ||$password_master_id==4)
{

	$candidateid=$_SESSION['candidateid'];
$get_id=$_REQUEST['get_id'];
$org1=$_REQUEST['org2'];
$Link1=$_REQUEST['Link2'];
$Username1=$_REQUEST['Username2'];
$password1=$_REQUEST['password2'];


	$sql=$con->query("update password_recovery set organization='$org1',link='$Link1',
	username='$Username1',Password='$password1',Modified_by=now(),modified_on='$candidateid' where id='$get_id'");

	echo "update password_recovery set organization='$org1',link='$Link1',
	username='$Username1',Password='$password1',recovery_mailid='$R_mailid',
	phone_number='$Re_number',Modified_by=now(),modified_on='$candidateid' where id='$get_id'";
} else if ($password_master_id==11)
{

$candidateid=$_SESSION['candidateid'];
$get_id=$_REQUEST['get_id'];
$org1=$_REQUEST['org3'];
$Link1=$_REQUEST['Link3'];
$Username1=$_REQUEST['Username3'];
$password1=$_REQUEST['password4'];
$UAN=$_REQUEST['UAN'];

	$sql=$con->query("update password_recovery set organization='$org1',link='$Link1',
	username='$Username1',Password='$password1',uan_number='$UAN',Modified_by=now(),modified_on='$candidateid' where id='$get_id'");

	echo "update password_recovery set organization='$org1',link='$Link1',
	username='$Username1',Password='$password1',recovery_mailid='$R_mailid',
	phone_number='$Re_number',Modified_by=now(),modified_on='$candidateid' where id='$get_id'";
} 
else if ($password_master_id==12)
{

$candidateid=$_SESSION['candidateid'];
$get_id=$_REQUEST['get_id'];
$org1=$_REQUEST['org4'];
$Link1=$_REQUEST['Link4'];
$Username1=$_REQUEST['Username4'];
$password1=$_REQUEST['password5'];
$esNumber=$_REQUEST['esNumber'];

	$sql=$con->query("update password_recovery set organization='$org1',link='$Link1',
	username='$Username1',Password='$password1',Esic_number='$esNumber',Modified_by=now(),modified_on='$candidateid' where id='$get_id'");

	echo "update password_recovery set organization='$org1',link='$Link1',
	username='$Username1',Password='$password1',recovery_mailid='$R_mailid',
	phone_number='$Re_number',Modified_by=now(),modified_on='$candidateid' where id='$get_id'";
}
else if ($password_master_id==13)
{

$candidateid=$_SESSION['candidateid'];
$get_id=$_REQUEST['get_id'];
$org1=$_REQUEST['org5'];
$bank1=$_REQUEST['bank1'];
$acount_type1=$_REQUEST['acount_type1'];
$acc_num1=$_REQUEST['acc_num1'];
$acc_hol_name1=$_REQUEST['acc_hol_name1'];
$ifsc1=$_REQUEST['ifsc1'];
$Branch1=$_REQUEST['Branch1'];
$acc_open_date1=$_REQUEST['acc_open_date1'];
$minimum_balance1=$_REQUEST['minimum_balance1'];
$net_Link=$_REQUEST['net_Link'];
$NetUsername=$_REQUEST['NetUsername'];
$netpassword=$_REQUEST['netpassword'];
$debitcard_number1=$_REQUEST['debitcard_number1'];
$card_hoder_name1=$_REQUEST['card_hoder_name1'];
$Type_card1=$_REQUEST['Type_card1'];
$month_year1=$_REQUEST['month_year1'];


	$sql=$con->query("update password_recovery set organization='$org1',link='$net_Link',
	username='$NetUsername',Password='$netpassword',Name_bank='$bank1',Name_bank='$bank1',Account_type='$acount_type1',Account_number='$acc_num1',Account_holder_name='$acc_hol_name1'
	,ifsc='$ifsc1',Branch='$Branch1',Account_opening_date='$acc_open_date1',Minimum_balance='$minimum_balance1',Card_number='$debitcard_number1',Card_holder_name='$card_hoder_name1'
	,Type_card='$Type_card1',exp_month_year='$month_year1',Modified_by=now(),modified_on='$candidateid' where id='$get_id'");

	echo "update password_recovery set organization='$org1',link='$Link1',
	username='$Username1',Password='$password1',recovery_mailid='$R_mailid',
	phone_number='$Re_number',Modified_by=now(),modified_on='$candidateid' where id='$get_id'";
}
else if ($password_master_id==14)
{

$candidateid=$_SESSION['candidateid'];
$get_id=$_REQUEST['get_id'];
$org6=$_REQUEST['org6'];
$bank2=$_REQUEST['bank2'];
$holder_name2=$_REQUEST['holder_name2'];
$Type_card2=$_REQUEST['Type_card2'];
$month_year2=$_REQUEST['month_year2'];
$credit_limit2=$_REQUEST['credit_limit2'];


$sql=$con->query("update password_recovery set organization='$org6',Name_bank='$bank2',Card_holder_name='$bank1',Card_holder_name='$holder_name2'
	,Type_card='$Type_card2',exp_month_year='$month_year2',credit_limit='$credit_limit2',Modified_by=now(),modified_on='$candidateid' where id='$get_id'");

	echo "update password_recovery set organization='$org1',link='$Link1',
	username='$Username1',Password='$password1',recovery_mailid='$R_mailid',
	phone_number='$Re_number',Modified_by=now(),modified_on='$candidateid' where id='$get_id'";
}
?>