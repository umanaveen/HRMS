	<?php
	require '../../connect.php';
	date_default_timezone_set("Asia/Kolkata");
	$curdate=date("d-m-y");
	?>
	<div class="container-fluid">
	<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
		<div class="panel-heading">
		<h3>Attendance Report</h3>
		</div>
		<!-- /.panel-heading -->
		<!-- Page Content -->
	 
		<div class="panel-body">
		<!-- Nav tabs -->  
		<ul class="nav nav-tabs">
		<li class="active"><a data-toggle="tab" href="#home">Attendance Upload</a>
		</li>
		<li><a data-toggle="tab" href="#menu1">Daily Report</a>
		</li>
		<li><a data-toggle="tab" href="#menu2">Attendance Report</a>
		</li>
		<li><a data-toggle="tab" href="#menu3">In-Out Report</a>
		</li>
		<li><a data-toggle="tab" href="#menu4">Summary Report</a>
		</li>
		</ul>
		</div>
		<!-- /.panel-body -->
		</div>
	
	<!-- /.panel -->
	<!-- Tab panes -->
		<div class="tab-content">
			<div id="home" class="tab-pane fade in active">		
			<div class='row'>
			<div class='col-lg-12'>
			<div class='panel panel-default'>
			<div class='panel-body'>
			<div class='row'>
			  <form enctype="multipart/form-data" method="post" action="/HRMS/HRMS/attendance/attendance_upload.php" role="form">
			  <div class='control-group'>
			  <div class='col-md-12'>
			  <a href='/HRMS/HRMS/attendance/attendance_Format.csv'>Download Template</a>
			  </p>
			  </div>
			  <br>
			  <div class='form-group'>
			  <label for='exampleInputFile'>File Upload</label>
			  <input type='file' name='file' id='file' size='150'>
			  <p class='help-block'>Only Excel/CSV File Import.</p>
			  </div>
			  <button type="submit" class="btn btn-default" name="submit" value="submit">Upload</button>
			  </div>
			  </form>
			</div>
			</div>
			</div>
			</div>
			</div>
			</div>			
			<div id="menu1" class="tab-pane fade">
			<div class='row'>
			<div class='col-lg-12'>
			<div class='panel panel-default'>
			<div class='panel-body'>
			<div class='row'>
			<form method='GET' name='attendance_report' role='form' >
			<div class='col-lg-12'>
			<div class='col-lg-2'>
			<input type='date' id='datepicker' class='add-on form-control' id='from_date' name='from_date1' placeholder='From Date'></div>
			<div class='col-lg-2'>
			<input type='date' id='datepicker1' class='add-on form-control' id='to_date' name='to_date1' placeholder='To Date'>
			</div>
			<div class='col-lg-1'>OR</div>
			<div class='col-lg-3'>
			<input type='month' class='add-on form-control'  id='month' name='month1'/>
			</div>
			<div class='col-lg-3'>
			<select id='department_id' name='department_id'  class='add-on form-control' required>
			<option value='0'>All</option>
			<?php
			$department=$con->query("SELECT id,dept_name FROM z_department_master");
			$cnt=1;
			while($department_master = $department->fetch(PDO::FETCH_ASSOC))
			{
				?>
				<option value='<?php echo $department_master['id']; ?>'><?php echo $department_master['dept_name']; ?></option>
				<?php
			}
			?>
			</select>
			</div>
			<div class='col-lg-1'>
			<input type='button' name='attendance_report' id='attendance_report' class='btn btn-success' value='SEARCH' onClick='Daily_Report_view()'>
			</div>
			</div>
			</form>
			</div>
			</div>
			</div>
			</div>
			</div>
			</div>			
		  </div>
	</div>
	<!-- /.row -->
	
	<div id="attendance_reports_view">
	</div>
	</div>
	<!-- /.container-fluid -->
	</div>
	

	<script>
		
	function Daily_Report_view()
	{
		var data = $('form').serialize();	
		$.ajax({
		type:'GET',
		url:'/HRMS/HRMS/attendance/attendance_report_view.php',
		data:"id="+1,data,
		success:function(data)
		{
			$("#attendance_reports_view").html(data);
		}
		})
	}
	
	function Attendance_Report_view()
	{
		var data = $('form').serialize();	
		$.ajax({
		type:'GET',
		url:'/HRMS/HRMS/attendance/attendance_report_view.php',
		data:"id="+1,data,
		success:function(data)
		{
			$("#attendance_reports_view").html(data);
		}
		})
	}
	
	function In_Out_Report_view()
	{
		var data = $('form').serialize();	
		$.ajax({
		type:'GET',
		url:'/HRMS/HRMS/attendance/attendance_report_view.php',
		data:"id="+1,data,
		success:function(data)
		{
			$("#attendance_reports_view").html(data);
		}
		})
	}
	
	function Summary_Report_view()
	{
		var data = $('form').serialize();	
		$.ajax({
		type:'GET',
		url:'/HRMS/HRMS/attendance/attendance_report_view.php',
		data:"id="+1,data,
		success:function(data)
		{
			$("#attendance_reports_view").html(data);
		}
		})
	}
	</script>
	

