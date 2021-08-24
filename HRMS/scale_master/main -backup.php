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
    <li class="breadcrumb-item active">Scale Master <?php if($con) {	echo "connect"; } ?></li>
  </ol>
  <!-- Example DataTables Card-->
  <div class="card mb-3">
    <div class="card-header">
      <i class="fa fa-table"></i> Scale Master
	  <input type="button" style="float:right;" class="btn btn-warning" name="new" value="ADD" onclick="scale_new()">
	  </div>
    <div class="card-body">
      <div class="table-responsive">
       <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
          <tr>
          <th>#</th>
          <th>Scale</th>
          <th>Date</th>
          <th>Basic Pay</th>
          <th>Spl Pay</th>
          <th>Grade Pay</th>
          <th>DA</th>
          <th>HRA</th>
          <th>CCA</th>
          <th>Bonus</th>
          <th>Other Allowance</th>
		  <th>Other</th>
          <th>Actions</th>
          </tr>
          </thead>
         
          <tbody>
          <?php

          $sql=$con->query("SELECT id,scale_name, from_date, basic_pay, spl_pay, grade_pay, da, hra, cca, bonus, addition_allowance, others FROM master_scale_master where status=1");

          $i=1;
          while($res = $sql->fetch(PDO::FETCH_ASSOC))
          {
          ?>
          <tr>
          <td><?php echo $i; ?></td>
          <td><?php echo $res['scale_name'] ; ?></td>
          <td><?php echo date('d-m-Y',strtotime($res['from_date'])); ?></td>
          <td><?php echo $res['basic_pay'] ; ?></td>
          <td><?php echo $res['spl_pay'] ; ?></td>
          <td><?php echo $res['grade_pay'] ; ?></td>
          <td><?php echo $res['da'] ; ?></td>
          <td><?php echo $res['hra'] ; ?></td>
          <td><?php echo $res['cca'] ; ?></td>
          <td><?php echo $res['bonus'] ; ?></td>
          <td><?php echo $res['addition_allowance'] ; ?></td>
          <td><?php echo $res['others'] ; ?></td>
          <td>
          <button class="btn btn-primary"  value="<?php echo $res['id']; ?>" onclick="scale_view(this.value)"> View</button>
          <button class="btn btn-danger" value="<?php echo $res['id']; ?>" onclick="scale_edit(this.value)">Edit</button>
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
</div>
<script>
function scale_view(id)
{
	
	$.ajax({
    type:"GET",
    data:"ids="+id,
    url:"/HRMS/HRMS/scale_master/view.php",
    success:function(data){
      $("#main_content").html(data);
    }
  })
}
function scale_edit(ids)
{
	$.ajax({
    type:"GET",
    data:"ids="+ids,
    url:"/HRMS/HRMS/scale_master/edit.php",
    success:function(data){
      $("#main_content").html(data);
    }
  })
}
function scale_new()
{
	$.ajax({
    type:"POST",
    url:"/HRMS/HRMS/scale_master/new.php",
    success:function(data){
      $("#main_content").html(data);
    }
  })
}
</script>
