<?php
require '../../../connect.php';
include("../../../user.php");
$userrole=$_SESSION['userrole'];
?>

<div  class="card card-primary">
              <div class="card-header">
                <h3 class="card-title"><font size="5">Interview Rounds Mapping List</font></h3>
			<a onclick="add_interviewroundsmapping()"  style="float: right;" data-toggle="modal" class="btn btn-dark"><i class="fa fa-plus"></i>  ADD</a>
			
              </div>
              <!-- /.card-header -->
              <div class="card-body">

		 
    <table id="example1" class="dataTables-example table table-bordered">
    <thead>
      <th>#</th>
	  <th>Round ID</th>
	  <th>Department</th>
      <th>Employee</th>
      <th>Status</th>
      <th>Action</th>
      </thead>
      <tbody>
      <?php
      $emp_sql=$con->query("SELECT interview_rounds_mapping.id as interview_rounds_mapping_id,staff_master.emp_name as staff_name,interview_rounds.name as interview_rounds_name,z_department_master.dept_name as dep_name,interview_rounds_mapping.*,staff_master.*,interview_rounds.*,z_department_master.* FROM `interview_rounds_mapping` 
	  left join staff_master ON interview_rounds_mapping.person_name=staff_master.candid_id 
	  left JOIN interview_rounds ON interview_rounds_mapping.round_id=interview_rounds.id 
	  left JOIN z_department_master ON interview_rounds_mapping.dep=z_department_master.id
");
      $i=1;
      while($emp_res = $emp_sql->fetch(PDO::FETCH_ASSOC))
      {
       ?>
      <tr>
      <td><?php echo $i; ?></td>
	  <td><?php echo $emp_res['interview_rounds_name']; ?></td>
      <td><?php echo $emp_res['dep_name']; ?></td>
	     <td><?php echo $emp_res['staff_name']; ?></td>
	  <td>
	  <?php
	  if($emp_res['status']==1)
	  {
		 echo '<span style="color:green;text-align:center;"><b>Active</b></span>';
	  }
	  else
	  {
		   echo '<span style="color:red;text-align:center;"><b>Inactive</b></span>';
	  }
	  ?>
	  </td>
      <td>
	  <button class="btn btn-success btn-sm edit btn-flat" data-id="<?php echo $emp_res['interview_rounds_mapping_id']; ?>" onclick="interviewroundsmapping_edit(<?php echo $emp_res['interview_rounds_mapping_id']; ?>)"><i class="fa fa-edit"></i> Edit</button>
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
    
<script>
            $(document).ready(function() {
                $('.dataTables-example').DataTable({
                        responsive: true
                });
            });
        </script>
<script>
		function add_interviewroundsmapping()
    {
    $.ajax({
    type:"POST",
    url:"/HRMS/HRMS/masters/interview_rounds_mapping/new_interview_rounds_mapping.php",
    success:function(data){
    	$("#main_content").html(data);
    }
    })
  }
  function interviewroundsmapping_edit(v)
    {
    $.ajax({
    type:"POST",
    url:"/HRMS/HRMS/masters/interview_rounds_mapping/edit_interview_rounds_mapping.php?id="+v,
    success:function(data){
   	$("#main_content").html(data);
    }
    })
  }
  
   
</script>