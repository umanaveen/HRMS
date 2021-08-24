<?php
require '../../../connect.php';

$id=$_REQUEST['id'];
	//$getid=$_REQUEST['get_id'];
	$name=$_REQUEST['name'];
	$status=$_REQUEST['status'];
		
	$sql=$con->query("update interview_rounds set name='$name',status='$status' where id='$id'");
	
	
$count=$_REQUEST['count'];
$count_name_count= count($count);
	for($i=0;$i<$count_name_count;$i++)
{
	 $get_id=$_REQUEST['get_id'.$i];
$section_names= $_REQUEST['section_name'.$i];

 $sql1=$con->query("update interview_round_name set Sec_name='$section_names' where id='$get_id'");
  echo "update interview_round_name set Sec_name='$section_names' where id='$get_id'";

}
?>
