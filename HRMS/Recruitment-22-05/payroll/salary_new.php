<?php
require '../../connect.php';
?>

<div class="content-wrapper" id="main_content">
<div class="container-fluid">
  <div class="card mb-3">
    <div class="card-header">
      <i class="fa fa-table"></i> Payroll Structure
<a onclick="scale_master()" style="float: right;" data-toggle="modal" class="btn btn-primary"></i>Back</a>
	  </div>
    <div class="card-body">
	 <form method="POST">
		  <div class="form-group row">
			<label for="Scale" class="col-sm-2 col-form-label"> Name</label>
			<div class="col-sm-10">
						  <input type="hidden"  class="form-control" id="scalename" name="scalename"  placeholder="scalename">

			  <input type="text"  class="form-control" id="scale" name="scale" placeholder="Scale Name">
			</div>
		  </div>
		  <div class="form-group row">
			<label for="text" class="col-sm-2 col-form-label">Type</label>
			<div class="col-sm-10">
			  <input type="text" class="form-control" id="type" name="type" placeholder="text">
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
		   <div class="card-body">
	 <form method="POST">
		  <div class="form-group row">
			<label for="status" class="col-sm-2 col-form-label"> Status</label>
			<div class="col-sm-10">
<select class="form-control" name="status" id="status">
<option value="">Select Status</option>
<option value="1">Active</option>
<option value="0">InActive</option>
</select>
			</div>
		  </div>
		 
			
		  </div>
		 <!--div class="form-group row">
			<div class="col-sm-10">
			  <input type="hidden"  class="form-control" id="grade_pay" name="grade_pay" value="<?php echo $res[0]; ?>" placeholder="Grade Pay Amount">
			</div>
		  </div-->
			<div class="col-sm-2">
			  <input type="button" class="btn btn-primary btn-md" onclick="salary_create()" value="Create">
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
function salary_create()
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
				//scale_master();
			}
			else
			{
				alert("Not Created Scale Master");
				//scale_master();
			}	
		}       
	});
}
</script>