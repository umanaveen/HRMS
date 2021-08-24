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
      <th>
	  <?php 
	  $sel=$con->query("select * from question_name_master where status=1");
	  ?>
	  <select name="qn_name" id="qn_name" class="form-control" onchange="get_qns(this.value)">
	  <option value="">Select Question</option>
	  <?php 
	  while($row=$sel->fetch())
	  {
	  ?>
	  <option value="<?php echo $row['id']; ?>"><?php echo $row['name'];?></option>
	  <?php
	  }
	  ?>
	  </select>
	  </th>
      
      </thead>
	  </table>
	  <table class="table table-bordered">
      <tbody id="table-view">
      
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
    url:"HRMS/Question_Management/questions_add.php",
    success:function(data){
    $(".content").html(data);
    }
    })
  }
  function get_qns(v){
	$.ajax({
	type:"POST",
	url:"HRMS/Question_Management/questions_view.php?id="+v,
	success:function(data)
	{
		$("#table-view").html(data);
	}
	})
}
</script>