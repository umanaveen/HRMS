<?php
require '../../../../connect.php';
include("../../../../user.php");
$userrole=$_SESSION['userrole'];

$id=$_REQUEST['id'];
$stmt = $con->prepare("SELECT * FROM `project_management` 
	 INNER JOIN project_modules ON project_management.project_id=project_modules.projectmanagement_id
	 INNER JOIN client_master ON project_management.Client=client_master.id
	 where project_management.project_id='$id'"); 

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
<input type="hidden" name="userrole" id="userrole" value="<?php echo  $userrole; ?>">

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
                    <label for="inputdob" class="col-sm-2 col-form-label">Total Man Hours</label>
                    <div class="col-sm-4">
                         <input type="text" class="form-control" name="Hours" id="Hours" value="<?php echo  $row['Total_Man_Hours'];?>"readonly>
                    </div>
                  </div>
				  <div class="form-group row">
                    <label for="inputdob" class="col-sm-2 col-form-label">Project Deadline Date</label>
                    <div class="col-sm-4">
                         <input type="date" class="form-control" name="date" id="date" value="<?php echo  $row['Project_Deadline_Date'];?>"readonly>
                    </div>
                  </div>
				  
				   <table class="table table-bordered">
<h3><center>Project Management Entry Details</center></h3>
<tbody>

<?php

$sql=$con->query("SELECT * FROM  project_modules
INNER JOIN z_department_master ON project_modules.Department=z_department_master.id
INNER JOIN staff_master ON project_modules.Employee=staff_master.id
 where projectmanagement_id='$id'");


$cnt=1;
while($rows = $sql->fetch(PDO::FETCH_ASSOC))

{
	
		?>
<tr>

<td>Modules</td>
<td><input type="text" class="form-control" id="modules" name="modules[]" value="<?php echo  $rows['modules']; ?>" readonly></td>
<td>Department</td>
<td><input type="text" class="form-control" id="Department" name="Department[]" value="<?php echo  $rows['dept_name']; ?>" readonly></td>
<td>Employee</td>
<td><input type="text" class="form-control" id="Employee" name="Employee[]" value="<?php echo  $rows['emp_name']; ?>" readonly></td>
<td>No Of Working Hours</td>
<td><input type="text" class="form-control" id="no_of_working_hours1" name="no_of_working_hours1[]" value="<?php echo  $rows['no_of_working_hours1']; ?>" readonly></td>



</tr>
<?php 
$cnt=$cnt+1;
 }?>
 </tbody>
 
      </table>


</form>
