<?php
require '../../../connect.php';
 $id=$_REQUEST['id'];
$stmt = $con->prepare("select * from staff_asset where id='$id'");
$stmt->execute(); 
$row = $stmt->fetch();
$sid=$row['emp_name'];
$id=$row['pur_dept'];
?>
<div class="container-fluid">
<div class="card mb-3">
<div class="card-header">
<i class="fa fa-table"></i> DEPARTMENT DETAILS EDIT
<a onclick="back()" style="float: right;" data-toggle="modal" class="btn btn-primary">Back</a>
</div>
<div class="card-body" id="printableArea">
<form role="form" name="" action="HRMS/Recruitment/staff_asset/update_staff_asset.php" method="post" enctype="multipart/type">

<table class="table table-bordered">
<tr>
<td><center><img src="../../Recruitment/image/userlog/bluebase.png" alt="quadsel" style="width:100px;height:50px;"></center></td>
<td colspan="5"><center><b>Bluebase Software services Pvt Ltd</b></center></td>
</tr>
<tr>
<td>Employee Name:</td>
<td colspan="2"><select class="form-control" name="emp_name">
<?php
$dep_sql1=$con->query("SELECT * FROM staff_master where id='$sid' ");
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
<td>Stationaries:</td>
<td colspan="2">
<input type="text" class="form-control" id="stationaries" name="stationaries" value="<?php echo $row['stationaries'];?>"></td>
</td>
</tr>
<tr>
<td>System Or LapTop:</td>
<td colspan="2">
<input type="text" class="form-control" id="system_or_laptop" name="system_or_laptop" value="<?php echo $row['system_or_laptop'];?>"></td>
</td>
<td>Purchase Department:</td>
<td colspan="2">
<input type="hidden" class="form-control" id="pur_dept" name="pur_dept" value="<?php echo  $id; ?>">
<select class="form-control" name="pur_dept">
<?php
$dep_sql1=$con->query("SELECT * FROM staff_asset where id='$id' ");
$fet=$dep_sql1->fetch();
?>
				<option value="<?php echo $fet['id'];?>"><?php echo $fet['pur_dept'];?></option>
		<?php
		$dep_sql=$con->query("SELECT * FROM staff_asset");
		while($dep_sql_res=$dep_sql->fetch(PDO::FETCH_ASSOC))
		{
			?>
			<option value="<?php echo $dep_sql_res['id']; ?>"><?php echo $dep_sql_res['pur_dept']; ?></option>
			<?php
		}
		?>
		</select></td>
<td>Purchase Department:</td>
		<td colspan="2">
		 <input type="hidden" class="form-control" id="pur_dept" name="pur_dept" value="<?php echo  $id; ?>">
		<select class="form-control" id="pur_dept" name="pur_dept">
		<?php
$dep_sql1=$con->query("SELECT * FROM staff_asset where id='$id' ");
$fet=$dep_sql1->fetch();
?>
		<option value="<?php echo $dep_sql_res['id']; ?>"><?php echo $dep_sql_res['pur_dept']; ?></option>
		<option value="Ramakrishnan">Ramakrishnan</option>
		<option value="Kalai">Kalai</option>
		<?php
		$dep_sql=$con->query("SELECT * FROM staff_asset");
		while($dep_sql_res=$dep_sql->fetch(PDO::FETCH_ASSOC))
		{
			?>
			<option value="<?php echo $dep_sql_res['id']; ?>"><?php echo $dep_sql_res['pur_dept']; ?></option>
			<?php
		}
		?>
		</td>
</tr>
<tr>
<td>ID Card:</td>
<td colspan="2">
<input type="text" class="form-control" id="id_card" name="id_card" value="<?php echo $row['id_card'];?>"></td>
</td>
</tr><tr>
<td>CUG:</td>
<td colspan="2">
<input type="text" class="form-control" id="cug" name="cug" value="<?php echo $row['cug'];?>"></td>
</td>
</tr>
<tr>
<td>Access Card:</td>
<td colspan="2">
<input type="text" class="form-control" id="access_card" name="access_card" value="<?php echo $row['access_card'];?>"></td>
</td>
</tr>
<tr>
<td>ERP Access:</td>
<td colspan="2">
<input type="text" class="form-control" id="erp_access" name="erp_access" value="<?php echo $row['erp_access'];?>"></td>
</td>
</tr>
<tr>
<td>Mail ID:</td>
<td colspan="2">
<input type="text" class="form-control" id="mail_id" name="mail_id" value="<?php echo $row['mail_id'];?>"></td>
</td>
</tr>
</table>

<input type="submit" name="submit" class="btn btn-primary btn-md" style="float:right;">
</form>
</div>
</div>
</div>
<script>
		function back()
    {
    $.ajax({
    type:"POST",
    url:"/HRMS/HRMS/Recruitment/staff_asset/staff_asset.php",
    success:function(data){
    $(".content").html(data);
    }
    })
  }
  </script>
