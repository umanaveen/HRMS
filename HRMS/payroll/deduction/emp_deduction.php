<?php
require '../../../connect.php';
?>


	<div  class="card card-primary">
	<div class="card-header">
	<h3 class="card-title"><font size="5">Deduction Master</font></h3>
	<input type="button" style="float:right;" class="btn btn-warning" name="new" value="ADD" onclick="emp_deduction_add()">
	</div>
	<!-- /.card-header -->
	<div class="card-body" id="deduction_view">

	<table class="table table-striped table-bordered table-hover" id="dataTables-example">
	<thead>

	<!--th>#</th-->
	<th>Id</th>
	<th>Name</th>
	<th>From Date</th>
	<th>Amount</th>
	<th>Percentage</th>
	<th>Minimum Amount</th>
	<th>Maximum Amount</th>
	<th>Status</th>
	<th>Action</th>

	</thead>

	<tbody>
	<?php

	$sql=$con->query("SELECT id,name,from_date,amount,percentage,min_amount,max_amount,status FROM payroll_deduction_master");

	$i=1;
	while($res = $sql->fetch(PDO::FETCH_ASSOC))
	{
	?>
	<tr>
	<!--td><?php echo $i; ?></td-->
	<td><?php echo $res['id'] ; ?></td>
	<td><?php echo $res['name'] ; ?></td>
	<td><?php echo $res['from_date'] ; ?></td>
	<td><?php echo $res['amount'] ; ?></td>
	<td><?php echo $res['percentage'] ; ?></td>
	<td><?php echo $res['min_amount'] ; ?></td>
	<td><?php echo $res['max_amount'] ; ?></td>
	<td>

	<?php 
	if($res['status'] ==1)
	{

	echo '<span style="color:green;text-align:center;"><b>Active</b></span>';
	?>
	<?php }else {

	echo '<span style="color:red;text-align:center;"><b>INActive</b></span>';
	?>
	<?php }?>


	</td>
	<td>
	<!--button class="btn btn-primary"  value="<?php echo $payroll_structure['id']; ?>" onclick="scale_view(this.value)"> View</button-->
	<!--button class="btn btn-danger" value="<?php echo $payroll_structure['id']; ?>" onclick="scale_edit(this.value)">Edit</button-->
	<button class="btn btn-success btn-sm edit btn-flat" data-id="<?php echo $res['id']; ?>" onclick="emp_deduction_edit(<?php echo $res['id']; ?>)"><i class="fa fa-edit"></i> Edit</button>
	</td>
	</tr>

	<?php
	$i++;
	}
	?>
	</tbody>
	</table>

	</div>
	<!-- /.card-body -->
	</div>

	<script>
	$(document).ready(function() {
	$('#dataTables-example').DataTable({
			responsive: true
	});
	});
	</script>
	<script>
	function emp_deduction_edit(ids)
	{
	$.ajax({
	type:"GET",
	data:"ids="+ids,
	url:"/HRMS/HRMS/payroll/deduction/emp_deduction_edit.php",
	success:function(data){
	$("#payroll_view").html(data);
	}
	})
	}

	function emp_deduction_add()
	{

	$.ajax({
	type:"POST",
	url:"/HRMS/HRMS/payroll/deduction/emp_deduction_add.php",
	success:function(data){
	$("#payroll_view").html(data);
	}
	})
	}
	</script>
