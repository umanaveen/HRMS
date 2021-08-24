<?php
require '../../../connect.php';
?>
<div class="card mb-3">
<div class="card-header">
<i class="fa fa-table"></i> Payroll Structure
<a onclick="scale_master_back()" style="float: right;" data-toggle="modal" class="btn btn-primary"></i>Back</a>
</div>
<div class="card-body">
<form method="POST">
<div class="form-group row">
<label for="Earnings" class="col-sm-2 col-form-label"> Name</label>
<div class="col-sm-10">
<input type="hidden"  class="form-control" id="Earnings_name" name="Earnings_name"  placeholder="Earnings name">
<input type="text"  class="form-control" id="Earnings" name="Earnings" placeholder="Earnings Name">
</div>
</div>
<div class="form-group row">
<label for="basicpay" class="col-sm-2 col-form-label">Amount</label>
<div class="col-sm-10">
  <input type="number"  class="form-control" id="amount" name="amount" placeholder="amount">
</div>
</div>
<div class="form-group row">
<label for="spl_pay" class="col-sm-2 col-form-label">Percentage</label>
<div class="col-sm-10">
  <input type="number"  class="form-control" id="percentage" name="percentage" placeholder="percentage">
</div>
</div>
<div class="form-group row">
<label for="text" class="col-sm-2 col-form-label">Status</label>
<div class="col-sm-10">
<select id="status" name="status" class="form-control" >
<option value="1">Active</option>
<option value="2"> IN Active</option>
</select>
</div>
</div>
<div class="col-sm-2">
<input type="button" class="btn btn-primary btn-md" onclick="salary_create()" value="SAVE">
</div>
</div>
</form>
</div>
<script>
function scale_master_back()
{
	$.ajax({
	type:"POST",
	url:"HRMS/payroll/salary_structure/salary_structure.php",
	success:function(data)
	{
		$("#salary_structure_view").html(data);
	}
	})
}
function salary_create()
{
	var field=1;
	var data = $('form').serialize();
	$.ajax({
	type:'GET',
	data:"field="+field, data,
	url:'HRMS/payroll/salary_structure/salary_structure_insert.php',
		success:function(data)
		{
			if(data==1)
			{
				alert("Not Created Scale Master");
			}       
			else
			{
				alert("Created Scale Master");
			}	
		}
	});
}
</script>