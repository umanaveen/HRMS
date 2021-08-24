<?php
require '../../../connect.php';
?>

<section class="content">

<!-- Default box -->
<div class="card">
<div class="card-body">
<input class="btn btn-primary" type="button" value="Employee Deduction" onclick="emp_deduction_view()"> 
<input class="btn btn-danger" type="button" value="Employer Deduction" onclick="employer_deduction_view()">
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
function emp_deduction_view()
{
	$.ajax({
    type:"GET",
    url:'/HRMS/HRMS/payroll/deduction/emp_deduction.php',
    success:function(data){
      $("#payroll_view").html(data);
    }
  })
}
function employer_deduction_view()
{
	$.ajax({
    type:"GET",
    url:'/HRMS/HRMS/payroll/deduction/employer_deduction.php',
    success:function(data){
      $("#payroll_view").html(data);
    }
  })
}
</script>
