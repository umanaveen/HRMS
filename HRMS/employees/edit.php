<?php
require '../../connect.php';
$ids=$_REQUEST['ids'];
 $edit_id=$con->query("select * from masters_employee where id='$ids'");
$res = $edit_id->fetch();
$dept_id=$res['department'];
$desg_id=$res['designation'];
$leave_type_id=$res['type'];
$salary_id=$res['salary'];
$dept_det = $con->query("SELECT * FROM masters_department where status=1 and id='$dept_id'");
$row1 = $dept_det->fetch();
$dept_name=$row1['name'];
$desg_det = $con->query("SELECT * FROM masters_desigination where id='$desg_id'");
$row2 = $desg_det->fetch();
$desg_name=$row2['name'];
$leave_det = $con->query("SELECT * FROM leave_category where status=1 and id='$leave_type_id'");
$row3 = $leave_det->fetch();
$leave_types=$row3['type'];
$salary_det = $con->query("SELECT * FROM master_scale_master where status=1 and id='$salary_id'");
$row4 = $salary_det->fetch();
$scale_names=$row4['scale_name'];
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
			  <select class="form-control" id="gender" name="gender" placeholder="Choose Gender">
			  <option value="<?php echo $res['gender']; ?>"><?php echo  $res['gender']; ?></option>
				<?php if($res['gender']=="female"){ ?>  <option value="male"> Male </option> <?php } else { ?>
				<option value="female"> Female </option> <?php } ?>
			  </select>
			</div>
		  </div>
		  <div class="form-group row">
			<label for="name" class="col-sm-2 col-form-label">First Name</label>
			<div class="col-sm-4">
			  <input type="text" class="form-control" id="first_name" name="first_name" placeholder="First Name" value="<?php echo $res['first_name']; ?>" autocomplete="off">
			</div>
			<label for="lname" class="col-sm-2 col-form-label">Last Name</label>
			<div class="col-sm-4">
			  <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last Name" value="<?php echo $res['last_name']; ?>" autocomplete="off">
			</div>
		  </div>
		  <div class="form-group row">
			<label for="uname" class="col-sm-2 col-form-label">User Name</label>
			<div class="col-sm-4">
			  <input type="text" class="form-control" id="user_name" name="user_name" placeholder="User Name" value="<?php echo $res['user_name']; ?>" autocomplete="off">
			</div>
			</div>	
			 <div class="form-group row">
			<label for="salary" class="col-sm-2 col-form-label">Salary</label>
			<div class="col-sm-4">
			      <input type="text" class="form-control" id="remark" name="remark" value="<?php echo $res['salary']; ?>" placeholder="Remark" readonly>
		  </div>
		  </div>
		  <div class="form-group row">
			<label for="mail" class="col-sm-2 col-form-label">E-Mail</label>
			<div class="col-sm-4">
			  <input type="text" class="form-control" id="mail" name="mail" placeholder="Mail" value="<?php echo $res['email']; ?>" autocomplete="off">
			</div>
			<label for="phone" class="col-sm-2 col-form-label">Phone</label>
			<div class="col-sm-4">
			  <input type="number" class="form-control" id="phone" name="phone" placeholder="Phone" value="<?php echo $res['phone']; ?>" autocomplete="off">
			</div>
		  </div>
		  <div class="form-group row">
			<label for="dob" class="col-sm-2 col-form-label">Date of Birth</label>
			<div class="col-sm-4">
			  <input type="date" class="form-control" id="dob" name="dob" placeholder="Date of Birth" value="<?php echo $res['DOB']; ?>">
			</div>
			<label for="doj" class="col-sm-2 col-form-label">Date of Join</label>
			<div class="col-sm-4">
			  <input type="date" class="form-control" id="doj" name="doj" placeholder="Date of Join" value="<?php echo $res['doj']; ?>">
			</div>
		  </div>
		  <div class="form-group row">
			<label for="department" class="col-sm-2 col-form-label">Department</label>
			<div class="col-sm-4">
			  <select class="form-control" id="department" name="department" placeholder="Department">
			  <option value="<?php echo $dept_id; ?>"> <?php echo $dept_name; ?> </option>
			 <?php $stmt = $con->query("SELECT * FROM masters_department where status=1 and id!='$dept_id'");
					while ($row = $stmt->fetch()) {?>
					 <option value="<?php echo $row['id']; ?>"> <?php echo $row['name']; ?> </option>
				<?php } ?>
				</select>
			</div>
			<label for="designation" class="col-sm-2 col-form-label">Designation</label>
			<div class="col-sm-4">
			   <select class="form-control" id="designation" name="designation" placeholder="designation">
			  <option value="<?php echo $desg_id; ?>"> <?php echo $desg_name; ?> </option>
			 <?php $stmt = $con->query("SELECT * FROM masters_desigination where status=1 and id!='$desg_id'");
					while ($row = $stmt->fetch()) {?>
					 <option value="<?php echo $row['id']; ?>"> <?php echo $row['name']; ?> </option>
				<?php } ?>
				</select>
			</div>
		  </div>
		  <div class="form-group row">
			<label for="country" class="col-sm-2 col-form-label">Country</label>
			<div class="col-sm-4">
			  <input type="text" class="form-control" id="country" name="country" placeholder="Country"  value="<?php echo $res['country']; ?>" autocomplete="off">
			</div>
			<label for="region" class="col-sm-2 col-form-label">Region</label>
			<div class="col-sm-4">
			  <input type="text" class="form-control" id="region" name="region" placeholder="Region"  value="<?php echo $res['region']; ?>" autocomplete="off">
			</div>
		  </div>
		  <div class="form-group row">
			<label for="city" class="col-sm-2 col-form-label">City</label>
			<div class="col-sm-4">
			  <input type="text" class="form-control" id="city" name="city" placeholder="City"  value="<?php echo $res['city']; ?>" autocomplete="off">
			</div>
			<label for="address" class="col-sm-2 col-form-label">Address</label>
			<div class="col-sm-4">
			  <input type="textarea" class="form-control" id="address" name="address" placeholder="Address"  value="<?php echo $res['address']; ?>" autocomplete="off">
			</div>
		  </div>
		  <div class="form-group row">
			<label for="id_type" class="col-sm-2 col-form-label">Id Type</label>
			<div class="col-sm-4">
			  <input type="text" class="form-control" id="id_type" name="id_type" placeholder="Id Type" autocomplete="off"  value="<?php echo $res['id_type']; ?>">
			</div>
			<label for="id_number" class="col-sm-2 col-form-label">Id Number</label>
			<div class="col-sm-4">
			  <input type="text" class="form-control" id="id_number" name="id_number" placeholder="Id Number" autocomplete="off"  value="<?php echo $res['id_number']; ?>">
			</div>
		  </div>
		  <div class="form-group row">
			<label for="designation" class="col-sm-2 col-form-label">Leave Type</label>
			<div class="col-sm-4">
			   <select class="form-control" id="leave_type" name="leave_type" placeholder="Leave">
			  <option value="<?php echo $leave_type_id; ?>"> <?php echo $leave_types; ?> </option>
			 <?php $stmt = $con->query("SELECT * FROM leave_category where status=1 and id!='$leave_type_id'");
					while ($row = $stmt->fetch()) {?>
					 <option value="<?php echo $row['leave_ids']; ?>"> <?php echo $row['type']; ?> </option>
				<?php } ?>
				</select>
			</div>
			<label for="remark" class="col-sm-2 col-form-label">Remark</label>
			<div class="col-sm-4">
			  <input type="textarea" class="form-control" id="remark" name="remark" placeholder="Remark"  value="<?php echo $res['remark']; ?>" autocomplete="off">
			</div>
		  </div>
		   <div class="form-group row">
			<label for="salary" class="col-sm-2 col-form-label">Salary</label>
			<div class="col-sm-10">
			     <select class="form-control" id="salary" name="salary" placeholder="salary">
			  <option value="<?php echo $salary_id; ?>"> <?php echo $scale_names; ?> </option>
			 <?php $stmt = $con->query("SELECT * FROM master_scale_master where status=1 and id!='$salary_id'");
					while ($row = $stmt->fetch()) {?>
					 <option value="<?php echo $row['id']; ?>"> <?php echo $row['scale_name']; ?> </option>
				<?php } ?>
				</select>
			</div>
		  </div>
		  <div class="form-group row">
			<div class="col-sm-10"></div>
			<div class="col-sm-2">
			  <input type="button" class="btn btn-primary btn-md" onclick="employee_upate()" value="upate">
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
function employee_upate()
{
	var field=1;
	var data = $('form').serialize();
	$.ajax({
		type:'GET',
		data:"field="+field, data,
		url:'/Admin/HR_Management/employees/employees_update.php',
		success:function(data)
		{
			if(data)
			{
				alert("Employee Update");
				employee();
			}
			else
			{
				alert("Employee Not Updated");
				employee();
			}		
		}       
	});
}
</script>
