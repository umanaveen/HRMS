<?php
require '../../../connect.php';
 $id=$_REQUEST['id'];
$stmt = $con->prepare("select * from sim_master where id='$id'");
$stmt->execute(); 
$row = $stmt->fetch();
$sta=$row['status'];
?>
<div class="container-fluid">
<div class="card mb-3">
<div class="card-header">
<i class="fa fa-table"></i> Sim Details Edit
<a onclick="return back_ctc()" style="float: right;" data-toggle="modal" class="btn btn-primary">Back</a>
</div>
<div class="card-body" id="printableArea">
<form role="form" name="" action="HRMS/Assets/sim_master/update_sim.php" method="post" enctype="multipart/type">

<table class="table table-bordered">
<tr>
<td><center><img src="../../Recruitment/image/userlog/bluebase.png" alt="quadsel" style="width:100px;height:50px;"></center></td>
<td colspan="5"><center><b>Bluebase Software services Pvt Ltd</b></center></td>
</tr>
<tr>
<td> Provider Name:</td>

<td colspan="2">
<input type="hidden" name="sid" id="sid" value="<?php echo $id;?>">
<input type="text" class="form-control" id="provider_name" name="provider_name" value="<?php echo $row['provider_name'];?>"></td>
</tr>
<tr>
<td> Phone Number:</td>
<td colspan="2"><input type="text" class="form-control" id="phone_no" name="phone_no"  value="<?php echo $row['phone_no'];?>"></td>
</tr>
<tr>
<td>Activation Date</td>
<td colspan="2"><input type="date" class="form-control" id="activation_date" name="activation_date"  value="<?php echo $row['activation_date'];?>"></td>
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
