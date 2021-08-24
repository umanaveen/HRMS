<?php
require '../../connect.php';
?>

<div class="content-wrapper" id="main_content">
<div class="container-fluid">
  <div class="card mb-3">
    <div class="card-header">
      <i class="fa fa-table"></i> Employee Leave Master
	  <input type="button" style="float:right;" class="btn btn-warning" name="back" value="BACK" onclick="emp_Leave_master()">
	  </div>
    <div class="card-body">
	 <form method="POST">
		  <div class="form-group row">
			<label for="Leave" class="col-sm-2 col-form-label">Workers Type</label>
			<div class="col-sm-10">
			  <input type="text"  class="form-control" id="workers" name="workers" placeholder="Workers Name">
			</div>
		  </div>
		  <div class="form-group row">
			<label for="days" class="col-sm-2 col-form-label">Leave Type</label>
			<div class="col-sm-4">
			  <select class="form-control" id="leave_type" name="leave_type" placeholder="Leave Type">
			  <option value=""> CHOOSE Leave Type </option>
			 <?php $stmt = $con->query("SELECT * FROM master_leave where status=1");
					while ($row = $stmt->fetch()) {?>
					 <option value="<?php echo $row['id']; ?>"> <?php echo $row['leave_name']; ?> </option>
				<?php } ?>
				</select>
			</div>
		  </div>
		  <div class="form-group row">
			<div class="col-sm-10"></div>
			<div class="col-sm-2">
			  <input type="button" class="btn btn-primary btn-md" onclick="emp_Leave_create()" value="Create">
			</div>
		  </div>
	</form>
    </div>
  </div>
</div>
</div>
<script>
function emp_Leave_master()
{
  $.ajax({
    type:"POST",
    url:"/HRMS/HRMS/employees_leave/main.php",
    success:function(data){
      $("#main_content").html(data);
    }
  })
}
function emp_Leave_create()
{
	var field=1;
	var data = $('form').serialize();
	$.ajax({
		type:'GET',
		data:"field="+field, data,
		url:'/HRMS/HRMS/employees_leave/emp_Leave_new_submit.php',
		success:function(data)
		{
			if(data==0)
			{
				alert("Created Leave Master");
				emp_Leave_master();
			}
			else
			{
				alert("Not Created Leave Master");
				emp_Leave_master();
			}	
		}       
	});
}
</script>
