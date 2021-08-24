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
  
    <li class="breadcrumb-item active">Department Reports</li>
  </ol>
  <!-- Example DataTables Card-->
  <div class="card mb-3">
    <div class="card-header">
	<table class="table table-bordered"> 
	<tr> 
     <td> 
		<select class="form-control" id="tech_department" name="tech_department" onchange="report()" >
				<option value="">Choose Department</option>
			<?php $stmt = $con->query("SELECT * FROM z_department_master where status=1");
				while ($row = $stmt->fetch()) {?>
				 <option value="<?php echo $row['id']; ?>"> <?php echo $row['dept_name']; ?> </option>
			<?php } ?>
		</select> 
	 </td>
	 </tr>
	 </table>
	</div>
	<div class="card-body" id="response">
      
	</div>
  </div>
</div>
<script>
function report()
{  
	var from_date=$('#from_date').val();// alert(from_date);
	var to_date=$('#to_date').val();// alert(to_date);
	$.ajax({
    type:"GET",
	data:"from_date="+from_date+"&to_Date="+to_date,
    url:"HRMS/departmentreports/response.php",
    success:function(data){
      $("#response").html(data);
    }
  })
}
</script>
<script src="js/sb-admin-datatables.min.js"></script>