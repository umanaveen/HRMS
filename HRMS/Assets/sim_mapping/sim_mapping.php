<?php
require '../../../connect.php';
include("../../../user.php");
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
                            <h1 class="page-header">Sim Mapping</h1>
                        </div>
                        </div>
						<div class="row">
						 <div class="col-lg-12">
		  <a onclick=" add_sim()" style="float: right;" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus"></i> ADD</a>


          </div>
                        <!-- /.col-lg-12 -->
                    </div>
					
					<br>
					
					<div class="row content">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    
                                </div>
					
    <!-- Content Header (Page header) -->
    
    <!-- Main content -->
  
   <div class="panel-body">
      <div class="table-responsive">
       <table class="dataTables-example table table-striped table-bordered table-hover"  id="example1">
		 
   
    <thead>
      <th>#</th>
      <th>Department</th>
      <th>Provider Name</th>
      <th>Phone Number</th>
      <th>Activation Date</th>
	  <th>Status</th>
	  <th>Action</th>
      </thead>
      <tbody>
      <?php
      $emp_sql=$con->query("SELECT *,m.id as id FROM sim_master s join sim_mapping m on s.id=m.sim_id join z_department_master d on d.id=m.department_id ");
      $i=1;
      while($emp_res = $emp_sql->fetch(PDO::FETCH_ASSOC))
      {
       ?>
      <tr>
      <td><?php echo $i; ?></td>
      <td><?php echo $emp_res['dept_name']; ?></td>
      <td><?php echo $emp_res['provider_name']; ?></td>
      <td><?php echo $emp_res['phone_no']; ?></td>
      <td><?php echo $emp_res['activation_date']; ?></td>
	  <td>
	  <?php
	  if($emp_res['status']==1)
	  {
		   echo '<span style="color:green;text-align:center;"><b>Active</b></span>';
	  }
	  else
	  {
		  echo '<span style="color:red;text-align:center;"><b>Inactive</b></span>';
	  }
	  ?>
	  </td>
      <td>
	  <button class="btn btn-success btn-sm edit btn-flat" data-id="<?php echo $emp_res['id']; ?>" onclick="sim_edit(<?php echo $emp_res['id']; ?>)"><i class="fa fa-edit"></i> Edit</button>
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
		function add_sim()
    {
    $.ajax({
    type:"POST",
    url:"/HRMS/HRMS/Assets/sim_mapping/new_sim_mapping.php",
    success:function(data){
    $("#main_content").html(data);
    }
    })
  }
  function sim_edit(v)
    {
    $.ajax({
    type:"POST",
    url:"/HRMS/HRMS/Assets/sim_mapping/edit_sim_mapping.php?id="+v,
    success:function(data){
    $("#main_content").html(data);
    }
    })
  } 
  
   
</script>