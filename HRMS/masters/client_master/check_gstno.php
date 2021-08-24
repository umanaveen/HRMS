<?php
require '../../../connect.php';
include("../../../user.php");

$GstNo = $_POST['gst'];

$Count = 0;
$check_gst_query = $con->query("select gst_no from client_master where gst_no = '$GstNo'");

  while($row = $check_gst_query->fetch(PDO::FETCH_ASSOC)){
	if($row>0){
	   $Count = 1;
    }
  }
echo $Count;
?> 