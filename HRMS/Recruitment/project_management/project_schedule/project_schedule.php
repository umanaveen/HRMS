

<?php
require '../../../../connect.php';
require '../../../../user.php';
$userrole=$_SESSION['userrole'];
?>

<div  class="card card-primary">
              <div class="card-header">
                <h3 class="card-title"><font size="5">Project Schedule List</font></h3>
			
			<a onclick="return add_project_schedule()"  style="float: right;" data-toggle="modal" class="btn btn-dark"><i class="fa fa-plus"></i>  New project Schedule</a>
              </div>
  
              <div class="card-body">
			  
       <table class="dataTables-example table table-striped table-bordered table-hover"  id="example1">
    
      <thead>
	   <th>ID</th>
	  <th>Client</th>
	 <th>Project Name</th>
	  <th>Modules</th>
	  
	    <th>Employee</th>
	  
	        
<th>Action</th>
      </thead>
      <tbody>
       <?php
 
	 $emp_sql=$con->query("SELECT project_schedule.id as projectscheduleid,project_modules.modules as modulename,client_master.*,project_management.*,
project_modules.*,staff_master.*,project_schedule.*	 FROM `project_schedule`
	 INNER JOIN client_master ON project_schedule.client_id=client_master.id 
	 INNER JOIN project_management ON project_schedule.project_id=project_management.project_id 
	 INNER JOIN project_modules ON project_schedule.modules=project_modules.id 
	 INNER JOIN staff_master ON project_schedule.employees=staff_master.id
");
	 
      $i=1;
      while($emp_res = $emp_sql->fetch(PDO::FETCH_ASSOC))
      {
       ?>
      <tr>
      <td><?php echo $i; ?></td>
	        <td><?php echo $emp_res['org_name']; ?></td>
 <td><?php echo $emp_res['Project_Name']; ?></td>
 <td><?php echo $emp_res['modulename']; ?></td>
     
 <td><?php echo $emp_res['emp_name']; ?></td>
     
<td>
<button class="btn btn-info" data-id="<?php echo $emp_res['project_id']; ?>" onclick="project_view(<?php echo $emp_res['project_id']; ?>)"><i class="fa fa-eye"></i></button>
	
	  </td>
      
      </tr>
      <?php
	  $i++;
      }
      ?>
      </tbody>
       </table>
				
              </div>
              <!-- /.card-body -->
            </div>
<script>
	$(document).ready(function() {
		$('.dataTables-example').DataTable({
				responsive: true
		});
	});
</script>
<script>
	function add_project_schedule()
    {
	//	alert();
    $.ajax({

    type:"POST",
    url:"/HRMS/HRMS/Recruitment/project_management/project_schedule/new_project_schedule.php",
    success:function(data){
   $("#main_content").html(data);
    }
    })
  }
function project_view(v){
	  //alert(v);
	$.ajax({
	type:"POST",
	url:"/HRMS/HRMS/Recruitment/project_management/project_schedule/project_schedule_view.php?id="+v,
	success:function(data)
	{
		$("#main_content").html(data);
	}
	})
}


    </script>
