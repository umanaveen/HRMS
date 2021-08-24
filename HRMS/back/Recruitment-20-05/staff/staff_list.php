<?php
require '../../../connect.php';
include("../../../user.php");
$userrole=$_SESSION['userrole'];
?>

	<div id="table_view">
<div class="content-wrapper" style="padding-left: 50px;">

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Staff List</h1>
          </div>
          
        </div>
      </div><!-- /.container-fluid -->
	</section>
    <!-- Main content -->
    <section class="content">
    <div class="container-fluid">
    <div class="row">
    <div class="col-md-12">
    <!-- Profile Image -->
    <div class="card card-primary card-outline">
    <div class="card-body box-profile">

<table id="example1" class="table table-bordered">
	   <thead>
		<tr>
		  <th>Id</th>
		  <th>Code</th>
		  <th>Staff Name</th>
		  <th>Department</th>
		  <th>Status</th>
		  
		   <th>Action</th>
		</tr>
      </thead>
      <tbody>
      <?php
      $emp_sql=$con->query("SELECT *,s.id as id,s.status as status FROM staff_master s left join z_department_master d on s.dep_id=d.id where s.status=1");
      $i=1;
      while($emp_res = $emp_sql->fetch(PDO::FETCH_ASSOC))
      {
      $emp_id = $emp_res['id'] ;
      ?>
      <tr>
		  <td><?php echo $i; ?></td>
		  <td><?php echo $emp_res['prefix_code'].$emp_res['emp_code']; ?></td>
		  <td><?php echo $emp_res['emp_name']; ?></td>		 
		  <td><?php echo $emp_res['dept_name']; ?></td>		  
		  <td>
		  <?php 
		  if($emp_res['status'] == 1)
		  {
			  ?>
		<span style="color:orange;text-align:center;"><b>Active</b></span>
		  <?php
		  } else if($emp_res['status'] == 0)
		  {
		  ?>
		  <span style="color:green;text-align:center;"><b>In Active</b></span>
		  <?php
		  }  
		  ?>		   
		  </td>
		  
		   <td><?php if($emp_res['status'] == 1){
			  ?>
		  <button class="btn btn-primary btn-sm" data-id="<?php echo $emp_res['id']; ?>" onclick="edit(<?php echo $emp_res['candid_id']; ?>)"> <i class="fa fa-mail">Edit</i><?php }  ?></button>
		  
		  <button class="btn btn-success btn-sm" data-id="<?php echo $emp_res['id']; ?>" onclick="staff_view(<?php echo $emp_res['id']; ?>)"> View</button>
		  
		  <button class="btn btn-primary btn-sm" data-id="<?php echo $emp_res['id']; ?>" onclick="staff_mail(<?php echo $emp_res['id']; ?>)"> Send Mail</button>
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
	  <script>
	  
	   function staff_mail(v)
	  {
		$.ajax({
			type:"POST",
			url:"HRMS/Recruitment/staff/send_mail.php?id="+v,
			success:function(data)
			{
				alert("Mail Sended Successfully")
			}
		})
	  }
	  
	  
	  function staff_view(v)
	  {
	$.ajax({
	type:"POST",
	url:"HRMS/Recruitment/staff/document_view.php?id="+v,
	success:function(data)
	{
		$("#table_view").html(data);
	}
	})

	  }
	  
	  function edit(v)
	  {
		 
		  $.ajax({
	type:"POST",
	url:"HRMS/Recruitment/staff/staff_edit.php?id="+v,
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