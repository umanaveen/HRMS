<?php

require('../configuration.php');
require("../user.php");
$user=$_SESSION['user'];

$date=$_REQUEST['date'];
$voucher_category_code=$_REQUEST['voucher_category_code'];

$pur_code=mysql_fetch_array(mysql_query("SELECT code FROM voucher_purpose WHERE voucher_category_code='CAT-006'"));
$voucher_purpose_code=$pur_code['code'];

$old_voucher_code=$_REQUEST['voucher_code'];
$amount=$_REQUEST['amount'];
$sdr=$_REQUEST['sdr'];
$ledger_code=$_REQUEST['ledger_code'];


?>
<div class="right">
</div>

<table class="table table-hoever table-bordered" id="tblMemberClosed">
<thead>
</thead>
<tbody>
<tr>
<td>Ref Voucher Code</td><td colspan="2"><?php echo $old_voucher_code;?></td>
<td>Date</td><td colspan="2"><?php echo $date;?></td>
</tr>

<tr>
<td>Category</td>
<td colspan="2"><?php echo $voucher_category_code;?></td>
<td>Purpose</td>
<td colspan="2"><?php echo $voucher_purpose_code;?></td>
</tr>

</tbody>

<thead>
<tr>
<td colspan="3"><center>RECEIPTS</center></td>
<td colspan="3"><center>PAYMENTS</center></td>
</tr>
<tr>
<td>Head of Account</td><td colspan="2">Amount</td><td>Head of Account</td><td colspan="2">Amount</td>
</tr>
<tr>
<td></td>
<td>Rs.</td>
<td>P.</td>
<td></td>
<td>Rs.</td>
<td>P.</td>
</tr>
</thead>
<tbody>

<tr>
<td><?php echo $sdr;?></td><td><?php echo $amount;?></td><td></td>
<td><?php echo $ledger_code;?></td><td><?php echo $amount;?></td><td></td>
</tr>

</tbody>

