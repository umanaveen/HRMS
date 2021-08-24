<?php
include_once("function.php");
$new=new DB_con();
	$sta=$_REQUEST['sta'];
	$cid=$_REQUEST['cid'];
	$round=$_REQUEST['round'];
	$qn_name=$_REQUEST['qn_name'];
	$allocate_person=$_REQUEST['allocate_person'];	
	
	$status=1;
	$ins=$new->insert_data($cid,$round,$qn_name,$allocate_person);
	 if($ins)
	{
		echo "hii";
	} 

?>