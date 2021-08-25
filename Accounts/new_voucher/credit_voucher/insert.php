<?php
require('../../../connect.php');
?>
<form type="POST">
<input type="hidden" name="cat_id" id="cat_id" value="<?php echo $_REQUEST['cat_id'];?>">
<table class="table table-bordered">
	<thead>
	<center>Credit Voucher</center>
	</thead>
	<tr>
		<td>Date</td>
		<td>
			<div class="input-group"><div class="input-group-addon"><i class="fa fa-calendar"></i></div>
				<div id="credit_vouch_date" class="input-append date">
				<div class="input-group" style="width:100%;">
				<input type="text" class="add-on form-control" id="voucher_date" name="voucher_date" title=" Date" value="<?php echo date("d-m-Y"); ?>" />			
				</div>
				<i data-time-icon="icon-time" data-date-icon="icon-calendar"></i>
				</div>
			</div>
		</td>
	</tr>
	<tr>
		<td>Slip No</td>
		<td>
			<input type="text" name="slip_no" id="slip_no" value="" class="form-control" />
		</td>
	</tr>
	<tr>
		<td>Ledger</td>
		<td>
			<select class="form-control select2" id="ledger_code" name="ledger_code">
			<option value="">Choose Ledger</option>
			<?php
			$ledger_sql = $con->query("SELECT code,name FROM accounts_ledger");
			while($ledger_res=$ledger_sql->fetch(PDO::FETCH_ASSOC))
			{
			?>
			<option value="<?php echo $ledger_res['code'];?>"><?php echo $ledger_res['name'];?></option>
			<?php

			}	
			?>	
			</select>
		</td>
	</tr>
	<tr>
		<td>Amount</td>
		<td>
			<input type="text" name="amount" id="amount" value="" class="form-control" />
		</td>
	</tr>
	<tr>
		<td></td>
		<td>
			<input type="button" name="submit" onclick="credit()"  value="Save" class="btn btn-primary btn-sm" />
		</td>
	</tr>
</table>
</form>

<script>
$(document).ready(function () {
	
		$('#credit_vouch_date').datetimepicker({
		format: "dd-MM-yyyy"
		});
	});
function credit()
{
	var id=0;
	var data=$('form').serialize();
		var ledger_code=$('#ledger_code').val();  
		var amount=$('#amount').val();	
	if(amount!='' && amount>0 && ledger_code!='')
	{
	$.ajax({
		type: "GET",
		url: "new_voucher/credit_voucher/index.php",
		data: "id="+id, data,
		success: function(data) {
			if(data==1)
			{
			alert("Vocuher Will Not be Created");
				new_voucher();
			}
			else
			{
			alert("Vocuher Will be Created");
				new_voucher();
			}
			}
		});
	}
	
	else
	{
		alert("Choose Ledger Code OR Enter amount...!!!");
	}
}
</script>