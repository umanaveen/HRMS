<?php
require '../../connect.php';
Session_start();
$user_id =$_SESSION['userid'];
$id    = $_REQUEST['id'];
$company_id    = $_REQUEST['company_name'];
	$department_id = $_REQUEST['Department_id'];
	$employee_id   = $_REQUEST['employee_id'];
	$org_name      = $_REQUEST['txt_org_name'];
	$org_type      = $_REQUEST['client_type_id'];
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
	$flag = 1;
	
	 $insert_sql=$con->query("insert into client_master(company_id,department_id,employee_id,client_name,org_name,org_type,
	designation,mobile_no1,mobile_no2,land_line_no,email_id1,email_id2,address1,
	address2,area,town_city,pincode,district,state,country,gst_no,website,flow,created_by,created_on)
	values('$company_id','$department_id','$employee_id','$client_name','$org_name',
	'$org_type','$client_desig','$mobile1','$mobile2','$land_lineno','$mailid1','$mailid2','$address1',
	'$address2','$area','$town_city','$pincode','$district','$state','$country','$gst_no','$website','1',
	'$user_id',NOW())");
	
	$update_sql=$con->query("UPDATE `enquiry` SET `flag`='$flag' WHERE id='$id'"); 
	
	/* echo "insert into client_master(company_id,department_id,employee_id,client_name,org_name,org_type,
	designation,mobile_no1,mobile_no2,land_line_no,email_id1,email_id2,address1,
	address2,area,town_city,pincode,district,state,country,gst_no,website,flow,created_by,created_on)
	values('$company_id','$department_id','$employee_id','$client_name','$org_name',
	'$org_type','$client_desig','$mobile1','$mobile2','$land_lineno','$mailid1','$mailid2','$address1',
	'$address2','$area','$town_city','$pincode','$district','$state','$country','$gst_no','$website','1',
	'$user_id',NOW())"; */
	
	
?>