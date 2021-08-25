<?php
require('../../../connect.php');
//require('../../user.php');
$user_id=1;//$_SESSION['user'];
$voucher_code=$_REQUEST['voucher_code'];


$voucher_sql  = $con->query("SELECT code,date,voucher_category_code,voucher_purpose_code,slip_no,reference_voucher,member_no, name,branch_code,reference_no,
ledger_code,amount,bank_code,cheque_no,cheque_date,description,narration,status FROM accounts_voucher 
WHERE code='$voucher_code'");

$voucher = $voucher_sql->fetch(PDO::FETCH_ASSOC);

$vou_cat_code=$voucher['voucher_category_code'];
$vou_pur_code=$voucher['voucher_purpose_code'];

$voc_cat_sql=$con->query("select name from accounts_voucher_category where code='$vou_cat_code'");
$voc_cat_name=$voc_cat_sql->fetch(PDO::FETCH_ASSOC);

$voc_purp_sql=$con->query("select name from accounts_voucher_purpose where code='$vou_pur_code'");
$voc_purp_name=$voc_purp_sql->fetch(PDO::FETCH_ASSOC);

$date=$voucher['date'];
$narration=$voucher['narration'];

?>
<div>
<form>
<input type="hidden" name="voucher_code" id="voucher_code" value="<?php echo $voucher_code;?>">
<input type="hidden" name="narration" id="narration" value="<?php echo $narration;?>">
<table class="table table-bordered table-hover" style="margin:1px;">
<thead style="FONT-SIZE: 14px;font-family: Times new roman;">
<h4>
<center><?php echo $voc_cat_name['name'].'-'.$voc_purp_name['name']; ?></center>
</h4>
</thead>

<tr>
<td colspan="2">Date</td>

<td colspan="2">
<div class="input-group"><div class="input-group-addon"><i class="fa fa-calendar"></i></div>
<div id="cur_datetimepicker" class="input-append date">
<div class="input-group" style="width:100%;">
<input type="text" class="add-on form-control" id="date" name="date" title=" Date" value="<?php echo date("d-m-Y",strtotime($date)); ?>" />
</div>
<i data-time-icon="icon-time" data-date-icon="icon-calendar"></i>
</div>
</div>
</td>
</tr>
<script>
$(document).ready(function () {
	
		$('#cur_datetimepicker').datetimepicker({
		format: "dd-MM-yyyy"
		});
	});
</script>
<tr>
<td colspan="2">Member No</td> 
<td colspan="2"><input type="text" class="form-control" id="member_no" name="member_no" onchange="checkMember(this.value)" value="<?php echo $voucher['member_no']; ?>" />
</td>
</tr>
<tr>
<td colspan="2">Name</td>
<td colspan="2"><input type="text" class="form-control" id="name" name="name" value="<?php echo $voucher['name'];?>"  readonly="true"/></td>
</tr>
<tr>
<td colspan="2">Branch</td>
<td colspan="2">
<input type="hidden" class="form-control" id="branch_code" name="branch_code" value="<?php echo $voucher['branch_code'];?>"  readonly="true"/>
<input type="text" class="form-control" id="branch_name" name="branch_name" value="<?php echo $voucher['branch_code'];?>" readonly="true"/></td>
</tr>
<tr>
<td colspan="2">Amount</td>
<td colspan="2"><input type="text" class="form-control" id="amount" name="amount" value="<?php echo $voucher['amount']; ?>" autocomplete="off"/></td>
</tr>
<tr>
<td colspan="2">Bank</td>
<td colspan="2">
<select class="form-control select2" id="bank_code" name="bank_code">
<option value="bank-002">CURRENT A/C WITH UCO BANK (SOWCARPET)</option>


<?PHP

$bank_sql="SELECT code,name FROM accounts_bank WHERE code<>'BANK-002' ";
$bank_row=$con->query($bank_sql);
while($bank_res=$bank_row->fetch(PDO::FETCH_ASSOC))
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
<td colspan="2">
Cheque No
</td>
<td colspan="2">
<input type="text" id="cheque_no" name="cheque_no" class="form-control" value="" autocomplete="off"/>
</td>
</tr>
<tr>
<td colspan="2">Cheque Date</td>
<td colspan="2">
<div class="input-group"><div class="input-group-addon"><i class="fa fa-calendar"></i></div>
<div id="check_date" class="input-append date">
<input type="text" class="add-on form-control"  value="" id="cheque_date" name="cheque_date" autocomplete="off">
<i data-time-icon="icon-time" data-date-icon="icon-calendar"></i>
</div>
</div>
</td>
</tr>
<script>
$(document).ready(function () {
	
		$('#check_date').datetimepicker({
		format: "dd-MM-yyyy"
		});
	});
</script>

<tr><th>#</th><th>Ledger Code</th><th>Receipt</th><th>Payment</th></tr>
<?php
$v_sql=$con->query("SELECT ledger_code,reference,amount,type,narration,status FROM accounts_voucher_detail WHERE voucher_code='$voucher_code'");

$p=1;
while($vou_det=$v_sql->fetch(PDO::FETCH_ASSOC))
{
	$ledger=$vou_det['ledger_code'];
?>
<tr>	
	<td><?php echo $p++;?></td>	
	<td>
	<select class="form-control select2" id="ledger_code" name="ledger_code[]">
	<?php 
		
		$led_sql = $con->query("SELECT name FROM accounts_ledger WHERE code='$ledger'");
		$led_name=$led_sql->fetch(PDO::FETCH_ASSOC);
	?>
	<option value="<?php echo $ledger; ?>"><?php echo $ledger.'-'.$led_name['name']; ?></option>
	<?PHP
	$led_sql="SELECT code,name FROM accounts_ledger WHERE code<>'$ledger' ";
	$led_row=$con->query($led_sql);
	while($led_res=$led_row->fetch(PDO::FETCH_ASSOC))
	{
	?>
	<option value="<?php echo $led_res['code'];?>"><?php echo $led_res['code'].'-'.$led_res['name'];?></option>
	<?php
	}
	?>
	</select>
	</td>
		
	<td>
	<?php 
	if($vou_det['type']=='credit')
	{
	?>
	<input type="hidden" name="led_type[]" value="credit">
	<input class="form-control" style="text-align:right" type="text" name="ledger_amount[]" id="" value="<?php echo $vou_det['amount'];?>">
	<?php 
	}
	?>
	</td>
		
	<td>
	<?php
	if($vou_det['type']=='debit')
	{
	?>
	<input type="hidden" name="led_type[]" value="debit">
	<input class="form-control" style="text-align:right" type="text" name="ledger_amount[]" id="" value="<?php echo $vou_det['amount'];?>">
	<?php 
	}
	?>
	</td>
</tr>		
	
<?php
}
?>
</table>
</form>
</div>
<div style="margin-bottom: 1px;text-align:right;">
<input type="button" id="create_btn" class="btn btn-primary" name="voucher_up" onclick="voucher_update()" value="Update"/>
</div>

<script>
function checkMember(v)
	{
	$.get('Accounts/new_voucher/checkMember.php?member_no='+v,function(data) { 
		var splitData=data.split("=");
		var mob=splitData[3];
		var dem_check=splitData[4];
		var mem_name=splitData[0];
		
			if(mem_name == '')   // If Member not exists....,,,,
			{
				alert("Invalid Member No....");
				$('#member_no').val(" ");
			}
			if(dem_check != 0)
			{
				alert('Member Demand is not closed / do only loan closed');
			}
			if(mob == "")
			{
				alert('Please Fix Mobile No');
			}
			else
			{
				$('#name').val(splitData[0]);
				$('#branch_code').val(splitData[1]);
				$('#branch_name').val(splitData[2]);	
			}
		});
		
	}
	
function voucher_update()
{
	var data=$('form').serialize();
	$.get('Accounts/new_voucher/Update/voucher_update.php',data);
	new_voucher();
}
</script>
<script>
</script>