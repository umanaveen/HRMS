<?php
require '../../../../connect.php';
require '../../../../user.php';
$userrole=$_SESSION['userrole'];
?>

<div  class="card card-primary">
              <div class="card-header">
                <h3 class="card-title"><font size="5">Scope of Work</font></h3>
			
			
              </div>
  
              <div class="card-body">
			  
       <table class="dataTables-example table table-striped table-bordered table-hover"  id="example1">
    
      <thead>
	   <th>ID</th>
	        <th>Client</th>
<th>Project Name</th>
 <th>Project Timeline</th>
   <th>No Of Working Hours</th> 
   <th>Action</th>
      </thead>
      <tbody>
      <?php
$emp_sql=$con->query("SELECT cm.client_name,p.* FROM project_management p join client_master cm on p.client=cm.id
");
	
	 //echo "SELECT sm.emp_name,s.stationaries,s.system_or_laptop,s.id_card,s.cug,s.access_card,s.erp_access,s.mail_id,s.id AS sid FROM staff_asset s join staff_master sm on s.emp_name=sm.id";
      $i=1;
      while($emp_res = $emp_sql->fetch(PDO::FETCH_ASSOC))
      {
       ?>
      <tr>
      <td><?php echo $i; ?></td>
      <td><?php echo $emp_res['client_name']; ?></td>
	  <td><?php echo $emp_res['Project_Name']; ?></td>
<td><?php echo $emp_res['Project_Deadline_Date']; ?></td>
<td><?php echo $emp_res['Total_Man_Hours']; ?></td>
	<td>	
	
		<button class="btn btn-success btn-sm add btn-flat" data-id="<?php echo $emp_res['project_id']; ?>" onclick="add(<?php echo $emp_res['project_id']; ?>)"><i class="fa fa-add"></i> Add</button>
		<button class="btn btn-primary btn-sm view btn-flat" data-id="<?php echo $emp_res['project_id']; ?>" onclick="scope_view(<?php echo $emp_res['project_id']; ?>)"><i class="fa fa-view"></i> View</button>
		<button class="btn btn-secondary btn-sm send mail btn-flat" data-id="<?php echo $emp_res['project_id']; ?>" onclick="send_mail(<?php echo $emp_res['project_id']; ?>)"><i class="fa fa-add"></i>Send Mail</button>
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
		function add(v)
    {
    $.ajax({
    type:"POST",
    url:"/HRMS/HRMS/Recruitment/project_management/scope_of_work/add_scope_of_work.php?id="+v,
    success:function(data){
    $("#main_content").html(data);
    }
    })
  }
  function scope_view(v)
    {
    $.ajax({
    type:"POST",
    url:"/HRMS/HRMS/Recruitment/project_management/scope_of_work/view_scope_of_works.php?id="+v,
    success:function(data){
    $("#main_content").html(data);
    }
    })
  }
  function send_mail(v)
	  {
		$.ajax({
			type:"POST",
			url:"HRMS/Recruitment/project_management/scope_of_work/send_mail.php?id="+v,
			success:function(data)
			{
				alert("Mail Sended Successfully")
			}
		})
	  }


    </script>