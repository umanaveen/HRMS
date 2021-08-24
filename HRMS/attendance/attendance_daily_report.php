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
		<tr id="row2">
		<td> Department :</td>
		<td>
		<div class="container1">
		<select name="department_id" id="department_id" class="form-control" required>
		<option value="All">All</option>
		<?php 
		$department_master_sql = $con->query("SELECT * FROM z_department_master");
		while($department_master_res = $department_master_sql->fetch(PDO::FETCH_ASSOC))
		{
		?>
		<option value="<?php echo $department_master_res['id']; ?>"><?php echo $department_master_res['dept_name']; ?></option>
		<?php
		}
		?>
		</select>
		</div>
		</td>
		<td >
		<input type="date" class="add-on form-control" id="from_date" name="from_date" placeholder="From Date" required>
		</td>
		<td><input type="button" name="daily_report_view" id="daily_report_view" class="btn btn-success" value="SEARCH" onClick="daily_report()"></td>
		</tr>
		</tbody>
		</table><!-- /.table -->
		</form>
	</div>
	<!-- /.card -->
	</div>

	<div class="col-12" id="attendance_daily_report_view">	
	</div>
<script>
	
function daily_report()
{
	var department_id = document.getElementById("department_id").value;
	var from_date = document.getElementById("from_date").value;
	
	$.ajax({
	type:'GET',
	url:'/HRMS/HRMS/attendance/attendance_daily_report_view.php?department_id='+department_id+'&from_date='+from_date,
	data:"id="+1,
	success:function(data)
	{
		$("#attendance_daily_report_view").html(data);
	}
	})
}

</script>

	