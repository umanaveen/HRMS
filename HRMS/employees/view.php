<?php

require '../../connect.php';
 $ids=$_REQUEST['ids'];
 $edit_id=$con->query("SELECT * FROM masters_employee where id='$ids'");
 $res = $edit_id->fetch();


?>

<div class="content-header" id="main_content">
<div class="container-fluid">
  <div class="card mb-3">
    <div class="card-header">
      <i class="fa fa-table"></i> Employee Master
	  <input type="button" style="float:right;" class="btn btn-warning" name="back" value="BACK" onclick="employee()">
	  </div>
    <div class="card-body">
	 <form method="POST">
		  <div class="form-group row">
			
			<label for="Scale" class="col-sm-2 col-form-label">Gender</label>
			<div class="col-sm-4">
			  <input type="text"  class="form-control" id="gender" name="gender" value="<?php echo $res['gender']; ?>"  placeholder="Gender" readonly>
			</div>
		  </div>
		  <div class="form-group row">
			<label for="name" class="col-sm-2 col-form-label">First Name</label>
			<div class="col-sm-4">
			  <input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo $res['first_name']; ?>"   placeholder="First Name" readonly>
			</div>
			<label for="lname" class="col-sm-2 col-form-label">Last Name</label>
			<div class="col-sm-4">
			  <input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo $res['last_name']; ?>" placeholder="Last Name" readonly>
			</div>
		  </div>
		  <div class="form-group row">
			<label for="uname" class="col-sm-2 col-form-label">User Name</label>
			<div class="col-sm-4">
			  <input type="text" class="form-control" id="user_name" name="user_name"  value="<?php echo $res['user_name']; ?>" placeholder="User Name" readonly>
			</div>
			<label for="salary" class="col-sm-2 col-form-label">Salary</label>
			<div class="col-sm-4">
			      <input type="text" class="form-control" id="remark" name="remark" value="<?php echo $res['salary']; ?>" placeholder="Remark" readonly>
			</div>
		  </div>
		  <div class="form-group row">
			<label for="mail" class="col-sm-2 col-form-label">E-Mail</label>
			<div class="col-sm-4">
			  <input type="text" class="form-control" id="mail" name="mail" value="<?php echo $res['email']; ?>" placeholder="Mail" readonly>
			</div>
			<label for="phone" class="col-sm-2 col-form-label">Phone</label>
			<div class="col-sm-4">
			  <input type="number" class="form-control" id="phone" name="phone" value="<?php echo $res['phone']; ?>" placeholder="Phone" readonly>
			</div>
		  </div>
		  <div class="form-group row">
			<label for="dob" class="col-sm-2 col-form-label">Date of Birth</label>
			<div class="col-sm-4">
			  <input type="date" class="form-control" id="dob" name="dob" value="<?php echo $res['DOB']; ?>" placeholder="Date of Birth" readonly>
			</div>
			<label for="doj" class="col-sm-2 col-form-label">Date of Join</label>
			<div class="col-sm-4">
			  <input type="date" class="form-control" id="doj" name="doj" value="<?php echo $res['doj']; ?>" placeholder="Date of Join" readonly>
			</div>
		  </div>
		  <div class="form-group row">
			<label for="department" class="col-sm-2 col-form-label">Department</label>
			<div class="col-sm-4">
			 <input type="text" class="form-control" id="doj" name="doj" value="<?php echo $res['department']; ?>" placeholder="Date of Join" readonly>
			</div>
			<label for="designation" class="col-sm-2 col-form-label">Designation</label>
			<div class="col-sm-4">
			   <input type="text" class="form-control" id="doj" name="doj" value="<?php echo $res['designation']; ?>" placeholder="Date of Join" readonly>
			</div>
		  </div>
		  <div class="form-group row">
			<label for="country" class="col-sm-2 col-form-label">Country</label>
			<div class="col-sm-4">
			  <input type="text" class="form-control" id="country" name="country" value="<?php echo $res['country']; ?>" placeholder="Country" readonly>
			</div>
			<label for="region" class="col-sm-2 col-form-label">Region</label>
			<div class="col-sm-4">
			  <input type="text" class="form-control" id="region" name="region" value="<?php echo $res['region']; ?>" placeholder="Region" readonly>
			</div>
		  </div>
		  <div class="form-group row">
			<label for="city" class="col-sm-2 col-form-label">City</label>
			<div class="col-sm-4">
			  <input type="text" class="form-control" id="city" name="city"  value="<?php echo $res['city']; ?>" placeholder="City" readonly>
			</div>
			<label for="address" class="col-sm-2 col-form-label">Address</label>
			<div class="col-sm-4">
			  <input type="textarea" class="form-control" id="address" name="address" value="<?php echo $res['address']; ?>" placeholder="Address" readonly>
			</div>
		  </div>
		  <div class="form-group row">
			<label for="id_type" class="col-sm-2 col-form-label">Id Type</label>
			<div class="col-sm-4">
			  <input type="text" class="form-control" id="id_type" name="id_type" value="<?php echo $res['id_type']; ?>" placeholder="Id Type" readonly>
			</div>
			<label for="id_number" class="col-sm-2 col-form-label">Id Number</label>
			<div class="col-sm-4">
			  <input type="text" class="form-control" id="id_number" name="id_number" value="<?php echo $res['id_number']; ?>" placeholder="Id Number" readonly>
			</div>
		  </div>
		  <div class="form-group row">
			<label for="designation" class="col-sm-2 col-form-label">Leave Type</label>
			<div class="col-sm-4">
			   <input type="text" class="form-control" id="id_number" name="id_number" value="<?php echo $res['type']; ?>" placeholder="Id Number" readonly>
			</div>
			<label for="remark" class="col-sm-2 col-form-label">Remark</label>
			<div class="col-sm-4">
			  <input type="textarea" class="form-control" id="remark" name="remark" value="<?php echo $res['remark']; ?>" placeholder="Remark" readonly>
			</div>
		  </div>
		
	</form>
    </div>
  </div>
</div>
</div>
<script>
function employee()
{
  $.ajax({
    type:"POST",
    url:"/Admin/HR_Management/employees/main.php",
    success:function(data){
      $("#main_content").html(data);
    }
  })
}
</script>