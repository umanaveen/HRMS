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
                            <h1 class="page-header">Department Mapping</h1>
                        </div>
                        </div>
						<div class="row">
						 <div class="col-lg-12">
		  <a onclick="newdepartment_mapping()" style="float: right;" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus"></i> ADD</a>


          </div>
                        <!-- /.col-lg-12 -->
                    </div>
  
  <br>
  
  
    <div class="row content">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    Department Mapping 
                                </div>
  
  
 
   
    <div class="panel-body">
      <div class="table-responsive">
       <table class="dataTables-example table table-striped table-bordered table-hover" id="example1">
		
    <thead>
      <th>#</th>
      <th>Company Name</th>
      <th>Department Name</th>
      <th>Head Name</th>
      <th>Status</th>
      <th>Tools</th>
      </thead>
      <tbody>
      <?php
      $emp_sql=$con->query(" select *,d.id as dmid,c.companyname as cname,z.dept_name as dname,u.user_name as uname,d.status as dstatus from department_mapping d join z_department_master z on z.id=d.department_id join z_user_master u on u.user_id=d.department_head join company_master c on c.id=d.company_name");
      
	  
	  $i=1;
      while($emp_res = $emp_sql->fetch(PDO::FETCH_ASSOC))
      {
       ?>
      <tr>
      <td><?php echo $i; ?></td>
      <td><?php echo $emp_res['cname']; ?></td>
      <td><?php echo $emp_res['dname']; ?></td>
      <td><?php echo $emp_res['uname']; ?></td>
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
	  <button class="btn btn-success btn-sm edit btn-flat" data-id="<?php echo $emp_res['dmid']; ?>" onclick="question_edit(<?php echo $emp_res['dmid']; ?>)"><i class="fa fa-edit"></i> Edit</button>
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
   function newdepartment_mapping()
    {
    $.ajax({
    type:"POST",
    url:"/HRMS/HRMS/masters/department_mapping/new_department_mapping.php",
    success:function(data){
    $("#main_content").html(data);
    }
    })
  }
  function question_edit(v)
    {
    $.ajax({
    type:"POST",
    url:"/HRMS/HRMS/masters/department_mapping/edit_department_mapping.php?id="+v,
    success:function(data){
    $("#main_content").html(data);
    }
    })
  }
  
</script>