<?php
require '../../../connect.php';
require '../../../user.php';
$user=$_SESSION['userid'];
$candidateid=$_SESSION['candidateid'];
 $relieve_reason=$_REQUEST['relieve_reason'];
  $remarks=$_REQUEST['remarks'];
  $status=1;
  $upd=$con->query("insert into resignation_form_details (candidate_id,reason,remarks,applied_date,status)values('$candidateid','$relieve_reason','$remarks',now(),'$status')");
  
  if($upd)
  {
	  echo 0;
	  
  }
  else
  {
	  echo 1;
  }
?>