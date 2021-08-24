<?php
require '../../../connect.php';
 $id=$_REQUEST['id'];
$stmt = $con->prepare("select * from staff_access_request where id='$id'");
$stmt->execute(); 
$row = $stmt->fetch();

$sid=$row['staff_id'];
$access=$row['asset_master_id'];
?>
<div class="container-fluid">
<div class="card mb-3">
<div class="card-header">
<i class="fa fa-table"></i> Asset Access Edit
<a onclick="back()" style="float: right;" data-toggle="modal" class="btn btn-primary">Back</a>
</div>
<div class="card-body" id="printableArea">
<form role="form" name="" action="HRMS/Recruitment/staff_asset/staff_access_update.php" method="post" enctype="multipart/type">

<table class="table table-bordered">
<tr>
<td><center><img src="../../Recruitment/image/userlog/bluebase.png" alt="quadsel" style="width:100px;height:50px;"></center></td>
<td colspan="5"><center><b>Bluebase Software services Pvt Ltd</b></center></td>
</tr>
<tr>
<td>Employee Name:</td>
<td colspan="2">
<input type="hidden" name="aid" id="aid" value="<?php echo $id;?>">
<?php
$dep_sql1=$con->query("SELECT * FROM staff_master where id='$sid' ");
$fet=$dep_sql1->fetch();		
		?>
		<input type="text" name="emp_name" id="emp_name" class="form-control" value="<?php echo $fet['emp_name'];?>" readonly>
		</td>
</tr>
<tr>
<td>Access:</td>
</tr>
</table>

<table class="dataTables-example table table-striped table-bordered table-hover"  id="example1">

<tr>
<td>
<?php
$isel=$con->query("select distinct m.id as id,name,a.Serial_no as Serial_no from assets_form_detail a join assets_master m on a.asset_name=m.id where a.asset='Internal Asset' and m.id in($access)");

$i=0;
$s=1;
while($dfet=$isel->fetch())
{
		 ?>
		 <div style="width:100%;float:left;padding: 5px 0px;">
	<div style="width:15%;float:left;margin-left: 113px;">
<input type="checkbox" name="View[]>" id="View<?php echo $i.$s++ ; ?>" checked  value="<?php echo $dfet['id'];?>" />&emsp;<?php echo $dfet['name'];?></div>

</div>
 
 <?php		 
 
 	$i++;
	$s++;
}

?>
<?php
$isel=$con->query("select distinct m.id as id,name,a.Serial_no as Serial_no from assets_form_detail a join assets_master m on a.asset_name=m.id where a.asset='Internal Asset' and m.id not in($access) ");

$i=0;
$s=1;
while($dfet=$isel->fetch())
{
		 ?>
		 <div style="width:100%;float:left;padding: 5px 0px;">
	<div style="width:15%;float:left;margin-left: 113px;">
<input type="checkbox" name="View[]>" id="View<?php echo $i.$s++ ; ?>"  value="<?php echo $dfet['id'];?>" />&emsp;<?php echo $dfet['name'];?></div>

</div>
 
 <?php		 
 
 	$i++;
	$s++;
}

?>
</td>
</tr>
</table>

<table class="table table-bordered">
<tr>
<td>CUG</td>

<td >
<select class="form-control" name="cug" id="cug">
<option value="Yes">Yes</option>
<option value="No">No</option>
</select>
</td>
</tr>
<tr>
<td>Status:</td>
<td>
 
<select name="status" id="status" class="form-control">
<option value="1">Active</option>
<option value="2">In-Active</option>
</select>

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
