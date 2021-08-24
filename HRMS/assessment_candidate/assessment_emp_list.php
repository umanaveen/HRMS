<?php
require '../../connect.php';
?>
<div class="content-wrapper" style="padding-left: 50px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Employee List</h1>
          </div>
          <div class="col-sm-6">
		  <a onclick="return add_employee()" style="float: right;" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus"></i> ADD</a>
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
      <th>S.No</th>
      <th>Question Name</th>
      <th>Company Name</th>
      <th>Department</th>
      <th>First Name</th>
      <th>Last Name</th>
      <th>DOB</th>
     <th>Address </th>
	<!--th>Status</th-->
	<th>Action</th>
      </thead>
      <tbody>
      <?php
      $questions=$con->query("SELECT *,e.id as eid,e.status as estatus FROM `emp_assessment_login_detail` e join company_master c on e.company_name=c.id join z_department_master d on e.department=d.id left join question_name_master q on e.qn_name_id=q.id");
     $cnt=1;
      while($answer_keys = $questions->fetch(PDO::FETCH_ASSOC))
      {
     
      ?>
      <tr>
	  <td><?php echo $cnt;?>.</td>
      <td><?php echo $answer_keys['name']; ?></td>
      <td><?php echo $answer_keys['companyname']; ?></td>
      <td><?php echo $answer_keys['dept_name']; ?></td>
      <td><?php echo $answer_keys['first_name']; ?></td>
      <td><?php echo $answer_keys['last_name']; ?></td>
      <td><?php echo $answer_keys['dob']; ?></td>
      <td><?php echo $answer_keys['address']; ?></td>
	  
	 <!--td>
	  <!?php 
	  if($answer_keys['estatus'] ==1)
	  {
		  
	  echo '<span style="color:green;text-align:center;"><b>Active</b></span>';
	  ?>
	  <!?php }else {
		  
		 echo '<span style="color:red;text-align:center;"><b>INActive</b></span>';
		 ?>
      <!?php }?>
	 
	  
     </td-->
     <td>				
		<button class="btn btn-success btn-sm edit btn-flat" data-id="<?php echo $answer_keys['eid']; ?>" onclick="ctc_edit(<?php echo $answer_keys['eid']; ?>)"><i class="fa fa-edit"></i> Edit</button>
	</td>
      </tr>
      <?php
	  $cnt=$cnt+1;
      }
      ?>
      </tbody>
      </table>
    
<!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
</div>

<script>
		function add_employee()
    {
    $.ajax({
    type:"POST",
    url:"HRMS/assessment_candidate/candidate_form.php",
    success:function(data){
    $(".content").html(data);
    }
    })
  }
  function ctc_edit(v){
	$.ajax({
	type:"POST",
	url:"HRMS/assessment_candidate/candidate_edit.php?id="+v,
	success:function(data)
	{
		$(".content").html(data);
	}
	})
}
</script>