<?php
require '../../connect.php';
 $id=$_REQUEST['id'];

$stmt = $con->prepare("SELECT * FROM `holiday_master` WHERE id='$id'"); 
$stmt->execute(); 
$row = $stmt->fetch();

?>
<div  class="card card-primary">
 <div class="card-header">
  <h3 class="card-title"><font size="5">Holiday  EDIT</font></h3>
	<a onclick="back_holiday()"  style="float: right;" data-toggle="modal" class="btn btn-danger"></i>Back</a>
  </div>
<form method="POST" enctype="multipart/form-data">
    <!-- Post -->
    <table class="table table-bordered">
 <tr>
        <td><center><img src="/HRMS/HRMS/Recruitment/image/userlog/bluebase.png"  style="width:300px;height:150px;"></center></td>
        <td colspan="5"><center><h1><b>Bluebase Software services Pvt Ltd</b></h1></center></td>
        </tr>
<tr rowspan="6">
<td >Year</td>
<input type="hidden" class="form-control" id="get_id" name="get_id" value="<?php echo  $row[0]; ?>"></td>
<td colspan="5">

<input type="text" class="form-control" id="Year" name="Year" value="<?php echo  $row[1]; ?>"></td>
</tr>


<tr rowspan="6">
<td >Date</td>
<td colspan="5"><input type="date" class="form-control" id="date" name="date" value="<?php echo  $row[2]; ?>"></td>
</tr>
<tr rowspan="6">
<td>Holiday Name</td>
<td colspan="5"><input type="text" class="form-control" id="holiday_name" name="holiday_name" value="<?php echo  $row[3]; ?>"></td>
</tr>



<tr>

<td>Status</td>
<td colspan="5">
<select id="status" name="status" class="form-control" >
 
<?php 
if($row[4] ==1)
{
?>
    <option value="1">Active</option>
	 <option value="2"> IN Active</option>
<?php }else {?>
  <option value="2"> IN Active</option>
  <option value="1">Active</option>
<?php } ?>
</select>
</td>
</tr>

</table>
<input type="button" class="btn btn-primary btn-md"  style="float:right;" name="Update" onclick="holiday_update()" value="Update"> 
</form>
  </div>

<script>
	function back_holiday()
	{
		$.ajax({
		type:"POST",
		url:"Recruitment/payroll/holiday.php",
		success:function(data){
		$("#main_content").html(data);
		}
		})
	}
    function holiday_update()
    {
    var id=$('#get_id').val();
	//alert(id);
    var data = $('form').serialize();
    $.ajax({
    type:'GET',
    data:"id="+id, data,
    url:'Recruitment/payroll/payroll_update.php',
    success:function(data)
    {
      if(data==1)
      { 
        alert('Not updated');
      
      }
      else
      {
        alert("Update Successfully");
		holidays()
      }
      
    }       
    });
    }
    </script>