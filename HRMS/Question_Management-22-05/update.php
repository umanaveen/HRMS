<?php
//require '../../user.php';
require '../../connect.php';

 $id=$_REQUEST['get_id'];

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



 $sql=$con->query("Update question_master set Questions='$Questions',Option_A='$Option_A',Option_B='$Option_B',Option_C='$Option_C',Option_D='$Option_D',answer_key='$answer_key',status='$status' where id='$id'");
 
 
 
 

?>