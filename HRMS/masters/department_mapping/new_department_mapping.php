<?php
require '../../../connect.php';
include("../../../user.php");
$userrole=$_SESSION['userrole'];
?>
<div class="container-fluid">
<div class="card mb-3">

<form method="POST" action="HRMS/masters/department_mapping/depmapping_submit.php">
<input type="hidden" name="userrole" id="userrole" value="<?php echo  $userrole; ?>">
<table class="table table-bordered">
<tr>
<td><center><img src="../../Recruitment/image/userlog/bluebase.png" alt="quadsel" style="width:100px;height:50px;"></center></td>
<td colspan="5"><center><b>Bluebase Software services Pvt Ltd</b></center></td>
</tr>
<tr>
<td>Company Name:</td>
<td colspan="2">
<select name="company" id="company" class="form-control">
<option value="">Select Company</option>
<?php
$sql=$con->query("SELECT * FROM company_master ");
      $i=1;
      while($cmp = $sql->fetch(PDO::FETCH_ASSOC))
      {
		  ?>
		  <option value="<?php echo $cmp['id'];?>"><?php echo $cmp['companyname'];?></option>
		  <?php
	  }
		  ?>
		  </select>
</td>
</tr>
<tr>
<td>Department Name:</td>
<td colspan="2">
<select name="department" id="department" class="form-control">
<option value="">Select Department</option>
<?php
$emp_sql=$con->query("SELECT * FROM z_department_master ");
      $i=1;
      while($emp_res = $emp_sql->fetch(PDO::FETCH_ASSOC))
      {
		  ?>
		  <option value="<?php echo $emp_res['id'];?>"><?php echo $emp_res['dept_name'];?></option>
		  <?php
	  }
		  ?>
		  </select>
</td>
</tr>
<tr>
<td>Head Name:</td>
<td colspan="2">
<select name="head" id="head" class="form-control">
<option value="">Select Head</option>
<?php
$emp_sql1=$con->query("SELECT * FROM staff_master where status=1");
     
      while($emp_res1 = $emp_sql1->fetch(PDO::FETCH_ASSOC))
      {
		  ?>
		  <option value="<?php echo $emp_res1['candid_id'];?>"><?php echo $emp_res1['emp_name'];?></option>
		  <?php
	  }
		  ?>
		  </select>
</td>
</tr>
<tr>
<td>Status</td>
<td colspan="2">
<select class="form-control" name="status" id="status">
<option value="">Select Status</option>
<option value="1">Active</option>
<option value="0">InActive</option>
</select>
</td>
</tr>
</table>
<input type="submit" name="submit" class="btn btn-primary btn-md" style="float:right;">
</form>
