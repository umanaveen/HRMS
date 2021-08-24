<?php
require '../../../connect.php';
include("../../../user.php");
$userrole=$_SESSION['userrole'];
$consultantid=$_SESSION['consultantid'];

?>

<div class="row">
						 <div class="col-lg-12">
                <h3 class="card-title"><font size="5">Job description List</font></h3>
				</div>
				</div>
				<div class="row">
						 <div class="col-lg-12">
			<!--a onclick="new_jd()" style="float: right;" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"></i>Add</a-->
			
              </div>
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
		  <th>Job title</th>
		  <th>Client</th>
		  <th>Location</th>
		  <th>Experience</th>
		  <th>Joining Date</th>
		  <th>Closing Date</th>
		  <th>Consultant Name</th>
		   <th>Action</th>
		</tr>
      </thead>
      <tbody>
      <?php
      $emp_sql=$con->query("SELECT *,j.status as status,j.id as jid FROM `jobdescription_form_details` j join jobdescription_master m on j.jobdescription_id=m.id join client_master c on j.client_id=c.id join jd_allocation jd on j.id=jd.jd_id join consultant_master cm on jd.consultant_id=cm.consultant_id where j.status=2 or j.status=3 order by j.id desc");
      $i=1;
      while($emp_res = $emp_sql->fetch(PDO::FETCH_ASSOC))
      {
      $emp_id = $emp_res['id'] ;
      ?>
      <tr>
		  <td><?php echo $i; ?></td>
		  <td><?php echo $emp_res['tittle']; ?></td>		 
		  <td><?php echo $emp_res['client_name']; ?></td>		  
		  <td><?php echo $emp_res['location']; ?></td>		  
		  <!--td><!?php echo $emp_res['aadhar_no']; ?></td-->		  
		  <td><?php echo $emp_res['experience']; ?></td>		  
		  <td><?php echo $emp_res['joining_date']; ?></td>		  
		  <td><?php echo $emp_res['closed_date']; ?></td>	 
		  <td><?php echo $emp_res['consultant_name']; ?></td>	 
		  
		   <td>
			  <?php 
			  if($emp_res['status']==2)
			  {
			  ?>
		   <button class="btn btn-success btn-sm" data-id="<?php echo $emp_res['jid']; ?>" onclick="jd_allocation_view(<?php echo $emp_res['jid']; ?>)"> View</button>
		   <?php 
			  }
			  else
			  {
				  ?>
				  
		 
				  <?php
			  }
			  ?>
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
		  <th>Job title</th>
		  <th>Client</th>
		  <th>Location</th>
		  <th>Experience</th>
		  <th>Joining Date</th>
		  <th>Closing Date</th>
		   <th>Action</th>
		</tr>
      </thead>
      <tbody>
      <?php
      $emp_sql=$con->query("SELECT *,j.status as status,j.id as jid FROM `jobdescription_form_details` j join jobdescription_master m on j.jobdescription_id=m.id join client_master c on j.client_id=c.id join jd_allocation jd on j.id=jd.jd_id join consultant_master cm on jd.consultant_id=cm.consultant_id where jd.consultant_id='$consultantid' and j.status=2 order by j.id desc");
      $i=1;
      while($emp_res = $emp_sql->fetch(PDO::FETCH_ASSOC))
      {
      $emp_id = $emp_res['id'] ;
      ?>
      <tr>
		  <td><?php echo $i; ?></td>
		  <td><?php echo $emp_res['tittle']; ?></td>		 
		  <td><?php echo $emp_res['client_name']; ?></td>		  
		  <td><?php echo $emp_res['location']; ?></td>		  
		  <!--td><!?php echo $emp_res['aadhar_no']; ?></td-->		  
		  <td><?php echo $emp_res['experience']; ?></td>		  
		  <td><?php echo $emp_res['joining_date']; ?></td>		  
		  <td><?php echo $emp_res['closed_date']; ?></td>	 
		  
		   <td>
			  <?php 
			  if($emp_res['status']==2)
			  {
			  ?>
		   <button class="btn btn-success btn-sm" data-id="<?php echo $emp_res['jid']; ?>" onclick="jd_allocation_view(<?php echo $emp_res['jid']; ?>)"> View</button>
		   <?php 
			  }
			  else
			  {
				  ?>
				 
						
				 <?php
			  }
			  ?>
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
		jobdescription_list();
	}
	
	$(document).ready(function() {
		$('.dataTables-example').DataTable({
				responsive: true
		});
	});
  </script>
 <script>
	  function new_jd(v)
	  {
		
 	$.ajax({
	type:"POST",
	url:"/HRMS/HRMS/resource/jobdescription_form/jobdescription_form.php?id="+v,
	success:function(data)
	{
		$("#main_content").html(data);
	}
	}) 

	  }
	 function jd_allocation_view(v)
	  {
		
 	$.ajax({
	type:"POST",
	url:"/HRMS/HRMS/resource/jobdescription_form/jd_allocation_view.php?jid="+v,
	success:function(data)
	{
		$("#main_content").html(data);
	}
	}) 

	  }
	  
	  function jd_edit(v)
	  {		 
		  $.ajax({
	type:"POST",
	url:"/HRMS/HRMS/resource/jobdescription_form/jd_edit.php?jid="+v,
	success:function(data)
	{
		$("#main_content").html(data);
	}
	})
		  
	  }
	 
	 function jd_allocate(v)
	  {		 
		  $.ajax({
	type:"POST",
	url:"/HRMS/HRMS/resource/jobdescription_form/jd_allocate.php?jid="+v,
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