<?php
require '../../../../connect.php';
include("../../../../user.php");
$id=$_REQUEST['id'];
$stmt = $con->prepare("SELECT project_schedule.id as project_scheduleid,project_modules.id as project_modulesid,project_schedule.*,project_management.*,project_modules.* FROM `project_schedule` 
 INNER JOIN project_management ON project_schedule.client_id=project_management.Client
 INNER JOIN project_modules ON project_schedule.modules=project_modules.id 
where project_schedule.id='$id'"); 

$stmt->execute(); 
$row = $stmt->fetch();
?>
 <div class="card card-info">
              <div class="card-header">  
              <center><h3 class="card-title"><b>Project To Do  Details </b></h3></center>
			<a onclick="return back()" style="float: right;" data-toggle="modal" class="btn btn-danger"></i>Back</a>
              </div>
			  <br>
			  <br>
			  <br>
              <!-- /.card-header -->
              <!-- form start -->
<form role="form" name="" action="" method="post" enctype="multipart/type">
         
                <div class="card-body">
				  
				  
				  
				    <input type="hidden" class="form-control" id="get_id" name="get_id" value="<?php echo  $id; ?>">
					<input type="hidden" class="form-control" id="get_id" name="gets_id" value="<?php echo  $row['project_modulesid']; ?>">
				  <div class="form-group row">
                    <label for="inputnumber" class="col-sm-2 col-form-label">Project_Name </label>
                    <div class="col-sm-4">
                      <input type="text" class="form-control" name="Project_Name" id="Project_Name" value="<?php echo  $row['Project_Name'];?>"readonly>
                    </div>
                  </div>
				
				 <div class="form-group row">
                    <label for="inputnumber" class="col-sm-2 col-form-label">modules </label>
                    <div class="col-sm-4">
                      <input type="text" class="form-control" name="modules" id="modules" value="<?php echo  $row['modules'];?>"readonly>
                    </div>
                  </div>
				

				 <div class="form-group row">
                    <label for="inputnumber" class="col-sm-2 col-form-label">no_of_working_hours </label>
                    <div class="col-sm-4">
                      <input type="text" class="form-control" name="no_of_working_hours1" id="no_of_working_hours1" value="<?php echo  $row['no_of_working_hours1'];?>"readonly>
                    </div>
                  </div>
				
 <div class="form-group row">
                    <label for="inputnumber" class="col-sm-2 col-form-label">date </label>
                    <div class="col-sm-4">
                      <input type="text" class="form-control" name="date" id="date" value="<?php echo  $row['date'];?>"readonly>
                    </div>
                  </div>
				  
 <div class="form-group row">
                    <label for="inputnumber" class="col-sm-2 col-form-label">schedule_hours </label>
                    <div class="col-sm-4">
                      <input type="text" class="form-control" name="schedule_hours" id="schedule_hours" value="<?php echo  $row['schedule_hours'];?>"readonly>
                    </div>
                  </div>

     <div class="form-group row">
                    <label for="inputnumber" class="col-sm-2 col-form-label">Status </label>
                    <div class="col-sm-4">
					<select id="status" class="form-control"  name="status">
						<option value="">Select</option>
					<option value="2">Completed</option>
                      </select>
                    </div>
                  </div>

	 <input type="button" class="btn btn-success" id="save" name="save" onclick="dolist()" value="Save">
		
              </form>
			   
			
			  
            </div>
			
			<script>

	function back()
	{
		project_to_do_list()
	}
 function dolist()
    {
    var id=$('#get_id').val();
	//alert(id);
 var data = $('form').serialize();
 
    $.ajax({
    type:'GET',
    data:"id="+id, data,
	
  url:"/HRMS/HRMS/Recruitment/project_management/project_to_do_list/project_to_do_list_view_submit.php",
    success:function(data)
    {
      if(data==1)
      { 
        alert('Not');
      }
      else
      {
        alert("Update Successfully");
	 project_to_do_list()
      }
      }           
    });
    }
	
		
 
	
	</script>
	