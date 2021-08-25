<?php
require('../../configuration.php');
require('../../user.php');
$user_id=$_SESSION['user'];

echo $vou_category_id=$_REQUEST['vou_cat_code'];
echo $vou_pur_id=$_REQUEST['vouc_pur_id'];

$vouch_pur=mysql_query("select code from voucher_purpose where id='$vou_pur_id' and voucher_category_code='$vou_category_id'"); // get the purpose code 
$voucher_pur_code_count=mysql_num_rows($vouch_pur);
$vouch_pur_code=mysql_fetch_array($vouch_pur);  	// Get the data
echo $voucher_purp_code=$vouch_pur_code['code'];   		// voucher purpose code 
if($voucher_pur_code_count>0)  						// Voucher count greater than 0 -- Success function
{
	if($voucher_purp_code=='PUR-008') 				// New member Creation of Adjustment receipt
	{
	?>
	<div id="sundry_credit">
	<h4><center>SUNDRY CREDITORS</center></h4>
	<form type="POST" id="sundry_creditors">
	<div> 
	<input type="hidden" name="vou_cat" id="vou_cat" value="<?php echo $vou_category_id;?>">
	<table class="table table-bordered">
	<input type="hidden" class="form-control" id="voucher_purpose_code" name="voucher_purpose_code" value="PUR-008" readonly="TRUE">
	<tr>
	<td>Date</td>
	<td>
	<div class="input-group"><div class="input-group-addon"><i class="fa fa-calendar"></i></div>
	<div id="cur_suncre_datetimepicker" class="input-append date">
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
	<td><input type="text" class="form-control" id="member_no" name="member_no" value="" onchange="checkMember(this.value)" maxlength="5"/></td>
	</tr>
	<tr>
	<td>Name</td>
	<td><input type="text" class="form-control" id="name" name="name" value="" readonly="true"/></td>
	</tr>
	<tr>
	<td>Branch</td>
	<td>
	<input type="hidden" class="form-control" id="branch_code" name="branch_code" value=""/>
	<input type="text" class="form-control" id="branch_name" name="branch_name" value="" readonly="true"/></td>
	</tr>
	<div id="branch_wise">
	</div>
	<tr>
	<td>Amount</td>
	<td><input type="text" class="form-control" id="amount" name="amount" onchange="check_amount(this.value)" value=""/></td>
	</tr>
	<tr>
	<td>Bank</td>
	<!-- Default Bank Selection -->
	<td><select class="form-control select2" id="bank_code" name="bank_code">
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
	<td>Description</td>
	<td><textarea rows="4"  class="form-control" id="description" name="description">
	</textarea></td>
	</tr>
		</table>
	</div>
	<div id="branch_wise">
	<table class="table table-striped">
	<tbody>
	<?php
		$member_no=$_REQUEST['member_no'];
		if($member_no=='' || $member_no==null)
		{
	?>
		<tr>
		<td>Branch</td>
		<td> <select class="form-control select2" style="width: 100%;" name="branch" id="branch">
		<option value="">Select Branch</option>
		<?php
		$branch_sql="SELECT code,name FROM branch";
		$branch_row=mysql_query($branch_sql);
		while($branch_res=mysql_fetch_array($branch_row))
		{
		?>
		<option value="<?php echo $branch_res['code'];?>"><?php echo $branch_res['code']."-".	$branch_res['name'];?></option>
		<?php
		}
		?>
		</select>	
		</td>
		</tr>
				
		<script>
		$(function(){
			$(".select2").select2();
		});

		</script>

		<?php
		}
		?>
	</tbody>
		<tfoot>
		<tr>
		<th colspan="2"></th>
		</tr>
		<tr>
	<td><input type="submit" class="btn btn-primary btn-md" style="float:right; margin-right:50px;" name="submit_sundry" onclick="sundrycred()"></td>
	</tr>
		</tfoot>
</table>
	</div>
</form>
</div>
<script>
function sundrycred()
{
	var data=$('form').serialize();
	$.get('new_voucher/sundrycred/index.php',data);
	new_voucher();			
}

</script>
<?php
	}
}
?>