<?php
require '../../../../connect.php';
include("../../../../user.php");
$userrole=$_SESSION['userrole'];

?>
<style>
#page-wrapper{
	margin-left: 117px !important;
}
.btn-warning{
	padding-top: 0px !important;
}

.btn-warning{
	background-color: #337ab7 !important;
    border-color: #337ab7 !important;
}
.btn-success{
	background-color: #5cb85c !important;
    border-color: #5cb85c !important;
}
.page-header{
	border-bottom: 3px solid #eee !important;
}
</style>
<div class="content-wrapper" id="page-wrapper">
<div class="container-fluid">

 <div class="row">
                        <div class="col-lg-12">
                            <!--h1 class="page-header">Staff Asset Master List</h1-->
                        </div>
                        </div>
						
					
					<div class="row content">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                   Modules 
                                </div>
					
    <!-- Content Header (Page header) -->
    
    <!-- Main content -->
  <div class="row">
						 <div class="col-lg-12">
		  <a onclick=" add_modules()" style="float: right;" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus"></i> ADD</a>


          </div>
                        <!-- /.col-lg-12 -->
                    </div>
				
   <div class="panel-body">
      <div class="table-responsive">
       <table class="dataTables-example table table-striped table-bordered table-hover"  id="example1">
		 
   
    <thead>
      <th>ID</th>
	        <th>Client</th>
<th>Date</th>
<th>Project</th>
<th>Module</th>
  <th>No Of Working Hours</th> 
<th>Remarks</th>
<th>Status</th>  
  <th>Reason</th>
<th>Action</th>
      <!--th>Tools</th-->
      </thead>
      <tbody>
      <?php
      $emp_sql=$con->query("SELECT * FROM modules");
	  
	 //echo "SELECT sm.emp_name,s.stationaries,s.system_or_laptop,s.id_card,s.cug,s.access_card,s.erp_access,s.mail_id,s.id AS sid FROM staff_asset s join staff_master sm on s.emp_name=sm.id";
      $i=1;
      while($emp_res = $emp_sql->fetch(PDO::FETCH_ASSOC))
      {
       ?>
      <tr>
      <td><?php echo $i; ?></td>
      <td><?php echo $emp_res['client']; ?></td>
	  <td><?php echo $emp_res['date']; ?></td>
<td><?php echo $emp_res['project']; ?></td>
     	  <td><?php echo $emp_res['module']; ?></td>
     	  <td><?php echo $emp_res['no_of_working_hours']; ?></td>
     	  <td><?php echo $emp_res['remarks']; ?></td>
     	   <td>
	  <?php
	  if($emp_res['status']==1)
	  {
		  echo '<span style="color:green;text-align:center;"><b>Completed</b></span>';
	  }
	  else
	  {
		   echo '<span style="color:red;text-align:center;"><b>Not Completed</b></span>';
	  }
	  ?>
	  </td>
	  	  <td><?php echo $emp_res['reason']; ?></td>
<td>
	  <button class="btn btn-success btn-sm edit btn-flat" data-id="<?php echo $emp_res['id']; ?>" onclick="modules_edit(<?php echo $emp_res['id']; ?>)"><i class="fa fa-edit"></i> Edit</button>
	  </td>
      
      </tr>
      <?php
	  $i++;
      }
      ?>
      </tbody>
      </table>
	 
      </div>
<!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div><!-- /.container-fluid -->

<!-- /.content -->
</div>
</div>
</div>
<script>
            $(document).ready(function() {
                $('.dataTables-example').DataTable({
                        responsive: true
                });
            });
        </script>
<script>
		function add_modules()
    {
    $.ajax({
    type:"POST",
    url:"/HRMS/HRMS/Recruitment/project_management/modules/new_modules.php",
    success:function(data){
    $(".content").html(data);
    }
    })
  }
 function modules_edit(v)
    {
    $.ajax({
    type:"POST",
    url:"/HRMS/HRMS/Recruitment/project_management/modules/edit_modules.php?id="+v,
    success:function(data){
    $(".content").html(data);
    }
    })
  }
  
   
</script>