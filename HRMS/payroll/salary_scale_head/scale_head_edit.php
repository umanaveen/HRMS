<?php
require '../../../connect.php';
$ids=$_REQUEST['ids'];
 $edit_id=$con->query("select * from payroll_scale_master where id='$ids'");
$res = $edit_id->fetch();
?>

	<div class="container-fluid">
	<div class="card mb-3">
	<div class="card-header">
	<i class="fa fa-table"></i> Scale Head 
	<a onclick="scale_head_tab_back()" style="float: right;" data-toggle="modal" class="btn btn-primary"></i>Back</a>
	</div>
	<div class="card-body">
	<form method="POST">
	<div class="form-group row">
	<label for="Scale" class="col-sm-2 col-form-label"> Name</label>
	<div class="col-sm-10">
	<input type="text"  class="form-control" id="scale" name="scale" value="<?php echo $res[1]; ?>">
	</div>
	</div>
	<table id="new_po_tr" class="table table-striped table-hover table-bordered">	
	<thead>
	<tr><th>#</th><th>Name</th><th>Amount</th><th>Percentage</th></tr>
	</thead>
	<tbody>	
	<?php
		
	$scale_details_sql=$con->query("SELECT a.id,a.salary_structure_name,a.salary_structure_id,b.amount,b.percentage,a.status FROM payroll_scale_details a join payroll_structure b on a.salary_structure_id=b.id where a.payroll_master_id='$ids'");		
	
	$i=1;
	while($scale_details_val = $scale_details_sql->fetch(PDO::FETCH_ASSOC))			
	{
		$s_d_id = $scale_details_val['id'];
	?>
	<tr class="row_<?php echo $s_d_id;?>">	
	<td>
	<input type="checkbox" class="chk" name="chk[]" id="chk_<?php echo $s_d_id;?>" value="<?php echo $s_d_id;?>" style="width:15px;height:20px;"/>
	</td>
	<td>
	<select class="form-control" name="earnings[]" id="earnings_<?php echo $s_d_id;?>" onchange="earnings_validate(<?php echo $s_d_id;?>)" required="TRUE">
	<option value="<?php echo $scale_details_val['salary_structure_id'];?>"><?php echo $scale_details_val['salary_structure_name'];?></option>
	</select>
	</td>	
	<td>
	<input type="hidden" name="earning_name[]" id="earning_name_<?php echo $s_d_id;?>" value="<?php echo $scale_details_val['salary_structure_name'];?>">
	<input type="text" class="form-control" name="amount[]" id="amount_<?php echo $s_d_id;?>" value="<?php echo $scale_details_val['amount'];?>" readonly>
	</td>
	<td>
	<input type="text" class="form-control" name="percentage[]" id="percentage_<?php echo $s_d_id;?>" value="<?php echo $scale_details_val['percentage'];?>"  readonly>
	</td>
	</tr>			
	
	
	<?php 
	} 
	?>
	</tbody>
	</table>
	
	<div class="form-group row">
	<label for="text" class="col-sm-2 col-form-label">Status</label>
	<div class="col-sm-10">
	<select id="status" name="status" class="form-control" >
	<?php 
	if($res[2] ==1)
	{
	?>
	<option value="1">Active</option>
	<option value="2"> IN Active</option>
	<?php }else {?>
	<option value="2"> IN Active</option>
	<option value="1">Active</option>
	<?php } ?>
	</select>
	</div>
	</div>
	
	<table class="table table-bordered">
	<tr>
	<td style="width:75%">
	<input type="button" class="btn btn-success" id="new_row" name="new_row" onclick="add_new_scale()" value="Add">
	<input type="button" class="btn btn-danger" id="scale_row_remove" value="Remove">
	</td>
	<td style="width:25%">
	<input type="button" class="btn btn-primary btn-md" id="<?php echo $ids; ?>" onclick="scale_head_update(this.id)" value="Update">
	</td>
	</tr>
	</table>
	
	</form>
	</div>
	</div>
	</div>
	
<script>
function scale_head_tab_back()
{
	$.ajax({
    type:"GET",
    url:'HRMS/payroll/salary_scale_head/scale_head_main.php',
    success:function(data){
      $("#payroll_view").html(data);
    }
  })
}
</script>

<script>

function add_new_scale()
{
	var len=$('#new_po_tr tr').length;	
	len=len+1;
	$('#new_po_tr').append('<tr class="row_'+len+'"><td><input type="checkbox" class="chk" name="chk[]" id="chk_'+len+'" value="'+len+'" style="width:15px;height:20px;"/></td><td><select class="form-control" name="earnings[]" id="earnings_'+len+'" onchange="earnings_validate('+len+')" required="TRUE"><option value="0">Select Earnings</option><?php $isql=$con->query("SELECT id,name, amount, percentage,status FROM payroll_structure");$i=1;while($payroll_structure = $isql->fetch(PDO::FETCH_ASSOC))	{?><option value="<?php echo $payroll_structure['id']; ?>"><?php echo $payroll_structure['name']; ?></option><?php } ?></select></td>	<td><input type="hidden" name="earning_name[]" id="earning_name_'+len+'"><input type="text" class="form-control" name="amount[]" id="amount_'+len+'" readonly></td><td><input type="text" class="form-control" name="percentage[]" id="percentage_'+len+'" readonly></td></tr>');
}

$('#scale_row_remove').click(function()
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


function scale_head_update(v)
{
	var id=v;
	alert(id);
	var data = $('form').serialize();
	$.ajax({
	type:'GET',
	data:"id="+id, data,
	url:'/HRMS/HRMS/payroll/scale_head_update.php',
	success:function(data)
	{
	 if(data==0)
	{
		alert("Updated Scale Master");
		scale_head();
	}
	else
	{
		alert("Not Updated Scale Master");
		scale_head();
	} 	
	}       
	}); 
}
</script>
