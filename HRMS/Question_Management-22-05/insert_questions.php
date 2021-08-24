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





$sql=$con->query("insert into question_master(qn_name,section,Questions,Option_A,Option_B,Option_C,Option_D,answer_key) values('$qn_name','$section','$Questions','$Option_A','$Option_B','$Option_C','$Option_D','$answer_key')");

echo "insert into question_master(qn_name,section,Questions,Option_A,Option_B,Option_C,Option_D,answer_key) values('$qn_name','$section','$Questions','$Option_A','$Option_B','$Option_C','$Option_D','$answer_key')";


?>