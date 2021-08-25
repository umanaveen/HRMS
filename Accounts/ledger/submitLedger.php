<?php
require '../../connect.php';
require("../../user.php");
$user=1;

$code=$_REQUEST['code']; //A001
$name=$_REQUEST['name'];
$ac_id=$_REQUEST['ac_id'];
$pl_id=$_REQUEST['pl_id'];
$bs_id=$_REQUEST['bs_id'];

$led_sql=$con->query("SELECT code FROM accounts_ledger where code like '%$code%'");
$code_count=$led_sql->fetch(PDO::FETCH_ASSOC);

$led_name_sql=$con->query("SELECT name FROM accounts_ledger where name like '%$name%'");
$name_count=$led_name_sql->fetch(PDO::FETCH_ASSOC);

if($code_count==0 && $name_count==0)
{
	$ins=$con->query("INSERT INTO accounts_ledger (code,name,accounts_id,pl_group_id,bs_group_id,created_by,created_on) VALUES('$code','$name','$ac_id','$pl_id','$bs_id','$user',NOW())");
	
	$up = $con->prepare($ins);	
	if($up->execute())
	{
		echo 1;
	}
	else
	{
		echo 2;
		print_r($up->errorInfo());
	}
	
	echo 0;
	
}
else if($code_count!=0)
{
	echo 2;
}
else if($name_count!=0)
{
	echo 3;
}
else
	{
	echo 1;
	}

?>
