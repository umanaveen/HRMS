<?php
require '../../connect.php';
$ids=$_REQUEST['ids'];
 $edit_id=$con->query("select * from leave_category where id='$ids'");
$res = $edit_id->fetch();
$id_leave=$res['leave_ids'];
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
			<label for="Leave" class="col-sm-2 col-form-label">Leave Name</label>
			<div class="col-sm-10">
			  <input type="hidden"  class="form-control" id="ids" name="ids" value="<?php echo $ids; ?>" placeholder="Leave Name">
			  <input type="text"  class="form-control" id="Leave" name="Leave" value="<?php echo $res['type']; ?>" placeholder="Leave Name" readonly>
			</div>
		  </div>
		  <div class="form-group row">
			<label for="no_of_days" class="col-sm-2 col-form-label">No of days</label>
			<div class="col-sm-4">
			<?php   $stmt = $con->query("SELECT * FROM master_leave where status=1 and id='$id_leave'");
					$row = $stmt->fetch(); ?><input type="text"  class="form-control" id="leave_type" name="leave_type" value="<?php echo $row['leave_name']; ?>" placeholder="Leave Name" readonly>
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
</script>

