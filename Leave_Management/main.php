<?php
require '../connect.php';
?>

<section class="content">

<!-- Default box -->
<div class="card">
<div class="card-body">
<input class="btn btn-primary" type="button" value="Leave Master" onclick="leave_master_view()"> 
<input class="btn btn-success" type="button" value="Leave Mapping" onclick="leave_mapping_view()">
<input class="btn btn-danger" type="button" value="Leave Mapping with Staff" onclick="staff_leave_mapping_view()">
<input class="btn btn-danger" type="button" value="Leave Openings" onclick="staff_leave_opening_view()">
<input class="btn btn-success" type="button" value="Leave Balance" onclick="leave_balance_view()">
</div>
<!-- /.card-body -->
</div>
<!-- /.card -->

	<div class="card">
	<div class="card-body">
	<div id="leave_view">
	</div>
	</div>
	<!-- /.card-body -->
	</div>
	<!-- /.card -->
</section>


<script>
function leave_master_view()
{
	$.ajax({
    type:"GET",
    url:'Leave_Management/leave_master/leave_master_view.php',
    success:function(data){
      $("#leave_view").html(data);
    }
  })
}
function leave_mapping_view()
{
	$.ajax({
    type:"GET",
    url:'Leave_Management/leave_mapping/leave_mapping_view.php',
    success:function(data){
      $("#leave_view").html(data);
    }
  })
}
function staff_leave_mapping_view()
{
	$.ajax({
    type:"GET",
    url:'Leave_Management/leave_mapping_with_staff/leave_mapping_with_staff.php',
    success:function(data){
      $("#leave_view").html(data);
    }
  })
}

function staff_leave_opening_view()
{
	$.ajax({
    type:"GET",
    url:'Leave_Management/leave_opening/leave_opening_view.php',
    success:function(data){
      $("#leave_view").html(data);
    }
  })
}

function leave_balance_view()
{
	$.ajax({
    type:"GET",
    url:'Leave_Management/leave_balance/leave_balance_view.php',
    success:function(data){
      $("#leave_view").html(data);
    }
  })
}
</script>
