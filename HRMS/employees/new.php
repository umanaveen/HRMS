<?php
require '../../connect.php';
?>

<div class="content-header" id="main_content">
<section class="content">
	<div class="container-fluid">
	<div class="row">
	<!-- left column -->
	<div class="col-md-12">
	<!-- jquery validation -->
	<div class="card card-primary">
	<div class="card-header">
<div class="container-fluid">
  <div class="card mb-3">
    <div class="card-header">
      <i class="fa fa-table"></i> Employee Master
	  <input type="button" style="float:right;" class="btn btn-warning" name="back" value="BACK" onclick="employee_master()">
	  </div>


    <div class="card-body">
	 <form method="POST">
		  <div class="form-group row">
			<label for="Scale" class="col-sm-2 col-form-label">Gender</label>
			<div class="col-sm-4">
			  <select class="form-control" id="gender" name="gender" placeholder="Choose Gender">
				  <option value=""> CHOOSE GENDER </option>
				  <option value="male"> Male </option>
				  <option value="female"> Female </option>
			  </select>
			</div>
		  </div>
		  <div class="form-group row">
			<label for="name" class="col-sm-2 col-form-label">First Name</label>
			<div class="col-sm-4">
			  <input type="text" class="form-control" id="first_name" name="first_name" placeholder="First Name" autocomplete="off">
			</div>
			<label for="lname" class="col-sm-2 col-form-label">Last Name</label>
			<div class="col-sm-4">
			  <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last Name" autocomplete="off">
			</div>
		  </div>
		  <div class="form-group row">
			<label for="uname" class="col-sm-2 col-form-label">User Name</label>
			<div class="col-sm-4">
			  <input type="text" class="form-control" id="user_name" name="user_name" placeholder="User Name" autocomplete="off">
			</div>
			<label for="pswd" class="col-sm-2 col-form-label">Password</label>
			<div class="col-sm-4">
			  <input type="text" class="form-control" id="password" name="password" placeholder="Password" autocomplete="off">
			</div>
		  </div>
		  <div class="form-group row">
			<label for="mail" class="col-sm-2 col-form-label">E-Mail</label>
			<div class="col-sm-4">
			  <input type="text" class="form-control" id="mail" name="mail" placeholder="Mail" autocomplete="off">
			</div>
			<label for="phone" class="col-sm-2 col-form-label">Phone</label>
			<div class="col-sm-4">
			  <input type="number" class="form-control" id="phone" name="phone" placeholder="Phone" autocomplete="off">
			</div>
		  </div>
		  <div class="form-group row">
			<label for="dob" class="col-sm-2 col-form-label">Date of Birth</label>
			<div class="col-sm-4">
			  <input type="date" class="form-control" id="dob" name="dob" placeholder="Date of Birth">
			</div>
			<label for="doj" class="col-sm-2 col-form-label">Date of Join</label>
			<div class="col-sm-4">
			  <input type="date" class="form-control" id="doj" name="doj" placeholder="Date of Join">
			</div>
		  </div>
		  <div class="form-group row">
			<label for="department" class="col-sm-2 col-form-label">Department</label>
			<div class="col-sm-4">
			  <select class="form-control" id="department" name="department" placeholder="Department">
			  <option value=""> CHOOSE DEPARTMENT </option>
			 <?php $stmt = $con->query("SELECT * FROM masters_department where status=1");
					while ($row = $stmt->fetch()) {?>
					 <option value="<?php echo $row['id']; ?>"> <?php echo $row['name']; ?> </option>
				<?php } ?>
				</select>
			</div>
			<label for="designation" class="col-sm-2 col-form-label">Designation</label>
			<div class="col-sm-4">
			   <select class="form-control" id="designation" name="designation" placeholder="designation">
			  <option value=""> CHOOSE DESIGNATION </option>
			 <?php $stmt = $con->query("SELECT * FROM masters_desigination where status=1");
					while ($row = $stmt->fetch()) {?>
					 <option value="<?php echo $row['id']; ?>"> <?php echo $row['name']; ?> </option>
				<?php } ?>
				</select>
			</div>
		  </div>
		  <div class="form-group row">
			<label for="country" class="col-sm-2 col-form-label">Country</label>
			<div class="col-sm-4">
			  <input type="text" class="form-control" id="country" name="country" placeholder="Country" autocomplete="off">
			</div>
			<label for="region" class="col-sm-2 col-form-label">Region</label>
			<div class="col-sm-4">
			  <input type="text" class="form-control" id="region" name="region" placeholder="Region" autocomplete="off">
			</div>
		  </div>
		  <div class="form-group row">
			<label for="city" class="col-sm-2 col-form-label">City</label>
			<div class="col-sm-4">
			  <input type="text" class="form-control" id="city" name="city" placeholder="City" autocomplete="off">
			</div>
			<label for="address" class="col-sm-2 col-form-label">Address</label>
			<div class="col-sm-4">
			  <input type="textarea" class="form-control" id="address" name="address" placeholder="Address" autocomplete="off">
			</div>
		  </div>
		  <div class="form-group row">
			<label for="id_type" class="col-sm-2 col-form-label">Id Type</label>
			<div class="col-sm-4">
			  <input type="text" class="form-control" id="id_type" name="id_type" placeholder="Id Type" autocomplete="off">
			</div>
			<label for="id_number" class="col-sm-2 col-form-label">Id Number</label>
			<div class="col-sm-4">
			  <input type="text" class="form-control" id="id_number" name="id_number" placeholder="Id Number" autocomplete="off">
			</div>
		  </div>
		  <div class="form-group row">
			<label for="designation" class="col-sm-2 col-form-label">Leave Type</label>
			<div class="col-sm-4">
			   <select class="form-control" id="leave_type" name="leave_type" placeholder="designation">
			  <option value=""> CHOOSE Leave Type </option>
			 <?php $stmt = $con->query("SELECT * FROM leave_category where status=1");
					while ($row = $stmt->fetch()) {?>
					 <option value="<?php echo $row['leave_ids']; ?>"> <?php echo $row['type']; ?> </option>
				<?php } ?>
				</select>
			</div>
			<label for="remark" class="col-sm-2 col-form-label">Remark</label>
			<div class="col-sm-4">
			  <input type="textarea" class="form-control" id="remark" name="remark" placeholder="Remark" autocomplete="off">
			</div>
		  </div>
		   <div class="form-group row">
			<label for="salary" class="col-sm-2 col-form-label">Salary</label>
			<div class="col-sm-10">
			     <select class="form-control" id="salary" name="salary" placeholder="salary">
			  <option value=""> CHOOSE PAY TYPE </option>
			 <?php $stmt = $con->query("SELECT * FROM master_scale_master where status=1");
					while ($row = $stmt->fetch()) {?>
					 <option value="<?php echo $row['id']; ?>"> <?php echo $row['scale_name']; ?> </option>
				<?php } ?>
				</select>
			</div>
		  </div>
<div class="form-group row">
			<div class="col-sm-10"></div>
			<div class="col-sm-2">
			  <input type="button" class="btn btn-primary btn-md" onclick="employee_create()" value="Create">
			</div>
		  </div>
	</form>
    </div>
  </div>
</div>
</div>
<script>
function employee_master()
{
  $.ajax({
    type:"POST",
    url:"/HRMS/HRMS/employees/main.php",
    success:function(data){
      $("#main_content").html(data);
    }
  })
}
function employee_create()
{
	var field=1;
	var data = $('form').serialize();
	$.ajax({
		type:'GET',
		data:"field="+field, data,
		url:'/HRMS/HRMS/employees/employees_new_submit.php',
		success:function(data)
		{
			if(data)
			{
				alert("Employee Created");
				employee();
			}
			else
			{
				alert("Employee Not Created");
				employee();
			}		
		}       
	});
}
</script>
