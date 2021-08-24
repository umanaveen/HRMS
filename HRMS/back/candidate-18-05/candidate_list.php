<?php
require '../../connect.php';
include("../../user.php");
$userrole=$_SESSION['userrole'];
?>

	<div id="table_view">
<div class="content-wrapper" style="padding-left: 50px;">

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Interview candidates List</h1>
			
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
		  <!--th>Company Name</th-->
		  <th>Name</th>
		  <th>Department</th>
		  <th>Position</th>
		  <th>Phone</th>
		  <th>Mail</th>
		  <th>Status</th>	  
		  <th>Action</th>
		</tr>
      </thead>
      <tbody>
      <?php
      $emp_sql=$con->query("SELECT *,c.id as cid,c.status as status FROM `candidate_form_details` c left join company_master cm on c.company_name=cm.id join designation_master d on c.position=d.id join z_department_master z on c.department=z.id where c.status=2 or c.status=3 or c.status=4 or c.status=6 or c.status=20 or c.status=5 or c.status=7 or c.status=8 or c.status=9 or c.status=13 or c.status=14 or c.status=15 or c.status=16 or c.status=17 or c.status=18 order by c.id desc");
      $i=1;
      while($emp_res = $emp_sql->fetch(PDO::FETCH_ASSOC))
      {
      $emp_id = $emp_res['id'] ;
      ?>
      <tr>
	  <td><?php echo $i; ?></td>
		  <!--td><!?php echo $emp_res['companyname']; ?></td-->
		  <td><?php echo $emp_res['first_name']." ".$emp_res['last_name']; ?></td>
		 
		  <td><?php echo $emp_res['dept_name']; ?></td>
		  <td><?php echo $emp_res['designation_name']; ?></td>
		  <td><?php echo $emp_res['phone']; ?></td>
		  <td><?php echo $emp_res['mail']; ?></td>
		  <td>
<?php if(($emp_res['status']==11))  
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
if(($emp_res['status']==3))  
{
echo '<span style="color:red;text-align:center;"><b>Allocate to technical level</b></span>';

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
if(($emp_res['status']==20))  
{
echo '<span style="color:red;text-align:center;"><b>Waiting For Recruiter Approve</b></span>';

}

?></td>
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
		  if($emp_res['status'] == 2 || $emp_res['status'] == 5 || $emp_res['status'] == 8 || $emp_res['status'] == 13)
		  {
			  ?>
			  <td><button class="btn btn-primary btn-sm" data-id="<?php echo $emp_res['id']; ?>" onclick="candidate_edit(<?php echo $emp_res['cid']; ?>)"> Allocate</button></td>
		  <?php
		  }
		  else if($emp_res['status'] == 4 || $emp_res['status'] == 6 || $emp_res['status'] == 3 || $emp_res['status'] == 20|| $emp_res['status'] == 14 || $emp_res['status'] == 15|| $emp_res['status'] == 16|| $emp_res['status'] == 17|| $emp_res['status'] == 18)
		  {
			 ?> 
			 <td><button class="btn btn-success btn-sm" data-id="<?php echo $emp_res['id']; ?>" onclick="candidate_view(<?php echo $emp_res['cid']; ?>)"> View</button></td>
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
	  </div>
	  </div>
	  </div>
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
	  
	
	  
	  
	  </script>