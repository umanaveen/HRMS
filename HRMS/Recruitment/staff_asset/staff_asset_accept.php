<?php
require '../../../connect.php';
 $id=$_REQUEST['id'];
$stmt = $con->prepare("SELECT name,s.asset_master_id as asset_master_id,s.cug_status as cug_status,s.*,a.*,f.*,m.*,sm.* FROM `staff_access_request` s join staff_asset_list a on s.id=a.asset_request_id join assets_form_detail f on a.asset_id=f.id join assets_master m on f.asset_name=m.id left join sim_master sm on a.sim_id=sm.id where s.id='$id'");
$stmt->execute(); 
$row = $stmt->fetch();

$sid=$row['staff_id'];
$access=$row['asset_master_id'];
 $cug_status=$row['cug_status'];
$phone_no=$row['phone_no'];
$mail_id=$row['mail_id'];

$staff_mas=$con->query("select * from staff_master where id='$sid'");
$stafet=$staff_mas->fetch();
$dep=$stafet['dep_id'];
?>
<div class="container-fluid">
<div class="card mb-3">
<div class="card-header">
<i class="fa fa-table"></i>Allocated Assets
<a onclick="back()" style="float: right;" data-toggle="modal" class="btn btn-danger">Back</a>
</div>
<div class="card-body" id="printableArea">
<form role="form" name="" action="HRMS/Recruitment/staff_asset/staff_asset_accept_submit.php" method="post" enctype="multipart/type">

<table class="table table-bordered">
<tr>
<td><center><img src="../../Recruitment/image/userlog/bluebase.png" alt="quadsel" style="width:100px;height:50px;"></center></td>
<td colspan="5"><center><b>Bluebase Software services Pvt Ltd</b></center></td>
</tr>
<tr>
<td>Employee Name:</td>
<td colspan="2">
<input type="hidden" name="sid" id="sid" value="<?php echo $sid;?>">
<input type="hidden" name="reqid" id="reqid" value="<?php echo $id;?>">
<?php
$dep_sql1=$con->query("SELECT * FROM staff_master where id='$sid' ");
$fet=$dep_sql1->fetch();		
		?>
		<input type="text" name="emp_name" id="emp_name" class="form-control" value="<?php echo $fet['emp_name'];?>" readonly>
		</td>
</tr>


<?php
$isel=$con->query("select distinct m.id as id,name,a.Serial_no as Serial_no from assets_form_detail a join assets_master m on a.asset_name=m.id where a.asset='Internal Asset' and m.id in($access) and a.id in(select asset_id from staff_asset_list where staff_id='$sid') ");

/* echo "select distinct m.id as id,name,a.Serial_no as Serial_no from assets_form_detail a join assets_master m on a.asset_name=m.id where a.asset='Internal Asset' and m.id in($access)"; */
$i=0;
$s=1;
while($dfet=$isel->fetch())
{
	$mid=$dfet['id'];
		 ?>
	<tr>	 
<td><?php echo $dfet['name'];?></td>
<td><?php echo $dfet['Serial_no'];?></td>

</tr>

</div>
 
 <?php		 
 
 	$i++;
	$s++;
}

?>
<?php 
	if($cug_status=='Yes')
	{
	?>
<tr>
	
<td>CUG:</td>
<td>
<input type="hidden" name="cug_sta" id="cug_sta" value="<?php echo $cug_status;?>">
<input type="text" class="form-control" name="cug" id="cug" value="<?php echo $row['phone_no'];?>" readonly>

</td>
</tr>
<?php 
	}
	?>
<tr>
<td>Mail Id</td>
<td><input type="text" name="mail_id" id="mail_id" class="form-control" value="<?php echo $mail_id;?>" readonly></td>
</tr>
</table>


<!--table class="table table-bordered">
<tr>
<td>Status:</td>
<td>
 
<select name="status" id="status" class="form-control">
<option value="1">Active</option>
<option value="2">In-Active</option>
</select>

</td>
</tr>
</table-->
<input type="submit" name="submit" class="btn btn-primary btn-md" value="I Accept"style="float:right;">
</form>
</div>
</div>
</div>
<script>
		function back()
    {
    $.ajax({
    type:"POST",
    url:"/HRMS/HRMS/Recruitment/staff_asset/staff_asset_accept_list.php",
    success:function(data){
    $("#main_content").html(data);
    }
    })
  }
 </script>
