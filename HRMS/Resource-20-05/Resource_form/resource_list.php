<?php
require '../../../connect.php';
include("../../../user.php");
$userrole=$_SESSION['userrole'];
?>
<style>
#page-wrapper{
	margin-left: 117px !important;
}
.btn-warning{
	padding-top: 0px !important;
}

.btn-warning{
	background-color: #337ab7 !important;
    border-color: #337ab7 !important;
}
.btn-success{
	background-color: #5cb85c !important;
    border-color: #5cb85c !important;
}
.page-header{
	border-bottom: 3px solid #eee !important;
}
</style>

<div class="content-wrapper" id="page-wrapper">
<div class="container-fluid">
<div id="table_view">
 <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header">Resource List</h1>
                        </div>
                        </div>
						<div class="row">
						 
                        <!-- /.col-lg-12 -->
                    </div>
					
					<br>
					
					<div class="row content">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    Resource  
                                </div>
					
    <!-- Content Header (Page header) -->
    
    <!-- Main content -->
  
   <div class="panel-body">
      <div class="table-responsive">
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
	 
      </div>
<!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div><!-- /.container-fluid -->

<!-- /.content -->
</div>
</div>
</div>
</div>
<script>
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
		$("#table_view").html(data);
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
		$('#table_view').html(data);
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