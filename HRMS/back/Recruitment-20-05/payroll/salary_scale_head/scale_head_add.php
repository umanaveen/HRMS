<?php
require '../../../connect.php';
?>
<div class="card mb-3">
<div class="card-header">
<i class="fa fa-table"></i>  Payroll Scale Head Structure
<a onclick="scale_head_back()" style="float: right;" data-toggle="modal" class="btn btn-primary"></i>Back</a>
</div>
<div class="card-body">
<form method="GET">
<div class="form-group row">
<div class="col-sm-12">
<input type="hidden"  class="form-control" id="Scale Name" name="Scale Name"  placeholder="Scale Name">
<input type="text"  class="form-control" id="Scale" name="Scale" placeholder="Scale Name">
</div>
</div>
<table id="new_po_tr" class="table table-striped table-hover table-bordered">	
<thead>
<tr><th>#</th><th>Name</th><th>Amount</th><th>Percentage</th></tr>
</thead>
<tbody>	
<tr class="row_1">	
<td>
<input type="checkbox" class="chk" name="chk[]" id="chk_1" value="1" style="width:15px;height:20px;"/>
</td>
<td>
<select class="form-control" name="earnings[]" id="earnings_1" onchange="earnings_validate(1)" required="TRUE">
<option value="0">Select Earnings</option>
<?php
$isql=$con->query("SELECT id,name, amount, percentage,status FROM payroll_structure");			
$i=1;
while($payroll_structure = $isql->fetch(PDO::FETCH_ASSOC))			
{
?>
<option value="<?php echo $payroll_structure['id']; ?>"><?php echo $payroll_structure['name']; ?></option>
<?php 
} 
?>
</select>
</td>	
<td>
<input type="hidden" name="earning_name[]" id="earning_name_1">
<input type="text" class="form-control" name="amount[]" id="amount_1" readonly>
</td>
<td>
<input type="text" class="form-control" name="percentage[]" id="percentage_1" readonly>
</td>
</tr>			
</tbody>
</table>
<table class="table table-bordered">
<tr>
<td style="width:75%">
<input type="button" class="btn btn-success" id="new_row" name="new_row" onclick="add_new_po()" value="Add">
<input type="button" class="btn btn-danger" id="po_row_remove" onclick="po_row_remove()" value="Remove">
</td>
<td style="width:25%"><input type="button" class="btn btn-success" name="scale_save" onclick="scale_data_save()" value="SAVE"></td>
</tr>
</table>
</div>
</form>
</div>
<script>

function earnings_validate(v)
{	
	var earnings_id = document.getElementById('earnings_'+v).value;
	$.ajax({
		type:'GET',
		data:"earnings_id="+earnings_id,
		url:'Recruitment/payroll/salary_scale_head/scale_head_details.php',
		success:function(data)
		{
			var splitData=data.split("=");			
			$("#amount_"+v).val(splitData[0]);
			$("#percentage_"+v).val(splitData[1]);
			$("#earning_name_"+v).val(splitData[2]);
		}
	});
}
</script>



<script>

function add_new_po()
{
	var len=$('#new_po_tr tr').length;	
	len=len+1;
	$('#new_po_tr').append('<tr class="row_'+len+'"><td><input type="checkbox" class="chk" name="chk[]" id="chk_'+len+'" value="'+len+'" style="width:15px;height:20px;"/></td><td><select class="form-control" name="earnings[]" id="earnings_'+len+'" onchange="earnings_validate('+len+')" required="TRUE"><option value="0">Select Earnings</option><?php $isql=$con->query("SELECT id,name, amount, percentage,status FROM payroll_structure");$i=1;while($payroll_structure = $isql->fetch(PDO::FETCH_ASSOC))	{?><option value="<?php echo $payroll_structure['id']; ?>"><?php echo $payroll_structure['name']; ?></option><?php } ?></select></td>	<td><input type="hidden" name="earning_name[]" id="earning_name_'+len+'"><input type="text" class="form-control" name="amount[]" id="amount_'+len+'" readonly></td><td><input type="text" class="form-control" name="percentage[]" id="percentage_'+len+'" readonly></td></tr>');
}

$('#po_row_remove').click(function()
{
	$('input:checkbox:checked.chk').map(function(){
	var id=$(this).val();
	var le=$('#new_po_tr tr').length;
	if(le==1)
	{
		alert("You Can't Delete All the Rows");
	}
	else
	{
		$('.row_'+id).remove();
	}
	
	});
});

</script>

<script>

function scale_head_back()
{
	$.ajax({
    type:"GET",
    url:'Recruitment/payroll/salary_scale_head/scale_head_main.php',
    success:function(data){
      $("#payroll_view").html(data);
    }
  })
}

function scale_data_save()
{
	var field=1;
	var data = $('form').serialize();
	$.ajax({
	type:'GET',
	data:"field="+field, data,
	url:'Recruitment/payroll/salary_scale_head/scale_head_insert.php',
		success:function(data)
		{
			if(data == 1)
			{
				alert('Saved successfully');
			}
			else
			{
				alert('Not saved');
			}
		}
	});
}
</script>