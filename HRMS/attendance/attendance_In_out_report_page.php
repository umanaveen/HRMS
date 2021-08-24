	<?php
	require '../../connect.php';
	date_default_timezone_set("Asia/Kolkata");
	$curdate=date("d-m-y");
	?>
	<div class="col-12">
	<!-- Default box -->
	<div class="card">

			<form method="post">
			<table class="table table-hover" style="font-family:'Times New Roman', Times, serif">
			<tbody>
			<tr>
			
			<td>
				<input type="date" class="add-on form-control" id="from_date" name="from_date" placeholder="From Date" required>
			</td>
			<td>
				<input type="date" class="add-on form-control" id="to_date" name="to_date" placeholder="To Date">
			</td>
			<td>
			or choose month
			</td>
			<td> <input type="month" id="month_value" name="month_value" min="2018-03" value="2018-05"></td>
			<td>
			<select name="department_id" id="department_id" class="form-control" required>
			<option value="All">All</option>
			<?php 
			$department_master_sql = $con->query("SELECT id, dept_name, status, created_by, created_on FROM z_department_master");
			while($department_master_res = $department_master_sql->fetch(PDO::FETCH_ASSOC))
			{
			?>
			<option value="<?php echo $department_master_res['id']; ?>"><?php echo $department_master_res['dept_name']; ?></option>
			<?php
			}
			?>
			</select>
			<td>
				<input type="button" name="daily_report_view" id="daily_report_view" class="btn btn-success" value="SEARCH" onClick="in_out_report()"></td>
			</tr>
			</tbody>
			</table>
			</form>
	</div>
	<!-- /.card -->
	</div>

	<div class="col-12" id="attendance_in_out_report_view">	
	</div>
<script>
	
function in_out_report()
{
	var from_date = document.getElementById("from_date").value;
	var to_date = document.getElementById("to_date").value;
	var month_value = document.getElementById("month_value").value;	
	var department_id = document.getElementById("department_id").value;
	
	
	 $.ajax({
	type:'GET',
	url:'/HRMS/HRMS/attendance/monthly_in_out_report_view.php',
	data:"from_date="+from_date+"&to_date="+to_date+"&month_value="+month_value+"&department_id="+department_id,
	success:function(data)
	{
		$("#attendance_in_out_report_view").html(data);
	}
	}) 
}

</script>

	