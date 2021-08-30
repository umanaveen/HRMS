<?php
require '../../connect.php';
include("../../user.php");
 $userrole=$_SESSION['userrole'];

?>
<style>
#page-wrapper{
	margin-left: 117px !important;
}
</style>
	<div id="table_view">
<div  class="card card-primary">
              <div class="card-header">
                            <h1 class="page-header">Document List</h1>
                        </div>
						
						
				
					<br>
					
					<div class="row content">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    
                                </div>
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="dataTables-example table table-striped table-bordered table-hover" id="example1">
                                      
		
	   <thead>
		<tr>
		  <th>Id</th>
		  <th>Candidate Name</th>
		  <th>Position</th>
		  <th>Phone</th>
		  
		  <th>Head Status</th>
		  <th>Status</th>
		  
		   <th>Action</th>
		</tr>
      </thead>
      <tbody>
      <?php
      $emp_sql=$con->query("SELECT *,c.status as status,c.id as id FROM candidate_form_details c join designation_master d on c.final_designation=d.id where c.status=18 or c.status=19 or c.status=20 or c.status=21 or c.status=22 or c.status=23 or c.status=24 order by c.id desc");
      $i=1;
      while($emp_res = $emp_sql->fetch(PDO::FETCH_ASSOC))
      {
      $emp_id = $emp_res['id'] ;
      ?>
      <tr>
	  <td><?php echo $i; ?></td>
		  <td><?php echo $emp_res['first_name']; ?></td>
		 
		  <td><?php echo $emp_res['designation_name']; ?></td>
		  <td><?php echo $emp_res['phone']; ?></td>
		  
		    <td>
		  
			  <?php
		 echo '<span style="color:brown;text-align:center;"><b>MD LEVEL CLEARED</b></span>';
		  ?>
		 
		  </td>
		     <td>
		  <?php 
		  if($emp_res['status'] == 7)
		  {
			  ?>
		<span style="color:orange;text-align:center;"><b>PENDING</b></span>
		  <?php
		  } else if($emp_res['status'] == 13){
		  ?>
		  <span style="color:green;text-align:center;"><b>Selected for Fourth Level</b></span>
		  <?php
		  }  else if($emp_res['status'] == 8){
		  ?>
		   <span style="color:blue;text-align:center;"><b>Waiting List</b></span>
		  <?php
		  } else if($emp_res['status'] == 9){
		  ?>
		    <span style="color:Red;text-align:center;"><b>Rejected</b></span>
			<?php
		  }
		  else if($emp_res['status'] == 19){
		  ?>
		    <span style="color:green;text-align:center;"><b>Mail Sent</b></span>
			<?php
		  }
		  else if($emp_res['status'] == 17){
		  ?>
		    <span style="color:green;text-align:center;"><b>Document Submited</b></span>
			<?php
		  }
		  else if($emp_res['status'] == 18){
		  ?>
		    <span style="color:green;text-align:center;"><b>Document Approved</b></span>
			<?php
		  }
		   else if($emp_res['status'] == 19){
		  ?>
		    <span style="color:green;text-align:center;"><b>Freezed</b></span>
			<?php
		  } 
		  ?>
		  </td>
		  
		   <td><?php if($emp_res['status'] == 20){
			  ?>
		  <button class="btn btn-primary btn-sm" data-id="<?php echo $emp_res['id']; ?>" onclick="approve(<?php echo $emp_res['id']; ?>)"> <i class="fa fa-mail">Approve</i></button>
		  <button class="btn btn-danger btn-sm" data-id="<?php echo $emp_res['id']; ?>" onclick="edit_application(<?php echo $emp_res['id']; ?>)"> <i class="fa fa-mail">Edit</i></button>
		  <button class="btn btn-primary btn-sm" data-id="<?php echo $emp_res['id']; ?>" onclick="candidate_reupload(<?php echo $emp_res['id']; ?>)"> <i class="fa fa-mail">Reupload</i></button>
		  
		  <?php }  ?>
		  <?php if($emp_res['status'] == 23)
		  {
			  ?>			  
		  <button class="btn btn-primary btn-sm" data-id="<?php echo $emp_res['id']; ?>" onclick="insert_emp(<?php echo $emp_res['id']; ?>)"> <i class="fa fa-mail">Freeze</i>
		  <?php }  ?></button>
		  
		  <button class="btn btn-success btn-sm" data-id="<?php echo $emp_res['id']; ?>" onclick="view(<?php echo $emp_res['id']; ?>)"> View</button>
		   
		 </td>
      </tr>
      <?php
	  $i++;
      }
      ?>
      </tbody>
      </table>
	  </div>
	  </div>
	  </div>
	  </div>
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
	  function view(v)
	  {
	$.ajax({
	type:"POST",
	url:"HRMS/HRMS/document_view.php?id="+v,
	success:function(data)
	{
		$("#table_view").html(data);
	}
	})

	  }
	  
	  function approve(v)
	  {
		  $.ajax({
	type:"POST",
	url:"HRMS/HRMS/document_approve.php?id="+v,
	success:function(data)
	{
		alert("Approved");
		/* if(data==0)
		{
			alert("Approved");
			document_approve();
		}
		else{
			alert("Failed");
			document_approve();
		} */
	}
	})
		  
	  }
	 function edit_application(v)
	  {
		  $.ajax({
	type:"POST",
	url:"HRMS/HRMS/document_edit.php?id="+v,
	success:function(data)
	{
		$("#table_view").html(data);
	}
	});
		  
	  }
	  function candidate_reupload(v)
	  {
		  $.ajax({
	type:"POST",
	url:"HRMS/HRMS/document_reupload.php?id="+v,
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
	});
		  
	  }
	  
	  function insert_emp(v)
	  {
		  $.ajax({
	type:"POST",
	url:"HRMS/HRMS/insert_employee.php?id="+v,
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