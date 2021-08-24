<?php
require '../../connect.php';
$wid=$_REQUEST['eid'];

$sel=$con->query("select * from weekly_review w join staff_master s on w.staff_id=s.id where w.id='$wid'");
$selfet=$sel->fetch();
$emp_name=$selfet['emp_name'];
$we1=$selfet['week1'];
$we2=$selfet['week2'];
$we3=$selfet['week3'];
$we4=$selfet['week4'];
?>
<?php 
if($we1=='')
{
	?>
	<tr>
<td>Week 1</td>
<td colspan="2">
<input type="hidden" name="wid" id="wid" class="form-control" value="<?php echo $wid;?>">
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

