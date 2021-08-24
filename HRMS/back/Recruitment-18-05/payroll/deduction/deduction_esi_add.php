<?php
require '../../../connect.php';
?>

<div class="content-wrapper" id="main_content">
<div class="container-fluid">
  <div class="card mb-3">
    <div class="card-header">
      <i class="fa fa-table"></i>DEDUCTION ADD
	  <input type="button" style="float:right;" class="btn btn-warning" name="back" value="BACK" onclick="esi_back()">
	  </div>
    <div class="card-body">
	 <form method="POST">
<div class="form-group row">
<label for="Earnings" class="col-sm-2 col-form-label"> Name</label>
<div class="col-sm-10">
<input type="text"  class="form-control" id="name" name="name" placeholder="Name">
</div>
</div>
			<div class="form-group row">
<label for="from_date" class="col-sm-2 col-form-label"> From Date</label>
<div class="col-sm-10">
<input type="date"  class="form-control" id="from_date" name="from_date" placeholder="From Date">
</div>
</div>
<div class="form-group row">
<label for="min_amount" class="col-sm-2 col-form-label">Amount</label>
<div class="col-sm-10">
<input type="number"  class="form-control" id="amount" name="amount" placeholder="Amount">
</div>
</div>
			<div class="form-group row">
<label for="percentage" class="col-sm-2 col-form-label">Percentage</label>
<div class="col-sm-10">
<input type="number"  class="form-control" id="percentage" name="percentage" placeholder="Percentage">
</div>
</div>
			<div class="form-group row">
<label for="min_amount" class="col-sm-2 col-form-label">Minimum Amount</label>
<div class="col-sm-10">
<input type="number"  class="form-control" id="min_amount" name="min_amount" placeholder="Minimum Amount">
</div>
</div>
				<div class="form-group row">
<label for="max_amount" class="col-sm-2 col-form-label">Maximum Amount</label>
<div class="col-sm-10">
<input type="number"  class="form-control" id="max_amount" name="max_amount" placeholder="Minimum Amount">
</div>
</div>
		  <div class="form-group row">
			<label for="text" class="col-sm-2 col-form-label">Status</label>
			<div class="col-sm-10">
			<select class="form-control" name="status" id="status">
<option value="">Select Status</option>
<option value="1">Active</option>
<option value="0">InActive</option>
</select>
			</div>
		    </div>
			
			   <div class="card-header"> 
<input type="button" class="btn btn-primary btn-md" onclick="esi_create()" value="SAVE">
			   
	  <!--input type="button" style="float:center;" class="btn btn-warning" name="deduction_esi_insert" value="Save" onclick="deduction_esi_insert()"-->
	  </div>
		  </div>
		
	 </form>
    </div>
  </div>
</div>
</div>
</div>

<script>
function esi_back()
{ alert("nnn");
	 $.ajax({
    type:"POST",
    url:"/Recruitment/Recruitment/payroll/deduction/deduction_esi.php",
    success:function(data){
      $("#main_content").html(data);
    }
  }) 
}
</script>
<script>
 function esi_create()
{
	alert("hii");
	 var id=1;
	var data = $('form').serialize();
	$.ajax({
	type:'GET',
	data:"id="+id, data,
	  url:"/Recruitment/Recruitment/payroll/deduction/deduction_esi_insert.php",
		success:function(data)
		{
			if(data==1)
			{
				alert("Not Created Deduction Master");
				esi_back();
			}       
			else
			{
				alert("Created Deduction Master");
				esi_back();
			}	
		}
	}); 
}
</script>

