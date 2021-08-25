<?php 

require('../../../connect.php');
$date=date('d-m-Y');
$cur_date=date('m-d-Y',strtotime($date));


?>
<form id="cash_form" type="form">
<table class="table table-bordered table-hover">
<thead>
<tr style="font-weight:bold;"><center>CASH VOUCHER</center></tr>
</thead>
<tbody>
<tr>
<td>
<input type="hidden" name="cash_cat_code" id="cash_cat_code" value="CAT-001" class="form-control" readonly="TRUE" Autocomplete="OFF"/>
<input type="hidden" class="form-control" id="voucher_purpose_code" name="voucher_purpose_code" value="<?php echo "PUR-001"; ?>" readonly="true"/>
</td>
</tr>
<tr>
<td width="50%">Date</td>
<td>
<input type="Date" class="add-on form-control" id="date" name="date" title=" Date"/>
</td>
</tr>
<tr>
<td width="50%">Slip No</td>
<td>
<input type="text" name="slip_no" id="slip_no" value="" class="form-control"  Autocomplete="OFF" />
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
<input type="text" name="amount" id="amount" value="" class="form-control"  Autocomplete="OFF" />
</td>
</tr>
</tbody>	
</table>

</form>
<div style="float:right;margin-right:50px;">
<input type="submit" name="cash" id="cash" value="Save" onclick="cash_entry(1)" class="btn btn-primary btn-sm">
</div>
<script>

function cash_entry(s)
{	
	var id=0;
	var data=$('form').serialize();
	var ledger_code=$('#ledger_code').val();  
	var amount=$('#amount').val();	
	if(amount!='' && amount>0 && ledger_code!='')
	{
		$('#cash_form').html('<br><div style="text-align: center;"><img src="images/loader/loader.gif"></div>');
		$.ajax({
		type: "GET",
		url: "Accounts/new_voucher/cash_voucher/cash_vouch_insert.php",
		data: "id="+id, data,
		success: function(data) {

		alert("Vocuher Will be Created");
		new_voucher();
		}
		});
	}
	else
	{
		alert("Choose Ledger Code OR Enter amount...!!!");
	}
}

</script>