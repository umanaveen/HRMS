	<?php
	require '../../connect.php';
	?>
	<div class="content-wrapper" style="padding-left: 50px;">
	<!-- Content Header (Page header) -->
	<section class="content-header">
	<div class="container-fluid">
	<div class="row mb-2">
	<div class="col-sm-6">
	<h1>Holidays</h1>
	</div>
	<div class="col-sm-6">
	<a onclick="return add_employee()" style="float: right;" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus"></i> ADD</a>
	</div>
	</div>
	</div><!-- /.container-fluid -->
	</section>
	<!-- Main content -->
	<section class="content">
	<div class="container-fluid">
	<div class="row">
	<div class="col-md-12">
	<!-- Profile Image -->
	<div class="card card-primary card-outline">
	<div class="card-body box-profile">
	<table id="example1" class="table table-bordered">
	<thead>
	<th>S.No</th>
	<th>Holiday Name</th>
	<th>Date</th>
	<th>Year </th>
	<th>Status</th>
	<th>Action</th>
	</thead>
	<tbody>
	<?php
	$holiday=$con->query("SELECT * FROM `holiday_master`");
	$cnt=1;
	while($holiday_master = $holiday->fetch(PDO::FETCH_ASSOC))
	{

	?>
	<tr>
	<td><?php echo $cnt;?>.</td>
	<td><?php echo $holiday_master['leave_name']; ?></td>
	<td><?php echo $holiday_master['leave_date']; ?></td>
	<td><?php echo $holiday_master['year']; ?></td>

	<td>
	<?php 
	if($holiday_master['status'] ==1)
	{

	echo '<span style="color:green;text-align:center;"><b>Active</b></span>';
	?>
	<?php }else {

	echo '<span style="color:red;text-align:center;"><b>INActive</b></span>';
	?>
	<?php }?>


	</td>


	<td>

	<button class="btn btn-success btn-sm edit btn-flat" data-id="<?php echo $holiday_master['id']; ?>" onclick="holiday_edit(<?php echo $holiday_master['id']; ?>)"><i class="fa fa-edit"></i> Edit</button>

	</td>
	</tr>
	<?php
	$cnt=$cnt+1;
	}
	?>
	</tbody>
	</table>

	<!-- /.card -->
	</div>
	<!-- /.card -->
	</div>
	<!-- /.col -->
	</div>
	<!-- /.row -->    
	</div>
	<!-- /.row -->
	</div><!-- /.container-fluid -->
	</section>
	<!-- /.content -->
	</div>

<script>
	function add_employee()
    {
    $.ajax({
    type:"POST",
    url:"HRMS/Recruitment/payroll/payoll_add.php",
    success:function(data){
    $(".content").html(data);
    }
    })
  }
  function holiday_edit(v){
	$.ajax({
	type:"POST",
	url:"HRMS/Recruitment/payroll/payroll_edit.php?id="+v,
	success:function(data)
	{
		$(".content").html(data);
	}
	})
}
</script>