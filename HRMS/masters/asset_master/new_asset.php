<?php
require '../../../connect.php';
include("../../../user.php");
$userrole=$_SESSION['userrole'];
?>
<div class="container-fluid">
<div class="card mb-3">

<form method="POST" action="HRMS/masters/asset_master/asset_submit.php">
<input type="hidden" name="userrole" id="userrole" value="<?php echo  $userrole; ?>">
<table class="table table-bordered">
<tr>
<td><center><img src="../../Recruitment/image/userlog/bluebase.png" alt="quadsel" style="width:100px;height:50px;"></center></td>
<td colspan="5"><center><b>Bluebase Software services Pvt Ltd</b></center></td>
</tr>
<tr>
<td> Name:</td>
<td colspan="2"><input type="text" class="form-control" id="asset_name" name="asset_name" ></td>
</tr> 
<tr>
<td> Asset Type:</td>
<td colspan="2">
<select class="form-control" id="asset_type" name="asset_type">
		<option value="It Asset">It Asset</option>
		<option value="NonIt Asset">NonIt Asset </option>
        </select>
</td>
</tr> 
<tr>
<td> Prefix Code:</td>
<td colspan="2"><input type="text" class="form-control" id="prefix_code" name="prefix_code" ></td>
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
