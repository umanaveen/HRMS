<?php
require '../../../connect.php';
?>
<div class="content-wrapper" id="main_content">
<div class="container-fluid">
  <div class="card mb-3">
    <div class="card-header">
      <i class="fa fa-table"></i>Scale Head
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
		url:'/Recruitment/Recruitment/scale_master/scale_new_create.php',
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