<?php
session_start();
require ("../connect.php");
$user_id=$_SESSION['userid'];
$ip=$_SERVER['REMOTE_ADDR'];
$home_ins=$con->query("update log_entry set time=now() where user_id='$user_id' and system_ip='$ip'");
session_destroy();
	header('Location:login.php');
?>