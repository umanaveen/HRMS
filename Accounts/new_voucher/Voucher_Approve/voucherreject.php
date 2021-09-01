<?php

require('../../configuration.php');
require('../../user.php');
$user_id=$_SESSION['user'];

echo $voucher_code=$_REQUEST['voucher_code'];


$vou_reject=mysql_query("UPDATE voucher SET status=4,modified_by='$user_id',modified_on=now() WHERE code='$voucher_code'");
$vou_det_reject=mysql_query("UPDATE voucher_detail SET status=4,modified_by='$user_id',modified_on=now() WHERE voucher_code='$voucher_code'");
?>