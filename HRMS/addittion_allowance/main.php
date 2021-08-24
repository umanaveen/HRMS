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
    <li class="breadcrumb-item active">Allowance <?php if($con) {	echo "connect"; } ?></li>
  </ol>
  <!-- Example DataTables Card-->
  <div class="card mb-3">
    <div class="card-header">
      <i class="fa fa-table"></i> Allowance
	  <input type="button" style="float:right;" class="btn btn-warning" name="new" value="ADD" onclick="allowance_new()">
	  </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
			  <tr>
				  <th>#</th>
				  <th>Allowance Name</th>
				  <th>Short Form</th>
				  <th>Status</th>
				  <th>Actions</th>
			  </tr>
          </thead>
		  
		  <tbody>
          <?php
		  
			$sql=$con->query("SELECT id, allowance_name,short_name,status FROM master_addittion_allowance");

          $i=1;
          while($res = $sql->fetch(PDO::FETCH_ASSOC))
          {
          ?>
          <tr>
          <td><?php echo $i; ?></td>
          <td><?php echo $res['allowance_name'] ; ?></td>
          <td><?php echo $res['short_name'] ; ?></td>
          <td><?php echo $res['status'] ; ?></td>
          <td>
          <button class="btn btn-primary"  value="<?php echo $res['id']; ?>" onclick="addition_view(this.value)"> View</button>
          <button class="btn btn-danger" value="<?php echo $res['id']; ?>" onclick="addition_edit(this.value)">Edit</button>
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
function addition_view(id)
{
	$.ajax({
    type:"GET",
    data:"ids="+id,
    url:"/HRMS/HRMS/addittion_allowance/view.php",
    success:function(data){
      $("#main_content").html(data);
    }
  })
}
function addition_edit(ids)
{
	$.ajax({
    type:"GET",
    data:"ids="+ids,
    url:"/HRMS/HRMS/addittion_allowance/edit.php",
    success:function(data){
      $("#main_content").html(data);
    }
  })
}
function allowance_new()
{
	$.ajax({
    type:"POST",
    url:"/HRMS/HRMS/addittion_allowance/new.php",
    success:function(data){
      $("#main_content").html(data);
    }
  })
}
</script>
