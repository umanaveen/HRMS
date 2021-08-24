<?php
require '../../../connect.php';
include("../../../user.php");
$userrole=$_SESSION['userrole'];
?>
<style>
#page-wrapper{
	margin-left: 117px !important;
}
</style>

<div class="content-wrapper" id="page-wrapper">
<div class="container-fluid">

<div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header">Division Master List</h1>
                        </div>
                        </div>
						<div class="row">
						 <div class="col-lg-12">
		  <a onclick=" add_devision()" style="float: right;" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus"></i> ADD</a>


          </div>
                        <!-- /.col-lg-12 -->
                    </div>
  
  <br>
  
  
<div class="row content">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    Division Master List 
                                </div>
  
  
 
   
    <div class="panel-body">
      <div class="table-responsive">
       <table class="dataTables-example table table-striped table-bordered table-hover" id="example1">
    <thead>
      <th>#</th>
      <th>Department ID</th>
	   <th>Division Name</th>
      <th>Status</th>
      <th>Action</th>
      </thead>
      <tbody>
      <?php
      $emp_sql=$con->query("SELECT z.dept_name,d.div_name,d.status AS dstatus,d.id AS did FROM division_master d join z_department_master z on d.dep_id=z.id");
      $i=1;
      while($emp_res = $emp_sql->fetch(PDO::FETCH_ASSOC))
      {
       ?>
      <tr>
      <td><?php echo $i; ?></td>
      <td><?php echo $emp_res['dept_name']; ?></td>
	  <td><?php echo $emp_res['div_name']; ?></td>
	  <td>
	  <?php
	  if($emp_res['dstatus']==1)
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
	  <button class="btn btn-success btn-sm edit btn-flat" data-id="<?php echo $emp_res['did']; ?>" onclick="division_edit(<?php echo $emp_res['did']; ?>)"><i class="fa fa-edit"></i> Edit</button>
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
		function add_devision()
    {
    $.ajax({
    type:"POST",
    url:"/HRMS/HRMS/masters/devision_master/new_devision.php",
    success:function(data){
    $(".content").html(data);
    }
    })
  }
  function division_edit(v)
    {
    $.ajax({
    type:"POST",
    url:"/HRMS/HRMS/masters/devision_master/edit_devision.php?id="+v,
    success:function(data){
    $(".content").html(data);
    }
    })
  }
  
   
</script>