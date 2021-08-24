<?php
require '../../../connect.php';
include("../../../user.php");
$userrole=$_SESSION['userrole'];
?>
<div class="container-fluid">
<div class="card mb-3">

<form method="POST" action="HRMS/Assets/sim_mapping/sim_mapping_submit.php">
<input type="hidden" name="userrole" id="userrole" value="<?php echo  $userrole; ?>">
<table class="table table-bordered">
<tr>
<td><center><img src="../../Recruitment/image/userlog/bluebase.png" alt="quadsel" style="width:100px;height:50px;"></center></td>
<td colspan="5"><center><b>Bluebase Software services Pvt Ltd</b></center></td>
</tr>
<tr>
<td> Department:</td>
<td colspan="2">
<select name="department" id="department" class="form-control">
<option value="">Select Department</option>
<?php 
$sel=$con->query("select * from z_department_master where status=1");
while($dis=$sel->fetch())
{
	?>
	<option value="<?php echo $dis['id'];?>"><?php echo $dis['dept_name'];?></option>
<?php	
}
?>
</select>
 </td>
</tr>

<tr>
<td> Phone Number:</td>
<td colspan="2"><select name="phone_no" id="phone_no" class="form-control">
<option value="">Select Department</option>
<?php 
$sel=$con->query("select * from sim_master where status=1");
while($dis=$sel->fetch())
{
	?>
	<option value="<?php echo $dis['id'];?>"><?php echo $dis['phone_no'];?></option>
<?php	
}
?>
</select></td>
</tr>


<tr>
<td>Status</td>
<td colspan="2">
<select class="form-control" name="status" id="status">

<option value="1">Active</option>
<option value="0">InActive</option>
</select>
</td>
</tr>
</table>
<input type="submit" name="submit" class="btn btn-primary btn-md" style="float:right;">
</form>
