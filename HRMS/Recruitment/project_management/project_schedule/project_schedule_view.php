<?php
require '../../../../connect.php';
include("../../../../user.php");
$userrole=$_SESSION['userrole'];

$id=$_REQUEST['id'];
$stmt = $con->prepare("SELECT project_schedule.id as projectscheduleid,project_modules.modules as modulename,client_master.*,project_management.*,
project_modules.*,staff_master.*,project_schedule.*	 FROM `project_schedule`
	 INNER JOIN client_master ON project_schedule.client_id=client_master.id 
	 INNER JOIN project_management ON project_schedule.project_id=project_management.project_id 
	 INNER JOIN project_modules ON project_schedule.modules=project_modules.id 
	 INNER JOIN staff_master ON project_schedule.employees=staff_master.id
	 where project_schedule.id='$id'"); 

$stmt->execute(); 
$row = $stmt->fetch();
?>
  <div class="card card-info">
              <div class="card-header">
                
				              <center><h3 class="card-title"><b>Project Shedule</b></h3></center>
		<a onclick="return back()" style="float: right;" data-toggle="modal" class="btn btn-danger"></i>Back</a>
              </div>
<div class="card mb-3">

<form role="form" name="" action="" method="post" enctype="multipart/type">


				  <br>
				  <br>
				 
				  <div class="form-group row">
                    <label for="inputdob" class="col-sm-2 col-form-label">Client</label>
                    <div class="col-sm-4">
					 <input type="hidden" class="form-control" id="get_id" name="get_id" value="<?php echo $id; ?>">
					
                         <input type="text" class="form-control" name="name" id="name" value="<?php echo  $row['org_name'];?>"readonly>
                    </div>
                  </div>
				 
				   <div class="form-group row">
                    <label for="inputdob" class="col-sm-2 col-form-label">Project Name</label>
                    <div class="col-sm-4">
                         <input type="text" class="form-control" name="proposal" id="proposal" value="<?php echo  $row['Project_Name'];?>"readonly>
                    </div>
                  </div>
				    <div class="form-group row">
                    <label for="inputdob" class="col-sm-2 col-form-label">Modules</label>
                    <div class="col-sm-4">
                         <input type="text" class="form-control" name="Hours" id="Hours" value="<?php echo  $row['modulename'];?>"readonly>
                    </div>
                  </div>
				
				  <div class="form-group row">
                    <label for="inputdob" class="col-sm-2 col-form-label">Module  Man Hours</label>
                    <div class="col-sm-4">
                         <input type="text" class="form-control" name="Hours" id="Hours" value="<?php echo  $row['no_of_working_hours1'];?>"readonly>
                    </div>
                  </div>
				  <div class="form-group row">
                    <label for="inputdob" class="col-sm-2 col-form-label">Scheduled Man Hours</label>
                    <div class="col-sm-4">
                         <input type="text" class="form-control" name="Hours" id="Hours" value="<?php echo  $row['schedule_hours'];?>"readonly>
                    </div>
                  </div>
				  
				  
				   


</form>
