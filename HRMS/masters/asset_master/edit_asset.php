<?php
require '../../../connect.php';
 $id=$_REQUEST['id'];
$stmt = $con->prepare("select * from assets_master where id='$id'");
$stmt->execute(); 
$row = $stmt->fetch();
$sta=$row['status'];
?>
<div class="container-fluid">
<div class="card mb-3">
<div class="card-header">
<i class="fa fa-table"></i> Asset Edit
<a onclick="return back_ctc()" style="float: right;" data-toggle="modal" class="btn btn-primary">Back</a>
</div>
<div class="card-body" id="printableArea">
<form role="form" name="" action="HRMS/masters/asset_master/update_asset.php" method="post" enctype="multipart/type">

<table class="table table-bordered">
<tr>
<td><center><img src="../../Recruitment/image/userlog/bluebase.png" alt="quadsel" style="width:100px;height:50px;"></center></td>
<td colspan="5"><center><b>Bluebase Software services Pvt Ltd</b></center></td>
</tr>
<tr>
<td>Name</td>
<td colspan="5">
<input type="hidden" class="form-control" id="id" name="id" value="<?php echo  $id;?>">
<input type="text" class="form-control" id="asset_name" name="asset_name" value="<?php echo  $row['name'];?>">
</td>
</tr>
<tr>
<td> Asset Type:</td>
<td colspan="2">
<?php 
if($row['type']=='It Asset')
{
?>
<select class="form-control" id="asset_type" name="asset_type">
		<option value="It Asset">It Asset</option>
		<option value="NonIt Asset">NonIt Asset </option>
        </select>
		<?php
}
else{
	?>
	<select class="form-control" id="asset_type" name="asset_type">
		<option value="NonIt Asset">NonIt Asset </option>
		<option value="It Asset">It Asset</option>
        </select>
	<?php 
}
?>
</td>
</tr>
<tr>
<td>Prefix Code</td>
<td colspan="5">

<input type="text" class="form-control" id="prefix_code" name="prefix_code" value="<?php echo  $row['prefix_code'];?>">
</td>
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
