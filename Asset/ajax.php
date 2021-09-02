<?php

include '../connect.php';
$database = new Database();
$db = $database->getConnection();

include 'ajax_class.php';
$obj = new Action($db);

$action = $_GET['action'];

if($action == "save_inward")
{
   $save_dep =  $obj->save_inward();
   if($save_dep)
       echo $save_dep ;
}

if($action == "stationary_inward")
{
	$save_stationary =  $obj->stationary_inward();
   if($save_stationary)
       echo $save_stationary ;
}


?>