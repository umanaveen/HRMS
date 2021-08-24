<?php
require '../../connect.php';
?>

<div class="content-wrapper" id="main_content">
<div class="container-fluid">
  <div class="card mb-3">
    <div class="card-header">
      <i class="fa fa-table"></i> Scale Details
	  <input type="button" style="float:right;" class="btn btn-warning" name="back" value="BACK" onclick="scale_master()">
	  </div>
    <div class="card-body">
	 <form method="POST">
		  <div class="form-group row">
			<label for="Scale" class="col-sm-2 col-form-label">Scale Name</label>
			<div class="col-sm-10">
			  <input type="text"  class="form-control" id="scale_name" name="scale_name" placeholder="Scale Name">
			</div>
		  </div>
		  <div class="form-group row">
			<label for="Date" class="col-sm-2 col-form-label">Date</label>
			<div class="col-sm-10">
			  <input type="date" class="form-control" id="from_date" name="from_date" placeholder="Date">
			</div>
		  </div>
		  <div class="form-group row">
			<label for="basicpay" class="col-sm-2 col-form-label">Basic Pay</label>
			<div class="col-sm-10">
			  <input type="number"  class="form-control" id="basic_pay" name="basic_pay" placeholder="Basic Pay Amount">
			</div>
		  </div>
		  <div class="form-group row">
			<label for="spl_pay" class="col-sm-2 col-form-label">Special Pay</label>
			<div class="col-sm-10">
			  <input type="number"  class="form-control" id="spl_pay" name="spl_pay" placeholder="Special Pay Amount">
			</div>
		  </div>
		  <div class="form-group row">
			<label for="grade_pay" class="col-sm-2 col-form-label">Grade Pay</label>
			<div class="col-sm-10">
			  <input type="number"  class="form-control" id="grade_pay" name="grade_pay" placeholder="Grade Pay Amount">
			</div>
		  </div>
		  <div class="form-group row">
			<label for="da" class="col-sm-2 col-form-label">Da</label>
			<div class="col-sm-10">
			  <input type="number"  class="form-control" id="da" name="da" placeholder="DA Amount">
			</div>
		  </div>
		  <div class="form-group row">
			<label for="hra" class="col-sm-2 col-form-label">Hra</label>
			<div class="col-sm-10">
			  <input type="number"  class="form-control" id="hra" name="hra" placeholder="Hra Amount">
			</div>
		  </div>
		  <div class="form-group row">
			<label for="cca" class="col-sm-2 col-form-label">Cca</label>
			<div class="col-sm-10">
			  <input type="number"  class="form-control" id="cca" name="cca" placeholder="Cca Amount">
			</div>
		  </div><div class="form-group row">
			<label for="bonus" class="col-sm-2 col-form-label">Bonus</label>
			<div class="col-sm-10">
			  <input type="number"  class="form-control" id="bonus" name="bonus" placeholder="Bonus Amount">
			</div>
		  </div>
		  <div class="form-group row">
			<label for="Add_Allowance" class="col-sm-2 col-form-label">Additional Allowance</label>
			<div class="col-sm-10">
			  <input type="number"  class="form-control" id="addition_allowance" name="addition_allowance" placeholder="Additional Allowance">
			</div>
		  </div>
		  <div class="form-group row">
			<label for="Others" class="col-sm-2 col-form-label">Others</label>
			<div class="col-sm-10">
			  <input type="number"  class="form-control" id="others" name="others" placeholder="Other Amount">
			</div>
		  </div>
		   <div class="form-group row">
			<label for="text" class="col-sm-2 col-form-label">Status</label>
			<div class="col-sm-10">
			<select id="status" name="status" class="form-control" >
 
<?php 
if($res[12] ==1)
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
    url:"/HRMS/HRMS/scale_master/main.php",
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
		url:'/HRMS/HRMS/scale_master/details_new_create.php',
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