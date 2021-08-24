<?php
require '../../../connect.php';
 $id=$_REQUEST['id'];
$stmt = $con->prepare("select * from sim_mapping where id='$id'");
$stmt->execute(); 
$row = $stmt->fetch();
$sta=$row['status'];
$dep=$row['department_id'];
$phone=$row['sim_id'];
?>
<div class="container-fluid">
<div class="card mb-3">
<div class="card-header">
<i class="fa fa-table"></i> Sim Details Edit
<a onclick="return back_ctc()" style="float: right;" data-toggle="modal" class="btn btn-primary">Back</a>
</div>
<div class="card-body" id="printableArea">
<form role="form" name="" action="HRMS/Assets/sim_mapping/update_sim_mapping.php" method="post" enctype="multipart/type">

<table class="table table-bordered">
<tr>
<td><center><img src="../../Recruitment/image/userlog/bluebase.png" alt="quadsel" style="width:100px;height:50px;"></center></td>
<td colspan="5"><center><b>Bluebase Software services Pvt Ltd</b></center></td>
</tr>
<tr>
<td> Department:</td>
<td colspan="2">
<input type="hidden" id="sid" name="sid" value="<?php echo $id;?>">
<select name="department" id="department" class="form-control">
<?php 
$sel1=$con->query("select * from z_department_master where status=1 and id='$dep'");
$setlfet=$sel1->fetch();
?>
<option value="<?php echo $setlfet['id'];?>"><?php echo $setlfet['dept_name'];?></option>
<?php 
$sel=$con->query("select * from z_department_master where status=1 and id !='$dep'");
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
<?php 
$sel1=$con->query("select * from sim_master where status=1 and id='$phone'");
$setlfet=$sel1->fetch();
?>
<option value="<?php echo $setlfet['id'];?>"><?php echo $setlfet['phone_no'];?></option>
<?php 
$sel=$con->query("select * from sim_master where status=1 and id!='$phone'");
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
<?php

if($sta==0)
{
	?>
<option value="0">InActive</option>
<option value="1">Active</option>
<?php	
}
else{
	?>
	<option value="1">Active</option>
	<option value="0">InActive</option>
	<?php
}
?>

</select>
</td>
</tr>
</table>

<input type="submit" name="submit" class="btn btn-primary btn-md" style="float:right;">
</form>
</div>
</div>
</div>
