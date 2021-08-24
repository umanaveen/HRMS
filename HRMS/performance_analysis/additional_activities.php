<?php
require '../../connect.php';
include("../../user.php");
$userrole=$_SESSION['userrole'];
$candidateid=$_SESSION['candidateid'];



?>
<div class="container-fluid">
<div class="card mb-3">

<form method="POST" action="HRMS/performance_analysis/activities_submit.php">
<input type="hidden" name="userrole" id="userrole" value="<?php echo  $userrole; ?>">
<table class="table table-bordered">
<tr>
<td><center><img src="../../Recruitment/image/userlog/bluebase.png" alt="quadsel" style="width:100px;height:50px;"></center></td>
<td colspan="5"><center><b>Bluebase Software services Pvt Ltd</b></center></td>
</tr>
<tr>
<td>Employee</td>
<?php 
if($candidateid==0)
{
	$sta=$con->query("select * from staff_master where status=1");
	?>
	<td>
	<select name="emp_name" id="emp_name" class="form-control">
	<?php 
	while($dis=$sta->fetch())
	{
		?>
		<option value="<?php echo $dis['id'];?>"><?php echo $dis['emp_name'];?></option>
		<?php
	}
	?>
	</td>
	<?php
}
else
{
	$sta1=$con->query("select * from staff_master where status=1 and candid_id='$candidateid'");
	$fet=$sta1->fetch();
	?>
	<td>
	<input type="hidden" name="emp_name" id="emp_name" class="form-control" value="<?php echo $fet['id'];?>" readonly>
	<input type="text" name="emp_id" id="emp_id" class="form-control" value="<?php echo $fet['emp_name'];?>" readonly>
	</td>
	<?php 
}
?>
</tr>
<tr>
<td>Type</td>
<td colspan="2">
<select name="type" id="type" class="form-control">
<option value="">Select Type</option>
<option value="WorkShop">WorkShop</option>
<option value="Certification">Certification</option>
<option value="Training">Training</option>
</select>
</td>
</tr>

<tr>
<td>Course Name</td>
<td colspan="2">
<input type="text" name="course" id="course" class="form-control">
</td>
</tr>
<tr>
<td>Conducted by</td>
<td colspan="2">
<input type="text" name="conducted_by" id="conducted_by" class="form-control">
</td>
</tr>
<tr>
<td>Conducted Date</td>
<td colspan="2">
<input type="date" name="conducted_date" id="conducted_date" class="form-control">
</td>
</tr>
</table>
<input type="submit" name="submit" class="btn btn-primary btn-md" style="float:right;">
</form>
