<?php
require '../../../connect.php';
?>
   <div class="card card-info">
              <div class="card-header">
                
				              <center><h3 class="card-title"><b>E-Resignation </b></h3></center>
		<!--a onclick="return back()" style="float: right;" data-toggle="modal" class="btn btn-danger"></i>Back</a-->
              </div>
			
   <form method="POST" enctype="multipart/form-data">
    <!-- Post -->
    <table class="table table-bordered">
        <tr>
        <td><center><img src="/HRMS/HRMS/Recruitment/image/userlog/bluebase.png"  style="width:300px;height:150px;"></center></td>
        <td colspan="5"><center><h1><b>Bluebase Software services Pvt Ltd</b></h1></center></td>
        </tr>
        <tr>
			<td colspan="6"><center><b>Resignation Form</b></center></td>
        </tr>
	   
		<tr>
		<td>Reason of Relieving :</td>
        <td><input type="text" class="form-control" id="relieve_reason" name="relieve_reason"></td>
		</tr>
		<tr>
		<td>Remarks :</td>
        <td><input type="text" class="form-control" id="remarks" name="remarks"></td>
		</tr>
			
		 
        <tr>  
        <td colspan="6"><input type="button" class="btn btn-success" name="save" onclick="resign_form()" style="float:right;" value="save"></td>
        </tr>
        </table>
        <!-- /.post -->
    </form>
    </div>



<script>
function back()
	{
		jobdescription_form();
	}
function resign_form()
{
	var field=1;
	var data = $('form').serialize();
	$.ajax({
		type:'GET',
		data:"field="+field, data,
		url:'/HRMS/HRMS/Recruitment/staff_resignation/resignation_submit.php',
		success:function(data)
		{
			if(data==0)
			{
				alert("Form Data has not been Submitted");
				
				//window.location.href="login/logout.php";
				//candidate_form();
					staff_resignation_form();
			}
			else
			{
			alert("Form Data has been Submitted Successfully");
				//candidate_form();
			
				staff_resignation_form();
			}	
		}       	
	});
}
</script>
