<?php
require '../../../../connect.php';
include("../../../../user.php");
$userrole=$_SESSION['userrole'];
?>
<!--div class="container-fluid"-->
<div class="card mb-3">

<form method="POST"  action="HRMS/Recruitment/project_management/project_schedule/project_to_do_list_submit.php">
<input type="hidden" name="userrole" id="userrole" value="<?php echo  $userrole; ?>">
<table class="table table-bordered">
<h>Project To Do List</h>
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
		  <th>Project Name</th>
		  <TH>Employees</TH>
		  		  <th>Action</th>

		</TR>
		<TR>
		 <?php
      $emp_sql=$con->query("SELECT * FROM project_schedule");
	  
	 //echo "SELECT sm.emp_name,s.stationaries,s.system_or_laptop,s.id_card,s.cug,s.access_card,s.erp_access,s.mail_id,s.id AS sid FROM staff_asset s join staff_master sm on s.emp_name=sm.id";
      $i=1;
      while($emp_res = $emp_sql->fetch(PDO::FETCH_ASSOC))
      {
       ?>
      <tr>
<TD>
			<INPUT type="checkbox" name="chk[]">
		  </TD>
		  
      <td><?php echo $emp_res['project_name']; ?></td>

	  <td><?php echo $emp_res['employees']; ?></td>
	  <td>
		<input type="button" class="btn btn-success" id="new_row" name="new_row" onclick="append()" value="Add">
		   <input type="button" class="btn btn-danger" id="enquiry_row_remove"  value="Remove">
		</td>
		 <tr id="new_tab">
	<td>
	</td>
		
      </tr>
      <?php
	  $i++;
      }
      ?>
	  
     
		</TR>
	  </TABLE>
<input type="submit" name="submit" class="btn btn-primary btn-md" style="float:right;">

</form>
<script>
function back()
    {
    $.ajax({
    type:"POST",
    url:"/HRMS/HRMS/Recruitment/project_management/project_schedule/project_schedule.php",
    success:function(data){
    $(".content").html(data);
    }
    })
  }
  </script>
<script>
  function append() 
    {
    var len=$('#new_tab tr').length;	
    len=len+1; 
     $('#new_tab').append('<tr class="row_'+len+'"><td><input type="checkbox" class="chk" name="chk[]" id="chk_'+len+'" value="'+len+'"</td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<td><select class="form-control" id="project_name_'+len+'"  name="project_name_'+len+'" ><option value="1">1</option><option value="2">2</option><option value="3">1</option><option value="4">7</option><option value="5">7</option><option value="6">5</option></select></td><td><select class="form-control" id="employees_'+len+'"  name="employees_'+len+'"><option value="1">1</option><option value="2">1</option><option value="3">1</option><option value="4">6</option><option value="5">6</option><option value="6">5</option><option value="7">7</option><option value="8">7</option><option value="9">7</option><option value="10">7</option><option value="11">7</option><option value="12">7</option><option value="13">9</option></select></td></td></tr>'); 
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
