<?php
require '../../../../connect.php';
include("../../../../user.php");
$candidateid=$_SESSION['candidateid'];
$userrole=$_SESSION['userrole'];

?>
<div  class="card card-primary">
              <div class="card-header">
                <h3 class="card-title"><font size="5">Project To Do List</font></h3>
			
              </div>
			
         

              <div class="card-body">
       <table class="dataTables-example table table-striped table-bordered table-hover"  id="example1">
		 
   
    <thead>
	<th>ID</th>
       <th>Project Name</th>
	  	  <th>Modules</th>
<th>Working Hours</th>
<th>Date</th>
<th>Scheduled Hours</th>
<th>Status</th>
<th>Action</th>
      <!--th>Tools</th-->
      </thead>
      <tbody>
      <?php
	   if($userrole=='R016' ){
 $emp_sql=$con->query("SELECT project_schedule.status as prostatus,project_schedule.id as project_scheduleid,project_schedule.*,project_management.*,project_modules.* FROM `project_schedule` 
 INNER JOIN project_management ON project_schedule.client_id=project_management.Client
 INNER JOIN project_modules ON project_schedule.modules=project_modules.id 
 
	   
");	  
	   } else { 
	   $emp_sql=$con->query("SELECT project_schedule.status as prostatus,project_schedule.id as project_scheduleid,project_schedule.*,project_management.*,project_modules.*,staff_master.* FROM `project_schedule`  
 INNER JOIN project_management ON project_schedule.client_id=project_management.Client
 INNER JOIN project_modules ON project_schedule.modules=project_modules.id 
 INNER JOIN staff_master ON project_modules.Employee=staff_master.id WHERE staff_master.candid_id='$candidateid'
	   
");	 
	   }
      $i=1;
      while($emp_res = $emp_sql->fetch(PDO::FETCH_ASSOC))
      {
       ?>
      <tr>
      <td><?php echo $i; ?></td>

      <td><?php echo $emp_res['Project_Name']; ?></td>

	  <td><?php echo $emp_res['modules']; ?></td>
	  	  <td><?php echo $emp_res['no_of_working_hours']; ?></td>

	  <td><?php echo $emp_res['date']; ?></td>
	  <td><?php echo $emp_res['schedule_hours']; ?></td>
	  <td><?php if($emp_res['prostatus']==1)
		{

echo '<span style="color:red;text-align:center;"><b>Working In Progress</b></span>';
}
if($emp_res['prostatus']==2)
{

echo '<span style="color:Green;text-align:center;"><b>Completed</b></span>';
}

		?></td>
<td>
<?php if($emp_res['prostatus']==1)
{
	?>
		  <button class="btn btn-info" data-id="<?php echo $emp_res['project_scheduleid']; ?>" onclick="project_view(<?php echo $emp_res['project_scheduleid']; ?>)"><i class="fa fa-eye"></i></button>
<?php }
?>
	  </td>
      
      </tr>
      <?php
	  $i++;
      }
      ?>
      </tbody>
      </table>
	
        </div>

<script>
            $(document).ready(function() {
                $('.dataTables-example').DataTable({
                        responsive: true
                });
            });
        </script>
<script>
		
 
  function project_view(v){
	  //alert(v);
	$.ajax({
	type:"POST",
	 url:"/HRMS/HRMS/Recruitment/project_management/project_to_do_list/project_to_do_list_view.php?id="+v,
	success:function(data)
	{
		$("#main_content").html(data);
	}
	})
}
   
</script>
project.php