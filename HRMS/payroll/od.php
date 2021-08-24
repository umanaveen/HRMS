<?php
require '../../connect.php';
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
	<h1 class="page-header">OD Master</h1>
	</div>
	</div>
	<div class="row">
	<div class="col-lg-12">
	<a onclick="return add_od()" style="float: right;" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus"></i> ADD</a>


	</div>
	<!-- /.col-lg-12 -->
	</div>
	<br>
	<div class="row content">
	<div class="col-lg-12">
	<div class="panel panel-default">
	<div class="panel-heading">
	OD Master  
	</div>
					
    <!-- Content Header (Page header) -->
    
    <!-- Main content -->
  
	<div class="panel-body">
	<div class="table-responsive">
	<table class="dataTables-example table table-striped table-bordered table-hover"  id="example1">
	<thead>
	<th>S.No</th>
	<th>Emp Code</th>
	<th>Emp Name</th>
	<th>Date </th>
	<th>Customer Name</th>
	<th>Location</th>
	<th>Purpose</th>
	<th>Option</th>

	</thead>
	<tbody>
	<?php
	$holiday=$con->query("SELECT * FROM `manual_att` INNER JOIN staff_master on manual_att.emp_code=staff_master.id");

	$cnt=1;
      while($holiday_master = $holiday->fetch(PDO::FETCH_ASSOC))           
      {
     
      ?>
		<tr>
		<td><?php echo $cnt;?>.</td>
		<td><?php echo $holiday_master['emp_code']; ?></td>
		<td><?php echo $holiday_master['emp_name']; ?></td>
		<td><?php echo $holiday_master['date']; ?></td>
		<td><?php echo $holiday_master['customer_name']; ?></td>
		<td><?php echo $holiday_master['location']; ?></td>
		<td><?php echo $holiday_master['purpose']; ?></td>

	  

	<td>				
	<button class="btn btn-success btn-sm edit btn-flat" value="<?php echo $holiday_master['id']; ?>" onclick="od_edit(v)"><i class="fa fa-edit"></i> Edit</button>
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
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div><!-- /.container-fluid -->
</section>
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
		function add_od()
    {
    $.ajax({
    type:"POST",
    url:"HRMS/payroll/od_add.php",
    success:function(data){
    $(".content").html(data);
    }
    })
  }
  function od_edit(v){
	$.ajax({
	type:"POST",
	url:"HRMS/payroll/od_edit.php?id="+v,
	success:function(data)
	{
		$(".content").html(data);
	}
	})
}
</script>