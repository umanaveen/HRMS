<?php 
require('../configuration.php');
require('../user.php');
$user_id=$_SESSION['user'];
?>

<div class="box box-success ">
	<div class="box-body no-padding" style="margin:1px;">
	<div class="col-sm-1">
	<input type="button" class="btn btn-warning" name="home_voucher" id="home_voucher" onclick="home_voucher()" value="HOME"/>
	</div>
	<div class="col-sm-5">
	<select class="form-control vouch_search" id="search_voucher_no" name="search_voucher_nos" style="">
	<option value="">Choose Voucher Number</option>
	<?php
	//$search_vouc=mysql_query("SELECT code,voucher_purpose_code,voucher_category_code FROM voucher where created_on<now() and status!='1' order by id desc limit 0,50");
	$search_vouc=mysql_query("SELECT code,voucher_purpose_code,voucher_category_code FROM voucher where created_on<now() and status in (2,3)order by id desc limit 0,50");
	while($voucher_list=mysql_fetch_array($search_vouc))
	{  $vou_code=$voucher_list['code'];
	?>
	<option value="<?php echo $vou_code; ?>"><?php echo $vou_code; ?></option>
	<?php } ?>
	</select>
	</div> 
	<div class="col-sm-2">
	<span class="input-group-btn">
	<button class="btn btn-info btn-flat" type="button" onClick="voucher_search()">Search</button>
	</span>
	</div>
	<br/>
	</div> 
</div>		<!-- box box-primary-->

<div id="voucher_home">
<div class="newmember_adj" style="width:100%;height:100%;">		
<div class="newmember_adj_left" style="width:25%;height:480px;float:left;margin-top:1px;">
					
<!-- Side Screeen of page -->
<div class="box box-primary" style=" overflow:scroll;height:1000px;">
<div class="box-body">
<ul class="nav nav-pills" style="float:left; width:100%; " >	<li style="background-color:orange; width:100%;"><p style="text-align:center; margin-top:10px;   font-family: none;    font-style: inherit;    font-size: large;    font-variant-caps: unset; font-size:14px;font-weight:bold;text-align:center;">Voucher Waiting List</p></li>
<?php
$vouch_query="SELECT code,date,member_no,name,status,voucher_purpose_code,voucher_category_code FROM `voucher` where status=1";
$vouch_row=mysql_query($vouch_query);
$s1=1;
while($voucher_res=mysql_fetch_array($vouch_row))
{
$member_no=$voucher_res['member_no'];
$code=$voucher_res['code'];
$flag_id=$voucher_res['status'];
$voucher_purpose_code=$voucher_res['voucher_purpose_code'];
$voucher_category_code=$voucher_res['voucher_category_code'];
?>
<li style="border-top:1px solid #ddd;cursor:pointer;width:100%;text-transform: uppercase;line-height: 20px; font-weight:bold;float:; position:relative;" class="active1"  id="<?php echo $s1; ?>" > 
<input type="hidden" name="member_no" id="member_no_<?php echo $s1; ?>" value="<?php echo $member_no;?>"  />
<input type="hidden" name="voucher_no" id="voucher_no_<?php echo $s1; ?>" value="<?php echo $code;?>"  />
<input type="hidden" name="status_id" id="status_id_<?php echo $s1;?>" value="<?php echo $flag_id;?>"  />
<input type="hidden" name="voucher_category_code" id="voucher_category_code_<?php echo $s1;?>" value="<?php echo $voucher_category_code; ?>"  />
<?php echo "Vou Code:&nbsp".$voucher_res['code'];?>
<div style="float:right;">
<button class="btn btn-primary" id="<?php echo $code;?>" value="<?php echo $s1; ?>" onclick="edit(this.id,this.value)"><i class="fa fa-pencil"></i></button>
<button class="btn btn-success" id="<?php echo $s1;?>" value="<?php echo $voucher_purpose_code; ?>" onClick="clicked(this.id,this.value);"><i class="fa fa-eye"></i></button>
</div>
<?php $s1++;	 ?>
</li>
<?php
}    
?>
</ul>
</div>                   <!-- box-body close-->
</div>		
</div>
<div class="box box-primary" id="newmember_adj_right" style="width:75%;float:left;overflow:scroll;height:500px;">
</div>
</div>
</div>

 <!-- Page js file will be there..@! -->

<?php require('edit_voucher_page.js'); ?> 
