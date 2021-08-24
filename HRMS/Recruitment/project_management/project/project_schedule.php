

<?php
require '../../../../connect.php';
require '../../../../user.php';
$userrole=$_SESSION['userrole'];
?>

<div  class="card card-primary">
              <div class="card-header">
                <h3 class="card-title"><font size="5">Project Schedule List</font></h3>
			<a onclick="return add_project_schedule()"  style="float: right;" data-toggle="modal" class="btn btn-dark"><i class="fa fa-plus"></i>  New Project Schedule</a>
			
              </div>
  
              <div class="card-body">
			  
       <table class="dataTables-example table table-striped table-bordered table-hover"  id="example1">
    
      <thead>
	   <th>ID</th>
	  <th>Client</th>
	  <th>Client Name</th>
	   <th>Department</th>
	  <th>Project Name</th>
	        
<th>Action</th>
      </thead>
      <tbody>
      <?php
 
	 $emp_sql=$con->query("SELECT enquiry.id as enquiry_id,enquiry.status as enquiry_status,enquiry.Client as enClient,enquiry.*,quotation.* FROM `enquiry` INNER JOIN quotation ON enquiry.id=quotation.Enquire_id where enquiry.status=7
");
	 
      $i=1;
      while($emp_res = $emp_sql->fetch(PDO::FETCH_ASSOC))
      {
       ?>
      <tr>
      <td><?php echo $i; ?></td>
	        <td><?php echo $emp_res['Company_name']; ?></td>
 <td><?php echo $emp_res['enClient']; ?></td>
 <td><?php echo $emp_res['Designation']; ?></td>
      <td><?php echo $emp_res['proposal']; ?></td>

      
<td>
<button class="btn btn-info" data-id="<?php echo $emp_res['enquiry_id']; ?>" onclick="project_view(<?php echo $emp_res['enquiry_id']; ?>)"><i class="fa fa-eye"></i></button>
	
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
	url:"/HRMS/HRMS/Recruitment/project_management/project_schedule/project_schedule_add.php?id="+v,
	success:function(data)
	{
		$("#main_content").html(data);
	}
	})
}
    </script>
