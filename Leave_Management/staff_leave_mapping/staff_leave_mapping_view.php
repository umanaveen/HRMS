<?php
require '../../connect.php';
?>
<div class="card mb-3" id="salary_structure_view">
<div class="card-header">
<i class="fa fa-table"></i>  Salary Structure 
<input type="button" style="float:right;" class="btn btn-warning" name="new" value="ADD" onclick="salary_structure_add()">
</div>
<div class="card-body">
<div class="table-responsive">
<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
<thead>
<th>Id</th>
<th>Name</th>
<th>Amount</th>
<th>Percentage</th>
<th>Status</th>
<th>Action</th>
</thead>
<tbody>
<?php

$sql=$con->query("SELECT id,name, amount, percentage,status FROM payroll_structure");

$i=1;
while($payroll_structure = $sql->fetch(PDO::FETCH_ASSOC))
{
?>
<tr>
<!--td><?php echo $i; ?></td-->
<td><?php echo $payroll_structure['id'] ; ?></td>
<td><?php echo $payroll_structure['name'] ; ?></td>
<td><?php echo $payroll_structure['amount'] ; ?></td>
<td><?php echo $payroll_structure['percentage'] ; ?></td>
<td>

<?php 
if($payroll_structure['status'] ==1)
{
	echo '<span style="color:green;text-align:center;"><b>Active</b></span>';
}
else
{
	echo '<span style="color:red;text-align:center;"><b>INActive</b></span>';
}
?>


</td>
<td>

<button class="btn btn-success btn-sm edit btn-flat" data-id="<?php echo $payroll_structure['id']; ?>" onclick="scale_structure_edit(<?php echo $payroll_structure['id']; ?>)">
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
function salary_structure_add()
{
	$.ajax({
	type:"POST",
	url:"/HRMS/HRMS/payroll/salary_structure/salary_structure_add.php",
	success:function(data){
	$("#salary_structure_view").html(data);
	}
	})
}

function scale_structure_edit(ids)
{
	$.ajax({
	type:"GET",
	data:"ids="+ids,
	url:"/HRMS/HRMS/payroll/salary_structure/salary_structure_edit.php",
	success:function(data){
	$("#salary_structure_view").html(data);
	}
	})
}
</script>