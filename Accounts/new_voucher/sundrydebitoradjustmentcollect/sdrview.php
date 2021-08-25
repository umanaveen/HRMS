<?php


$vd_sql="SELECT sum(a.amount) as total,a.reference,a.ledger_code,a.type,l.name FROM `account_entry` a join ledger l on l.code=a.ledger_code
where type='credit' and reference='$voucher_code' group by ledger_code,search_no";
$vd_sql1="SELECT sum(a.amount) as total,a.reference,a.ledger_code,a.type,l.name FROM `account_entry` a join ledger l on l.code=a.ledger_code
where type='debit' and reference='$voucher_code' group by ledger_code,search_no";
				 
$vd_row=mysql_query($vd_sql);
$vd_row1=mysql_query($vd_sql1);
$rtot=0;
?>


<div class="right">
<a href="#" id="1" class="excel"  onclick="tableToExcel('aslFDClosed', 'List User')">
<span class="fa fa-download">&nbsp;Excel</a>&nbsp;&nbsp;
<a href="/UCO/voucher/voucher-print.php?voucher_code=<?php echo $voucher_code; ?>" target="_blank"  style="float:right"><i class="fa fa-print"></i> Print</a>
</div>


<thead>
<caption>
<center><B> UCO BANK EMPLOYEE' CO-OP THRIFT & CREDIT SOCIETY LTD., MSCS/CR/42/94.<BR />
															NO.328,THAMBU CHETTY STREET, CHENNAI 600 001, PHONE : 044-25331230
													</B>
													</center></caption>
</thead>
<table class="table table-hoever table-bordered" id="tblMemberClosed">
<thead>
</thead>
<tbody>
<tr>
<td>Voucher Code</td><td colspan="2"><?php echo $voucher_code;?></td>
<td>Date</td><td colspan="2"><?php echo date('d-m-Y',strtotime($date));?></td>
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
<?php
while($vd_res=mysql_fetch_array($vd_row))
{
$payment=round($vd_res['total']);
if($payment<>0)
{
?>
<tr>

<td><?php echo $vd_res['name'];?></td>
<td><?php echo $val=round($vd_res['total']);?></td>
<td></td>

<?php
}
$rtot=$rtot+$val;
}
$ptot=0;
while($vd_res1=mysql_fetch_array($vd_row1))
{
$payment=round($vd_res1['total']);
if($payment<>0)
{
?>

<td><?php echo $vd_res1['name'];?></td>
<td><?php echo $val=round($vd_res1['total']);?></td>
<td></td>
</tr>
<?php
}
$ptot=$ptot+$val;
}
?>
</tbody>


