<?php
require('../../configuration.php');
require('../../user.php');
$user_id=$_SESSION['user'];

$vou_category_id=$_REQUEST['vou_cat_code'];
$vou_pur_id=$_REQUEST['vouc_pur_id'];

$vouch_pur=mysql_query("select code from voucher_purpose where id='$vou_pur_id' and voucher_category_code='$vou_category_id'"); // get the purpose code 
$voucher_pur_code_count=mysql_num_rows($vouch_pur);
$vouch_pur_code=mysql_fetch_array($vouch_pur);  	// Get the data
$voucher_purp_code=$vouch_pur_code['code'];   		// voucher purpose code 
if($voucher_pur_code_count>0)  						// Voucher count greater than 0 -- Success function
{
	if($voucher_purp_code=='PUR-004') 				// New member Creation of Adjustment receipt
	{
 ?>
 
  <h4><center>BULK COLLECTION</center></h4>
<form type="POST" id="bulkcollect">

<input type="hidden" name="vou_cat" id="vou_cat" value="<?php echo $vou_category_id;?>">
<table class="table table-bordered">
	<input type="hidden" class="form-control" id="voucher_purpose_code" name="voucher_purpose_code" value="PUR-004" readonly="TRUE">
	<tr>
		<td>Date</td>
		<td>
			<div class="input-group"><div class="input-group-addon"><i class="fa fa-calendar"></i></div>
			<div id="cur_newmem_datetimepicker" class="input-append date">
				<div class="input-group" style="width:100%;">
				<input type="text" class="add-on form-control" id="date" name="date" title=" Date" value="<?php echo date("d-m-Y"); ?>" />

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
	<tr>
		<td>Amount</td>
		<td><input type="text" class="form-control" id="amount" name="amount" value=""/></td>
	</tr>
	<tr>
		<td>Bank</td>
		<!-- Default Bank Selection -->
		<td><select class="form-control select2" id="bank_code" name="bank_code">
		<option value="bank-002">CURRENT A/C WITH UCO BANK (SOWCARPET)</option>
		<?PHP
		$bank_sql="SELECT code,ledger_code,name FROM bank WHERE code<>'BANK-002' ";
		$bank_row=mysql_query($bank_sql);
		while($bank_res=mysql_fetch_array($bank_row))
		{
		?>
		<option value="<?php echo $bank_res['code'];?>"><?php echo $bank_res['ledger_code'].'-'.$bank_res['name'];?></option>
		<?php
		}
		?>
		</select>
		</td>
	</tr>			  

	<tr>
		<td>SRF</td>
		<td><input type="text" class="form-control groupOfTexbox" id="srf" name="srf" value="0.00" /></td>
	</tr>
	<tr>
		<td>Thrift Deposit</td>
		<td><input type="text" class="form-control groupOfTexbox" id="thrift_deposit" name="thrift_deposit" value="0.00" /></td>
	</tr>
	<tr>
		<td>Share Capital</td>
		<td><input type="text" class="form-control groupOfTexbox" id="share_capital" name="share_capital" value="0.00" /></td>
	</tr>
	<tr>
		<td>Surety Loan</td>
		<td><input type="text" class="form-control groupOfTexbox" id="surety_balance" name="surety_balance" value="0.00" onchange="changeValue(1,this.value)"/></td>
	</tr>
	<tr>
		<td>Surety Interest</td>
		<td><input type="text" class="form-control groupOfTexbox" id="surety_interest" name="surety_interest" value="0.00" /></td>
	</tr>
	<tr>
		<td>Surety OD Interest</td>
		<td><input type="text" class="form-control groupOfTexbox" id="surety_od_interest" name="surety_od_interest" value="0.00" /></td>
	</tr>
	<tr>
		<td>Surety OD Balance</td>
		<td><input type="text" class="form-control groupOfTexbox" id="surety_od_balance" name="surety_od_balance" value="0.00" /></td>
	</tr>
	<tr>
		<td>Surety Regular Balance</td>
		<td><input type="text" class="form-control groupOfTexbox" id="surety_reg_balance" name="surety_reg_balance" value="0.00" /></td>
	</tr>
	<tr>
		<td>Festival Loan</td>
		<td><input type="text" class="form-control groupOfTexbox" id="festival_balance" name="festival_balance" value="0.00" onchange="changeValue(2,this.value)"/></td>
	</tr>
	<tr>
		<td>Festival Interest</td>
		<td><input type="text" class="form-control groupOfTexbox" id="festival_interest" name="festival_interest" value="0.00" /></td>
	</tr>
	<tr>
		<td>Festival OD Interest</td>
		<td><input type="text" class="form-control groupOfTexbox" id="festival_od_interest" name="festival_od_interest" value="0.00"  /></td>
	</tr>
	<tr>
		<td>Festival OD Balance</td>
		<td><input type="text" class="form-control groupOfTexbox" id="festival_od_balance" name="festival_od_balance" value="0.00" /></td>
	</tr>
	<tr>
		<td>Festival Regular Balance</td>
		<td><input type="text" class="form-control groupOfTexbox" id="festival_reg_balance" name="festival_reg_balance" value="0.00" /></td>
	</tr>
	<tr>
		<td>Sundry Creditors</td>
		<td><input type="text" class="form-control groupOfTexbox" id="scr" name="scr" value="0.00" /></td>
	</tr>
	<tr>
		<td></td><td><input type="button" name="bulk_coll" style="float:right;margin-right:50px;margin-bottom:10px;" onclick="bulkcollection()"  value="Save" class="btn btn-primary btn-sm" /></td>
	</tr>
</table>
</form>
<script>
function changeValue(id,amount)
{
	var member_no=$('#member_no').val();
	var vou_entry_date=$('#date').val();
	alert(vou_entry_date);
	
	$.ajax({
		type: 'get',
		url: '/UCO/new_voucher/bulkcollect/changeValueARC.php',
		data: 'member_no='+member_no+'&id='+id+'&amount='+amount+'&vou_entry_date='+vou_entry_date,
		success: function(data)
		{
			if(data==1)
			{
				alert("Amount Range is High");
			}
			else
			{
				var splitData=data.split("=");
				if(id==1)
				{
				//$('#surety_od_interest').val(splitData[0]);
				//$('#surety_od_balance').val(splitData[1]);
				//$('#surety_reg_balance').val(splitData[2]);
				//$('#surety_interest').val(splitData[3]);
				//$('#scr').val(splitData[4]);
				}
				else
				if(id==2)
				{
				$('#festival_od_interest').val(splitData[0]);
				$('#festival_od_balance').val(splitData[1]);
				$('#festival_reg_balance').val(splitData[2]);
				$('#scr').val(splitData[3]);
				}				
			}		
		}
	});

}

/* This is used to Allow decimal point value (1500.536 */

$("input[class*='groupOfTexbox']").keydown(function (event) {


	if (event.shiftKey == true) {
		event.preventDefault();
	}

	if ((event.keyCode >= 48 && event.keyCode <= 57) || 
		(event.keyCode >= 96 && event.keyCode <= 105) || 
		event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 37 ||
		event.keyCode == 39 || event.keyCode == 46 || event.keyCode == 190) {

	} else {
		event.preventDefault();
	}

	if($(this).val().indexOf('.') !== -1 && event.keyCode == 190)
		event.preventDefault(); 
	//if a decimal has been added, disable the "."-button

});

function bulkcollection()
{
	var data=$('form').serialize();
	$('#bulkcollect').html('<br><div style="text-align: center;"><img src="/UCO/images/loader/loader.gif"></div>');
	$.get('new_voucher/bulkcollect/index.php',data);
	$.ajax({
		type: "POST",
		url: "/UCO/new_voucher/voucher_home.php",
		success: function(data)
		{
		//$('#voucher_home').html(data);
			alert("BULK COLLECTION CREATED");
			new_voucher();
		}
		});
}
</script>
<script>
$(function() {
	$('#cur_newmem_datetimepicker').datetimepicker({
	format: "dd-MM-yyyy"
	});
});
</script>
	<?php }
}	?>