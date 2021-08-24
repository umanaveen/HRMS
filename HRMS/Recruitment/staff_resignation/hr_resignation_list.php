<?php
require '../../../connect.php';
include("../../../user.php");
$userrole=$_SESSION['userrole'];
?>

	<div id="table_view">
<div  class="card card-primary">
              <div class="card-header">
            <h1>Staff Resignation List</h1>
          </div>
          
       
    <!-- Main content -->
    <section class="content">
    <div class="container-fluid">
    <div class="row">
    <div class="col-md-12">
    <!-- Profile Image -->
    <div class="card card-primary card-outline">
    <div class="card-body box-profile">

<table class="dataTables-example table table-striped table-bordered table-hover" id="example1">
	   <thead>
		<tr>
		  <th>Id</th>
		  <th>Name</th>
		  <th>Reason</th>
		  <th>Remarks</th>
		  <th>Date</th>
		  <th>Status</th>		  
		  <th>Action</th>
		  <th></th>
		</tr>
      </thead>
      <tbody>
      <?php
      $emp_sql=$con->query("SELECT *,s.emp_name as name,r.candidate_id as cid,r.id as id,r.status as status,s.id as sid FROM `resignation_form_details` r join staff_master s on r.candidate_id=s.candid_id");
      $i=1;
      while($emp_res = $emp_sql->fetch(PDO::FETCH_ASSOC))
      {
      $emp_id = $emp_res['id'] ;
      $staff_id = $emp_res['sid'] ;
      $staff_code = $emp_res['prefix_code'] . $emp_res['emp_code'];
      ?>
      <tr>
		  <td><?php echo $i; ?></td>
		  <td><?php echo $emp_res['name']; ?></td>
		  <td><?php echo $emp_res['reason']; ?></td>		 
		  <td><?php echo $emp_res['remarks']; ?></td>		  
		  <td><?php echo $emp_res['applied_date']; ?></td>		  
		  <td>
		  <?php 
		  if($emp_res['status'] == 1)
		  {
		  ?>
		<span style="color:orange;text-align:center;"><b>Watitng</b></span>
		  <?php
		  } else if($emp_res['status'] == 3)
		  {
		  ?>
		  <span style="color:green;text-align:center;"><b>HOD Rejected</b></span>
		  <?php
		  }  
		  		  
		  else if($emp_res['status'] == 2)
		  {
		  ?>
		  <span style="color:green;text-align:center;"><b>HOD Accepted</b></span>
		  <?php
		  }  
		 else if($emp_res['status'] == 4)
		  {
		  ?>
		  <span style="color:green;text-align:center;"><b>Accepted</b></span>
		  <?php
		  }  
		  else if($emp_res['status'] == 5)
		  {
		  ?>
		  <span style="color:green;text-align:center;"><b>Rejected</b></span>
		  <?php
		  }  
		  ?>		   
		  </td>		  
		   <td><?php if($emp_res['status'] == 2 or $emp_res['status'] == 3 )
		   {
			  ?>
		  <button class="btn btn-primary btn-sm" data-id="<?php echo $emp_res['id']; ?>" onclick="hr_approve(<?php echo $emp_res['id']; ?>)"> <i class="fa fa-mail">Approve</i><?php } ?></button>
		  
		  <button class="btn btn-success btn-sm" data-id="<?php echo $emp_res['id']; ?>" onclick="staff_view(<?php echo $emp_res['id']; ?>)"> View</button>
		  <input type="hidden" name="canid" id="canid" value="<?php echo $emp_res['cid']; ?>">
		  
		 </td>
		 <?php
		 $cou=$con->query("SELECT count(staff_id) as count FROM `staff_asset_list` where staff_id='$staff_id'");
		 $cfet=$cou->fetch();
		 $staff_count=$cfet['count'];
		 
		 $stats=$con->query("SELECT count(staff_id) as count FROM `staff_asset_list` where staff_id='$staff_id' and status=3");
		 $sta_cou=$stats->fetch();
		 $stats_count=$sta_cou['count'];
		 
		 if($staff_count=$stats_count and $emp_res['status'] == 4)
		 {
			 ?>
			 <td><button class="btn btn-primary btn-sm" data-id="<?php echo $emp_res['id']; ?>" onclick="releving_letter(<?php echo $emp_res['id']; ?>)"> Relieving Letter</button>
		  <button class="btn btn-success btn-sm" data-id="<?php echo $emp_res['id']; ?>" onclick="exp_letter(<?php echo $emp_res['id']; ?>)"> Experience Letter</button>
		  <input type="hidden" name="staff" id="staff" value="<?php echo $emp_res['sid']; ?>">
		  <input type="hidden" name="staff_name" id="staff_name" value="<?php echo $emp_res['emp_name']; ?>">
		  <input type="hidden" name="applied_date" id="applied_date" value="<?php echo $emp_res['applied_date']; ?>">
		  <input type="hidden" name="notice" id="notice" value="<?php echo $emp_res['notice_period']; ?>">
		  <input type="hidden" name="dep" id="dep" value="<?php echo $emp_res['dep_id']; ?>">
		  <input type="hidden" name="designation" id="designation" value="<?php echo $emp_res['design_id']; ?>">
		  <input type="hidden" name="staff_code" id="staff_code" value="<?php echo $staff_code; ?>">
		  </td>
			 <?php 
		 }
		 ?>
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
	$(document).ready(function() {
		$('.dataTables-example').DataTable({
				responsive: true
		});
	});
  </script>
	  <script>
	  
	  function staff_view(v)
	  {
		  var cid=$('#canid').val();
	$.ajax({
	type:"POST",
	url:"/HRMS/HRMS/Recruitment/staff_resignation/hr_staff_view.php?id="+v+"&cid="+cid,
	success:function(data)
	{
		$("#table_view").html(data);
	}
	})

	  }
	 
	  function hr_approve(v)
	  {
		  var cid=$('#canid').val();
	$.ajax({
	type:"POST",
	url:"/HRMS/HRMS/Recruitment/staff_resignation/hr_approve.php?id="+v+"&cid="+cid,
	success:function(data)
	{
		$("#table_view").html(data);
	}
	})

	  }
	  
	 function releving_letter(v)
	  {
		  var staff=$('#staff').val();
		  var staf_code=$('#staff_code').val();
		  var staff_name=$('#staff_name').val();
		  var applied_date=$('#applied_date').val();
		  var notice=$('#notice').val();
	$.ajax({
	type:"POST",
	url:"/HRMS/HRMS/Recruitment/staff_resignation/relieving_letter.php?id="+v+"&staff="+staff+"&staff_code="+staf_code+"&staff_name="+staff_name+"&applied_date="+applied_date+"&notice="+notice,
	success:function(data)
	{
		$("#table_view").html(data);
	}
	})

	  }
	  
function exp_letter(v)
	  {
		  var staff=$('#staff').val();
		  var staf_code=$('#staff_code').val();
		  var staff_name=$('#staff_name').val();
		  var designation=$('#designation').val();
		  var dep=$('#dep').val();
		  var notice=$('#notice').val();
	$.ajax({
	type:"POST",
	url:"/HRMS/HRMS/Recruitment/staff_resignation/experience.php?id="+v+"&staff="+staff+"&staff_code="+staf_code+"&staff_name="+staff_name+"&designation="+designation+"&dep="+dep+"&notice="+notice,
	success:function(data)
	{
		$("#table_view").html(data);
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