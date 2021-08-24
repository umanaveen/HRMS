<?php
require '../../../connect.php';
include("../../../user.php");
$userrole=$_SESSION['userrole'];
?>
<!--div class="container-fluid"-->
<div class="card mb-3">

<form method="POST" action="HRMS/Recruitment/staff_asset/staff_asset_submit.php">
<input type="hidden" name="userrole" id="userrole" value="<?php echo  $userrole; ?>">
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
<td colspan="2"><select class="form-control" name="emp_name">
		<option value="">Select Employee Name</option>
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
<td>Access:</td>
</tr>
</table>
<table class="dataTables-example table table-striped table-bordered table-hover"  id="example1">

<tr>
<td>
<?php
$isel=$con->query("select distinct m.id as id,name from assets_form_detail a join assets_master m on a.asset_name=m.id where a.asset='Internal Asset'");
$i=1;
$s=1;
while($dfet=$isel->fetch())
{
	?>
	<div style="width:100%;float:left;padding: 5px 0px;">
	<div style="width:15%;float:left;margin-left: 113px;">
	
<input type="checkbox" name="View[]>" id="View<?php echo $i.$s++ ; ?>"   value="<?php echo $dfet['id'];?>" />&emsp;<?php echo $dfet['name'];?></div>

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
<td>CUG</td>

<td colspan="2">
<select class="form-control" name="cug" id="cug">
<option value="Yes">Yes</option>
<option value="No">No</option>
</select>
</td>
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
    url:"/HRMS/HRMS/Recruitment/staff_asset/staff_asset.php",
    success:function(data){
    $(".content").html(data);
    }
    })
  }
  </script>
