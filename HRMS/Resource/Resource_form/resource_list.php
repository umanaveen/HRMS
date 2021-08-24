<?php
require '../../../connect.php';
include("../../../user.php");
$userrole=$_SESSION['userrole'];
$consultantid=$_SESSION['consultantid'];
?>

<div  class="card card-primary">
              <div class="card-header">
                <h3 class="card-title"><font size="5">Resource List</font></h3>
			
			
              </div>
              <!-- /.card-header -->
              <div class="card-body">
<?php 
if($consultantid=='')
{
?>
       <table class="dataTables-example table table-striped table-bordered table-hover" id="example1">		 
   
    <thead>
		<tr>
		  <th>Id</th>
		  <th>Date</th>
		  <th>Name</th>
		  <th>Designation</th>
		  <th>Contact No</th>
		  <th>Resource Type</th>
		  <th>Status</th>
		  
		   <th>Action</th>
		</tr>
      </thead>
      <tbody>
      <?php
      $emp_sql=$con->query("SELECT *,s.id as sid,s.status as status FROM resource_form_detail s left join designation_master d on s.position=d.id join source_master sm on s.source=sm.id order by s.id desc");
      $i=1;
      while($emp_res = $emp_sql->fetch(PDO::FETCH_ASSOC))
      {
      $emp_id = $emp_res['id'] ;
      ?>
      <tr>
		  <td><?php echo $i; ?></td>
		  <td><?php echo $emp_res['date']; ?></td>		 
		  <td><?php echo $emp_res['first_name']." ".$emp_res['last_name']; ?></td>		  
		  <td><?php echo $emp_res['designation_name']; ?></td>		  
		  <!--td><!?php echo $emp_res['aadhar_no']; ?></td-->		  
		  <td><?php echo $emp_res['mobile']; ?></td>		  
		  <td><?php echo $emp_res['employement_status']; ?></td>		  
		  <td>
		  <?php 
		  if($emp_res['status'] == 1)
		  {
			  ?>
		<span style="color:orange;text-align:center;"><b>Not Scheduled</b></span>
		  <?php
		  } else if($emp_res['status'] == 2)
		  {
		  ?>
		  <span style="color:green;text-align:center;"><b>Scheduled</b></span>
		  <?php
		  }  
		  ?>		   
		  </td>
		  
		   <td><?php if($emp_res['status'] == 1){
			  ?>
		  <button class="btn btn-primary btn-sm" data-id="<?php echo $emp_res['sid']; ?>" onclick="schedule(<?php echo $emp_res['sid']; ?>)"> <i class="fa fa-mail">Schedule</i><?php }  ?></button>
		  
		  <button class="btn btn-success btn-sm" data-id="<?php echo $emp_res['sid']; ?>" onclick="resource_view(<?php echo $emp_res['sid']; ?>)"> View</button>
		   
		 </td>
      </tr>
      <?php
	  $i++;
      }
      ?>
      </tbody>
      </table>
	 <?php 
}
else
{
	?>
	 <table class="dataTables-example table table-striped table-bordered table-hover" id="example1">		 
   
    <thead>
		<tr>
		  <th>Id</th>
		  <th>Date</th>
		  <th>Name</th>
		  <th>Designation</th>
		  <th>Contact No</th>
		  <th>Resource Type</th>
		  <th>Status</th>
		  
		   <th>Action</th>
		</tr>
      </thead>
      <tbody>
      <?php
      $emp_sql=$con->query("SELECT *,s.id as sid,s.status as status FROM resource_form_detail s left join designation_master d on s.position=d.id join source_master sm on s.source=sm.id where s.created_by='$consultantid' order by s.id desc");
      $i=1;
      while($emp_res = $emp_sql->fetch(PDO::FETCH_ASSOC))
      {
      $emp_id = $emp_res['id'] ;
      ?>
      <tr>
		  <td><?php echo $i; ?></td>
		  <td><?php echo $emp_res['date']; ?></td>		 
		  <td><?php echo $emp_res['first_name']." ".$emp_res['last_name']; ?></td>		  
		  <td><?php echo $emp_res['designation_name']; ?></td>		  
		  <!--td><!?php echo $emp_res['aadhar_no']; ?></td-->		  
		  <td><?php echo $emp_res['mobile']; ?></td>		  
		  <td><?php echo $emp_res['employement_status']; ?></td>		  
		  <td>
		  <?php 
		  if($emp_res['status'] == 1)
		  {
			  ?>
		<span style="color:orange;text-align:center;"><b>Not Scheduled</b></span>
		  <?php
		  } else if($emp_res['status'] == 2)
		  {
		  ?>
		  <span style="color:green;text-align:center;"><b>Scheduled</b></span>
		  <?php
		  }  
		  ?>		   
		  </td>
		  
		   <td><?php if($emp_res['status'] == 1){
			  ?>
		  <button class="btn btn-primary btn-sm" data-id="<?php echo $emp_res['sid']; ?>" onclick="schedule(<?php echo $emp_res['sid']; ?>)"> <i class="fa fa-mail">Schedule</i><?php }  ?></button>
		  
		  <button class="btn btn-success btn-sm" data-id="<?php echo $emp_res['sid']; ?>" onclick="resource_view(<?php echo $emp_res['sid']; ?>)"> View</button>
		   
		 </td>
      </tr>
      <?php
	  $i++;
      }
      ?>
      </tbody>
      </table>
	 
	<?php
}
?>
      </div>
 </div>
<script>
function back()
	{
		resource_list();
	}
	
	$(document).ready(function() {
		$('.dataTables-example').DataTable({
				responsive: true
		});
	});
  </script>
 <script>
	  function resource_view(v)
	  {
		
 	$.ajax({
	type:"POST",
	url:"/HRMS/HRMS/resource/resource_form/resource_view.php?id="+v,
	success:function(data)
	{
		$("#main_content").html(data);
	}
	}) 

	  }
	  
	  function schedule(v)
	  {		 
		  $.ajax({
	type:"POST",
	url:"/HRMS/HRMS/resource/resource_form/interview_schedule.php?id="+v,
	success:function(data)
	{
		$("#main_content").html(data);
	}
	})
		  
	  }
	  
	  function insert_emp(v)
	  {
		  $.ajax({
	type:"POST",
	url:"HRMS/Recruitment/insert_employee.php?id="+v,
	success:function(data)
	{
		if(data==0)
		{
			alert("success");
			document_approve();
		}
		else{
			alert("Failed");
			document_approve();
		}
	}
	})
		  
	  }  
	  
	  </script>