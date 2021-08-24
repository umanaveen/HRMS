<?php
require '../../../connect.php';
 $id=$_REQUEST['id'];
$stmt = $con->prepare("select *,d.id as dmid,c.companyname as cname,z.dept_name as dname,u.user_name as uname,d.status as dstatus from department_mapping d join z_department_master z on z.id=d.department_id join z_user_master u on u.user_id=d.department_head join company_master c on c.id=d.company_name where d.id='$id'");
$stmt->execute(); 
$row = $stmt->fetch();
$sta=$row['dstatus'];

?>
<div class="container-fluid">
<div class="card mb-3">
<div class="card-header">
<i class="fa fa-table"></i> DEPARTMENT DETAILS EDIT
<a onclick="return back_ctc()" style="float: right;" data-toggle="modal" class="btn btn-primary">Back</a>
</div>
<div class="card-body" id="printableArea">
<form role="form" name="" action="HRMS/masters/department_mapping/update_depmapping.php" method="post" enctype="multipart/type">

<table class="table table-bordered">
<tr>
<td><center><img src="../../Recruitment/image/userlog/bluebase.png" alt="quadsel" style="width:100px;height:50px;"></center></td>
<td colspan="5"><center><b>Bluebase Software services Pvt Ltd</b></center></td>
</tr>
<tr>
<td>Company Name:</td>
<td colspan="2">
<select name="company" id="company" class="form-control">
<option value="<?php echo $row['company_name'];?>"><?php echo $row['cname'];?></option>
<?php
$sql=$con->query("SELECT * FROM company_master ");
      $i=1;
      while($cmp = $sql->fetch(PDO::FETCH_ASSOC))
      {
		  ?>
		  <option value="<?php echo $cmp['id'];?>"><?php echo $cmp['companyname'];?></option>
		  <?php
	  }
		  ?>
		  </select>
</td>
</tr>
<tr>
<td>Department Name:</td>

<input type="hidden" class="form-control" id="id" name="id" value="<?php echo  $id;?>"readonly>

<td colspan="2">
<select name="department" id="department" class="form-control">
<option value="<?php echo $row['department_id'];?>"><?php echo $row['dname'];?></option>
<?php
$sql=$con->query("SELECT * FROM z_department_master ");
      $i=1;
      while($cmp = $sql->fetch(PDO::FETCH_ASSOC))
      {
		  ?>
		  <option value="<?php echo $cmp['id'];?>"><?php echo $cmp['dept_name'];?></option>
		  <?php
	  }
		  ?>
		  </select>
</td>
</tr>
<tr>
<td>Head Name:</td>

<input type="hidden" class="form-control" id="id" name="id" value="<?php echo  $id;?>"readonly>

<td colspan="2">
<select name="head" id="head" class="form-control">
<option value="<?php echo $row['department_head'];?>"><?php echo $row['uname'];?></option>
<?php
$sql=$con->query("SELECT * FROM staff_master where status=1");
      $i=1;
      while($cmp = $sql->fetch(PDO::FETCH_ASSOC))
      {
		  ?>
		  <option value="<?php echo $cmp['candid_id'];?>"><?php echo $cmp['emp_name'];?></option>
		  <?php
	  }
		  ?>
		  </select>
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
