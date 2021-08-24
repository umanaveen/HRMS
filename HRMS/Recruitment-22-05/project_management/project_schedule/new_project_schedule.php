<?php
require '../../../../connect.php';
include("../../../../user.php");
$userrole=$_SESSION['userrole'];
?>
<!--div class="container-fluid"-->
<div class="card mb-3">

<form method="POST"  action="HRMS/Recruitment/project_management/project_schedule/project_to_do_list.php">
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
		  <th>Project Name</th>
		  <th>Modules</th>
		  <TH>Employees</TH>
		  <th>No Of Working Hours</th>
		  <th>Date</th>
		  		  <th>Action</th>

		</TR>
		<TR>
		  <TD>
			<INPUT type="checkbox" name="chk[]">
		  </TD>
		  <TD>
<select id="client_1" name="client_1" onchange="getProject_data(1)" class="form-control" >
		<option value="0">-- Select Client Name --</option>
		<?php
		$dep_sql=$con->query("SELECT * FROM project");
		while($dep_sql_res=$dep_sql->fetch(PDO::FETCH_ASSOC))
		{
			?>
			<option value="<?php echo $dep_sql_res['id']; ?>"><?php echo $dep_sql_res['client']; ?></option>
			<?php
		}
		?>
		</select></td>
		  		  <TD>
<select id="project_name_1" name="project_name_1" class="form-control">
		</select>
		  </td>
		 

		  <TD>
			<input type="text" id="modules" name="modules" class="form-control"></td>

		 <TD>
<select id="client" name="employees" id="employees" class="form-control" >
		<option value="0">-- Select Employee Name --</option>
		<?php
		$dep_sql=$con->query("SELECT * FROM staff_master");
		while($dep_sql_res=$dep_sql->fetch(PDO::FETCH_ASSOC))
		{
			?>
			<option value="<?php echo $dep_sql_res['id']; ?>"><?php echo $dep_sql_res['emp_name']; ?></option>
			<?php
		}
		?>
		</select>	</td>			
		<td>
			<input type="text" id="no_of_working_hours" name="no_of_working_hours" class="form-control"></td>
			<td>
			<input type="date" id="date" name="date" class="form-control"></td>
			

		<td>
		<input type="button" class="btn btn-success" id="new_row" name="new_row" onclick="append()" value="Add">
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
    url:"/HRMS/HRMS/Recruitment/project_management/project_schedule/project_schedule.php",
    success:function(data){
    $(".content").html(data);
    }
    })
  }
  </script>
  <script>
  function response()
	{
		var data = $('form').serialize();
			$.ajax({
			type: "GET",
			url: "/HRMS/HRMS/Recruitment/project_management/project_schedule/response.php",
			data:  "id="+ 1,  data,
			success: function(data)
			{
				$("#response").html(data);		
			}				
		});	
	}
	</script>

   <script>
		  function getProject_data(v){
			  alert(v);
			  var client_id=document.getElementById('client_'+v).value;
			  $.ajax({
url: "/HRMS/HRMS/Recruitment/project_management/project_schedule/find_project.php",
type: "GET",
data: {
client_id: client_id
},
cache: false,
success: function(result){
$("#project_name_"+v).html(result);
}
});

		  }
		  </script>
	
  <script>
  $(document).ready(function() {
$('#client').on('change', function() {

var client_id = this.value;
alert(client_id);
$.ajax({
url: "/HRMS/HRMS/Recruitment/project_management/project_schedule/find_project.php",
type: "POST",	
data: {
client_id: client_id
},
cache: false,
success: function(result){
$("#project_name").html('<option value="">Select Project Name</option>');

}
});
});
});
 
  function append() 
    {
    var len=$('#new_tab tr').length;	
    len=len+1; 
     $('#new_tab').append('<tr class="row_'+len+'"><td><input type="checkbox" class="chk" name="chk[]" id="chk_'+len+'" value="'+len+'"</td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<td><select class="form-control" id="client_'+len+'"  name="client_'+len+'" onchange="getProject_data('+len+')"><option value="1">8</option><option value="2"></option><option value="3"></option><option value="4">9</option><option value="5">1</option><option value="6">8</option><option value="7">6</option></select></td><td><select class="form-control" id="project_name_'+len+'"  name="project_name_'+len+'"><option value="1">Project Management</option><option value="2">Project Management</option><option value="3">Project Management</option><option value="4">HRMS</option><option value="5">HRMS</option><option value="6">HRMS</option><option value="7">Project Management</option></select></td><td><input type="text" class="form-control" id="modules'+len+'"  name="modules[]"></td><td><select class="form-control" id="employee_'+len+'"  name="employee[]"><option value="1">Jaikumar</option><option value="2">Rizwana</option><option value="3">Rajeshwari</option><option value="4">Mohana Krishnan</option><option value="5">Gopinath</option><option value="6">Sebastain</option><option value="7">Laxmi Priya</option><option value="8">Arunachalam</option><option value="9">Vanitha</option><option value="10">Jefferson Fernando</option><option value="11">Meena B</option><option value="12">Umadevi</option><option value="13">Sindhu G</option><option value="14">Girish Madhavan</option><option value="15">Ramakrishnan</option><option value="16">Arun</option><option value="17">Sakthi</option><option value="18">Mythili</option><option value="19">Karthikeyan</option><option value="20">Selvaraj</option><option value="21">Vaidyanathan</option><option value="22">Christy</option><option value="23">Muthuraj</option><option value="24">Kalai</option><option value="25">Shanmuganathan</option><option value="26">Karthik</option><option value="27">Venkatesan</option></select></td><td><input type="date" class="form-control" id="no_of_working_hours_'+len+'"  name="no_of_working_hours_[]"></td><td><input type="date" class="form-control" id="date_'+len+'"  name="date[]"></td></tr>'); 
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
	