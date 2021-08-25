<?php
 require("../../configuration.php");
 require("../../user.php");
$user=$_SESSION['user'];	




$id=$_REQUEST['id'];
$code=$_REQUEST['code']; //A001
$name=$_REQUEST['name'];
$ac_id=$_REQUEST['ac_id'];
$pl_id=$_REQUEST['pl_id'];
$bs_id=$_REQUEST['bs_id'];

if($ac_id != '')
{
$sql=mysql_query("update ledger set code='$code',name='$name',accounts_id='$ac_id',pl_group_id='$pl_id',bs_group_id='$bs_id',modified_by='$user',modified_on=NOW() where id='$id'");
if($sql)
{
	echo 0;
}
else
{
	echo 1;
}
}
else
{
	echo 1;
}
?>

