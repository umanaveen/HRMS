<?php
require '../../connect.php';
?>

<div class="content-wrapper" id="main_content">
<div class="container-fluid">
  <!-- Breadcrumbs-->
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="#">Dashboard</a>
    </li>
    <li class="breadcrumb-item active">Employee Leave Master <?php if($con) {	echo "connect"; } ?></li>
  </ol>
  <!-- Example DataTables Card-->
  <div class="card mb-3">
    <div class="card-header">
      <i class="fa fa-table"></i> Employee Leave Master
	  <input type="button" style="float:right;" class="btn btn-warning" name="new" value="ADD" onclick="emp_Leave_new()">
	  </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
          <tr>
          <th>#</th>
          <th>Workers Type</th>
          <th>Leave Name</th>
          <th>No of days</th>
          <th>Status</th>
          <th>Actions</th>
          </tr>
          </thead>
         
          <tbody>
          <?php

          $sql=$con->query("SELECT lc.id as id,lc.type as type,ml.leave_name,ml.no_of_days,case when lc.status=1 then 'Active' else 'InActive' end as status FROM `leave_category` lc join master_leave ml on lc.leave_ids=ml.id where  lc.status=1");

          $i=1;
          while($res = $sql->fetch(PDO::FETCH_ASSOC))
          {
          ?>
          <tr>
          <td><?php echo $i; ?></td>
          <td><?php echo $res['type'] ; ?></td>
          <td><?php echo $res['leave_name'] ; ?></td>
          <td><?php echo $res['no_of_days'] ; ?></td>
          <td><?php echo $res['status'] ; ?></td>
          <td>
          <button class="btn btn-primary"  value="<?php echo $res['id']; ?>" onclick="emp_Leave_view(this.value)"> View</button>
          <button class="btn btn-danger" value="<?php echo $res['id']; ?>" onclick="emp_Leave_edit(this.value)">Edit</button>
          </td>
          </tr>

          <?php
          $i++;
          }
          ?>
          </tbody>
        </table>
        </table>
      </div>
    </div>
  </div>
</div>
</div>
<script>
function emp_Leave_view(id)
{
	$.ajax({
    type:"GET",
    data:"ids="+id,
    url:"/HRMS/HRMS/employees_leave/view.php",
    success:function(data){
      $("#main_content").html(data);
    }
  })
}
function emp_Leave_edit(ids)
{
	$.ajax({
    type:"GET",
    data:"ids="+ids,
    url:"/HRMS/HRMS/employees_leave/edit.php",
    success:function(data){
      $("#main_content").html(data);
    }
  })
}
function emp_Leave_new()
{
	$.ajax({
    type:"POST",
    url:"/HRMS/HRMS/employees_leave/new.php",
    success:function(data){
      $("#main_content").html(data);
    }
  })
}
</script>