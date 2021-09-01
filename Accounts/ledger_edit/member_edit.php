<?php
require('../../configuration.php');
require('../../user.php');

$type=$_REQUEST['type'];
$date=$_REQUEST['date'];
$from_date=date('Y-m-d',strtotime($date));
$code=$_REQUEST['code'];
?>
<div id="demandView">
	<form>
	<table class="table table-striped" id='branchwisecollection2' style="width: 1000;">
		<thead>
		<tr>
		<th COLSPAN='3' align="center">MEMBER LEDGER &nbsp;&nbsp; BALANCE &nbsp;&nbsp;ON&nbsp;&nbsp;
		<?php echo date('d-m-Y',strtotime($date));?></th>
		</tr>
		</thead>
		<?php 
		$query="SELECT sh.date, sh.member_no,m.name, 
		sr.balance as sr_bal, sr.od_balance as sr_od,
		t.balance as t_bal, t.od_balance as t_od,
		sh.balance as sh_bal,su.balance as su_bal,su.od_balance as su_od,su.od_interest as su_od_int,
		fe.balance as fe_bal,fe.od_balance as fe_od,fe.od_interest as fe_od_int,   
		fl.balance as fl FROM 
		opening_balance_share sh left join member m on sh.member_no=m.member_no left join 
		opening_balance_srf sr on sh.member_no=sr.member_no and sh.date=sr.date left join 
		opening_balance_thrift t on sh.member_no=t.member_no and sh.date=t.date left join 
		opening_balance_surety su on sh.member_no=su.member_no and sh.date=su.date left join 
		opening_balance_festival fe on sh.member_no=fe.member_no and sh.date=fe.date left join 
		opening_balance_flood fl on sh.member_no=fl.member_no and sh.date=fl.date WHERE sh.date='$from_date' and sh.member_no='$code'";
		$result=mysql_fetch_array(mysql_query($query));
		?>
		
		<tbody>		
		<tr>
		<td>DATE</td>
		<td><input class="form-control select2" name="date" id="date" 
		value="<?php echo date('d-m-Y',strtotime($result['date']));?>" readonly></td>
		</tr>
		<tr>
		<td>MEMBER</td>
		<td><input class="form-control select2" type="text" name="member_no" id="member_no" 
			value="<?php echo $result['member_no'].'-'.$result['name'];?>" readonly></td>
		</tr>
		<tr>
		<td>SRF BALANCE</td>
		<td><input class="form-control select2" type="text" name="sr_bal" id="sr_bal" 
		value="<?php echo $result['sr_bal'];?>">
		</td>
		</tr>
		<tr>
		<td>SRF OD BALANCE</td>
		<td><input class="form-control select2" type="text" name="sr_od" id="sr_od" 
		value="<?php echo $result['sr_od'];?>">
		</td>
		
		</tr>
		<tr>
		<td>THRIFT BALANCE</td>
		<td><input class="form-control select2" type="text" name="t_bal" id="t_bal" 
		value="<?php echo $result['t_bal'];?>">
		</td>
		</tr>
		<tr>
		<td>THRIFT OD BALANCE</td>
		<td><input class="form-control select2" type="text" name="t_od" id="t_od" 
		value="<?php echo $result['t_od'];?>">
		</td>
		</tr>		
		<tr>
		<td>SHARE BALANCE</td>
		<td><input class="form-control select2" type="text" name="sh_bal" id="sh_bal" 
		value="<?php echo $result['sh_bal'];?>">
		</td>
		</tr>
		<tr>
		<td>SURETY BALANCE</td>
		<td><input class="form-control select2" type="text" name="su_bal" id="su_bal" 
		value="<?php echo $result['su_bal'];?>">
		</td>
		</tr>		
		<tr>
		<td>SURETY OD BALANCE</td>
		<td><input class="form-control select2" type="text" name="su_od" id="su_od" 
		value="<?php echo $result['su_od'];?>">
		</td>
		</tr>
		
		<tr>
		<td>SURETY OD INT</td>
		<td><input class="form-control select2" type="text" name="su_od_int" id="su_od_int" 
		value="<?php echo $result['su_od_int'];?>">
		</td>
		</tr>
		<tr>
		<td>FESTIVAL BALANCE</td>
		<td><input class="form-control select2" type="text" name="fe_bal" id="fe_bal" 
		value="<?php echo $result['fe_bal'];?>">
		</td>
		</tr>		
		<tr>
		<td>FESTIVAL OD BALANCE</td>
		<td><input class="form-control select2" type="text" name="fe_od" id="fe_od" 
		value="<?php echo $result['fe_od'];?>">
		</td>
		</tr>
		<tr>
		<td>FESTIVAL OD INT</td>
		<td><input class="form-control select2" type="text" name="fe_od_int" id="fe_od_int" 
		value="<?php echo $result['fe_od_int'];?>">
		</td>
		</tr>	
		
		
		<tr><td></td><td><div class="input-group "> 
		<span class="input-group-btn">
		<button class="btn btn-info btn-flat" type="button" onclick="member_update()">UPDATE!</button>
		</span>
		</div></td></tr>
		</tbody>
	</table>
	</form>
</div>

<script>
function member_update()
{
	var date='<?php echo $date; ?>';
	var mem_no='<?php echo $code; ?>';
	var sr_bal=document.getElementById("sr_bal").value;
	var sr_od=document.getElementById("sr_od").value;
	var t_bal=document.getElementById("t_bal").value;
	var t_od=document.getElementById("t_od").value;
	var sh_bal=document.getElementById("sh_bal").value;
	var su_bal=document.getElementById("su_bal").value;
	var su_od=document.getElementById("su_od").value;
	var su_od_int=document.getElementById("su_od_int").value;
	var fe_bal=document.getElementById("fe_bal").value;
	var fe_od=document.getElementById("fe_od").value;
	var fe_od_int=document.getElementById("fe_od_int").value;
	$.ajax({
		type : "GET",
		data : '&id='+2+'&date='+date+'&mem_no='+mem_no+'&sr_bal='+sr_bal+'&sr_od='+sr_od+'&t_bal='+t_bal+'&t_od='+t_od+'&sh_bal='+sh_bal+'&su_bal='+su_bal+'&su_od='+su_od+'&su_od_int='+su_od_int+'&fe_bal='+fe_bal+'&fe_od='+fe_od+'&fe_od_int='+fe_od_int,
		url	 : "/UCO/ledgertransaction/edit/update.php",
	});
}
</script>