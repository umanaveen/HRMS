<?php
require('../configuration.php');

$entry_date=$_REQUEST['vou_entry_date'];
$voucher_category_code=$_REQUEST['voucher_category_code'];

?>

<div>
<form class="form-horizontal">



<table class="table table-bordered">
<thead>
</thead>

<tbody>

<tr><td>Voucher Code</td><td>
	<select class="form-control select2" name="voucher_code" id="voucher_code" onchange="Viewdata(this.value)">
	<option value="">Choose Category</option>
	<?php
	$vcSql="SELECT reference,amount FROM sundry_debtors where flag_id='19' ORDER BY id";
	$vcRow=mysql_query($vcSql);
	while($vcRes=mysql_fetch_array($vcRow))
	{
	?>
	<option value="<?php echo $vcRes['reference'];?>">
	<?php echo $vcRes['reference'].'-'.$vcRes['amount'];?></option>
	<?php
	}
	?>
	</select>
	</td></tr>

<tr><td>Amount</td><td><input type="text" name="amount" id="amount"  readonly="true"></td></tr>
<tr><td>SDR LEDGER</td><td><input type="text" name="sdr" id="sdr" value="I001" readonly="true"></td></tr>
<tr><td>Ledger</td>
<td><select class="form-control select2" id="ledger_code" name="ledger_code" onchange="sdr_sub()">
						<option value="">Select Ledger</option>
						<?PHP
							$ledger_sql="SELECT code,name FROM ledger";
							$ledger_row=mysql_query($ledger_sql);
							while($ledger_res=mysql_fetch_array($ledger_row))
							{
						?>
							<option value="<?php echo $ledger_res['code'];?>"><?php echo $ledger_res['name'];?></option>
						<?php
							}
						?>
					</select>
				</td>
		</tr>
<!--tr>
<td><input type="button" name="submit" id="submit" value="submit"></td><td></td></tr-->



</tbody>

</table>
</form>
</div>
<div id="vou_view">
</div>
<script>
function Viewdata(v)
{
	
	$.ajax({
		type:'GET',
		data:'voucher_code='+v,
		url:'voucher/get_data.php',
		success:function (data)
		{
			$('#amount').val(data);
		}
	});
}
function sdr_sub()
{
	var date='<?php echo  $entry_date; ?>';
	var voucher_category_code='<?php echo  $voucher_category_code; ?>';
	var voucher_code=$('#voucher_code').val();
	var amount=$('#amount').val();
	var sdr=$('#sdr').val();
	var ledger_code=$('#ledger_code').val();
	$.ajax({
		type:'GET',
		data:'date='+date+'&voucher_category_code='+voucher_category_code+'&voucher_code='+voucher_code+'&amount='+amount+'&sdr='+sdr+'&ledger_code='+ledger_code,
		url:'voucher/sdr_sub.php',
		success:function(data)
		{
			$('#vou_view').html(data);
		}
	});
}
</script>
