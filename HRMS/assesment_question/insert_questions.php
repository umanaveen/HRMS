<?php
require '../../connect.php';


$qn_name=$_REQUEST['qn_name'];
$section=$_REQUEST['section'];
$Questions=$_REQUEST['Questions'];

 $Option_A=$_REQUEST['Option_A'];
$Option_B=$_REQUEST['Option_B'];
$Option_C=$_REQUEST['Option_C'];
$Option_D=$_REQUEST['Option_D'];
$answer_key=$_REQUEST['answer_key'];





$sql11=$con->query("insert into assessment_qn_master(qn_name,section,Questions,Option_A,Option_B,Option_C,Option_D,answer_key,status) values('$qn_name','$section','$Questions','$Option_A','$Option_B','$Option_C','$Option_D','$answer_key',1)");
/* 
echo "insert into assessment_qn_master(qn_name,section,Questions,Option_A,Option_B,Option_C,Option_D,answer_key,status) values('$qn_name','$section','$Questions','$Option_A','$Option_B','$Option_C','$Option_D','$answer_key',1)"; */
?>