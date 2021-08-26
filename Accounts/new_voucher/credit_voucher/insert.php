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
		<td>Bank</td>
		<td>
			<select class="form-control select2" id="bank_code" name="bank_code">
			<option value="">Choose Bank</option>
			<?php
			$ledger_sql = $con->query("SELECT code,name FROM accounts_bank");
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
		<td>Date</td>
		<td>
			<div class="input-group">
				<div id="credit_vouch_date" class="input-append date">
				<div class="input-group" style="width:100%;">
				<input type="Date" class="add-on form-control" id="voucher_date" name="voucher_date" title="Date" value="<?php echo date("Y-m-d"); ?>" />			
				</div>
				<i data-time-icon="icon-time" data-date-icon="icon-calendar"></i>
				</div>
			</div>
		</td>
	</tr>
	<tr>
		<td>Ledger</td>
		<td>
			<select class="form-control select2" id="ledger_code" name="ledger_code">
			<option value="">Choose Ledger</option>
			<?php
			$ledger_sql = $con->query("SELECT code,name FROM accounts_ledger order by name asc");
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
		<td>Customer </td>
		<td>
			<select class="form-control select2" id="customer_code" name="customer_code" onchange="get_workorder()">
			<option value="">Choose Customer</option>
			<?php
			$ledger_sql = $con->query("SELECT id,org_name FROM client_master order by org_name asc");
			while($ledger_res=$ledger_sql->fetch(PDO::FETCH_ASSOC))
			{
				?>
				<option value="<?php echo $ledger_res['id'];?>"><?php echo $ledger_res['org_name'];?></option>
				<?php
			}	
			?>	
			</select>
		</td>
	</tr>
	<tr>
		<td>Cost Center</td>
		<td>
			<select class="form-control select2" id="cost_center" name="cost_center">
			<option value="">Choose Cost Center</option>
			<?php
			$ledger_sql = $con->query("SELECT id,org_name FROM client_master order by org_name asc");
			while($ledger_res=$ledger_sql->fetch(PDO::FETCH_ASSOC))
			{
				?>
				<option value="<?php echo $ledger_res['id'];?>"><?php echo $ledger_res['org_name'];?></option>
				<?php
			}	
			?>	
			</select>
		</td>
	</tr>
	<tr>
		<td>Work Order</td>
		<td>
			<select class="form-control select2" id="workorder_number" name="workorder_number" onchange="">
			<option value="">Choose Work Order</option>
			<?php
			$ledger_sql = $con->query("SELECT Po_id,enquiry_id,CONCAT(prefix_code,workorder_number) as workorder_number FROM po_upload");
			while($ledger_res=$ledger_sql->fetch(PDO::FETCH_ASSOC))
			{
				?>
				<option value="<?php echo $ledger_res['enquiry_id'];?>"><?php echo $ledger_res['workorder_number'];?></option>
				<?php
			}	
			?>	
			</select>
		</td>
	</tr>
	<tr>
		<td>Period</td>
		<td>
			<select class="form-control select2" id="ledger_code" name="ledger_code">
			<option value="">Choose Period</option>
			<?php
			$ledger_sql = $con->query("SELECT code,name FROM accounts_ledger order by name asc");
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
			<input type="text" name="amount" id="amount" value="" class="form-control" readonly=true/>
		</td>
	</tr>
	<tr>
		<td>Narration</td>
		<td>
		<input type="text" name="narration" id="narration" class="form-control" />
		</td>
	</tr>
	<tr>
		<td>Against Ledger</td>
		<td>
		<select class="form-control select2" id="against_ledger" name="against_ledger">
		<option value="1">General</option>
		<option value="2">Advance</option>
		<option value="3">TDS</option>
		</select>
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
$(document).ready(function(){	
		$('#credit_vouch_date').datetimepicker({
		format: "dd-MM-yyyy"
		});
	});

function get_workorder(org_id)
{
	alert(org_id);
}

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