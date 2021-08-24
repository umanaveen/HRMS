	<?php
	require '../../connect.php';
	?>
	<div  class="card card-primary">
              <div class="card-header">
                <h3 class="card-title"><font size="5">Holiday Master</font></h3>
			<a onclick="return add_employee()"  style="float: right;" data-toggle="modal" class="btn btn-dark"><i class="fa fa-plus"></i>  Add Holidays</a>
			
              </div>
              <!-- /.card-header -->
              <div class="card-body">
	<table class="dataTables-example table table-striped table-bordered table-hover" id="example1">
	<thead>
	<th>S.No</th>
	<th>Holiday Name</th>
	<th>Date</th>
	<th>Year </th>
	<th>Status</th>
	<th>Action</th>
	</thead>
	<tbody>
	<?php
	$holiday=$con->query("SELECT * FROM `holiday_master`");
	$cnt=1;
	while($holiday_master = $holiday->fetch(PDO::FETCH_ASSOC))
	{
     
	 ?>
	<tr>
	<td><?php echo $cnt;?>.</td>
	<td><?php echo $holiday_master['leave_name']; ?></td>
	<td><?php echo $holiday_master['leave_date']; ?></td>
	<td><?php echo $holiday_master['year']; ?></td>

	<td>
	<?php 
	if($holiday_master['status'] ==1)
	{	  
		echo '<span style="color:green;text-align:center;"><b>Active</b></span>';
	?>
	<?php 
	}
	else 
	{
		echo '<span style="color:red;text-align:center;"><b>INActive</b></span>';	  
	}
	?>


	</td>
	<td>
	<button class="btn btn-success btn-sm edit btn-flat" data-id="<?php echo $holiday_master['id']; ?>" onclick="holiday_edit(<?php echo $holiday_master['id']; ?>)"><i class="fa fa-edit"></i> Edit</button>
	</td>
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

<!-- /#page-wrapper -->
<script>
$(document).ready(function()
{
	$('.dataTables-example').DataTable({
	responsive: true
	});
});
</script>
<script>
	function add_employee()
    {
		$.ajax({
		type:"POST",
		url:"HRMS/payroll/payoll_add.php",
		success:function(data){
		 $("#main_content").html(data);
		}
		})
	}
  function holiday_edit(v){
		$.ajax({
		type:"POST",
		url:"HRMS/payroll/payroll_edit.php?id="+v,
		success:function(data)
		{
			 $("#main_content").html(data);
		}
		})
	}
</script>