<?php
require '../../connect.php';
 
?>

<table class="table table-striped" style="font-family:'Times New Roman', Times, serif;">
<thead>
<tr>
<th colspan="2">Add Ledger</th>
</tr>
</thead>
<tbody>
<tr>
<td>Ledger Code</td>
<td><input type="text" class="form-control" id="code" name="code" /></td>
</tr>
<tr>
<td>Ledger Name</td>
<td><input type="text" class="form-control" id="name" name="name" /></td>
</tr>
<tr>
<td>Account Category</td>
<td><select class="form-control select2" style="width: 100%;" name="accounts_id" id="accounts_id">
<option value=" ">----SLECT Account Category ----</option>
<?php	$accSql="SELECT	id,type	FROM accounts";
		$accRow=$con->query("$accSql");
		while($accRes=$accRow->fetch(PDO::FETCH_ASSOC)){	?>
		<option value="<?php echo $accRes['id'];?>"><?php echo $accRes['type'];?></option>	<?php 	}  ?> 
</select>
</td></tr>
<tr>
<td>Profit Loss Category</td>
<td><select class="form-control select3" style="width: 100%;" name="pl_id" id="pl_id">	
	<option value="0">----SLECT Profit Loss Category ----</option>
<?php	$accSql="SELECT	id,name	FROM accounts_pl_group_master";
		$accRow=$con->query("$accSql");
		while($accRes=$accRow->fetch(PDO::FETCH_ASSOC))	{ ?>
		<option value="<?php echo $accRes['id'];?>"><?php echo $accRes['name'];?></option> <?php 	} ?>
</select>
</td>
</tr>
<tr>
<td>Balance Sheet Category</td>
<td><select class="form-control select4" style="width: 100%;" name="bs_id" id="bs_id">
<option value="0">----SLECT Profit Loss Category ----</option>
<?php	$accSql="SELECT	id,name	FROM accounts_bs_group_master";
		$accRow=$con->query("$accSql");
		while($accRes=$accRow->fetch(PDO::FETCH_ASSOC))	{ ?>
		<option value="<?php echo $accRes['id'];?>"><?php echo $accRes['name'];?></option>	<?php	} ?>
</select>
</td>
</tr>
<tr>
<td></td>
<td><input type="button" name="addProduct" class="btn btn-success" value="SAVE" onclick="submitLedger()" /></td>
</tr>
</tbody>
	
</table>
<script>

$(function () {
	   //Initialize Select2 Elements
        $(".select2").select2();
		  });
		  
	 /* Name validation */
		$("#name").bind('keyup', function (e) {
    if (e.which >= 97 && e.which <= 122) {
        var newKey = e.which - 32;
        // I have tried setting those
        e.keyCode = newKey;
        e.charCode = newKey;
		}

		$("#name").val(($("#name").val()).toUpperCase());
		
		}	);
		
		/* CODE validation */
		$("#code").bind('keyup', function (e) {
    if (e.which >= 97 && e.which <= 122) {
        var newKey = e.which - 32;
        // I have tried setting those
        e.keyCode = newKey;
        e.charCode = newKey;
		}

		$("#code").val(($("#code").val()).toUpperCase());
		
		}	);

function submitLedger()
{
			var code=$('#code').val();
			var name=$('#name').val();
			var ac_id=$('#accounts_id').val();
			var pl_id=$('#pl_id').val();
			var bs_id=$('#bs_id').val();
			
			if(code!='' && name!='' && ac_id!='')
			{
				$.ajax({
			
    							type: "GET",
    							url: "Accounts/ledger/submitLedger.php",
    							data: "code="+code+"&name="+name+"&ac_id="+ac_id+"&pl_id="+pl_id+"&bs_id="+bs_id,
								
    							success: function(data){
								if(data==0)
									{
										$('#changeGeneralLedger').html('<br><div style="text-align: center;"><img src="images/loader/loader.gif"></div>');
										alert("Ledger Saved Successfully");
										$('#changeGeneralLedger').html(data);
									}
								else if(data==1)
									{
										alert("Ledger Cannot be Saved");
									}
								else if(data==2)
									{
										alert("LEDGER CODE ALREADY EXISTS");
									}
								else if(data==3)
									{
										alert("LEDGER NAME ALREADY EXISTS");
									}	
									}
								});
			}
			else
			{
				alert ('Please Fill All Fields');			
			}
		
}
</script>
	
	