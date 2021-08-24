<?php
require '../../../connect.php';
Session_start();
?>
<?php
$user_id =$_SESSION['userid'];
if(isset($_REQUEST['submit']))
{

	$department_id = $_REQUEST['Department'];
	$employee_id   = $_REQUEST['employee'];
	$org_name      = $_REQUEST['txt_org_name'];
	$org_type      = $_REQUEST['client_type'];
	$client_name   = $_REQUEST['txt_client_name'];
	$client_desig  = $_REQUEST['txt_client_desig'];
	$mobile1       = $_REQUEST['txt_mobile1'];
	$mobile2       = $_REQUEST['txt_mobile2'];
	$land_lineno   = $_REQUEST['txt_landno'];
	$mailid1       = $_REQUEST['txt_mail_id1'];
	$mailid2       = $_REQUEST['txt_mail_id2'];
	$address1      = $_REQUEST['txt_address1'];
	$address2      = $_REQUEST['txt_address2'];
	$area          = $_REQUEST['txt_area'];
	$town_city     = $_REQUEST['txt_town'];
	$pincode       = $_REQUEST['txt_pincode'];
	$district      = $_REQUEST['txt_district'];
	$state         = $_REQUEST['txt_state'];
	$country       = $_REQUEST['txt_country'];
	$gst_no        = $_REQUEST['txt_gst_no'];
	$website       = $_REQUEST['txt_website'];
	$status        = $_REQUEST['status'];
	$pur_name        = $_REQUEST['pur_name'];
	$pur_designation        = $_REQUEST['pur_designation'];
	$pur_contact        = $_REQUEST['pur_contact'];
	$pur_mail        = $_REQUEST['pur_mail'];
	$pur_branch        = $_REQUEST['pur_branch'];
	$pur_address1        = $_REQUEST['pur_address1'];
	$pur_area        = $_REQUEST['pur_area'];
	$pur_town        = $_REQUEST['pur_town'];
	$pur_pincode        = $_REQUEST['pur_pincode'];
	$pur_district        = $_REQUEST['pur_district'];
	$pur_state        = $_REQUEST['pur_state'];
	$pur_country        = $_REQUEST['pur_country'];
	$fin_name        = $_REQUEST['fin_name'];
	$fin_designation        = $_REQUEST['fin_designation'];
	$fin_contact        = $_REQUEST['fin_contact'];
	$fin_mail        = $_REQUEST['fin_mail'];
	$fin_branch        = $_REQUEST['fin_branch'];
	$fin_address1        = $_REQUEST['fin_address1'];
	$fin_area        = $_REQUEST['fin_area'];
	$fin_town        = $_REQUEST['fin_town'];
	$fin_pincode        = $_REQUEST['fin_pincode'];
	$fin_district        = $_REQUEST['fin_district'];
	$fin_state        = $_REQUEST['fin_state'];
	$fin_country        = $_REQUEST['fin_country'];
	
	
	
	
	
	$insert_sql=$con->query("insert into client_master(department_id,employee_id,client_name,org_name,org_type,designation,mobile_no1,mobile_no2,land_line_no,email_id1,email_id2,address1,
	address2,area,town_city,pincode,district,state,country,gst_no,website,pur_name, pur_designation, pur_contact, pur_mail, fin_name, fin_designation, fin_contact, fin_mail, pur_bran_address, pur_bran_area, pur_bran_city, pur_bran_district, pur_bran_pincode, pur_bran_state, pur_bran_country, fin_bran_address, fin_bran_area, fin_bran_city, fin_bran_district, fin_bran_pincode, fin_bran_state, fin_bran_country, pur_bran_status, fin_bran_status,status,flow,created_by,created_on,approve_flag)
	values('$department_id','$employee_id','$client_name','$org_name','$org_type','$client_desig','$mobile1','$mobile2','$land_lineno','$mailid1','$mailid2','$address1','$address2','$area','$town_city','$pincode','$district','$state','$country','$gst_no','$website','$pur_name','$pur_designation','$pur_contact','$pur_mail','$fin_name','$fin_designation','$fin_contact','$fin_mail','$pur_address1','$pur_area','$pur_town','$pur_district','$pur_pincode','$pur_state','$pur_country','$fin_address1','$fin_area','$fin_town','$fin_district','$fin_pincode','$fin_state','$fin_country','$pur_branch','$fin_branch','$status','1','$user_id',NOW(),'2')");
	echo "insert into client_master(company_id,department_id,employee_id,client_name,org_name,org_type,designation,mobile_no1,mobile_no2,land_line_no,email_id1,email_id2,address1,
	address2,area,town_city,pincode,district,state,country,gst_no,website,status,flow,created_by,created_on)
	values('$company_id','$department_id','$employee_id','$client_name','$org_name','$org_type','$client_desig','$mobile1','$mobile2','$land_lineno','$mailid1','$mailid2','$address1','$address2','$area','$town_city','$pincode','$district','$state','$country','$gst_no','$website','$status','1','$user_id',NOW())";
if($insert_sql)
{
	echo "<script>alert('Client Details Saved Successfuly');</script>";
	header("location:/HRMS/index.php");
}
}
?>