<?php
require('../../../connect.php');
?>

<form type="POST">
<input type="hidden" name="cat_id" id="cat_id" value="<?php echo $_REQUEST['cat_id'];?>">
<table class="table table-bordered table-hover">
	<tr>
		<td>Date</td>
		<td>
			<div class="input-group"><div class="input-group-addon"><i class="fa fa-calendar"></i></div>
				<div id="debit_vouch_date" class="input-append date">
				<div class="input-group" style="width:100%;">
					<input type="text" class="add-on form-control" id="voucher_date" name="voucher_date" title="Date" value="<?php echo date("d-m-Y"); ?>" />			
				</div>
					<i data-time-icon="icon-time" data-date-icon="icon-calendar"></i>
				</div>
			</div>
		</td>
	</tr>
	<tr>
		<td width="50%">Slip No</td> 
		<td>
			<input type="text" name="slip_no" id="slip_no" value="" class="form-control" />
		</td>
	</tr>
	<tr>
		<td>Member No</td>
		<td>
		<input type="text" class="form-control" id="member_no" name="member_no" value="" onchange="checkMember(this.value)"/>
			<script>
			$(document).ready(function () {
				
					$('#debit_vouch_date').datetimepicker({
					format: "dd-MM-yyyy"
					});
				});
			function checkMember(v)
			{
			$.get('/UCO/voucher/checkMember.php?member_no='+v,function(data) { 
			var splitData=data.split("=");
			$('#name').val(splitData[0]);
			$('#branch_code').val(splitData[1]);
			$('#branch_name').val(splitData[2]);
			});
			}
			</script>
		</td>
	</tr>
	<tr>
		<td>Name</td>
		<td>
			<input type="text" class="form-control" id="name" name="name" value="" readonly="true"/>
		</td>
	</tr>
	<tr>
		<td>Branch</td>
	<td>
		<input type="hidden" id="branch_code" name="branch_code" value="" />
		<input type="text" class="form-control" id="branch_name" name="branch_name" value="" readonly="true"/></td>
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

<script>
function dispFdr(v)
{
	if(v=='P003')
	{
		data='<select class="form-control select2" id="fdr_no" name="fdr_no" onchange=FDRCheck(this.value)><option value="">Select Old FDR No</option><?php $fdr_sql="SELECT fdr_no FROM fd_balance WHERE flag_id=2"; $fdr_row=mysql_query($fdr_sql); while($fdr_res=mysql_fetch_array($fdr_row)) { ?> <option value="<?php echo $fdr_res["fdr_no"];?>"><?php echo $fdr_res["fdr_no"];?></option><?php } ?></select> '

		$('#changeFDR').html(data);
		$('.select2').select2();
	}
}

function FDRCheck(v)
{
	var member_no=$('#member_no').val();
	$.get('/UCO/fd/fdrcheck.php?old_fdr_no='+v+'&member_no='+member_no,function(data){			
				
	if(data==1)  
	{			
	}
	else
	{
		alert("Please select valid fdr_no");	 
		 data='<select class="form-control select2" id="fdr_no" name="fdr_no" onchange=FDRCheck(this.value,this.id)><option value="">Select Old FDR No</option><?php $fdr_sql="SELECT fdr_no FROM fd_balance WHERE flag_id=2"; $fdr_row=mysql_query($fdr_sql); while($fdr_res=mysql_fetch_array($fdr_row)) { ?> <option value="<?php echo $fdr_res["fdr_no"];?>"><?php echo $fdr_res["fdr_no"];?></option><?php } ?></select> '
		   $('#changeFDR').html(data);
			$('.select2').select2();
	}
	});
}
</script>
	<tr>
		<td>Amount</td>
		<td>
			<input type="text" name="amount" id="amount" value="" class="form-control" />
		</td>
	</tr>
<tr>
	<td>Bank</td>
	<td>
		<select class="form-control select2" id="bank_code" name="bank_code">
		 <option value="bank-002">CURRENT A/C WITH UCO BANK (SOWCARPET)</option>
			<?PHP
			$bank_sql="SELECT code,name FROM bank WHERE code<>'BANK-002' ";
			$bank_row=mysql_query($bank_sql);
			while($bank_res=mysql_fetch_array($bank_row))
			{
			?>
				<option value="<?php echo $bank_res['code'];?>"><?php echo $bank_res['name'];?></option>
			<?php
			}
			?>
		</select>
	</td>
	</tr>			  
	<tr>
		<td>
			Cheque No
		</td>
		<td>
			<input type="text" id="cheque_no" name="cheque_no" class="form-control" value="" />
		</td>
	</tr>
	<tr>
		<td>Cheque Date</td>
		<td>
			<div class="input-group"><div class="input-group-addon"><i class="fa fa-calendar"></i></div>
				<div id="datetimepicker1" class="input-append date">
					<input type="text" class="add-on form-control"  value="" id="cheque_date" name="cheque_date" >
					<i data-time-icon="icon-time" data-date-icon="icon-calendar"></i>
				</div>
			</div>
							<script>
								$(function() {
							$('#datetimepicker1').datetimepicker({
							format: "dd-MM-yyyy"
							});
							});
							</script>
		</td>
	</tr>
	<tr>
		<td></td>
		<td>
			<input type="button" name="debitvoucher" onclick="debit(12)"  value="Save" class="btn btn-primary btn-sm" />
		</td>
	</tr>
</table>
</form>

<script>
function debit(ab)
{   var id=1;
	var data=$('form').serialize();
		var member_no=$('#member_no').val();  
		var amount=$('#amount').val();
		if(amount!='' && amount>0 && member_no!='')
			{
				 $.ajax({
						type: "GET",
						url: "/UCO/new_voucher/debit_voucher/index.php",
						data: "id="&id, data,

						success: function(data)
						{
							if(data)
								{
									alert("STAFF ADJUSTMENT Will Not Created...");new_voucher();
								}
								else
								{
									alert("STAFF ADJUSTMENT Will Created...");new_voucher();
								}
						}
					}); 
			}
		else
		{
			alert("Please Enter Member No OR Amount is Greater than zero....!!!");
		}
}
</script>