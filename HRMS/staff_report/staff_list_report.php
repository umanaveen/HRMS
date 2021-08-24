	<?php
require '../../connect.php';
?>
<style>
.breadcrumb>.active{
	color: black !important;
    font-weight: bold !important;
}
</style>
<div class="content-wrapper">
<div class="container-fluid">
	<!-- Breadcrumbs-->
	<ol class="breadcrumb">

	<li class="breadcrumb-item active">Staff List Report</li>
	</ol>
	<!-- Example DataTables Card-->
	<div class="card mb-3">
	<div class="card-header">
	<form class="form-horizontal" method="POST">
	<table class="table table-bordered"> 
	<tr> 
	<td> 
	<select class="form-control" name="department" id="department">
	<!--option value="all">-- Select Department --</option-->
	<option value="all">All</option>
	<?php
	$dep_sql=$con->query("SELECT id, dept_name, status, created_by, created_on FROM z_department_master where status=1");
	while($dep_sql_res=$dep_sql->fetch(PDO::FETCH_ASSOC))
	{
		?>
		<option value="<?php echo $dep_sql_res['id']; ?>"><?php echo $dep_sql_res['dept_name']; ?></option>
		<?php
	}
	?>
	</select>
	</td>
	</div>
	</div>
	<div class="col-2">
	<div class="form-group">
	<td>
	<select class="form-control" name="division" id="division" required>
	<option value="all">All</option>					
	</select>
	</td>
	</div>
	</div>
	<td>
	<select class="form-control" name="status" id="status">
	<option value="">Select Status</option>
	<option value="1">Active</option>
	<option value="0">InActive</option>
	</select>
	</td>
	</div>
	</div>
	<td>
			
	<input type="button" class="btn btn-primary" value="Go" onclick="response()">
	
	</td>
	 </tr>
	 </table>
	 </form>
	</div>
	<div class="card-body" id="response">
      
	</div>
  </div>
</div>
	<script>
	$(document).ready(function() {
	$('#department').on('change', function() {

	var department_id = this.value;
	//alert(department_id);
	$.ajax({
	url:"HRMS/staff_report/find_division.php",
	type: "POST",
	data: {
	department_id: department_id
	},
	cache: false,
	success: function(result){
	$("#division").html(result);

	}
	});
	});
	});

	function response()
	{
		var data = $('form').serialize();
			$.ajax({
			type: "GET",
			url: "HRMS/staff_report/response.php",
			data:  "id="+ 1,  data,
			success: function(data)
			{
				$("#response").html(data);		
			}				
		});	
	}

	</script>
<script src="js/sb-admin-datatables.min.js"></script>