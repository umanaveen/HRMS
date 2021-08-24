<?php
require '../../connect.php';
include("../../user.php");
 $id=$_REQUEST['id'];
$stmt = $con->prepare("SELECT * FROM `z_role_master` where id='$id'");
$stmt->execute(); 
$row = $stmt->fetch();
$sta=$row['status'];
?>
<div  class="card card-primary">
 <div class="card-header">
  <h3 class="card-title"><font size="5">Role DETAILS EDIT</font></h3>
	<a onclick="return back()" style="float: right;" data-toggle="modal" class="btn btn-danger"></i>Back</a>
  </div>


<form method="post" enctype="multipart/type">

<table class="table table-bordered">
<tr>
<td><center><img src="../../Recruitment/image/userlog/bluebase.png" alt="quadsel" style="width:100px;height:50px;"></center></td>
<td colspan="5"><center><b>Bluebase Software services Pvt Ltd</b></center></td>
</tr>
<tr>
<td>Role Code:</td>
<td colspan="5">
<input type="hidden" class="form-control" id="get_id" name="get_id" value="<?php echo  $id;?>">
<input type="text" class="form-control" id="Code" name="Code" value="<?php echo  $row['code'];?>">
</td>
</tr>

<tr>
<td>Role Name:</td>
<td colspan="5">

<input type="text" class="form-control" id="name" name="name" value="<?php echo  $row['role_name'];?>">
</td>
</tr>
</table>
<input type="button" class="btn btn-primary btn-md"  style="float:right;" name="Update" onclick="role_update()" value="Update"> 

</form>
</div>

<script>
		function back()
    {
  role()
  }
     function role_update()
    {
    var id=$('#get_id').val();
	//alert(id);
    var data = $('form').serialize();
    $.ajax({
    type:'GET',
    data:"id="+id, data,
    url:'HRMS/role/update_role.php',
    success:function(data)
    {
      if(data==1)
      { 
        alert('Not updated');
      
      }
      else
      {
        alert("Update Successfully");
		role()
      }
      
    }       
    });
    }
  </script>