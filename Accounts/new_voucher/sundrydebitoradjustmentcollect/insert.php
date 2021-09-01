<?php
require('../../configuration.php');
require('../../user.php');
$user_id=$_SESSION['user'];
$date=date('d-m-Y');
$voucher_category_code=$_REQUEST['vou_cat_code'];
$vou_pur_id=$_REQUEST['vouc_pur_id'];

$vouch_pur=mysql_query("select code from voucher_purpose where id='$vou_pur_id' and voucher_category_code='$voucher_category_code'"); // get the purpose code 
$voucher_pur_code_count=mysql_num_rows($vouch_pur);
$vouch_pur_code=mysql_fetch_array($vouch_pur);  	// Get the data
$voucher_purp_code=$vouch_pur_code['code'];   		// voucher purpose code 
if($voucher_pur_code_count>0)  						// Voucher count greater than 0 -- Success function
{
	if($voucher_purp_code=='PUR-019') 				// New member Creation of Adjustment receipt
	{
 ?>
 <h4><center>SUNDRY DEBITOR</center></h4>
  <form type="POST" id="sundrydepitor">
<div>
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
<input type="hidden" name="date" value="<?php echo $date; ?>">
<tr><td>Amount</td><td><input class="form-control" type="text" name="amount" id="amount"  readonly="true"></td></tr>
<tr><td>SDR LEDGER</td><td><input class="form-control" type="text" name="sdr" id="sdr" value="I001" readonly="true"></td></tr>
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
</div>
  <div id="vou_view">
</div>  
<tr>
<td><input type="button"  name="adjustcollectasas" onclick="sundadjcollect(0)" style="float:right;margin-right:50px;" value="Save" class="btn btn-primary btn-md" /></td>
</tr>

</form>
<?php 
}	
}
else
{
	echo "Choose an valid code";
}
?>

<script>
function Viewdata(v)
{
	
	$.ajax({
		type:'GET',
		data:'voucher_code='+v,
		url:'new_voucher/sundrydebitoradjustmentcollect/get_data.php',
		success:function (data)
		{
			$('#amount').val(data);
		}
	});
}
function sundadjcollect(d)
{
	var id=1; //alert(id);
	var data=$('form').serialize();
	$.ajax({
		type:'GET',
		data:'id='+id, data,
		url:'new_voucher/sundrydebitoradjustmentcollect/index.php',
		success:function (data)
		{
			if(data)
			{
				alert('SUNDRY DEBIT ADJUSTMENT Not Created..!!!');
			}
			else
			{
				alert('SUNDRY DEBIT ADJUSTMENT Created..!!!');
			}
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
		url:'new_voucher/sundrydebitoradjustmentcollect/sdr_sub.php',
		success:function(data)
		{
			$('#vou_view').html(data);
		}
	});
}
</script>
