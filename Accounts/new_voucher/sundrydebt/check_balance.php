<?php
require('../../configuration.php');

$member_no=$_REQUEST['member_no'];
$amount=$_REQUEST['amount'];
		$query=mysql_fetch_array(mysql_query("select amount,against,reference from sundry_debtors where amount='$amount' and member_no='$member_no'"));
if($query)
{	
		$amount=$query['amount'];
		$reference=$query['reference'];
		$against=$query['against'];
	 echo $amount.'/'.$reference.'/'.$against;
}
else
{
	echo 0;
}

?>

	