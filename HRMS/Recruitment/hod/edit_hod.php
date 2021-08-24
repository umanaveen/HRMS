<?php
require '../../../connect.php';
 $id=$_REQUEST['id'];
$stmt = $con->prepare("select * from hod where id='$id'");
$stmt->execute(); 
$row = $stmt->fetch();
$sid=$row['emp_name'];
$hid=$row['dept_name'];
$hid=$row['asset'];
?>
<div class="container-fluid">
<div class="card mb-3">
<div class="card-header">
<i class="fa fa-table"></i> HOD DETAILS EDIT
<a onclick="return back_ctc()" style="float: right;" data-toggle="modal" class="btn btn-primary">Back</a>
</div>
<div class="card-body" id="printableArea">
<form role="form" name="" action="HRMS/Recruitment/hod/update_hod.php" method="post" enctype="multipart/type">

<table class="table table-bordered">
<tr>
<td><center><img src="../../Recruitment/image/userlog/bluebase.png" alt="quadsel" style="width:100px;height:50px;"></center></td>
<td colspan="5"><center><b>Bluebase Software services Pvt Ltd</b></center></td>
</tr>

<tr> 
     <td>Department Name:</td>
	 <td colspan="2">
	 <input type="hidden" class="form-control" id="id" name="id" value="<?php echo  $id;?>">

		<select class="form-control" name="dept_name" id="dept_name">
		<?php
$dep_sql1=$con->query("SELECT * FROM staff_master");
$fet=$dep_sql1->fetch();
?>
		<option value="<?php echo $fet['id']; ?>"><?php echo $fet['dep_id']; ?></option>
		<?php
		$dep_sql1=$con->query("SELECT * FROM staff_master");
		while($dep_sql_res=$dep_sql1->fetch(PDO::FETCH_ASSOC))
		{
			?>
			<option value="<?php echo $dep_sql_res['id']; ?>"><?php echo $dep_sql_res['dep_id']; ?></option>
			<?php
		}
		?>
		</select>
	 </td>
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
<tr id="new_tab">
<td>Asset:</td>
<td colspan="2"><select class="form-control" id="asset" name="asset">
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
		</select></td>
		<td>
		
    <input type="button" class="btn btn-success" id="new_row" name="new_row" onclick="check()" value="Add">
			  </td>
	
      </tr>
<tr>
<td>Mail ID:</td>
<td colspan="2">
<input type="text" class="form-control" id="mail_id" name="mail_id" value="<?php echo $row['mail_id'];?>"></td>
</tr>
<tr>
<td>Others</td>
<td colspan="2">
<input type="text" class="form-control" id="others" name="others" value="<?php echo $row['Others'];?>"></td>

</tr>
</table>
 <td colspan="2">

<input type="submit" name="submit" class="btn btn-primary btn-md" style="float:right;">
</form>
<script>
		function back()
    {
    $.ajax({
    type:"POST",
    url:"/HRMS/HRMS/Recruitment/hod/hod.php",
    success:function(data){
    $(".content").html(data);
    }
    })
  }
  </script>
  <script>
    function check() // education
    {
    var len=$('#new_tab tr').length;	
    len=len+1; 
    $('#new_tab').append('<tr class="row_'+len+'"><td><input type="text" class="form-control" class="form-control" id="asset'+len+'" name="asset[]"></td></tr>'); 
    }
    var id=$(this).val();
    var le=$('#new_tab tr').length;

    if(le==1)
    {
    alert("You Can't Delete All the Rows");
    }
    else
    {
    $('.row_'+id).remove();
    }

	</script>

