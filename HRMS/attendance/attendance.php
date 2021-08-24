	<?php
	require '../../connect.php';
	date_default_timezone_set("Asia/Kolkata");
	$curdate=date("d-m-y");
	?>
	
	<style>
	#navbarNav ul li
	{
		padding-left:30px;
	}		
	</style>
	<div class="container-fluid">
	<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<!-- Page Content -->	 
				<div class="panel-body">
				<!-- Nav tabs -->  
				<nav class="navbar navbar-expand-lg navbar-light bg-light">
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarNav">
				<ul class="navbar-nav">
				<li class="nav-item" onclick="attendance_upload()">Attendance Upload</li>
				<li class="nav-item" onclick="attendance_daily_report()">Daily Report</li>
				<li class="nav-item"  onclick="attendance_report()">Attendance Report</li>
				<li class="nav-item" onclick="in_out_report()">In-Out Report</li>
				</ul>
				</div>
				</nav>
				</div>
				<!-- /.panel-body -->
			</div>
	
	<!-- /.panel -->
	<!-- Tab panes -->
	</div>
	<!-- /.row -->
	
	</div>
	<!-- /.container-fluid -->
	</div>
	<div id="attendance_view">
	</div>
	
	
	<script>
		
	function attendance_upload()
	{
		$.ajax({
		type:'GET',
		url:'/HRMS/HRMS/attendance/attendance_report_view.php',
		data:"id="+1,
		success:function(data)
		{
			$("#attendance_view").html(data);
		}
		})
	}
	
	function attendance_daily_report()
	{
		$.ajax({
		type:'GET',
		url:'/HRMS/HRMS/attendance/attendance_daily_report.php',
		data:"id="+1,
		success:function(data)
		{
			$("#attendance_view").html(data);
		}
		})
	}
	
	function attendance_report()
	{
		$.ajax({
		type:'GET',
		url:'/HRMS/HRMS/attendance/attendance_attendance_report.php',
		data:"id="+1,
		success:function(data)
		{
			$("#attendance_view").html(data);
		}
		})
	}
	
	function in_out_report()
	{
		$.ajax({
		type:'GET',
		url:'/HRMS/HRMS/attendance/attendance_In_out_report_page.php',
		data:"id="+1,
		success:function(data)
		{
			$("#attendance_view").html(data);
		}
		})
	}
	
	
	
	</script>
	

