<?php
require '../../../../connect.php';
include("../../../../user.php");
$userrole=$_SESSION['userrole'];

$id=$_REQUEST['id'];
$stmt = $con->prepare("SELECT enquiry.id as enquiry_id,enquiry.status as enquiry_status,enquiry.Client as enClient,enquiry.*,quotation.* FROM `enquiry` 
INNER JOIN quotation ON enquiry.id=quotation.Enquire_id  where enquiry.id='$id' and enquiry.status='7'"); 

$stmt->execute(); 
$row = $stmt->fetch();
?>
  <div class="card card-info">
              <div class="card-header">
                
				              <center><h3 class="card-title"><b>Project Shedule</b></h3></center>
		<a onclick="return back()" style="float: right;" data-toggle="modal" class="btn btn-danger"></i>Back</a>
              </div>
<div class="card mb-3">

<form method="POST"  action="HRMS/Recruitment/project_management/project_schedule/project_schedule_submit.php">
<input type="hidden" name="userrole" id="userrole" value="<?php echo  $userrole; ?>">

				  <br>
				  <br>
				 
				  <div class="form-group row">
                    <label for="inputdob" class="col-sm-2 col-form-label">Client</label>
                    <div class="col-sm-4">
                         <input type="text" class="form-control" name="name" id="name" value="<?php echo  $row['Company_name'];?>"readonly>
                    </div>
                  </div>
				 
				   <div class="form-group row">
                    <label for="inputdob" class="col-sm-2 col-form-label">Project Name</label>
                    <div class="col-sm-4">
                         <input type="text" class="form-control" name="proposal" id="proposal" value="<?php echo  $row['proposal'];?>"readonly>
                    </div>
                  </div>
				  
				  <?php 
				  $stmt1 = $con->prepare("SELECT sum(day) as total FROM `cost_sheet_entry` WHERE enquiry_id='$id'
"); 

$stmt1->execute(); 
$row1 = $stmt1->fetch();
				  ?>
				  <div class="form-group row">
                    <label for="inputdob" class="col-sm-2 col-form-label">Total Man Hours</label>
                    <div class="col-sm-4">
                         <input type="text" class="form-control" name="Hours" id="Hours" value="<?php echo  $row1['total'];?>"readonly>
                    </div>
                  </div>
				  <div class="form-group row">
                    <label for="inputdob" class="col-sm-2 col-form-label">Project Deadline Date</label>
                    <div class="col-sm-4">
                         <input type="date" class="form-control" name="date" id="date">
                    </div>
                  </div>
<table class="table table-bordered">
<tr>

                       

 <table class="table table-bordered" id="new_tab">
		<TR>
		  <TH>
			<INPUT type="checkbox" name="select-all" id="select-all" onclick="toggle(this);">
		  </TH> 
		   <th>Modules</th>
		<th>Department</th>
		<th>Employee</th>
		  
		 
		  
		  <th>No Of Working Hours</th>
		 
 <th>Action</th>
		</TR>
		
			<TR>
			<TD>
			<INPUT type="checkbox" name="chk[]">
			</TD>
			<TD>
			<input type="text" id="modules_1" name="modules[]" onchange="getemp_data(1,this.value)" class="form-control">
			</td>
			<TD>
			
			<select id="department_1" name="department_1[]" onchange="getProject_data(1,this.value)" class="form-control" >
			<option value="">Select Department</option>
			<?php
			$dep_sql=$con->query("SELECT * FROM z_department_master");
			while($dep_sql_res=$dep_sql->fetch(PDO::FETCH_ASSOC))
			{
			?>
			<option value="<?php echo $dep_sql_res['id']; ?>"><?php echo $dep_sql_res['dept_name']; ?></option>
			<?php
			}
			?>
			</select>
			</TD>

<TD>
			<select id="project_name_1" name="project_name_1[]"  class="form-control">
			</select>	
			</TD>
			

						
			<td>
			<input type="text" id="no_of_working_hours_1" name="no_of_working_hours[]" onchange="gettotal(1)" class="form-control"></td>
			


			
			<td>
			<input type="button" class="btn btn-success" id="new_row" name="new_row" onclick="append()" value="Add">
			<input type="button" class="btn btn-danger" id="enquiry_row_remove"  value="Remove">
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
    $(".main_content").html(data);
    }
    })
  }
  </script>
 

   <script>
   function gettotal(i)
    {
		console.log('no_of_working_hours_'+i);
		
		var Hours=parseInt(document.getElementById('Hours').value);
		
		console.log('Hours'+Hours);
		var no_of_working_hours=parseInt(document.getElementById('no_of_working_hours_'+i).value);
		console.log("no of working hours : " + no_of_working_hours);
		if(no_of_working_hours <= Hours)
		{
			
  
	alert(no_of_working_hours);
		}
		else
		{
			document.getElementById('no_of_working_hours_'+i).value=0;
		}
  }
		  function getProject_data(v,c){
			  //alert(v);
			  //var client_id=document.getElementById('client_'+v).value;
			    //document.getElementById("demo").innerHTML = "You selected: " + client_id;

			  $.ajax({
				  type: "GET",
					url: "/HRMS/HRMS/Recruitment/project_management/project_schedule/find_project.php?client_id="+c,
					success: function(data){
					$("#project_name_"+v).html(data);
					}
					});

		  }
		  </script>
		   <script>
		  function getModules_data(v,c){
			  alert(v);
			  //var project_id=document.getElementById('project_name_'+v).value;
			  $.ajax({
				url: "/HRMS/HRMS/Recruitment/project_management/project_schedule/find_modules.php?project_id="+c,
				type: "GET",
				//data: {
				//project_id: project_id
				//},
				//cache: false,
				success: function(data){
				$("#modules_"+v).html(data);
				}
				});

		  }
		  </script>
	 <script>
		  function getemp_data(v,c){
			//  alert(v);
			 // var project_id=document.getElementById('modules_'+v).value;
			  $.ajax({
url: "/HRMS/HRMS/Recruitment/project_management/project_schedule/find_emp.php?project_id="+c,
type: "GET",
//data: {
//project_id: project_id
//},
//cache: false,
success: function(data){
$("#employees"+v).html(data);
}
});

		  }
		  </script>
		   <script>
		  function gethrs_data(v,c){
			  alert(v);
			  //var employees_id=document.getElementById('employees_'+v).value;
			  $.ajax({
url: "/HRMS/HRMS/Recruitment/project_management/project_schedule/find_hours.php?project_id="+c,
type: "GET",
//data: {
//employees_id: employees_id
//},
//cache: false,
success: function(data){
$("#no_of_working_hours"+v).html(data);
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

 $(document).ready(function() {
$('#project_name').on('change', function() {

var client_id = this.value;
alert(client_id);
$.ajax({
url: "/HRMS/HRMS/Recruitment/project_management/project_schedule/find_modules.php",
type: "POST",	
data: {
project_id: project_id
},
cache: false,
success: function(result){
$("#modules").html('<option value="">Select Modules</option>');

}
});
});
});

 $(document).ready(function() {
$('#modules').on('change', function() {

var client_id = this.value;
alert(client_id);
$.ajax({
url: "/HRMS/HRMS/Recruitment/project_management/project_schedule/find_emp.php",
type: "POST",	
data: {
project_id: project_id
},
cache: false,
success: function(result){
$("#employee").html('<option value="">Select Employee</option>');

}
});
});
});


 $(document).ready(function() {
$('#employees').on('change', function() {

var employees_id = this.value;
alert(employees_id);
$.ajax({
url: "/HRMS/HRMS/Recruitment/project_management/project_schedule/find_hours.php",
type: "POST",	
data: {
employees_id: employees_id
},
cache: false,
success: function(result){
$("#no_of_working_hours").html('<option value="">Select No Of Working Hours</option>');

}
});
});
});

  function append() 
    {
    var len=$('#new_tab tr').length;	
    len=len+1; 
     $('#new_tab').append('<tr class="row_'+len+'"><td><input type="checkbox" class="chk" name="chk[]" id="chk_'+len+'" value="'+len+'"</td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<td><input type="text" id="modules_'+len+'" name="modules_'+len+'[]" onchange="getemp_data('+len+',this.value)" class="form-control"></td><td><select id="department'+len+'" name="department_'+len+'[]" onchange="getProject_data('+len+',this.value)" class="form-control" ><option value="">Select Department</option><?php $dep_sql=$con->query("SELECT * FROM z_department_master"); while($dep_sql_res=$dep_sql->fetch(PDO::FETCH_ASSOC)){ ?><option value="<?php echo $dep_sql_res['id']; ?>"><?php echo $dep_sql_res['dept_name']; ?></option><?php } ?></select></td><td><select id="project_name_'+len+'" name="project_name_'+len+'[]"  class="form-control"></select>	</td><td><input type="text" id="no_of_working_hours_'+len+'" name="no_of_working_hours_'+len+'[]" onchange="gettotal('+len+')" class="form-control"></td></tr>'); 
    }
		
	 
  </script>
	