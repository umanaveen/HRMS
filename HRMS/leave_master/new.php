<?php
require '../../connect.php';
?>

<div  class="card card-primary">
              <div class="card-header">
                <h3 class="card-title"><font size="5">New Leave</font></h3>
				
			<input type="button" style="float:right;" class="btn btn-danger" name="back" value="BACK" onclick="Leave_master()">
              </div>
             <br>
			 <br>
	 <form method="POST">
	  <tr>
        <td><center><img src="/HRMS/HRMS/Recruitment/image/userlog/bluebase.png"  style="width:300px;height:150px;"></center></td>
      
        </tr>
		  <div class="form-group row">
			<label for="Leave" class="col-sm-2 col-form-label">Leave Name</label>
			<div class="col-sm-10">
			  <input type="text"  class="form-control" id="Leave" name="Leave" placeholder="Leave Name">
			</div>
		  </div>
		  <div class="form-group row">
			<label for="days" class="col-sm-2 col-form-label">No of Days</label>
			<div class="col-sm-10">
			  <input type="number" class="form-control" id="no_of_days" name="no_of_days" placeholder="No of Days..">
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
		  <div class="form-group row">
			<div class="col-sm-10"></div>
			<div class="col-sm-2">
			  <input type="button" class="btn btn-primary btn-md" onclick="Leave_create()" value="Create">
			</div>
		  </div>
	</form>
 </div>
  
<script>
function Leave_master()
{
  $.ajax({
    type:"POST",
    url:"/HRMS/HRMS/Leave_master/main.php",
    success:function(data){
      $("#main_content").html(data);
    }
  })
}
function Leave_create()
{
	var field=1;
	var data = $('form').serialize();
	$.ajax({
		type:'GET',
		data:"field="+field, data,
		url:'/HRMS/HRMS/Leave_master/Leave_new_submit.php',
		success:function(data)
		{
			if(data==0)
			{
				alert("Created Leave Master");
				Leave_master();
			}
			else
			{
				alert("Not Created Leave Master");
				Leave_master();
			}	
		}       
	});
}
</script>
