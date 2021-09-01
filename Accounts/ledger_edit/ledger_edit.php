<?php
require '../../connect.php';
//require('../../user.php');

$type=$_REQUEST['type'];
$date=$_REQUEST['date'];
$from_date=date('Y-m-d',strtotime($date));
$code=$_REQUEST['code'];
$splitDate=explode("-",$code);
$ledger_code=$splitDate[0];
?>


<div id="demandView">
<table class="table table-striped" id='branchwisecollection2' style="width: 1000;">
<thead>
<tr>
<th COLSPAN='3' align="center">LEDGER &nbsp;&nbsp; BALANCE &nbsp;&nbsp;ON&nbsp;&nbsp;<?php echo date('d-m-Y',strtotime($date));?></th>
</tr>
</thead>
<?php 
$query=$con->query("SELECT id,date,ledger_code,balance FROM accounts_ledger_opening_balance WHERE date='$from_date' and ledger_code='$ledger_code'");
$result=$query->fetch(PDO::FETCH_ASSOC);
?>
<tbody>
<tr><td>DATE</td>
<td><input class="form-control select2" name="date" id="date" value="<?php echo date('d-m-Y',strtotime($result['date']));?>" readonly></td>
</tr>
<tr><td>LEDGER</td>
<td><input class="form-control select2" type="text" name="ledger" id="ledger" value="<?php echo $result['ledger_code'];?>" readonly></td>
</tr>
<tr><td>LEDGER BALANCE</td>
<td><input class="form-control select2" type="text" name="balance" id="balance" value="<?php echo $result['balance'];?>"></td>
</tr>
<tr><td></td><td><div class="input-group "> 
<span class="input-group-btn">
<button class="btn btn-info btn-flat" type="button" onclick="ledger_update()">UPDATE!</button>
</span>
</div></td></tr>

</tbody>
</div>
<script>


function ledger_update()
{
	var date=$('#date').val();
	var ledger=$('#ledger').val();
	var balance=$('#balance').val();
	$('#report_view').html('<br><div style="text-align: center;"><img src="/UCO/images/loader/loader.gif"></div>');
	$.ajax({
	type:"get",
	url:'Accounts/ledger_edit/update.php',
	data:'&id='+1+'&ledger='+ledger+'&date='+date+'&balance='+balance,
	success:function(data)
	{
		$('#report_view').html(data);
		if(data==1)
		{
			alert('Update success');
			moreOption(56);
		}
		else
		{
			alert('check values');
		}
	}		
	});
}
</script>
