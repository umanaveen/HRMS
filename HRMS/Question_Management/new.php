<?php
require '../../connect.php';
?>

<div  class="card card-primary">
              <div class="card-header">
            <h1 class="card-title"><font size="5">Interview Questions</font></h1>
          
		  <a onclick="return add_employee()" style="float: right;" data-toggle="modal" class="btn btn-dark"><i class="fa fa-plus"></i> ADD</a>
          </div>
       <div class="card-body">

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
    $("#main_content").html(data);
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