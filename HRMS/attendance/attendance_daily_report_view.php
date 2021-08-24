	<?php
	require '../../connect.php';
	date_default_timezone_set("Asia/Kolkata");
	$curdate=date("d-m-y");

	$department_id = $_REQUEST['department_id'];
	$from_date = $_REQUEST['from_date'];
	
	?>
	<div class="col-12">
	<!-- Default box -->
	<div class="card">
	<div class="card-header">
	<h3 class="card-title">Attendance Daily Report</h3>
	</div>
	<div class="card-body">

	<table class="dataTables-example table table-striped table-bordered table-hover" id="example1">
	<thead>
	<th>S.No</th>
	<th>Employee Code</th>
	<th>Employee Name</th>
	<th>Date</th>
	<th>LogTime </th>
	<th>Direction</th>
	<th>LogTime </th>
	<th>Direction</th>
	</thead>
	<tbody>
	<?php
	
	
	$holiday=$con->query("SELECT a.EmployeeCode,c.emp_name,c.candid_id,c.prefix_code,c.dep_id,c.div_id,c.design_id,a.Date,a.LogTime as Intime,a.Direction as Indirection,b.LogTime as outtime,b.Direction as outdirection from (SELECT EmployeeCode, Date,min(LogTime) as LogTime, Direction, status FROM employee_attendance where date ='$from_date' and Direction = 'in' and EmployeeCode in (SELECT emp_code FROM staff_master where dep_id = '$department_id'))a left JOIN (SELECT EmployeeCode, Date, max(LogTime) as LogTime, Direction, status FROM employee_attendance where date ='$from_date' and Direction = 'out' and EmployeeCode in (SELECT emp_code FROM staff_master where dep_id = '$department_id'))b on a.EmployeeCode=b.EmployeeCode and a.Date=b.Date left join staff_master c on a.EmployeeCode=c.emp_code  order by c.prefix_code,a.EmployeeCode");	

	
	$cnt=1;
	while($holiday_master = $holiday->fetch(PDO::FETCH_ASSOC))
	{

	?>
	<tr>
	<td><?php echo $cnt;?>.</td>
	<td><?php echo $holiday_master['EmployeeCode']; ?></td>
	<td><?php echo $holiday_master['emp_name']; ?></td>
	<td><?php echo $holiday_master['Date']; ?></td>
	<td><?php echo $holiday_master['Intime']; ?></td>
	<td><?php echo $holiday_master['Indirection']; ?></td>
	<td><?php echo $holiday_master['outtime']; ?></td>
	<td><?php echo $holiday_master['outdirection']; ?></td>
	</tr>
	<?php
	$cnt=$cnt+1;
	}
	?>
	</tbody>
	</table>

	</div>
	<!-- /.card-body -->
	</div>
	<!-- /.card -->
	</div>