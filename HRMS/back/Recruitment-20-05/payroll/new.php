<?php
require '../../connect.php';
?>

<div class="content-wrapper" id="main_content">
<div class="container-fluid">
  <div class="card mb-3">
    <div class="card-header">
      <i class="fa fa-table"></i> Payroll Structure
	  <input type="button" style="float:right;" class="btn btn-warning" name="back" value="BACK" onclick="scale_master()">
	  </div>
    <div class="card-body">
	 <form method="POST">
		  <div class="form-group row">
			<label for="Scale" class="col-sm-2 col-form-label"> Name</label>
			<div class="col-sm-10">
			  <input type="text"  class="form-control" id="scale" name="scale" placeholder="Scale Name">
			</div>
		  </div>
		  <div class="form-group row">
			<label for="Date" class="col-sm-2 col-form-label">Type</label>
			<div class="col-sm-10">
			  <input type="date" class="form-control" id="from_date" name="from_date" placeholder="Date">
			</div>
		  </div>
		  <div class="form-group row">
			<label for="basicpay" class="col-sm-2 col-form-label">Amount</label>
			<div class="col-sm-10">
			  <input type="number"  class="form-control" id="basic_pay" name="basic_pay" placeholder="Basic Pay Amount">
			</div>
		  </div>
		  <div class="form-group row">
			<label for="spl_pay" class="col-sm-2 col-form-label">Percentage</label>
			<div class="col-sm-10">
			  <input type="number"  class="form-control" id="spl_pay" name="spl_pay" placeholder="Special Pay Amount">
			</div>
		  </div>
		 
			<div class="col-sm-2">
			  <input type="button" class="btn btn-primary btn-md" onclick="scale_create()" value="Create">
			</div>
		  </div>
	</form>
    </div>
  </div>
</div>
</div>
<script>
function scale_master()
{
  $.ajax({
    type:"POST",
    url:"/Recruitment/Recruitment/scale_master/main.php",
    success:function(data){
      $("#main_content").html(data);
    }
  })
}
function scale_create()
{
	var field=1;
	var data = $('form').serialize();
	$.ajax({
		type:'GET',
		data:"field="+field, data,
		url:'/Recruitment/Recruitment/scale_master/scale_new_submit.php',
		success:function(data)
		{
			if(data==0)
			{
				alert("Created Scale Master");
				scale_master();
			}
			else
			{
				alert("Not Created Scale Master");
				scale_master();
			}	
		}       
	});
}
</script>