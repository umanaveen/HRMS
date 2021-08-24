	<?php
		require '../../../connect.php';
	?>
	<div class="wrapper">
	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
	<!-- Main content -->
	<section class="content">
	<!-- Default box -->
	<div class="card">
	<div class="card-header">
	<h5 class="card-title">Payslip</h5>
	</div>
	<div class="card-body">
	<div class="card card-danger">
	<div class="card-body">
	<form method="GET">
	<div class="row">
	<div class="col-2">
	<div class="form-group">
	<select class="form-control" name="payroll_id">
	<option value="0">-- Select Month --</option>
	<?php
	$staff_payroll_sql=$con->query("select id,month,year,flag from payroll_master");
	while($staff_payroll_res=$staff_payroll_sql->fetch(PDO::FETCH_ASSOC))
	{
		?>
		<option value="<?php echo $staff_payroll_res['id']; ?>"><?php echo $staff_payroll_res['month'].'-'.$staff_payroll_res['year']; ?></option>
		<?php
	} 
	?>
	</select>
	</div>
	</div>
	<div class="col-2">
	<div class="form-group">
	<select class="form-control" name="department">
	<option value="0">-- Select Department --</option>
	<?php
	$dep_sql=$con->query("SELECT id, dept_name, status, created_by, created_on FROM z_department_master");
	while($dep_sql_res=$dep_sql->fetch(PDO::FETCH_ASSOC))
	{
		?>
		<option value="<?php echo $dep_sql_res['id']; ?>"><?php echo $dep_sql_res['dept_name']; ?></option>
		<?php
	}
	?>
	</select>
	</div>
	</div>
	<div class="col-2">
	<div class="form-group">
	<select class="form-control" name="division">
	<option value="0">-- Select Division --</option>
	<?php
	$div_sql=$con->query("SELECT id, dep_id, div_name, status, created_by, created_on, modified_by, modified_on FROM division_master");
	while($div_sql_res=$div_sql->fetch(PDO::FETCH_ASSOC))
	{
	?>
	<option value="<?php echo $div_sql_res['id']; ?>"><?php echo $div_sql_res['div_name']; ?></option>
	<?php
	}
	?>
	</select>
	</div>
	</div>
	<div class="col-2">
		<div class="form-group">
		<select class="form-control" name="employee">
		<option value="0">-- Select Employee --</option>		
		<?php
		$staff_sql=$con->query("SELECT id, candid_id, emp_code, emp_name, dep_id, div_id, design_id, scale_head, deductions, status, created_by, created_on, modified_by, modified_on FROM staff_master");
		while($staff_sql_res=$staff_sql->fetch(PDO::FETCH_ASSOC))
		{
			?>
			<option value="<?php echo $staff_sql_res['id']; ?>"><?php echo $staff_sql_res['emp_code'].'-'.$staff_sql_res['emp_name']; ?></option>
			<?php
		}
		?>
		</select>
		</div>
	</div>
	<div class="col-4">
	<input type="button" class="btn btn-primary" value="Search" onclick="payslip_view()">
	</div>
	</div>
	
	</form>
	</div>
	<!-- /.card-body -->
	</div>
	<!-- /.card -->
	<div id="salary_view"  style="font-family:'Times New Roman', Times, serif;float:left;width:100%;height:100%">
	</div>
	</div>	
	<!-- /.card-body -->
	<div class="card-footer">
	</div>
	<!-- /.card-footer-->
	</div>
	<!-- /.card -->

	</section>
	<!-- /.content -->
	</div>
	<!-- /.content-wrapper -->
	</div>
	<!-- ./wrapper -->
	
	
<script type="text/javascript" src="/UCO/plugins/jQuery/jQuery-2.1.4.min.js"></script>
<script type="text/javascript" src="/UCO/js/bootstrap-datetimepicker.min.js"></script>
<script>

$(document).ready(function(){
	$("#Gen_staff_salary").click(function(){
		$("#Gen_staff_salary").hide();
		$('#loading').show();
	});
});

$(document).ready(function() 
{						
	$('#datepicker').datetimepicker({
	format: "dd-MM-yyyy"
});
});

function payslip_view()
{
	var data = $('form').serialize();
		$.ajax({
		type: "GET",
		url: "Recruitment/payroll/payslip/payslip_view.php",
		data:  "id="+ 1,  data,
		success: function(data)
		{
			$("#salary_view").html(data);		
		}				
	});	
}
</script>