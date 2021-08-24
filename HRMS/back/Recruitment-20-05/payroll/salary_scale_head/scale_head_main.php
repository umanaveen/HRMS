<?php
require '../../../connect.php';
include("../../../user.php");
$userrole=$_SESSION['userrole'];
?>
<div class="card mb-3" id="salary_structure_view">
<div class="card-header">
<i class="fa fa-table"></i> Scale Head Data
<a onclick="scale_head_add()" style="float: right;" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus"></i> ADD</a>
</div>
<div class="card-body">
<div class="table-responsive">
<table id="example1" class="table table-bordered">
<thead>
<th>ID</th>
<th>Name</th>
<th>Status</th>
<th>Action</th>
</thead>
<tbody>
<?php
$emp_sql=$con->query("SELECT * FROM payroll_scale_master ");
$i=1;
while($emp_res = $emp_sql->fetch(PDO::FETCH_ASSOC))
{
?>
<tr>
<td><?php echo $emp_res['id']; ?></td>
<td><?php echo $emp_res['name']; ?></td>
<td>
<?php
if($emp_res['status']==1)
{
  echo "Active"; 
}
else
{
  echo "Inactive";
}
?>
</td>
<td>
<button class="btn btn-success btn-sm edit btn-flat" data-id="<?php echo $emp_res['id']; ?>" id="<?php echo $emp_res['id']; ?>" onclick="scale_head_edit(this.id)">
<i class="fa fa-edit"></i> Edit</button>
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
<script>
function scale_head_add()
{
	
	$.ajax({
    type:"POST",
    url:"Recruitment/payroll/salary_scale_head/scale_head_add.php",
    success:function(data){
      $("#salary_structure_view").html(data);
    }
  })
}
function scale_head_edit(ids)
{
	$.ajax({
    type:"GET",
    data:"ids="+ids,
    url:"Recruitment/payroll/salary_scale_head/scale_head_edit.php",
    success:function(data){
      $("#salary_structure_view").html(data);
    }
  })
}

</script>