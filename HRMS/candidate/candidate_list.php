<?php
require '../../connect.php';
include("../../user.php");
$userrole=$_SESSION['userrole'];
?>

	<div id="table_view">
<div  class="card card-primary">
              <div class="card-header">
            <h4>Interview candidates List</h4>
			
          </div>
        
    <!-- Main content -->
    

<table class="dataTables-example table table-striped table-bordered table-hover" id="example1">
	   <thead>
		<tr>
		  <th>Id</th>
		  <!--th>Company Name</th-->
		  <th>Name</th>
		  <th>Scheduled Date</th>
		  <!--th>Department</th-->
		  <th>Position</th>
		  <th>Phone</th>
		  <th>Mail</th>
		  <th>Status</th>	  
		  <th>Action</th>
		</tr>
      </thead>
      <tbody>
      <?php
      $emp_sql=$con->query("SELECT *,c.id as cid,c.status as status FROM `candidate_form_details` c left join company_master cm on c.company_name=cm.id left join designation_master d on c.position=d.id left join z_department_master z on c.department=z.id join interview_schedule_detail i on c.resource_id=i.resource_id  where c.status=2 or c.status=3 or c.status=4 or c.status=6 or c.status=20 or c.status=5 or c.status=7 or c.status=8 or c.status=9 or c.status=13 or c.status=14 or c.status=15 or c.status=16 or c.status=17 or c.status=18 or c.status=19 or c.status=20 or c.status=21 or c.status=22 or c.status=23  or c.status=30 or c.status=35 or c.status=37 order by c.id desc");
      $i=1;
      while($emp_res = $emp_sql->fetch(PDO::FETCH_ASSOC))
      {
      $emp_id = $emp_res['id'] ;
      $cid = $emp_res['cid'] ;
	  
	  $correct_sta=$con->query("SELECT c.round_id,i.name,c.candid_id,f.first_name,c.status as canstatus FROM `candidate_round_details` c join interview_rounds i on c.round_id=i.id join candidate_form_details f on c.candid_id=f.id where f.id='$cid' and c.status=3 order by  c.id desc limit 1");
	  $corfet=$correct_sta->fetch();
	  
	  $sta=$corfet['name'];
	  $canstatus=$corfet['canstatus'];
      ?>
      <tr>
	  <td><?php echo $i; ?></td>
		  <!--td><!?php echo $emp_res['companyname']; ?></td-->
		  <td><?php echo $emp_res['first_name']." ".$emp_res['last_name']; ?></td>
		 
		  <td><?php echo $emp_res['interview_date']; ?></td>
		  <!--td><!?php echo $emp_res['dept_name']; ?></td-->
		  <td><?php echo $emp_res['designation_name']; ?></td>
		  <td><?php echo $emp_res['phone']; ?></td>
		  <td><?php echo $emp_res['mail']; ?></td>
		  <td>
<?php 


 if(($emp_res['status']==11))  
{

echo '<span style="color:green;text-align:center;"><b>Selected</b></span>';
}
if(($emp_res['status']==12))  
{
echo '<span style="color:red;text-align:center;"><b>Rejected</b></span>';

}
if(($emp_res['status']==0))  
{
echo '<span style="color:green;text-align:center;"><b>SELECTED FOR  TECHNICAL</b></span>';

}
if(($emp_res['status']==1))  
{
echo '<span style="color:blue;text-align:center;"><b>Waiting List</b></span>';

}
if(($emp_res['status']==2))  
{
echo '<span style="color:blue;text-align:center;"><b>Candidate form submited</b></span>';

}
if(($emp_res['status']==3))  
{
echo '<span style="color:red;text-align:center;"><b>Allocate to ' .$sta.' level </b></span>';

}
if(($emp_res['status']==4))  
{
echo '<span style="color:green;text-align:center;"><b>Question Allocated</b></span>';

}
if(($emp_res['status']==6))  
{
echo '<span style="color:blue;text-align:center;"><b>Technical one Waiting List</b></span>';

}
if(($emp_res['status']==7))  
{
echo '<span style="color:red;text-align:center;"><b>Technical one Rejected</b></span>';

}
if(($emp_res['status']== 8))  
{
echo '<span style="color:green;text-align:center;"><b>Schedule interview round</b></span>';

}
if(($emp_res['status']== 9))  
{
echo '<span style="color:green;text-align:center;"><b>Assessment level rejected</b></span>';

}
if(($emp_res['status']==5))  
{
echo '<span style="color:blue;text-align:center;"><b>Technical one selected</b></span>';

}
if(($emp_res['status']==9))  
{
echo '<span style="color:red;text-align:center;"><b>REJECTED</b></span>';

}
if(($emp_res['status']==13))  
{
echo '<span style="color:red;text-align:center;"><b>Selected For Third Level</b></span>';

}
if(($emp_res['status']==14))  
{
echo '<span style="color:red;text-align:center;"><b>Technical two Waiting List</b></span>';

}
if(($emp_res['status']==15))  
{
echo '<span style="color:red;text-align:center;"><b>Technical two Rejected</b></span>';

}
if(($emp_res['status']==16))  
{
echo '<span style="color:red;text-align:center;"><b>MD Approved</b></span>';

}
if(($emp_res['status']==17))  
{
echo '<span style="color:red;text-align:center;"><b>MD Level Waiting List</b></span>';

}
if(($emp_res['status']==18))  
{
echo '<span style="color:red;text-align:center;"><b>MD Level Rejected</b></span>';

}
if(($emp_res['status']==19))  
{
echo '<span style="color:red;text-align:center;"><b>Application Form Sent</b></span>';

}
if(($emp_res['status']==20))  
{
echo '<span style="color:red;text-align:center;"><b>Waiting For Document Approve</b></span>';

}
if(($emp_res['status']==22))  
{
echo '<span style="color:red;text-align:center;"><b>Document Approved</b></span>';

}
if(($emp_res['status']==23))  
{
echo '<span style="color:blue;text-align:center;"><b>Staff Type allocated</b></span>';

}
if(($emp_res['status']==24))  
{
echo '<span style="color:blue;text-align:center;"><b>Staff</b></span>';

}
if(($emp_res['status']==30))  
{
echo '<span style="color:blue;text-align:center;"><b>Waiting For Assessment Approve</b></span>';

}
if(($emp_res['status']==32))  
{
echo '<span style="color:blue;text-align:center;"><b>Rejected</b></span>';

}
if(($emp_res['status']==35))  
{
echo '<span style="color:blue;text-align:center;"><b>HR Level Selected</b></span>';

}
if(($emp_res['status']==37))  
{
echo '<span style="color:blue;text-align:center;"><b>HR Level Waiting List</b></span>';

}

 
?>
</td>
		     <!--td>
		  <!?php 
		  if($emp_res['status'] == 1)
		  {
			  ?>
		<span style="color:orange;text-align:center;"><b>Active</b></span>
		  <!?php
		  } else if($emp_res['status'] == 0){
		  ?>
		  <span style="color:green;text-align:center;"><b>In Active</b></span>
		  <!?php
		  }  
		  ?>
		   
		  </td-->
		  <?php 
		  if($emp_res['status'] == 2 || $emp_res['status'] == 5 || $emp_res['status'] == 8 || $emp_res['status'] == 13|| $emp_res['status'] == 35)
		  {
			  ?>
			  <td><button class="btn btn-primary btn-sm" data-id="<?php echo $emp_res['id']; ?>" onclick="candidate_edit(<?php echo $emp_res['cid']; ?>)"> Allocate</button></td>
		  <?php
		  }
		  else if($emp_res['status'] == 4 || $emp_res['status'] == 6 || $emp_res['status'] == 3 || $emp_res['status'] == 14 || $emp_res['status'] == 15||  $emp_res['status'] == 17|| $emp_res['status'] == 18|| $emp_res['status'] == 23 || $emp_res['status'] == 24 || $emp_res['status'] == 30 || $emp_res['status'] == 32 || $emp_res['status'] == 35 || $emp_res['status'] == 37)
		  {
			 ?> 
			 <td><button class="btn btn-success btn-sm" data-id="<?php echo $emp_res['id']; ?>" onclick="candidate_view(<?php echo $emp_res['cid']; ?>)"> View</button></td>
		<?php	  
		  }
		 else if($emp_res['status'] == 16)
		  {
			 ?> 
			 <td><button class="btn btn-success btn-sm" data-id="<?php echo $emp_res['id']; ?>" onclick="candidate_view(<?php echo $emp_res['cid']; ?>)"> View</button>
			 <button class="btn btn-primary btn-sm" data-id="<?php echo $emp_res['id']; ?>" onclick="joining_detail(<?php echo $emp_res['cid']; ?>)"> Joining Detail</button></td>
			<!--button class="btn btn-success btn-sm" data-id="<?php echo $emp_res['id']; ?>" onclick="send_application(<?php echo $emp_res['cid']; ?>)"> Application Form</button></td-->
		<?php	  
		  }
		  else if($emp_res['status'] == 22)
		  {
			 ?> 
			 <td><button class="btn btn-success btn-sm" data-id="<?php echo $emp_res['id']; ?>" onclick="candidate_view(<?php echo $emp_res['cid']; ?>)"> View</button>
			<button class="btn btn-primary btn-sm" data-id="<?php echo $emp_res['id']; ?>" onclick="staff_code(<?php echo $emp_res['cid']; ?>)"> Staff code allocation</button></td>
		<?php	  
		  }
		  elseif($emp_res['status'] == 19 || $emp_res['status'] == 20 || $emp_res['status'] == 21 )
		   {
			 ?> 
			 <td><button class="btn btn-success btn-sm" data-id="<?php echo $emp_res['id']; ?>" onclick="candidate_view(<?php echo $emp_res['cid']; ?>)"> View</button>
			<button class="btn btn-danger btn-sm" data-id="<?php echo $emp_res['id']; ?>" onclick="rejection(<?php echo $emp_res['cid']; ?>)">Reject</button></td>
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
	  <script>
	$(document).ready(function() {
		$('.dataTables-example').DataTable({
				responsive: true
		});
	});
  </script>
	  <script>
	  
	  function candidate_edit(v)
	  {
	$.ajax({
	type:"POST",
	url:"HRMS/candidate/candidate_round_allocation.php?id="+v,
	success:function(data)
	{
		$("#table_view").html(data);
	}
	})

	  }
	  
	  function candidate_view(v)
	  {
		 
		  $.ajax({
	type:"POST",
	url:"HRMS/candidate/candidate_view.php?id="+v,
	success:function(data)
	{
		$('#table_view').html(data);
	}
	})
		  
	  }
	  
	function send_application(v)
	{
	$.ajax({
	type:"POST",
	url:"HRMS/candidate/send_application_form.php?id="+v,
	success:function(data)
	{
		alert("Application form sent successfully");
		interview_candidate_list();
		//$('#table_view').html(data);
	}
	})
	}
	function joining_detail(v)
	{
	$.ajax({
	type:"POST",
	url:"HRMS/candidate/joining_detail.php?id="+v,
	success:function(data)
	{
		//alert("Application form sent successfully");
		//interview_candidate_list();
		$('#table_view').html(data);
	}
	})
	}
	 function staff_code(v)
	{
	$.ajax({
	type:"POST",
	url:"HRMS/candidate/staff_code_allocation.php?id="+v,
	success:function(data)
	{
		$('#table_view').html(data);
	}
	})
	}
	
	 function rejection(v)
	{
	$.ajax({
	type:"POST",
	url:"HRMS/candidate/candidate_rejection.php?id="+v,
	success:function(data)
	{
		$('#table_view').html(data);
	}
	})
	}
	  
	  
	  </script>