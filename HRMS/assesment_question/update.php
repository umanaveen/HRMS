<?php
//require '../../user.php';
require '../../connect.php';

 $id=$_REQUEST['get_id'];

$qn_name=$_REQUEST['qn_name'];
$section=$_REQUEST['section'];
$Questions=$_REQUEST['Questions'];
$Option_A=$_REQUEST['Option_A'];
$Option_B=$_REQUEST['Option_B']; 
$Option_C=$_REQUEST['Option_C'];
$Option_D=$_REQUEST['Option_D'];
$answer_key=$_REQUEST['answer_key'];
if($_REQUEST['status']==1)
{
	$status = 1;
}
else
{
	$status = 2;
}

 $sql=$con->query("Update assessment_qn_master set qn_name='$qn_name',section='$section',Questions='$Questions',Option_A='$Option_A',Option_B='$Option_B',Option_C='$Option_C',Option_D='$Option_D',answer_key='$answer_key',status='$status' where id='$id'");
 
 echo "Update assessment_qn_master set qn_name='$qn_name',section='$section',Questions='$Questions',Option_A='$Option_A',Option_B='$Option_B',Option_C='$Option_C',Option_D='$Option_D',answer_key='$answer_key',status='$status' where id='$id'";
 
?>