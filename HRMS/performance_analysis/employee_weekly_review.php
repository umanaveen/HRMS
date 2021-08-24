<?php
require '../../connect.php';
include("../../user.php");
$userrole=$_SESSION['userrole'];
$candidateid=$_SESSION['candidateid'];
$wid=$_REQUEST['id'];
$sel=$con->query("select * from weekly_review w join staff_master s on w.staff_id=s.id where w.id='$wid'");
$selfet=$sel->fetch();
$emp_name=$selfet['emp_name'];
$we1=$selfet['week1'];
$we2=$selfet['week2'];
$we3=$selfet['week3'];
$we4=$selfet['week4'];
?>
<div class="container-fluid">
<div class="card mb-3">

<form method="POST" action="HRMS/performance_analysis/weekly_review_submit.php">
<input type="hidden" name="userrole" id="userrole" value="<?php echo  $userrole; ?>">
<input type="hidden" name="wid" id="wid" value="<?php echo  $wid; ?>">
<table class="table table-bordered">
<tr>
<td><center><img src="../../Recruitment/image/userlog/bluebase.png" alt="quadsel" style="width:100px;height:50px;"></center></td>
<td colspan="5"><center><b>Bluebase Software services Pvt Ltd</b></center></td>
</tr>
<tr>
<td>Employee</td>

	
	<td><input type="text" name="emp_name" id="emp_name" class="form-control" value="<?php echo $emp_name;?>" readonly></td>
	
</tr>

<?php 
if($we1=='')
{
	?>
	<tr>
<td>Week 1</td>
<td colspan="2">
<input type="text" name="week1" id="week1" class="form-control">
</td>
</tr>
	<?php
}
else
{
	?>
	<tr>
<td>Week 1</td>
<td colspan="2">
<input type="text" name="week1" id="week1" class="form-control" value="<?php echo $we1;?>" readonly>
</td>
</tr>
	<?php
}
?>

<?php 
if($we2=='')
{
	?>
	<tr>
<td>Week 2</td>
<td colspan="2">
<input type="text" name="week2" id="week2" class="form-control">
</td>
</tr>
	<?php
}
else
{
	?>
	<tr>
<td>Week 2</td>
<td colspan="2">
<input type="text" name="week2" id="week2" class="form-control" value="<?php echo $we2;?>" readonly>
</td>
</tr>
	<?php
}
?>

<?php
if($we3=='')
{
	?>

<tr>
<td>Week 3</td>
<td colspan="2">
<input type="text" name="week3" id="week3" class="form-control">
</td>
</tr>
	<?php
}
else
{
	?>
	<tr>
<td>Week 3</td>
<td colspan="2">
<input type="text" name="week3" id="week3" class="form-control" value="<?php echo $we3;?>" readonly>
</td>
</tr>
	<?php
}
?>

<?php
if($we4=='')
{
	?>

<tr>
<td>Week 4</td>
<td colspan="2">
<input type="text" name="week4" id="week4" class="form-control">
</td>
</tr>
	<?php
}
else
{
	?>
	<tr>
<td>Week 4</td>
<td colspan="2">
<input type="text" name="week4" id="week4" class="form-control" value="<?php echo $we4;?>" readonly>
</td>
</tr>
	<?php
}
?>




</table>
<input type="submit" name="submit" class="btn btn-primary btn-md" style="float:right;" value="Update">

</form>
