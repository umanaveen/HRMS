<?php
require '../../connect.php';
include("../../user.php");
$userid=$_SESSION['userid'];
$candidateid=$_REQUEST['id'];
$sel=$con->query("select * from candidate_form_details where id='$candidateid'");
$data=$sel->fetch();
$fname=$data['first_name'];
$lname=$data['last_name'];
$empname=$fname." ".$lname;
$department=$data['department'];

$staff_type=$data['staff_type'];


$typesel=$con->query("select * from prefixcode_master where id='$staff_type'");
$typefet=$typesel->fetch();
$code=$typefet['code'];

$staffsel=$con->query("select * from staff_master where prefix_code='$code' order by id desc");
$count = $staffsel->rowCount();
$staffet=$staffsel->fetch();
$stafcode=$staffet['emp_code'];

/*  if($company_name==1)
{
	$pref="BB";
}
else if($company_name==2)
{
	$pref=" ";
}
 */

/* $sel=$con->query("select * from staff_master where prefix_code='$pref' order by id desc limit 1");
$count = $sel->rowCount();

$emp_count=$sel->fetch();
echo $last_ecode=$emp_count['emp_code']; */
/* $exp=explode('-',$last_ecode);
 $num=$exp[1];
 $pref=$exp[0];
 $num; */

  //$num = 'Get number of Employees from database';
	$num=$stafcode+1; // add 1;

    $len = strlen($num);
	if($len <5)
	{
		echo $num ="000".$num ;
	}
	
    else
   {
	   echo $num;
   } 
   if($count==1)
{
	
  $ins=$con->query("insert into staff_master (candid_id,prefix_code,emp_code,emp_name,dep_id,status,created_by,created_on) values('$candidateid','$code','$num','$empname',$department,1,'$userid',now())"); 
  
  $que=$con->query("select id from staff_master order by id desc limit 1");
  $sfetch=$que->fetch();
  $sid=$sfetch['id'];
  
  $inser=$con->query("insert into emp_assessment_login_detail (staff_iddepartment, first_name,last_name) values('$sid','$department','$fname','$lname')");
echo "insert into emp_assessment_login_detail (staff_id,qn_name_id,company_name,department, first_name,last_name) values('$sid','$qn_name_id','$company_name','$department','$fname','$lname')";
} 
 else
{
	//$num="BB00001";
	$prefixcode=$code;
	$emp_code="00011";
	$ins=$con->query("insert into staff_master (candid_id,prefix_code,emp_code,emp_name,dep_id,status,created_by,created_on) values('$candidateid','$code','$num','$empname',$department,1,'$userid',now())"); 
   $que=$con->query("select id from staff_master order by id desc limit 1");
  $sfetch=$que->fetch();
  $sid=$sfetch['id'];

  $inser=$con->query("insert into emp_assessment_login_detail (staff_id,department, first_name,last_name) values('$sid','$department','$fname','$lname')");
	
}
if($ins)
{
$update=$con->query("update candidate_form_details set status='24' where id='$candidateid'");
}  
 if($update)
{
	echo 0;
}
else
{
echo 1;
}   
?>