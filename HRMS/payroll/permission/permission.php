<?php
require ("../../../connect.php");
Session_start();

echo $_SESSION['userrole'];
echo $_SESSION['username'];

if($_SESSION['userrole'] == "")
{

}
?>

	<div  class="card card-primary">
              <div class="card-header">
                <h3 class="card-title"><font size="5">Permissions</font></h3>
			<a onclick="return add_permission()"  style="float: right;" data-toggle="modal" class="btn btn-dark"><i class="fa fa-plus"></i>  New Permission</a>			
              </div>
              <!-- /.card-header -->
              <div class="card-body">
				<table class="dataTables-example table table-striped table-bordered table-hover" id="example1">
					<thead>
					<th>S.No</th>
					<th>Type</th>
					<th>Emp Code</th>
					<th>Emp Name</th>
					<th>Date</th>
					<th>From Time</th>
					<th>To Time</th>
					<th>Status</th>
					<th>Action</th>
					</thead>
					<tbody>
					<?php
					$permission=$con->query("SELECT * FROM employee_permission_master");
					$cnt=1;
					while($permission_master = $permission->fetch(PDO::FETCH_ASSOC))
					{
					
					?>
					<tr>
					<td><?php echo $cnt;?>.</td>
					<td>
					<?php 
					if($permission_master['employee_type'] ==1)
					{	  
						echo '<span style="color:black;text-align:center;">Onroll Employee</span>';
					?>
					<?php 
					}
					else if($permission_master['employee_type'] ==2)
					{
						echo '<span style="color:black;text-align:center;">Apprentices</span>';	  
					}
					else if($permission_master['employee_type'] ==3)
					{
						echo '<span style="color:black;text-align:center;">Contract Labour</span>';
					}
					?>


					</td>
					
					<td><?php echo $permission_master['emp_code']; ?></td>
					<td><?php echo $permission_master['emp_code']; ?></td>
					<td><?php echo $permission_master['permission_date']; ?></td>
					<td><?php echo $permission_master['from_time']; ?></td>
					<td><?php echo $permission_master['to_time']; ?></td>
					

					<td>
					<?php 
					if($permission_master['approve_status'] ==1)
					{	  
						echo '<span style="color:blue;text-align:center;"><b>Pending</b></span>';
					?>
					<?php 
					}
					else if($permission_master['approve_status'] ==2)
					{
						echo '<span style="color:Green;text-align:center;"><b>Approved</b></span>';	  
					} else if($permission_master['approve_status'] ==3)
					{
						echo '<span style="color:red;text-align:center;"><b>Rejected</b></span>';	  
					}
					?>


					</td>
					<td>
					<button class="btn btn-success btn-sm edit btn-flat" data-id="<?php echo $permission_master['id']; ?>" onclick="permission_edit(<?php echo $permission_master['id']; ?>)">
					<i class="fa fa-edit"></i>
					 Edit
					</button>
									
		<button class="btn btn-info" data-id="<?php echo $permission_master['id']; ?>" onclick="permission_view(<?php echo $permission_master['id']; ?>)"><i class="fa fa-eye"></i></button>
				

	
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
	function add_permission()
    {
		$.ajax({
		type:"POST",
		url:"HRMS/payroll/permission/new.php",
		success:function(data){
		 $("#main_content").html(data);
		}
		})
	}
  function permission_edit(v){
		$.ajax({
		type:"POST",
		url:"HRMS/payroll/permission/edit.php?id="+v,
		success:function(data)
		{
			 $("#main_content").html(data);
		}
		})
	}
	
	 function permission_view(v){
		$.ajax({
		type:"POST",
		url:"HRMS/payroll/permission/view.php?id="+v,
		success:function(data)
		{
			 $("#main_content").html(data);
		}
		})
	}
</script>