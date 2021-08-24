<?php
require '../../../connect.php';
include("../../../user.php");
$userrole=$_SESSION['userrole'];
 $id=$_REQUEST['id'];
$stmt = $con->prepare("SELECT name,s.asset_master_id as asset_master_id,s.cug_status as cug_status,sm.status as sim_status,s.*,a.*,f.*,m.*,sm.* FROM `staff_access_request` s join staff_asset_list a on s.id=a.asset_request_id join assets_form_detail f on a.asset_id=f.id join assets_master m on f.asset_name=m.id left join sim_master sm on a.sim_id=sm.id where s.id='$id'");
$stmt->execute(); 
$row = $stmt->fetch();

$sid=$row['staff_id'];
$access=$row['asset_master_id'];
 $cug_status=$row['cug_status'];
$phone_no=$row['phone_no'];
$mail_id=$row['mail_id'];
$sim_id=$row['sim_id'];

$sim_map=$con->query("select * from sim_mapping where id='$sim_id' ");
$simfe=$sim_map->fetch();
$sim_status=$simfe['status'];

$staff_mas=$con->query("select * from staff_master where id='$sid'");
$stafet=$staff_mas->fetch();
$dep=$stafet['dep_id'];
$staff_name=$stafet['emp_name'];
?>
<!--div class="container-fluid"-->
<div class="card mb-3">

<form method="POST" action="HRMS/Recruitment/staff_asset/asset_return_submit.php">
<input type="hidden" name="userrole" id="userrole" value="<?php echo  $userrole; ?>">
<input type="hidden" name="reqid" id="reqid" value="<?php echo  $id; ?>">
<input type="hidden" name="simid" id="simid" value="<?php echo  $sim_id; ?>">
<input type="hidden" name="cugsta" id="cugsta" value="<?php echo $cug_status; ?>">
<table class="table table-bordered">
<tr>
<div class="row">
						 <!--div class="col-lg-12"-->
		  <a onclick=" back()" style="float: right;" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus"></i>BACK</a>


          </div>
                        <!-- /.col-lg-12 -->
                    </div>
</tr>
<tr>
<td><center><img src="../../Recruitment/image/userlog/bluebase.png" alt="quadsel" style="width:100px;height:50px;"></center></td>
<td colspan="5"><center><b>Bluebase Software services Pvt Ltd</b></center></td>
</tr>
<tr>
<td>Employee Name:</td>
<td colspan="2"><input type="text" class="form-control" name="emp_name" value="<?php echo $staff_name;?>" readonly>
		</td>
</tr>
<tr>
<td>Given Assets:</td>
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
</tr>

 
 <?php		 
 
 	$i++;
	$s++;
}

?>
<tr>
<?php 
if($sim_status==2)
{
	?>
	<td>Mobile No:</td>
	<td><?php echo $phone_no;?></td>
	<td>Mail Id:</td>
	<td><?php echo $mail_id;?></td>
	<?php
}
else
{
	?>
	<td>Mail Id:</td>
	<td><?php echo $mail_id;?></td>
	<?php
}
	?>
</tr>
<tr>
<td>Return:</td>
</tr>
</table>
<table class="dataTables-example table table-striped table-bordered table-hover"  id="example1">

<tr>
<td>
<?php
$isel=$con->query("select distinct m.id as id,name,a.Serial_no as Serial_no,a.id as aid from assets_form_detail a join assets_master m on a.asset_name=m.id where a.asset='Internal Asset' and m.id in($access) and a.id in(select asset_id from staff_asset_list where staff_id='$sid' and status=1)");
$i=1;
$s=1;
while($dfet=$isel->fetch())
{
	?>
	<div style="width:100%;float:left;padding: 5px 0px;">
	<div style="width:15%;float:left;margin-left: 113px;">
	
<input type="checkbox" name="View[]>" id="View<?php echo $i.$s++ ; ?>"   value="<?php echo $dfet['aid'];?>" />&emsp;<?php echo $dfet['name'];?></div>

</div>
	<?php
	$i++;
	$s++;
}?>

</td>
<td>
<?php 

?>
</td>
</tr>
</table>
<table  class="table table-bordered">
<tr>
<?php 
if($sim_status==2)
{
?>
<td>CUG</td>

<td colspan="2">
<select class="form-control" name="cug" id="cug">
<option value="Yes">Yes</option>
<option value="No">No</option>
</select>
</td>
<?php 
}
?>
</tr>
<!--tr>
<td>ID Card:</td>
<td colspan="2">
<input type="text" class="form-control" id="id_card" name="id_card" ></td>

</tr><tr>
<td>CUG:</td>
<td colspan="2">
<input type="text" class="form-control" id="cug" name="cug" ></td>

</tr>
<tr>
<td>Access Card:</td>
<td colspan="2">
<input type="text" class="form-control" id="access_card" name="access_card" ></td>

</tr>
<tr>
<td>ERP Access:</td>
<td colspan="2">
<input type="text" class="form-control" id="erp_access" name="erp_access"></td>
</tr>
<tr>
<td>Mail ID:</td>
<td colspan="2">
<input type="text" class="form-control" id="mail_id" name="mail_id" ></td>
</tr-->

</table>
<input type="submit" name="submit" class="btn btn-primary btn-md" style="float:right;">
</form>
<script>
		function back()
    {
    $.ajax({
    type:"POST",
    url:"/HRMS/HRMS/Recruitment/staff_asset/staff_assets_retuen_hr.php",
    success:function(data){
    $("#main_content").html(data);
    }
    })
  }
  </script>
