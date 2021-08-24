<?php
require '../../../../connect.php';
include("../../../../user.php");
$userrole=$_SESSION['userrole'];
?>
<!--div class="container-fluid"-->
<div class="card mb-3">

<form method="POST"  action="HRMS/Recruitment/project_management/project_timeline/project_timeline_submit.php">
<input type="hidden" name="userrole" id="userrole" value="<?php echo  $userrole; ?>">
<table class="table table-bordered">
<tr>
<div class="row">
						 <!--div class="col-lg-12"-->
<a onclick="return back()" style="float: right;" data-toggle="modal" class="btn btn-danger"></i>Back</a>


          </div>
                        <!-- /.col-lg-12 -->
                    <!--/div>
</tr>
<tr>
<td><center><img src="../../Recruitment/image/userlog/bluebase.png" alt="quadsel" style="width:100px;height:50px;"></center></td>
<td colspan="5"><center><b>Bluebase Software services Pvt Ltd</b></center></td>
</tr>
<tr>
<td>Modules:</td>
<td colspan="2">
<input type="text" class="form-control" id="modules" name="modules" ></td>
			  </td>
</tr>
<tr>
<td>Employees:</td>
<td colspan="2">
<input type="text" class="form-control" id="employees" name="employees" ></td>
</tr>


<tr>
<td>No of Working Hours:</td>
<td colspan="2">
<input type="text" class="form-control" id="no_of_working_hours" name="no_of_working_hours" ></td>
</tr>
<tr>
<td>Date:</td>
<td colspan="2">
<input type="date" class="form-control" id="date" name="date" ></td>
 <td><input type="button" class="btn btn-success" id="new_row" name="new_row" onclick="check()" value="Add">
      <input type="button" class="btn btn-danger" id="enquiry_row_remove"  value="Remove">
</tr>
</table>
<input type="submit" name="submit" class="btn btn-primary btn-md" style="float:right;">
</form-->
<!--form action="" method="post" enctype="multipart/form-data"-->

 <table class="table table-bordered" id="new_tab">
		<TR>
		  <TH>
			<INPUT type="checkbox" name="select-all" id="select-all" onclick="toggle(this);">
		  </TH> 
		  <th>Client</th>
		  <th>Date</th>
		  <th>Project</th>
		  <TH>Module</TH>
		  <th>No Of Working Hours</th>
		  <th>Remarks</th>
		  		  <th>Status</th>
		  <th>Reason</th>

		  		  <th>Action</th>

		</TR>
		<TR>
		  <TD>
			<INPUT type="checkbox" name="chk[]">
		  </TD>
		  <TD>
			<INPUT type="text" id="client" name="client" class="form-control"> </TD>

		  		  <TD>
			<INPUT type="date" id="date" name="date" class="form-control"> </TD>
		  
		  <TD>
			<INPUT type="text" id="project" name="project" onchange="totalIt()" class="form-control"> </TD>
	
	<td>
			<INPUT type="text" id="module" name="module" onchange="totalIt()" class="form-control"> </TD>
			<td>
			<input type="text" id="no_of_working_hours" name="no_of_working_hours" class="form-control"></td>
			<td>
						
			<INPUT type="text" id="remarks" name="remarks" class="form-control"> </TD>
<td>
<select class="form-control" name="status" id="status">
<option value="">Select Status</option>
<option value="1">Completed</option>
<option value="0">Not Completed</option>
</select>
			</td>
			<TD>
			<INPUT type="text" id="reason" name="reason" class="form-control"> </TD>
		

		<td>
		<input type="button" class="btn btn-success" id="new_row" name="new_row" onclick="check()" value="Add">
		   <input type="button" class="btn btn-danger" id="enquiry_row_remove"  value="Remove">
		</td>
		 <tr id="new_tab">
	<td>
	</td>
	  </tr>
		</TR>
	  </TABLE>
<input type="submit" name="submit" class="btn btn-primary btn-md" style="float:right;">

</form>
<script>
/*function project_submit()
    {
    $.ajax({
    type:"POST",
    url:"/HRMS/HRMS/Recruitment/project_management/project/project_submit.php",
    success:function(data){
    $(".content").html(data);
    }
    })
  }*/
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
