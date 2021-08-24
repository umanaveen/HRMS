<?php
require '../../../../connect.php';
 $id=$_REQUEST['id'];
$stmt = $con->prepare("select * from modules where id='$id'");
$stmt->execute(); 
$row = $stmt->fetch();
//$hid=$row['emp_name'];
$status=$row['status'];
?>
<div class="container-fluid">
<div class="card mb-3">
<div class="card-header">
<i class="fa fa-table"></i> Modules DETAILS EDIT
<a onclick="return back()" style="float: right;" data-toggle="modal" class="btn btn-danger"></i>Back</a>
</div>
<div class="card-body" id="printableArea">
<form role="form" name="" action="HRMS/Recruitment/project_management/modules/update_modules.php" method="post" enctype="multipart/type">

 <table class="table table-bordered" id="new_tab">
<!--tr>
<td><center><img src="../../Recruitment/image/userlog/bluebase.png" alt="quadsel" style="width:100px;height:50px;"></center></td>
<td colspan="5"><center><b>Bluebase Software services Pvt Ltd</b></center></td>
</tr-->
<TR>
		  <TH>
			<INPUT type="checkbox" name="select-all" id="select-all" onclick="toggle(this);">
		  </TH> 
		  <th>Client</th>
		  		  <th>Date</th>

		  <th>Project</th>
		  <th>Module</th>
		  		  <th>No Of Working Hours</th>

		  <TH>Remarks</TH>
		  <th>Status</th>
		  <th>Reason</th>
		  		  <th>Action</th>

		</TR>
		<TR>
		  <TD>
			<INPUT type="checkbox" name="chk[]">
		  </TD>
		  <TD>
			<INPUT type="text" id="client" name="client" class="form-control" value="<?php echo  $row['client'];?>"> </TD>
			<TD>
			<INPUT type="date" id="date" name="date" class="form-control" value="<?php echo  $row['date'];?>"> </TD>
		  <TD>
			<INPUT type="text" id="project" name="project"  class="form-control" value="<?php echo  $row['project'];?>"> </TD>
		  
		  <TD>
			<INPUT type="text" id="module" name="module"  class="form-control" value="<?php echo  $row['module'];?>"> </TD>
		  
			<td>
			<input type="text" id="no_of_working_hours" name="no_of_working_hours" class="form-control" value="<?php echo  $row['no_of_working_hours'];?>"></td>
			<TD>
			<INPUT type="text" id="remarks" name="remarks" class="form-control" value="<?php echo  $row['remarks'];?>"> </TD>
			<td>
<select class="form-control" name="status" id="status">
<?php

if($status==0)
{
	?>
<option value="0">Not Completed</option>
<option value="1">Completed</option>
<?php	
}
else{
	?>
	<option value="1">Completed</option>
	<option value="0">Not Completed</option>
	<?php
}
?>

</select>
</td>
			<TD>
			<input type="hidden" class="form-control" id="id" name="id" value="<?php echo  $id;?>">

			<INPUT type="text" id="reason" name="reason" class="form-control" value="<?php echo  $row['reason'];?>"> </TD>
		<td>
		<input type="button" class="btn btn-success" id="new_row" name="new_row" onclick="check()" value="Add">
		   <input type="button" class="btn btn-danger" id="enquiry_row_remove"  value="Remove">
		</td>
		 <tr id="new_tab">
	<td>
	</td></tr>
</table>
<input type="submit" name="submit" class="btn btn-primary btn-md" style="float:right;">
</form>
<script>
		function back()
    {
    $.ajax({
    type:"POST",
    url:"/HRMS/HRMS/Recruitment/project_management/modules/modules.php",
    success:function(data){
    $(".content").html(data);
    }
    })
  }
function check() 
    {
    var len=$('#new_tab tr').length;	
    len=len+1; 
     $('#new_tab').append('<tr class="row_'+len+'"><td><input type="checkbox" class="chk" name="chk[]" id="chk_'+len+'" value="'+len+'"</td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<td><input type="text" class="form-control" id="client_'+len+'"  name="client[]"></td><td><input type="date" class="form-control" id="date_'+len+'"  name="date[]"></td><td><input type="text" class="form-control" id="project_'+len+'"  name="project[]"></td><td><input type="text" class="form-control" id="module_'+len+'"  name="module[]"></td><td><input type="text" class="form-control" id="no_of_working_hours'+len+'"  name="no_of_working_hours[]"></td><td><input type="text" class="form-control" id="remarks_'+len+'"  name="remarks[]"></td><td><select class="form-control" id="department_'+len+'"  name="department[]"><option value="1">Completed</option><option value="2">Not Completed</option></select></td><td><input type="text" class="form-control" id="reason_'+len+'"  name="reason[]"></td></tr>'); 
    }
		
	 $('#enquiry_row_remove').click(function(){
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

