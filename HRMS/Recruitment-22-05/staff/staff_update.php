<?php 
require '../../../connect.php';
require '../../../user.php';
$user=$_SESSION['userid'];
 $candidid=$_REQUEST['cid'];
  $cname=$_REQUEST['cname'];
  $ccode=$_REQUEST['ccode'];
  $deprt=$_REQUEST['deprt'];
  $div=$_REQUEST['div'];
  $desig=$_REQUEST['desig'];
  $reporting=$_REQUEST['reporting'];
  $date=date('Y-m-d');
  $update=$con->query("update staff_master set emp_name='$cname', dep_id='$deprt', div_id='$div', design_id='$desig',reporting_person='$reporting',modified_by='$user',modified_on='$date' where candid_id='$candidid'");
  /* echo "update staff_master set emp_name='$cname', dep_id='$deprt', div_id='$div', design_id='$desig' where candid_id='$candidid',modified_by='$user',modified_on='$date'"; */
  
  if($update)
  {
	  echo 0;
  }
?>