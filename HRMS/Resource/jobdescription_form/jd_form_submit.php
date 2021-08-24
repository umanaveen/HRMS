<?php 
include('../../../connect.php');
include('../../../user.php');
$userid=$_SESSION['userid'];
$candidid=$_SESSION['candidateid'];
$jd_title=$_REQUEST['jd_title'];
$client=$_REQUEST['client'];
$location=$_REQUEST['location'];
$experience=$_REQUEST['experience'];
$education=$_REQUEST['education'];
$certificate=$_REQUEST['certificate'];
$roles=$_REQUEST['roles'];
$skills=$_REQUEST['skills'];
$date_joining=$_REQUEST['date_joining'];
$date_close=$_REQUEST['date_close'];
$replacement=$_REQUEST['replacement'];
$ctc=$_REQUEST['ctc'];
$status=1;

$sql=$con->query("insert into jobdescription_form_details (jobdescription_id,client_id,location,experience,education,certifications,roles,skills,joining_date,closed_date,replacement,ctc,status,created_by,created_on) values('$jd_title','$client','$location','$experience','$education','$certificate','$roles','$skills','$date_joining','$date_close','$replacement','$ctc','$status','$candidid',now())");

echo "insert into jobdescription_form_details (jobdescription_id,client_id,location,experience,education,certifications,roles,skills,joining_date,closed_date,replacement,ctc,status,created_by,created_on) values('$jd_title','$client','$location','$experience','$education','$certificate','$roles','$skills','$date_joining','$date_close','$replacement','$ctc','$status','$candidid',now())";
/* echo "insert into jobdescription_form_details (jobdescription_id,client_id,location,experience,education,certifications,roles,skills,joining_date,closed_date,status,created_by,created_on) values('$jd_title','$client','$location','$experience','$education','$certificate','$roles','$skills','$date_joining','$date_close','$status','$candidid',now())"; */
if($sql)
{
	echo 1;
}
else
{
	echo 0;
}

?>