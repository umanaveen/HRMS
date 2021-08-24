<?php
require '../../connect.php';
?>

<div class="content-header">
<!-- /.content-header -->
	<!-- Main content -->
	<section class="content">
	<div class="container-fluid">
	<div class="row">
	<!-- left column -->
	<div class="col-md-12">
	<!-- jquery validation -->
	<div class="card card-primary">
	<div class="card-header">
	<h3 class="card-title">Employees</h3>
	<input class="btn btn-primary btn-sm" type="button" onclick="employee_new_add()" value="ADD" style="float: right;">
	</div>
	<!-- /.card-header -->
	

<div class="container-fluid">
  <!-- Breadcrumbs-->
 
  <!-- Example DataTables Card-->
  <div class="card mb-3">
    
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
          <tr>
          <th>#</th>
          <th>Leave</th>
          <th>No of days</th>
          <th>Status</th>
          <th>Actions</th>
          </tr>
          </thead>
         
          <tbody>
          <?php

          $sql=$con->query("SELECT id,leave_name,no_of_days,case when status=1 then 'Active' else 'InActive' end as status FROM `master_leave` where  status=1");

          $i=1;
          while($res = $sql->fetch(PDO::FETCH_ASSOC))
          {
          ?>
          <tr>
          <td><?php echo $i; ?></td>
          <td><?php echo $res['leave_name'] ; ?></td>
          <td><?php echo $res['no_of_days'] ; ?></td>
          <td><?php echo $res['status'] ; ?></td>
          <td>
          <button class="btn btn-primary"  value="<?php echo $res['id']; ?>" onclick="Leave_view(this.value)"> View</button>
          <button class="btn btn-danger" value="<?php echo $res['id']; ?>" onclick="Leave_edit(this.value)">Edit</button>
          </td>
          </tr>

          <?php
          $i++;
          }
          ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<script>
function employee_view(id)
{
	$.ajax({
    type:"GET",
    data:"ids="+id,
    url:"/HRMS/HRMS/employees/view.php",
    success:function(data){
      $("#main_content").html(data);
    }
  })
}
function employee_edit(ids)
{
	$.ajax({
    type:"GET",
    data:"ids="+ids,
    url:"/HRMS/HRMS/employees/edit.php",
    success:function(data){
      $("#main_content").html(data);
    }
  })
}
function employee_new_add()
{
	$.ajax({
    type:"POST",
    url:"/HRMS/HRMS/employees/new.php",
    success:function(data){
      $("#main_content").html(data);
    }
  })
}
</script>
<script src="js/sb-admin-datatables.min.js"></script>