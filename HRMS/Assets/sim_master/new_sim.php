<?php
require '../../../connect.php';
include("../../../user.php");
$userrole=$_SESSION['userrole'];
?>
<div class="container-fluid">
<div class="card mb-3">

<form method="POST" action="HRMS/Assets/sim_master/sim_submit.php">
<input type="hidden" name="userrole" id="userrole" value="<?php echo  $userrole; ?>">
<table class="table table-bordered">
<tr>
<td><center><img src="../../Recruitment/image/userlog/bluebase.png" alt="quadsel" style="width:100px;height:50px;"></center></td>
<td colspan="5"><center><b>Bluebase Software services Pvt Ltd</b></center></td>
</tr>
<tr>
<td> Provider Name:</td>
<td colspan="2"><input type="text" class="form-control" id="provider_name" name="provider_name" ></td>
</tr>
<tr>
<td> Phone Number:</td>
<td colspan="2"><input type="text" class="form-control" id="phone_no" name="phone_no" ></td>
</tr>
<tr>
<td>Activation Date</td>
<td colspan="2"><input type="date" class="form-control" id="activation_date" name="activation_date" ></td>
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
