<?php 
require('../../connect.php');
?>

<div class="box box-success ">
	<div class="box-body no-padding col-sm-12" style="margin:1px;">
		<div class="col-sm-5">
			<select class="form-control vouch_search" id="search_voucher_no" name="search_voucher_nos" style="">
			<option value="">Choose Voucher Number</option>
			<?php
			$search_voucher=$con->query("SELECT code,voucher_purpose_code,voucher_category_code FROM accounts_voucher where created_on<now() and status in (0,2,3,4)order by id desc");
			while($voucher_list=$search_voucher->fetch(PDO::FETCH_ASSOC))
			{  
			$vou_code=$voucher_list['code'];
			?>
			<option value="<?php echo $vou_code; ?>"><?php echo $vou_code; ?></option>
			<?php 
			}
			?>
			</select>
		</div> 
		<div class="col-sm-2">
			<span class="input-group-btn">
			<button class="btn btn-info btn-flat" type="button" onClick="voucher_search()">Search</button>
			</span>
		</div>
	</div> 
</div>		<!-- box box-primary-->

<div id="voucher_home">
<div class="newmember_adj" style="width:100%;height:100%;">		
<div class="newmember_adj_left" style="width:25%;height:480px;float:left;margin-top:1px;overflow:scroll;">
<!-- Side Screeen of page -->
<div class="box box-primary">
<div class="box-body">
<ul class="nav nav-pills" style="float:left; width:100%; " >	
<li style="background-color:orange; width:100%;">
<p style="text-align:center; margin-top:10px;font-family: none;font-style:inherit;font-size: large;font-variant-caps:unset; font-size:14px;font-weight:bold;text-align:center;">Voucher Waiting List</p></li>
<?php
$vouch_row=$con->query("SELECT code FROM accounts_voucher where status=1 order by id desc");
$s1=1;
while($voucher_res=$vouch_row->fetch(PDO::FETCH_ASSOC))
{
	$code=$voucher_res['code'];
?>
<li style="border-top:1px solid #ddd;cursor:pointer;width:100%;text-transform:uppercase;line-height:20px;font-weight:bold; position:relative;" class="active1" id="<?php echo $s1;?>">
<?php echo "Vou Code:&nbsp".$voucher_res['code'];?>
<div style="float:right;">
<button class="btn btn-primary" id="" value="<?php echo $code;?>" onclick="edit(this.value)"><i class="fa fa-pencil"></i></button>
<button class="btn btn-success" id="" value="<?php echo $code;?>" onClick="view(this.value)"><i class="fa fa-eye"></i></button>
</div>
<?php $s1++; ?>
</li>
<?php
}    
?>
</ul>
</div>                   <!-- box-body close-->
</div>		
</div>
<div class="box box-primary" id="newmember_adj_right" style="width:75%;float:left;overflow:scroll;height:500px;">

<?php 

	$vouch_res=$con->query("SELECT code,date,voucher_category_code,voucher_purpose_code,slip_no,reference_voucher,reference_no,ledger_code,amount,bank_code,cheque_no,cheque_date,description,narration,status FROM accounts_voucher order by id desc limit 0,1");
	$voucher=$vouch_res->fetch(PDO::FETCH_ASSOC);

	$date=$voucher['date'];
	$voucher_code=$voucher['code'];
?>
<table class="table table-bordered table-hover" style="margin:1px;" >

<thead style="FONT-SIZE: 14px;font-family: none;">
<center>
</center>
</thead>

<tbody>
<tr>
<td>Voucher Code</td><td><?php echo $voucher_code;?></td><td>Date</td><td><?php echo $date;?></td>
</tr>


<tr>
<td>Amount</td><td style="text-align:right"><?php echo round($voucher['amount']); ?></td>
<td>Bank <br> Cheque No</td><td><?php echo $voucher['bank_code']; ?><br><?php echo $voucher['cheque_no']; ?></td>
</tr>

<tr><th colspan="2">Ledger Code</th><th>Receipt</th><th>Payment</th></tr>
<?php

$v_sql=$con->query("SELECT ledger_code,reference,amount,type,narration,status FROM accounts_voucher_detail WHERE 
voucher_code='$voucher_code'");

$credit_t=0;
$debit_t=0;

while($vou_det=$v_sql->fetch(PDO::FETCH_ASSOC))
{
	
	$ledger=$vou_det['ledger_code'];
	$led_sql = $con->query("SELECT name FROM accounts_ledger WHERE code='$ledger'");
	$led_name=$led_sql->fetch(PDO::FETCH_ASSOC);
	$ledger_name=$led_name['name'];
?>
<tr>	
	<td colspan="2"><?php echo $ledger.'-'.$ledger_name; ?></td>	
	<td style="text-align:right">
	<?php 
	if($vou_det['type']=='credit')
	{
		$credit=$vou_det['amount'];
		echo round($credit);
		$credit_t=$credit_t+$credit;
	}
	?>
	</td>
		
	<td style="text-align:right">
	<?php
	if($vou_det['type']=='debit')
	{
		$debit=$vou_det['amount'];
		echo round($debit);
		$debit_t=$debit_t+$debit;
	}
	?>
	</td>
</tr>		
	
<?php
}
?>
<tr><td colspan="2">Total</td><td style="text-align:right"><?php echo $credit_t; ?></td>
								<td style="text-align:right"><?php echo $debit_t; ?></td>
								</tr>
</tbody>
</table>
</div>
</div>
</div>

 <!-- Page js file will be there..@! -->

<?php require('edit_voucher_page.js'); ?> 
