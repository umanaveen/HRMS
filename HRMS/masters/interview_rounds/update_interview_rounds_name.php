<?php
require '../../../connect.php';

	$id=$_REQUEST['id'];
	
		
	$section_name=$_REQUEST['section_name'];
$section_name_count=count($section_name);


 for($i=0;$i<$section_name_count;$i++)
{

$section_names= $section_name[$i];

 
  $sql1=$con->query("INSERT INTO `interview_round_name`(`inter_id`,`Sec_name`) VALUES ('$id','$section_names')");  
echo "INSERT INTO `interview_round_name`(`inter_id`,`Sec_name`) VALUES   values('$id','$section_names')";

}

?>
