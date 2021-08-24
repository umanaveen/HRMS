<?php
require '../../connect.php';
$ids=$_REQUEST['ids'];
 $edit_id=$con->query("select * from leave_category where id='$ids'");
$res = $edit_id->fetch();
$leaves_id=$res['leave_ids'];
?>

<div class="content-wrapper" id="main_content">
<div class="container-fluid">
  <div class="card mb-3">
    <div class="card-header">
      <i class="fa fa-table"></i> Leave Master
	  <input type="button" style="float:right;" class="btn btn-warning" name="back" value="BACK" onclick="emp_Leave_master()">
	  </div>
    <div class="card-body">
	 <form method="POST">
		  <div class="form-group row">
			<label for="workers" class="col-sm-2 col-form-label">workers Type</label>
			<div class="col-sm-10">
			  <input type="hidden"  class="form-control" id="ids" name="ids" value="<?php echo $ids; ?>">
			  <input type="text"  class="form-control" id="workers" name="workers" value="<?php echo $res['type']; ?>" placeholder="workers workers">
			</div>
		  </div>
		  <div class="form-group row">
			<label for="no_of_days" class="col-sm-2 col-form-label">Leave Type</label>
			<div class="col-sm-4">
			  <select class="form-control" id="leave_type" name="leave_type" placeholder="Leave Type">
			  <?php $stmt = $con->query("SELECT * FROM master_leave where status=1 and id='$leaves_id'");
					while ($row = $stmt->fetch()) {?>
					 <option value="<?php echo $row['id']; ?>"> <?php echo $row['leave_name']; ?> </option>
				<?php } ?>
				<?php $stmt1 = $con->query("SELECT * FROM master_leave where status=1 and id!='$leaves_id'");
					while ($row1 = $stmt1->fetch()) {?>
					 <option value="<?php echo $row1['id']; ?>"> <?php echo $row1['leave_name']; ?> </option>
				<?php } ?>
				
				</select>
			</div>
		  </div>
		  <div class="form-group row">
			<div class="col-sm-10"></div>
			<div class="col-sm-2">
			  <input type="button" class="btn btn-primary btn-md" onclick="emp_Leave_update()" value="Update">
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
function emp_Leave_update()
{
	var field=1;
	var data = $('form').serialize();
	$.ajax({
		type:'GET',
		data:"field="+field, data,
		url:'/HRMS/HRMS/employees_leave/emp_Leave_update.php',
		success:function(data)
		{
			if(data==0)
			{
				alert("Updated Leave Master");
				emp_Leave_master();
			}
			else
			{
				alert("Not Updated Leave Master");
				emp_Leave_master();
			}	
		}       
	});
}
</script>
