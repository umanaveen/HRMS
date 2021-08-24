<?php
require '../../../connect.php';
 $id=$_REQUEST['id'];
$stmt = $con->prepare("select * from interview_rounds_mapping where id='$id'");
$stmt->execute(); 
$row = $stmt->fetch();
$sta=$row['status'];
$rd=$row['round_id'];
$iid=$row['person_name'];
?>
<div class="container-fluid">
<div class="card mb-3">
<div class="card-header">
<i class="fa fa-table"></i> Interview Rounds Mapping Edit
<!--a onclick="return back_ctc()" style="float: right;" data-toggle="modal" class="btn btn-primary">Back</a-->
</div>
<div class="card-body" id="printableArea">
<form role="form" name="" action="HRMS/masters/interview_rounds_mapping/update_interview_rounds_mapping.php" method="GET" enctype="multipart/type">

<table class="table table-bordered">
<tr>
<td><center><img src="../../Recruitment/image/userlog/bluebase.png" alt="quadsel" style="width:100px;height:50px;"></center></td>
<td colspan="5"><center><b>Bluebase Software services Pvt Ltd</b></center></td>
</tr>
<tr>
<input type="hidden" name="intid" id="intid" value="<?php echo $id;?>">
<td>Round ID</td>
<td colspan="2"><select class="form-control" name="round_id">
<?php
$dep_sql1=$con->query("SELECT * FROM interview_rounds where id='$id' ");
$fet=$dep_sql1->fetch();
?>
		<option value="<?php echo $fet['id'];?>"><?php echo $fet['name'];?></option>
		<?php
		$dep_sql=$con->query("SELECT * FROM interview_rounds");
		while($dep_sql_res=$dep_sql->fetch(PDO::FETCH_ASSOC))
		{
			?>
			<option value="<?php echo $dep_sql_res['id']; ?>"><?php echo $dep_sql_res['name']; ?></option>
			<?php
		}
		?>
		</select></td>

</tr>
<tr>
<td>Person Name:</td>
<td colspan="2"><select class="form-control" name="person_name">
<?php
$dep_sql1=$con->query("SELECT * FROM staff_master where id='$iid' ");
$fet=$dep_sql1->fetch();
?>
				<option value="<?php echo $fet['id'];?>"><?php echo $fet['emp_name'];?></option>
		<?php
		$dep_sql=$con->query("SELECT * FROM staff_master");
		while($dep_sql_res=$dep_sql->fetch(PDO::FETCH_ASSOC))
		{
			?>
			<option value="<?php echo $dep_sql_res['id']; ?>"><?php echo $dep_sql_res['emp_name']; ?></option>
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
