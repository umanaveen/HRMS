<?php
require '../../../connect.php';
 $id=$_REQUEST['id'];
$stmt = $con->prepare("select * from interview_rounds where id='$id'");
$stmt->execute(); 
$row = $stmt->fetch();
$sta=$row['status'];
?>
     <div class="card card-info">
              <div class="card-header">
                
				              <center><h3 class="card-title"><b>Intrerview Round </b></h3></center>
		<a onclick="return back()" style="float: right;" data-toggle="modal" class="btn btn-danger"></i>Back</a>
              </div>

<form role="form" name="" action="" method="post" enctype="multipart/type">
<table class="table table-bordered">
 <tr>
        <td><center><img src="/HRMS/HRMS/Recruitment/image/userlog/bluebase.png"  style="width:300px;height:150px;"></center></td>
        <td colspan="5"><center><h1><b>Bluebase Software services Pvt Ltd</b></h1></center></td>
        </tr>
<tr>
<td>Name:</td>
<td colspan="5">
<input type="hidden" class="form-control" id="id" name="id" value="<?php echo  $id;?>">
<input type="text" class="form-control" id="name" name="name" value="<?php echo  $row['name'];?>" readonly>
</td>
</tr>


<tr>
<td>Status</td>
<td colspan="2">
<?php

if($sta==0)
{
	?>
<input type="text" name="status" class="form-control" value="<?php echo  "InActive";?>" readonly>
<?php	
}
else
{
	?>
	<input type="text" name="status" class="form-control" value="<?php echo  "Active";?>" readonly>
		<?php
}
?>

</td>
</tr>
<table class="table table-bordered" id="new_tab">
  
    <tr>
      <th>#</th>
      <th>Interview Feedback</th>
      <th>Action</th>
     
    </tr>
    
    
    <tr>
      <td><input type="checkbox" class="chk" name="chk[]" id="chk_1" value="1" style="width:15px;height:20px;"/></td>
    
      <td><input type="text" class="form-control" id="section_name1" name="section_name[]"></td>
      
     
      <td><input type="button" class="btn btn-success" id="new_row" name="new_row" onclick="check()" value="Add">
      <input type="button" class="btn btn-danger" id="row_remove"  value="Remove">
    </td>
    </tr>
   
     
</table>
</table>


<input type="button" class="btn btn-primary btn-md"  style="float:right;" name="Update" onclick="round_update()" value="Update"> 

</form>
</div>
</div>
</div>
<script>
 function round_update()
    {
    var id=$('#id').val();
	alert(id);
    var data = $('form').serialize();
    $.ajax({
    type:'GET',
    data:"id="+id, data,
    url:'HRMS/masters/interview_rounds/update_interview_rounds_name.php',
	
    success:function(data)
    {
      if(data==1)
      { 
        alert('Not updated');
      
      }
      else
      {
        alert("Update Successfully");
		interview_rounds()
      }
      
    }       
    });
    }
	</script>
		<script>
    function check() // education
    {
    var len=$('#new_tab tr').length;	
    len=len+1; 
    $('#new_tab').append('<tr class="row_'+len+'"><td><input type="checkbox" class="chk" name="chk[]" id="chk_'+len+'" value="'+len+'"</td><td><input type="text" class="form-control" id="section_name_'+len+'" name="section_name[]"></td></tr>'); 
    }



    $('#row_remove').click(function(){
    $('input:checkbox:checked.chk').map(function(){
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

    });
    });
	</script>