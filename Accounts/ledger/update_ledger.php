<?php
require '../../connect.php';
?>

<table class="table table-striped" style="font-family:'Times New Roman', Times, serif;">
<thead>
<tr>
<th colspan="2">Update Ledger</th>
</tr>
</thead>

<tbody>
<tr>
<input type="hidden" name="ledger_id" id="ledger_id">
<td>SELECT LEDGER</td>
<td>
<select class="form-control select2" style="width: 100%;" onchange="fix_all(this.value)" name="ledg_code" id="ledg_code">
	<option value="">----Choose Ledger----</option>
	<?php	
	$ledRow=$con->query("select code,name from accounts_ledger order by code asc");
	while($ledRes=$ledRow->fetch(PDO::FETCH_ASSOC)){	?>
	<option value="<?php echo $ledRes['code'];?>"><?php echo $ledRes['code'].' - '.$ledRes['name'];?></option>	<?php 	}  ?> 
</select>
</td>
</tr>
</tbody>
</table>
<th>
<div id="Ledgerdataview">
</div>
</th>
<script>

function fix_all(v)
{
	$.ajax({
			type: "GET",
			url: "Accounts/ledger/ledger_datas.php",
			data: "valid=" + v,
			success: function(data)
			{
				$('#Ledgerdataview').html(data);
			}
	});
}
</script>

