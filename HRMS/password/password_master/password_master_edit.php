<?php
require '../../../connect.php';
include("../../../user.php");
 $id=$_REQUEST['id'];

$stmt = $con->prepare("SELECT * FROM `password_master` WHERE password_id='$id'"); 
$stmt->execute(); 
$row = $stmt->fetch();

?>
<div class="card card-info">
              <div class="card-header">
                
				              <center><h3 class="card-title"><b>Edit</b></h3></center>
		<a onclick="return back()" style="float: right;" data-toggle="modal" class="btn btn-danger"></i>Back</a>
              </div>
    <form method="POST" enctype="multipart/form-data">
    <!-- Post -->
    <table class="table table-bordered">
        <tr>
        <td><center><img src="/HRMS/HRMS/Recruitment/image/userlog/bluebase.png"  style="width:300px;height:150px;"></center></td>
        <td colspan="5"><center><h1><b>Bluebase Software services Pvt Ltd</b></h1></center></td>
        </tr>
		
        
		
     
        <tr>
       <td>Product Name</td>
	   <input type="hidden" class="form-control" id="get_id" name="get_id" value="<?php echo  $id; ?>">
        <td colspan="5"><input type="text" class="form-control" name="password_name" id="password_name" value="<?php echo  $row['name'];?>" ></td>
        </tr>
		<?php if($row['status']==1){
			?>
       <tr>
       <td>Staus</td>
	        <td colspan="5">
			<select id="status" name="status" class="form-control">
			<option value="1">Active</option>
			<option value="2">In Active</option>

	 </select>
	 </td>
	 </tr>
        <?php }  else { ?>
 <tr>
       <td>Staus</td>
	        <td colspan="5">
			<select id="status" name="status" class="form-control">
			<option value="2">In Active</option>
			<option value="1">Active</option>
			
	
	 </select>
	 </td>
	 </tr>
		<?php } ?>
	
	
		<tr>
        <td colspan="6"><input type="button" class="btn btn-success" name="save" onclick="password_edit()" value="save"></td>
        </tr>
        </table>
        <!-- /.post -->
    </form>
    </div>

    
<script>
		function back()
    {
  password_masters()
  }
     function password_edit()
    {
    var id=$('#get_id').val();
	//alert(id);
    var data = $('form').serialize();
    $.ajax({
    type:'GET',
    data:"id="+id, data,
  url:"HRMS/password/password_master/password_update.php",
    success:function(data)
    {
      if(data==1)
      { 
        alert('Not updated');
      
      }
      else
      {
        alert("Update Successfully");
		password_masters()
      }
      
    }       
    });
    }
  </script>
