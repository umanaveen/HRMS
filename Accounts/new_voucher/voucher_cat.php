<?php

require('../../connect.php');
$voucher_comp_list = $con->query("SELECT code as vou_cate_code,name as voucher_cate_name FROM accounts_voucher_category order by code");

?>
<style>
.btn
{
	text-transform:uppercase;
}
</style>

<table class="table table-hoever table-bordered" id="voucher_cat">
<thead><tr><h3><Center> Voucher Creation</center></h3></tr></thead>
<tbody>
<tr>
<?php
while($vouch_det = $voucher_comp_list->fetch(PDO::FETCH_ASSOC))
{ 
	$v_code[]=$vouch_det['vou_cate_code'];
	echo '<th>'.$vouch_det['voucher_cate_name'].'</th>';
}
?>
</tr>
<tr>
<?php
$length=count($v_code);
for($i=0;$i<$length;$i++)
{
	echo '<td>';
	if($v_code[$i]=='CAT-001') // Check the Category Its Cash Voucher 
	{
	?>
	<input type="button" name="vouc_category_code" class="btn btn-primary btn-sm" id="<?php echo $v_code[$i]; ?>" 
	value="<?php echo 'Cash Voucher';?>" onclick="cash_vocher(this.id)"/>
	<?php
	}
	if($v_code[$i]=='CAT-002') // Check the Category Its Credit Voucher 
	{
	?>
	<input type="button" name="vouc_category_code" class="btn btn-primary btn-sm" id="<?php echo $v_code[$i]; ?>" 
	value="<?php echo 'Credit Voucher';?>" onclick="cash_vocher(this.id)"/>
	<?php
	}
	if($v_code[$i]=='CAT-003') // Check the Category Its Debit Voucher 
	{
	?>
	<input type="button" name="vouc_category_code" class="btn btn-primary btn-sm" id="<?php echo $v_code[$i]; ?>" 
	value="<?php echo 'Debit Voucher';?>" onclick="cash_vocher(this.id)"/>
	<?php
	}
	
	if($v_code[$i]=='CAT-006') // Check the Category Its Debit Voucher 
	{
	?>
	<input type="button" name="vouc_category_code" class="btn btn-primary btn-sm" id="<?php echo $v_code[$i]; ?>" 
	value="<?php echo 'Sundry Creditor Voucher';?>" onclick="cash_vocher(this.id)"/>
	<?php
	}
	
	if($v_code[$i]=='CAT-007') // Check the Category Its Debit Voucher 
	{
	?>
	<input type="button" name="vouc_category_code" class="btn btn-primary btn-sm" id="<?php echo $v_code[$i]; ?>" 
	value="<?php echo 'Sundry Debtor Voucher';?>" onclick="cash_vocher(this.id)"/>
	<?php
	}
	
	$voucher_comp_list1 = $con->query("SELECT vp.id as vo_id,vp.code as vou_code,vp.voucher_category_code as voc_cat_code,vp.name as vouc_purpo_name,vp.code as vou_pur_code FROM accounts_voucher_purpose vp where vp.voucher_category_code='$v_code[$i]' AND code NOT IN('PUR-001','PUR-007','PUR-006','PUR-012','PUR-021','PUR-022') and voucher_category_code!='CAT-005'");
	while($vouch_det1=$voucher_comp_list1->fetch(PDO::FETCH_ASSOC))
	{ 
	?>
	
	<ul>
	<input type="hidden" name="vouc_cat" id="vouc_cat" value="<?php echo $vouch_det1['voc_cat_code'] ; ?>">
	<input type="button" name="vouc_purpo_name" class="btn btn-primary btn-sm" id="<?php echo $vouch_det1['vo_id'] ; ?>" 
	value="<?php echo $vouch_det1['vouc_purpo_name'];?>" onclick="voucher_purp(this.id)"/>
	</ul>

	<?php 
	}
	
	echo '</td>';
}
// End of While loop

?>	
</tr>
</tbody>
</table>

<script>
function cash_vocher(vou_id)
{
	var cat_id=vou_id;
	if(cat_id=='CAT-001')
	{
		$.ajax({
			type: "GET",
			data: "cat_id="+cat_id,
			url: "Accounts/new_voucher/cash_voucher/new_cash_Voucher.php",	 
			success: function(data)
			{
				$('#main_page').html(data);
			}
			});	
	}
	else if(cat_id=='CAT-002')
	{
		$.ajax({
			type: "GET",
			data: "cat_id="+cat_id,
			url: "Accounts/new_voucher/credit_voucher/insert.php",	 
			success: function(data)
			{
				$('#main_page').html(data);
			}
			});	
	}
	else if(cat_id=='CAT-003')
	{
		$.ajax({
			type: "GET",
			data: "cat_id="+cat_id,
			url: "Accounts/new_voucher/debit_voucher/insert.php",	 
			success: function(data)
			{
				$('#main_page').html(data);
			}
			});	
	}
	
}
function voucher_purp(vou_id)
{
	var vou_cat_code=$('#vouc_cat').val();
	
  //alert(vou_cat_code);
   
   if(vou_id==1)
   {
	$('#voucher_cat').html('<br><div style="text-align: center;"><img src="/UCO/images/loader/loader.gif"></div>');
	$.ajax({
		type: "GET",
		data: "vou_cat_code="+vou_cat_code+"&vouc_pur_id="+vou_id,
		url: "Accounts/new_voucher/newmember/insert.php",	 
		success: function(data){
		$('#voucher_home').html(data);	
		}
		});	
   }
   else if(vou_id==3)
   { 
	   $('#voucher_cat').html('<br><div style="text-align: center;"><img src="/UCO/images/loader/loader.gif"></div>');
	$.ajax({
		type: "GET",
		data: "vou_cat_code="+vou_cat_code+"&vouc_pur_id="+vou_id,
		url: "Accounts/new_voucher/adjustmentcollect/insert.php",	 
		success: function(data){
		$('#voucher_home').html(data);	
		}
		});	
   }
    else if(vou_id==4)
   {   
	   $('#voucher_cat').html('<br><div style="text-align: center;"><img src="/UCO/images/loader/loader.gif"></div>');
	$.ajax({
		type: "GET",
		data: "vou_cat_code="+vou_cat_code+"&vouc_pur_id="+vou_id,
		url: "Accounts/new_voucher/bulkcollect/insert.php",	 
		success: function(data){
		$('#voucher_home').html(data);	
		}
		});	
   }
   else if(vou_id==7)
   {
	   $('#voucher_cat').html('<br><div style="text-align: center;"><img src="/UCO/images/loader/loader.gif"></div>');
	$.ajax({
		type: "GET",
		data: "vou_cat_code="+vou_cat_code+"&vouc_pur_id="+vou_id,
		url: "Accounts/new_voucher/loanclosed/insert.php",	 
		success: function(data){
		$('#voucher_home').html(data);	
		}
		});	
   }
    else if(vou_id==8)
   {
	   $('#voucher_cat').html('<br><div style="text-align: center;"><img src="/UCO/images/loader/loader.gif"></div>');
	$.ajax({
		type: "GET",
		data: "vou_cat_code="+vou_cat_code+"&vouc_pur_id="+vou_id,
		url: "Accounts/new_voucher/sundrycred/insert.php",	 
		success: function(data){
		$('#voucher_home').html(data);	
		}
		});	
   }
     else if(vou_id==10)
   {
	   $('#voucher_cat').html('<br><div style="text-align: center;"><img src="/UCO/images/loader/loader.gif"></div>');
	$.ajax({
		type: "GET",
		data: "vou_cat_code="+vou_cat_code+"&vouc_pur_id="+vou_id,
		url: "Accounts/new_voucher/fdloan/insert.php",	 
		success: function(data){
		$('#voucher_home').html(data);	
		}
		});	
   }
    else if(vou_id==13)
   {
	   $('#voucher_cat').html('<br><div style="text-align: center;"><img src="/UCO/images/loader/loader.gif"></div>');
	$.ajax({
		type: "GET",
		data: "vou_cat_code="+vou_cat_code+"&vouc_pur_id="+vou_id,
		url: "Accounts/new_voucher/fdnew/insert.php",	 
		success: function(data){
		$('#voucher_home').html(data);	
		}
		});	
   }
   else if(vou_id==16)
   {
	   $('#voucher_cat').html('<br><div style="text-align: center;"><img src="/UCO/images/loader/loader.gif"></div>');
	$.ajax({
		type: "GET",
		data: "vou_cat_code="+vou_cat_code+"&vouc_pur_id="+vou_id,
		url: "Accounts/new_voucher/sundrydebt/insert.php",	 
		success: function(data){
		$('#voucher_home').html(data);	
		}
		});	
   }
   else if(vou_id==17)
   {
	   $('#voucher_cat').html('<br><div style="text-align: center;"><img src="/UCO/images/loader/loader.gif"></div>');
	$.ajax({
		type: "GET",
		data: "vou_cat_code="+vou_cat_code+"&vouc_pur_id="+vou_id,
		url: "Accounts/new_voucher/staffadjcollect/insert.php",	 
		success: function(data){
		$('#voucher_home').html(data);	
		}
		});	
   }
    else if(vou_id==2)
   {
	   $('#voucher_cat').html('<br><div style="text-align: center;"><img src="/UCO/images/loader/loader.gif"></div>');
	$.ajax({
		type: "GET",
		data: "vou_cat_code="+'CAT-005'+"&vouc_pur_id="+vou_id,
		url: "Accounts/new_voucher/memberclosed/insert.php",	 
		success: function(data){
		$('#voucher_home').html(data);	
		}
		});	
   }
    else if(vou_id==5)
   {  
	   $('#voucher_cat').html('<br><div style="text-align: center;"><img src="/UCO/images/loader/loader.gif"></div>');
	$.ajax({
		type: "GET",
		data: "vou_cat_code="+'CAT-005'+"&vouc_pur_id="+vou_id,
		url: "Accounts/new_voucher/fixeddepclosed/insert.php",	 
		success: function(data){
		$('#voucher_home').html(data);	
		}
		});	
   }
   else if(vou_id==6)
   {
	   $('#voucher_cat').html('<br><div style="text-align: center;"><img src="/UCO/images/loader/loader.gif"></div>');
	$.ajax({
		type: "GET",
		data: "vou_cat_code="+'CAT-005'+"&vouc_pur_id="+vou_id,
		url: "Accounts/new_voucher/fdintpay/insert.php",	 
		success: function(data){
		$('#voucher_home').html(data);	
		}
		});	
   }
     else if(vou_id==9)
   {
	   $('#voucher_cat').html('<br><div style="text-align: center;"><img src="/UCO/images/loader/loader.gif"></div>');
	$.ajax({
		type: "GET",
		data: "vou_cat_code="+'CAT-005'+"&vouc_pur_id="+vou_id,
		url: "Accounts/new_voucher/againstledger/insert.php",	 
		success: function(data){
		$('#voucher_home').html(data);	
		}
		});	
   }
   else if(vou_id==11)
   {
	   $('#voucher_cat').html('<br><div style="text-align: center;"><img src="/UCO/images/loader/loader.gif"></div>');
	$.ajax({
		type: "GET",
		data: "vou_cat_code="+'CAT-005'+"&vouc_pur_id="+vou_id,
		url: "Accounts/new_voucher/fdforeclose/insert.php",	 
		success: function(data){
		$('#voucher_home').html(data);	
		}
		});	
   }
    else if(vou_id==12)
   {
	   $('#voucher_cat').html('<br><div style="text-align: center;"><img src="/UCO/images/loader/loader.gif"></div>');
	$.ajax({
		type: "GET",
		data: "vou_cat_code="+'CAT-005'+"&vouc_pur_id="+vou_id,
		url: "Accounts/new_voucher/fdrenewal/insert.php",	 
		success: function(data){
		$('#voucher_home').html(data);	
		}
		});	
   }
    else if(vou_id==14)
   {
	   $('#voucher_cat').html('<br><div style="text-align: center;"><img src="/UCO/images/loader/loader.gif"></div>');
	$.ajax({
		type: "GET",
		data: "vou_cat_code="+vou_cat_code+"&vouc_pur_id="+vou_id,
		url: "Accounts/new_voucher/fdtransloan/insert.php",	 
		success: function(data){
		$('#voucher_home').html(data);	
		}
		});	
   }
    else if(vou_id==15)
   {
	   $('#voucher_cat').html('<br><div style="text-align: center;"><img src="/UCO/images/loader/loader.gif"></div>');
	$.ajax({
		type: "GET",
		data: "vou_cat_code="+'CAT-005'+"&vouc_pur_id="+vou_id,
		url: "Accounts/new_voucher/fdloanclose/insert.php",	 
		success: function(data){
		$('#voucher_home').html(data);	
		}
		});	
   }
    else if(vou_id==18)
   {
	   $('#voucher_cat').html('<br><div style="text-align: center;"><img src="/UCO/images/loader/loader.gif"></div>');
	$.ajax({
		type: "GET",
		data: "vou_cat_code="+vou_cat_code+"&vouc_pur_id="+vou_id,
		url: "Accounts/new_voucher/staffloanclose/insert.php",	 
		success: function(data){
		$('#voucher_home').html(data);	
		}
		});	
   }
   else if(vou_id==19)
   {
	   $('#voucher_cat').html('<br><div style="text-align: center;"><img src="/UCO/images/loader/loader.gif"></div>');
	$.ajax({
		type: "GET",
		data: "vou_cat_code="+'CAT-006'+"&vouc_pur_id="+vou_id,
		url: "Accounts/new_voucher/sundrydebitoradjustmentcollect/insert.php",	 
		success: function(data){
		$('#voucher_home').html(data);	
		}
		});	
   }
}	
</script>