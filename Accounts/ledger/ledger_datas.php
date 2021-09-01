<?php
require '../../connect.php';

/* require("../../user.php");
$user=$_SESSION['user']; */

$code=$_REQUEST['valid'];

$detail = $con->query("SELECT 
			l.id,l.code,l.name,l.accounts_id,l.pl_group_id,l.bs_group_id,
			a.type,
			b.name as plgroup,
			c.name as bsgroup
				FROM accounts_ledger l LEFT JOIN	accounts a 
				ON a.id=l.accounts_id 
				LEFT JOIN 
				accounts_pl_group_master b ON b.id=l.pl_group_id
				LEFT JOIN
				accounts_bs_group_master c ON c.id=l.bs_group_id 
				where l.code='$code'");

$cus=$detail->fetch(PDO::FETCH_ASSOC);
?>

		
<table class="table table-striped" style="font-family:'Times New Roman', Times, serif;">
<tbody>
<tr>
<td>Ledger Code</td>
<td>
<input type="hidden" name="led_id" id="led_id" value="<?php echo $cus['id'];?>">
<input type="text" class="form-control" id="l_code" name="l_code" value="<?php echo $cus['code']; ?>" /></td>
</tr>
<tr>
<td>Ledger Name</td>
<td><input type="text" class="form-control" id="l_name" name="l_name" value="<?php echo $cus['name']; ?>"/></td>
</tr>
<tr>
<td>Account Category</td>
<td>
<select class="form-control select2" style="width: 100%;" name="l_type" id="l_type">
	<option value="<?php echo $cus['accounts_id']; ?>"><?php echo $cus['type']; ?></option>	
	<?php 
	    $accsqli="SELECT id,type FROM accounts";
		$accRow=$con->query("$accsqli");
		while($accRes=$accRow->fetch(PDO::FETCH_ASSOC))
		{	
	?>
	
	<option value="<?php echo $accRes['id'];?>"><?php echo $accRes['type'];?></option>	
	<?php 	
		}
		?> 
	</select>
</td>
</tr>
<tr>
<td>Profit Loss Category</td>
<td>
<select class="form-control select3" style="width: 100%;" name="l_plgroup" id="l_plgroup">	
<option value="<?php echo $cus['pl_group_id']; ?>"><?php echo $cus['plgroup']; ?></option>
<?php	
$accSql="SELECT	id,name	FROM accounts_pl_group_master";
$accRow=$con->query("$accSql");
while($accRes=$accRow->fetch(PDO::FETCH_ASSOC))	
{ ?>
<option value="<?php echo $accRes['id'];?>"><?php echo $accRes['name'];?></option> <?php 	} ?>
</select>
</td>
</tr>
<tr>
<td>Balance Sheet Category</td>
<td>
<select class="form-control select4" style="width: 100%;" name="l_bsgroup" id="l_bsgroup">
<option value="<?php echo $cus['bs_group_id']; ?>"><?php echo $cus['bsgroup']; ?></option>

<?php	
$accSql="SELECT	id,name	FROM accounts_bs_group_master";
$accRow=$con->query("$accSql");
while($accRes=$accRow->fetch(PDO::FETCH_ASSOC))	
{ ?>
<option value="<?php echo $accRes['id'];?>"><?php echo $accRes['name'];?></option>	
<?php	
} 
?>
</select>
</td>
</tr>
<tr>
<td></td>
<td><input type="button" name="update_ledger" class="btn btn-success" value="UPDATE" onclick="update()" /></td>
</tr>
</tbody>

	
</table>

<script>
function update()
{
	var id=$('#led_id').val();
	alert(id);
	var new_code=$('#l_code').val();
	var new_name=$('#l_name').val();
	alert(new_name);
	var new_accounts_id=$('#l_type').val();
	alert(new_accounts_id);
	var new_pl_id=$('#l_plgroup').val();
	alert(new_pl_id);
	var new_bs_id=$('#l_bsgroup').val();
	alert(new_bs_id);
	
	$.ajax({
                type: "GET",
				url: "/UCO/ledgertransaction/ledger/submit_update_ledger.php",
				data: "code="+new_code+"&name="+new_name+"&ac_id="+new_accounts_id+"&pl_id="+new_pl_id+"&bs_id="+new_bs_id+"&id="+id,
				
				success: function(data){
				if(data==0)
					{
						$('#changeGeneralLedger').html('<br><div style="text-align: center;"><img src="/UCO/images/loader/loader.gif"></div>');
						alert("Ledger update Successfully");
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
</script>

 