

<?php
require '../../../../connect.php';
require '../../../../user.php';
$userrole=$_SESSION['userrole'];
?>

<div  class="card card-primary">
              <div class="card-header">
                <h3 class="card-title"><font size="5">Project Schedule List</font></h3>
		<a onclick="return add_project()"  style="float: right;" data-toggle="modal" class="btn btn-dark"><i class="fa fa-plus"></i>  New project </a>
			
              </div>
  
              <div class="card-body">
			  
       <table class="dataTables-example table table-striped table-bordered table-hover"  id="example1">
    
      <thead>
	  <tr>
	   <th>ID</th>
	  <th>Project_Name</th>
	  <th>Total_Man_Hours</th>
	   <th>Project_Deadline_Date</th>
	 
	        <th>Action</th>
</tr>
      </thead>
      <tbody>
      <?php
 
	 $emp_sql=$con->query("SELECT * FROM `project_management` 
	 INNER JOIN project_modules ON project_management.project_id=project_modules.projectmanagement_id GROUP BY projectmanagement_id
");
	 
      $i=1;
      while($emp_res = $emp_sql->fetch(PDO::FETCH_ASSOC))
      {
       ?>
      <tr>
      <td><?php echo $i; ?></td>
	        <td><?php echo $emp_res['Project_Name']; ?></td>
 <td><?php echo $emp_res['Total_Man_Hours']; ?></td>
 <td><?php echo $emp_res['Project_Deadline_Date']; ?></td>
     

      
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
    $.ajax({

    type:"POST",
    url:"/HRMS/HRMS/Recruitment/project_management/project/new_project_schedule.php",
    success:function(data){
   $("#main_content").html(data);
    }
    })
  }
function project_view(v){
	  //alert(v);
	$.ajax({
	type:"POST",
	url:"/HRMS/HRMS/Recruitment/project_management/project/project_schedule_view.php?id="+v,
	success:function(data)
	{
		$("#main_content").html(data);
	}
	})
}

function add_project()
    {
    $.ajax({

    type:"POST",
    url:"/HRMS/HRMS/Recruitment/project_management/project/new_projec_add.php",
    success:function(data){
   $("#main_content").html(data);
    }
    })
  }
    </script>
