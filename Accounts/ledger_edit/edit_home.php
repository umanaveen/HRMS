<?php
require '../../connect.php';
//require('../../user.php');
?>

<div class="box box-success">
	<form name="ob_update" type="GET" action="#">
	<div class="form-group" style="width:100%;float:left;padding:10px;">
	<div class="col-xs-3" style="width:30%;float:left;">
	<select class="form-control select2" name="type" id="type">
	<option value="0">--SELECT TYPE--</option>
	<option value="1">OPENING BALANCE</option>
	</select>
	</div>		
	<div class="col-xs-3"> 
	<select class="form-control select2" name="date" id="date">
	<option value="0">--SELECT DATE--</option>
	<datalist id="countries">
	<?php
	$lcode=$con->query("SELECT date FROM accounts_ledger_opening_balance where status=1 group by year");
	while($res=$lcode->fetch(PDO::FETCH_ASSOC))
	{
		?>
		<option value="<?php echo date('d-m-Y',strtotime($res['date']));?>"> <?php echo date('d-m-Y',strtotime($res['date']));?></option>
		<?php
	} 
	?>	
	</select>
	</datalist>
	</div>
		
	<div class="col-xs-3"> 
	<input class="form-control select2" type="text" list="codes" id="code" name="code" placeholder='type ledger code'/>
	<datalist id="codes">
	<?php
	$lcode=$con->query("select b.ledger_code as code,l.name as name from accounts_ledger_opening_balance b join accounts_ledger l on b.ledger_code=l.code where status=1 group by l.code");
	while($res=$lcode->fetch(PDO::FETCH_ASSOC))
	{ 
	?>
	<option value="<?php echo $res['code'];?>"> <?php echo $res['code'].'-'.$res['name'];?></option>
	<?php 
	} 
	?>
	</datalist>
	</div>
	<div class="input-group "> 
	<span class="input-group-btn">
	<button class="btn btn-info btn-flat" type="button" onclick="change_view()">Go!</button>
	</span>
	</div>
	</div><!-- /.form-group --> 
	</form>
</div>
	
		
	

<div id="report_view">
	<caption>
		<center>
			QUADSEL<br />
		</center>
	</caption>
<table class="table table-striped" id="tblLedgerOutstanding" style="font-family:'Times New Roman', Times, serif;">				
<thead>
<tr>
<th colspan="4">LEDGER WISE OUTSTANDING </th>
</tr>
<tr>
<th>#</th>
<th>CODE</th>
<th>NAME</th>
<th>AMOUNT</th>
</tr>
</thead>
				
	<tbody>
	<?php
	$ledger_outstandingSql="SELECT o.ledger_code,l.name,o.balance FROM 
					accounts_ledger_opening_balance o
							JOIN accounts_ledger l 
							ON
								l.code=o.ledger_code
							WHERE
								o.balance<>0 and o.status=1
							ORDER BY
								o.ledger_code";

	$ledger_outstandingRow=$con->query($ledger_outstandingSql);
	$i=1;
	while($ledger_outstandingRes=$ledger_outstandingRow->fetch(PDO::FETCH_ASSOC))
	{
	?>
	<tr>
	<td><?php echo $i++;?></td>
	<td><?php echo $ledger_outstandingRes['ledger_code']; ?></td>
	<td><?php echo $ledger_outstandingRes['name']; ?></td>
	<td style="text-align:right"><?php $balance=$ledger_outstandingRes['balance']; 
										$splitVal=explode(".",$balance);
										$value1=$splitVal[0];
										$value2=$splitVal[1];
										$value3=moneyFormatIndia($value1);
										$amount=$value3.".".$value2;
										echo $amount; ?></td>
	</tr>
	<?php
	}
	?>
	<?php

	function moneyFormatIndia($num){
	$explrestunits = "" ;
	if(strlen($num)>3){
	$lastthree = substr($num, strlen($num)-3, strlen($num));
	$restunits = substr($num, 0, strlen($num)-3); // extracts the last three digits
	$restunits = (strlen($restunits)%2 == 1)?"0".$restunits:$restunits; // explodes the remaining digits in 2's formats, adds a zero in the beginning to maintain the 2's grouping.
	$expunit = str_split($restunits, 2);
	for($i=0; $i<sizeof($expunit); $i++){
	// creates each of the 2's group and adds a comma to the end
	if($i==0)
	{
	$explrestunits .= (int)$expunit[$i].","; // if is first value , convert into integer
	}else{
	$explrestunits .= $expunit[$i].",";
	}
	}
	$thecash = $explrestunits.$lastthree;
	} else {
	$thecash = $num;
	}
	return $thecash; // writes the final format where $currency is the currency symbol.
	}
	?>
	</tbody>				
	<tfoot>
	<tr>
	<th>#</th>
	<th>CODE</th>
	<th>NAME</th>
	<th>AMOUNT</th>
	</tr>
	</tfoot>
	</table> 
</div>

<script>
	 $('#tblLedgerOutstanding').DataTable({
	 	"paging": false 
      });
</script>
	
<script>
function change_view()
{
	var type=document.getElementById("type").value;
	var date=document.getElementById("date").value;
	var code=document.getElementById("code").value;
	
	
	if(type != 0 && date != 0 && code != 0)
	{
		if(isNaN(code))
		{
			$('#report_view').html('<br><div style="text-align: center;"><img src="/UCO/images/loader/loader.gif"></div>');
			$.ajax({
			type: "POST",
			data: '&type='+type+'&date='+date+'&code='+code,
			url: "Accounts/ledger_edit/ledger_edit.php",
			success: function(data){
			$('#report_view').html(data);	
			}
			});		
		}
		else
		{
			$('#report_view').html('<br><div style="text-align: center;"><img src="/UCO/images/loader/loader.gif"></div>');
			$.ajax({
			type: "POST",
			data: '&type='+type+'&date='+date+'&code='+code,
			url: "Accounts/ledger_edit/member_edit.php",
			success: function(data){
			$('#report_view').html(data);	
			}
			});	
		}
	}
	else
	{
		alert ('Select all');
	}
	
}
</script>