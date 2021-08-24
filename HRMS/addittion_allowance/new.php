<?php
require '../../connect.php';
?>

<div class="content-wrapper" id="main_content">
<div class="container-fluid">
  <div class="card mb-3">
    <div class="card-header">
      <i class="fa fa-table"></i> Allowance Master
	  <input type="button" style="float:right;" class="btn btn-warning" name="back" value="BACK" onclick="allowance_master()">
	  </div>
    <div class="card-body">
	 <form method="POST">
		  <div class="form-group row">
			<label for="allowancename" class="col-sm-2 col-form-label">Allowance Name</label>
			<div class="col-sm-10">
			  <input type="text"  class="form-control" id="allowance_name" name="allowance_name" placeholder="Allowance Name" autocomplete="off">
			</div>
		  </div>
		 <div class="form-group row">
			<label for="oname" class="col-sm-2 col-form-label">Short Name</label>
			<div class="col-sm-10">
			  <input type="text"  class="form-control" id="other_name" name="other_name" placeholder="Other Name" autocomplete="off">
			</div>
		  </div>
		  <div class="form-group row">
			<div class="col-sm-10"></div>
			<div class="col-sm-2">
			  <input type="button" class="btn btn-primary btn-md" onclick="allowance_create()" value="Create">
			</div>
		  </div>
	 </form>
   </div>
  </div>
</div>
</div>
<script>
function allowance_master()
{
  $.ajax({
    type:"POST",
    url:"/HRMS/HRMS/addittion_allowance/main.php",
    success:function(data){
      $("#main_content").html(data);
    }
  })
}
function allowance_create()
{
	var field=1;
	var data = $('form').serialize();
	$.ajax({
		type:'GET',
		data:"field="+field, data,
		url:'/HRMS/HRMS/addittion_allowance/allowance_new_submit.php',
		success:function(data)
		{
			if(data==0)
			{
				alert("Created Additional Allowance");
				allowance_master();
			}
			else
			{
				alert("Not Created Additional Allowance");
				allowance_master();
			}
		}       
	});
}
</script>
