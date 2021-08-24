<?php
require '../../../connect.php';
 $id=$_REQUEST['id'];
$stmt = $con->prepare("select * from staff_asset_master where id='$id'");
$stmt->execute(); 
$row = $stmt->fetch();
$hid=$row['asset'];
?>
<div class="container-fluid">
<div class="card mb-3">
<div class="card-header">
<i class="fa fa-table"></i> STAFF ASSET MASTER EDIT
<a onclick="back()" style="float: right;" data-toggle="modal" class="btn btn-primary">Back</a>
</div>
<div class="card-body" id="printableArea">
<form role="form" name="" action="HRMS/Recruitment/staff_asset_master/update_staff_asset_master.php" method="post" enctype="multipart/type">

<table class="table table-bordered">
<tr>
<td><center><img src="../../Recruitment/image/userlog/bluebase.png" alt="quadsel" style="width:100px;height:50px;"></center></td>
<td colspan="5"><center><b>Bluebase Software services Pvt Ltd</b></center></td>
</tr>
<tr>
<td>Asset</td>

<td colspan="2">
<select class="form-control" id="asset" name="asset">
<?php 
$dep_sql1=$con->query("SELECT * FROM staff_asset_master where id='$hid'");
$fet=$dep_sql1->fetch();
?>
		<option value="<?php echo $fet['id']; ?>"><?php echo $fet['asset']; ?></option>
		<?php
		$dep_sql1=$con->query("SELECT * FROM staff_asset_master");
		while($dep_sql_res=$dep_sql1->fetch(PDO::FETCH_ASSOC))
		{
			?>
			<option value="<?php echo $dep_sql_res['id']; ?>"><?php echo $dep_sql_res['asset']; ?></option>
			<?php
		}
		?>
		</select></td></tr>
</table>

<input type="submit" name="submit" class="btn btn-primary btn-md" style="float:right;">
</form>
</div>
</div>
</div><script>
		function back()
    {
    $.ajax({
    type:"POST",
    url:"/HRMS/HRMS/Recruitment/staff_asset_master/staff_asset_master.php",
    success:function(data){
    $(".content").html(data);
    }
    })
  }
  </script>
