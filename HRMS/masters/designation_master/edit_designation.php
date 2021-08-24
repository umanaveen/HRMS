<?php
require '../../../connect.php';
 $id=$_REQUEST['id'];
$stmt = $con->prepare("select * from designation_master where id='$id'");
$stmt->execute(); 
$row = $stmt->fetch();
$sta=$row['status'];
$did=$row['dep_id'];
?>
<div class="container-fluid">
<div class="card mb-3">
<div class="card-header">
<i class="fa fa-table"></i> DEPARTMENT DETAILS EDIT
<!--a onclick="return back_ctc()" style="float: right;" data-toggle="modal" class="btn btn-primary">Back</a-->
</div>
<div class="card-body" id="printableArea">
<form role="form" name="" action="HRMS/masters/designation_master/update_designation.php" method="GET" enctype="multipart/type">

<table class="table table-bordered">
<tr>
<td><center><img src="../../Recruitment/image/userlog/bluebase.png" alt="quadsel" style="width:100px;height:50px;"></center></td>
<td colspan="5"><center><b>Bluebase Software services Pvt Ltd</b></center></td>
</tr>
<tr>
<td>Department ID:</td>
<td colspan="5">
<input type="hidden" class="form-control" id="id" name="id" value="<?php echo  $id;?>">
<select class="form-control" name="dep_id">
<?php
$dep_sql1=$con->query("SELECT * FROM z_department_master where id='$did' ");
$fet=$dep_sql1->fetch();
?>

		<option value="<?php echo $fet['id'];?>"><?php echo $fet['dept_name'];?></option>
		<?php
		$dep_sql=$con->query("SELECT * FROM z_department_master");
		while($dep_sql_res=$dep_sql->fetch(PDO::FETCH_ASSOC))
		{
			?>
			<option value="<?php echo $dep_sql_res['id']; ?>"><?php echo $dep_sql_res['dept_name']; ?></option>
			<?php
		}
		?>
		</select>
</td>
</tr>
<tr>
<td>Designation Name:</td>
<td colspan="5">
<input type="text" class="form-control" id="designation_name" name="designation_name" value="<?php echo  $row['designation_name'];?>">
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
