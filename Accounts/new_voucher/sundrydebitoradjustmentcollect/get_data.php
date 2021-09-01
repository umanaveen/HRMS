<?php
require('../../configuration.php');

$voucher_code=$_REQUEST['voucher_code'];

$res=mysql_fetch_array(mysql_query("select amount FROM sundry_debtors where reference='$voucher_code'"));
echo $res['amount'];

