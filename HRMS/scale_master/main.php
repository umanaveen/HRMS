<?php
require '../../connect.php';
?>

<section class="content">

<!-- Default box -->
<div class="card">
<div class="card-body">
<input class="btn btn-primary" type="button" value="Salary Structure" onclick="salary_structure_view()"> 
<input class="btn btn-danger" type="button" value="Scale Head" onclick="scale_head()">
</div>
<!-- /.card-body -->
</div>
<!-- /.card -->

	<div class="card">
	<div class="card-body">
	<div id="payroll_view">
	</div>
	</div>
	<!-- /.card-body -->
	</div>
	<!-- /.card -->
</section>



<script>
function salary_structure_view()
{
	$.ajax({
    type:"GET",
    url:'/HRMS/HRMS/payroll/salary_structure/salary_structure.php',
    success:function(data){
      $("#payroll_view").html(data);
    }
  })
}
function scale_head()
{
	$.ajax({
    type:"GET",
    url:'/HRMS/HRMS/payroll/salary_scale_head/scale_head_main.php',
    success:function(data){
      $("#payroll_view").html(data);
    }
  })
}
</script>
