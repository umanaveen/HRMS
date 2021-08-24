<?php
require '../../../../connect.php';
include("../../../../user.php");
$userrole=$_SESSION['userrole'];
?>
  <div class="card card-info">
              <div class="card-header">
                
				              <center><h3 class="card-title"><b>Project Shedule</b></h3></center>
							  
		<a onclick="return back()" style="float: right;" data-toggle="modal" class="btn btn-danger"></i>Back</a>
		
              </div>
<div class="card mb-3">

<form method="POST"  action="HRMS/Recruitment/project_management/project_schedule/project_schedule_submit.php">
<input type="hidden" name="userrole" id="userrole" value="<?php echo  $userrole; ?>">
<table class="table table-bordered" id="new_tab">
    <tr>
  
    </tr>
    <tr>
      <th>#</th>
	 
      <th>Client</th>
      <th>Project_Name</th>
       <th>modules</th>
	     <th>Employee</th>
	 <th>Man_Hours</th>
	  <th>Date</th>
	  <th>Hours</th>
	  <th>action</th>
    </tr>
    
    
    <tr>
      <td><input type="checkbox" class="chk" name="chk[]" id="chk_1" value="1" style="width:15px;height:20px;"/></td>
    
      <td><select id="client_1" name="client[]" onchange="getclient_data(1,this.value)" class="form-control" >
			<option value="">Select Client</option>
			<?php
			$dep_sql=$con->query("SELECT * FROM client_master client_master");
			while($dep_sql_res=$dep_sql->fetch(PDO::FETCH_ASSOC))
			{
			?>
			<option value="<?php echo $dep_sql_res['id']; ?>"><?php echo $dep_sql_res['org_name']; ?></option>
			<?php
			}
			?>
			</select></td>
			<td><select id="project_name_1" name="project_name[]"  onchange="getModules_data(1,this.value)" class="form-control">
			</select></td>
			<td><select id="modules_1" name="modules[]" onchange="getemp_data(1,this.value)" class="form-control">
			</select></td>
			<TD>
			<select  name="employees[]" id="employees_1" onchange="gethrs_data(1,this.value)" class="form-control" >
			</select>
			</td>
     <td>
	 
			<select id="no_of_working_hours_1" name="no_of_working_hours[]" class="form-control"></td>
			
			 <td><input type="date" class="form-control" id="date_1" name="date[]"></td>
			  <td><input type="text" class="form-control" id="time_1" name="time[]"></td>
     
      <td><input type="button" class="btn btn-success" id="new_row" name="new_row" onclick="check()" value="Add">
      <input type="button" class="btn btn-danger" id="row_remove"  value="Remove">
    </td>
    </tr>
   
     
    </table>

                       
 <input type="button" class="btn btn-success" id="save" name="save" onclick="project_schedule_submit()" value="Save">

		
		
			
			
			


</form>
<script>
function project_schedule_submit()
    {
    var id=0;
	
 var data = $('form').serialize();

 
 $.ajax({
    type:'GET',
    data:"id="+id, data,
	
    url:'HRMS/Recruitment/project_management/project_schedule/add_project_sheduled.php',
    success:function(data)
    {
      if(data==1)
      { 
        alert('Not');
      }
      else
      {
        alert("Update Successfully");
	project()
      }
      }           
    });
    }
	
function getclient_data(v,c){
			  //alert(v);
			  //var client_id=document.getElementById('client_'+v).value;
			    //document.getElementById("demo").innerHTML = "You selected: " + client_id;

			  $.ajax({
				  type: "GET",
					url: "/HRMS/HRMS/Recruitment/project_management/project_schedule/find_client.php?client_id="+c,
					success: function(data){
					$("#project_name_"+v).html(data);
					}
					});

		  }
		  
		   function getModules_data(v,c){
			 // alert(v);
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
		  function getemp_data(v,c){
			 // alert(v);
			
			  $.ajax({
url: "/HRMS/HRMS/Recruitment/project_management/project_schedule/find_emp.php?emp_id="+c,
type: "GET",

success: function(data){
$("#employees_"+v).html(data);
}
});

		  }
		  function gethrs_data(v,c){
			
			  $.ajax({
url: "/HRMS/HRMS/Recruitment/project_management/project_schedule/find_hours.php?project_id="+c,
type: "GET",

success: function(data){
$("#no_of_working_hours_"+v).html(data);
}
});

		  }
	function back()
    {
    $.ajax({

    type:"POST",
    url:"/HRMS/HRMS/Recruitment/project_management/project_schedule/project_schedule.php",
    success:function(data){
   $("#main_content").html(data);
    }
    })
  }
  

    function check() // education
    {
    var len=$('#new_tab tr').length;	
    len=len+1; 
    $('#new_tab').append('<tr class="row_'+len+'"><td><input type="checkbox" class="chk" name="chk[]" id="chk_'+len+'" value="'+len+'"</td><td><select id="client_'+len+'" name="client[]" onchange="getclient_data('+len+',this.value)" class="form-control" ><option value="">Select Client</option><?php $dep_sql=$con->query("SELECT * FROM project_management INNER JOIN client_master ON project_management.Client=client_master.id"); while($dep_sql_res=$dep_sql->fetch(PDO::FETCH_ASSOC)){ ?><option value="<?php echo $dep_sql_res['id']; ?>"><?php echo $dep_sql_res['org_name']; ?></option><?php } ?></select></td><td><select id="project_name_'+len+'" name="project_name[]"  class="form-control" onchange="getModules_data('+len+',this.value)"></select>	</td><td><select id="modules_'+len+'" name="modules[]"  onchange="getemp_data('+len+',this.value)" class="form-control"></select></td><TD><select  name="employees[]" id="employees_'+len+'" onchange="gethrs_data('+len+',this.value)" class="form-control" ></select></td><td><select id="no_of_working_hours_'+len+'" name="no_of_working_hours[]" class="form-control"><td><input type="date" class="form-control" id="date_'+len+'" name="date[]"></td><td><input type="text" class="form-control" id="time_'+len+'" name="time[]"></td></td></tr>'); 
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
	