<?php
require('../../configuration.php');
require('../../user.php');

	$vou_category_id=$_REQUEST['vou_cat_code'];
	$vou_pur_id=$_REQUEST['vouc_pur_id'];
$vouch_pur=mysql_query("select code from voucher_purpose where id='$vou_pur_id' and voucher_category_code='$vou_category_id'");			 // get the purpose code 
		$voucher_pur_code_count=mysql_num_rows($vouch_pur);
$vouch_pur_code=mysql_fetch_array($vouch_pur);  	// Get the data
$voucher_purp_code=$vouch_pur_code['code'];   		// voucher purpose code 
if($voucher_pur_code_count>0)  						// Voucher count greater than 0 -- Success function
{
	if($voucher_purp_code=='PUR-017') 				// Sundry Debitor Creation of Adjustment receipt
	{
 ?>
 <div id="sundy"> 
							<h4><CENTER>SUNDRY DEBITORS</center></h4>
<form type="POST" id="sundrydebt">
   <table class="table table-bordered">
		<input type="hidden" name="vou_cat" id="vou_cat" value="<?php echo $vou_category_id;?>">
		<input type="hidden" class="form-control" id="voucher_purpose_code" name="voucher_purpose_code" value="<?php echo $voucher_purp_code; ?>" readonly="TRUE">
	<tr>
		<td>Date</td>
		<td>
			<div class="input-group"><div class="input-group-addon"><i class="fa fa-calendar"></i></div>
				<div id="fd_loan_datetimepicker" class="input-append date">
					<div class="input-group" style="width:100%;">
						<input type="text" class="add-on form-control" id="sund_date" name="sund_date" title=" Date" value="<?php echo date("d-m-Y"); ?>" />
					</div>
					<i data-time-icon="icon-time" data-date-icon="icon-calendar"></i>
				</div>
			</div>
		</td>
	</tr>
	<tr>
		<td>Member No</td>
		<td>
			<input type="text" class="form-control" id="member_no" name="member_no" value="" onchange="checkMember(this.value)" maxlength="5" autocomplete="off"/>
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
			<input type="hidden" class="form-control" id="branch_code" name="branch_code" value=""/>
			<input type="text" class="form-control" id="branch_name" name="branch_name" value="" readonly="true"/>
		</td>
	<tr>
	<td>Voucher</td>
	<td>
	<select class="form-control select2" name="amount" onchange="check_amount(this.value)">
		  <option value="">Choose voucher Number</option>
		  <?php
		  $debitor_check=mysql_query("select reference,amount from sundry_debtors where flag_id=19 order by amount asc");
		  while($debitor_c=mysql_fetch_array($debitor_check))
		  {
			  ?>
			  <option value="<?php echo $debitor_c['amount']; ?>"><?php echo $debitor_c['reference']."-".$debitor_c['amount']; ?> </option>
			  <?php
		  }
		  ?>
		</select>
		</td>
	</tr>
	<tr>
		<td width="50%">Amount</td>
		<td>
			<input class="form-control" style="text-align:right" id="sdr_amount" name="sdr_amount" value="" readonly/>
		</td>
	</tr>	
	<tr>	
		<td>Against</td>
		<td>
			<input class="form-control" style="text-align:right" id="against" name="against" value="" readonly/>
		</td>
	</tr>
	<tr>	
		<td>Reference</td>
		<td>
			<input class="form-control" style="text-align:right" id="reference" name="reference" value="" readonly/>
		</td>
	</tr>
	<tr>
		<td>Bank</td>
			<!-- Default Bank Selection -->
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
		</td>
		<td>
			<input type="button" name="sundrydebitor" onclick="sundrydebt(0)"  value="Save" class="btn 	btn-primary btn-md" style="float:right;"/>
		</td>
	</tr>
</table>
</form>
</div>
<script>
	$(function()
	{
		$(".select2").select2();
	});
	$(function() {
			$('#fd_loan_datetimepicker').datetimepicker({
			format: "dd-MM-yyyy"
		});
	});
function sundrydebt(a)
{ 
	var id='2';
	var data=$('form').serialize();
	$('#sundy').html('<br><div style="text-align: center;"><img src="/UCO/images/loader/loader.gif"></div>');	
	$.ajax({
		type: "GET",
		url: "new_voucher/sundrydebt/index.php",
		data: "id="+id, data,
			success: function(data)
				{
					alert("SUNDRY DEBIT created ");
					new_voucher();
				}
		}); 
}
function check_amount(amt)
{
	var member_no=$('#member_no').val(); 
	var amount=amt; 
	$.ajax({
		type: "POST",
		url: "/UCO/new_voucher/sundrydebt/check_balance.php",
		data: "member_no="+member_no+"&amount="+amount,
		success: function(data)
		{
			if(data==0)
			{
				alert("Choose Correct Voucher..!!");
			}
			else
			{
				var splitData=data.split("/");			
				$("#sdr_amount").val(splitData[0]);
				$("#reference").val(splitData[1]);
				$("#against").val("I001");
			}
		}
		}); 
}
</script>
<?php 
	}
}
?>