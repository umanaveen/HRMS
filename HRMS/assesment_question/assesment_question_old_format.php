<?php
require '../../connect.php';
?>
<div class="content-wrapper" style="padding-left: 50px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Interview Questions</h1>
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
      <th>Question Type</th>
      <th>Section</th>
      <th>Question</th>
      <th>Option A</th>
     <th>Option B </th>
	<th>Option C </th>
	<th>Option D</th>
   <th>Correct Answer</th>
	<th>Status</th>
	<th>Action</th>
      </thead>
      <tbody>
      <?php
      $questions=$con->query("SELECT a.id,qn_name,section,Questions, Option_A,Option_B,Option_C,Option_D,answer_key,a.status,q.name as qname,s.name as sname FROM assessment_qn_master a join question_name_master q on a.qn_name=q.id join section_master s on a.section=s.id");
     $cnt=1;
      while($answer_keys = $questions->fetch(PDO::FETCH_ASSOC))
      {
     
      ?>
      <tr>
	  <td><?php echo $cnt;?>.</td>
      <td><?php echo $answer_keys['qname']; ?></td>
      <td><?php echo $answer_keys['sname']; ?></td>
      <td><?php echo $answer_keys['Questions']; ?></td>
      <td><?php echo $answer_keys['Option_A']; ?></td>
      <td><?php echo $answer_keys['Option_B']; ?></td>
      <td><?php echo $answer_keys['Option_C']; ?></td>
	   <td><?php echo $answer_keys['Option_D']; ?></td>
      <td><?php echo $answer_keys['answer_key']; ?></td>
	 <td>
	  <?php 
	  if($answer_keys['status'] ==1)
	  {
		  
	  echo '<span style="color:green;text-align:center;"><b>Active</b></span>';
	  ?>
	  <?php }else {
		  
		 echo '<span style="color:red;text-align:center;"><b>INActive</b></span>';
		 ?>
      <?php }?>
	 
	  
     </td>
     <td>
				
							<button class="btn btn-success btn-sm edit btn-flat" data-id="<?php echo $answer_keys['id']; ?>" onclick="ctc_edit(<?php echo $answer_keys['id']; ?>)"><i class="fa fa-edit"></i> Edit</button>
							
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
    url:"HRMS/assesment_question/questions_add.php",
    success:function(data){
    $(".content").html(data);
    }
    })
  }
  function ctc_edit(v){
	$.ajax({
	type:"POST",
	url:"HRMS/assesment_question/question_edit.php?id="+v,
	success:function(data)
	{
		$(".content").html(data);
	}
	})
}
</script>