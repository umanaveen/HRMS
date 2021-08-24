<?php
require '../../../connect.php';
include("../../../user.php");
$userrole=$_SESSION['userrole'];
?>
<style>
#page-wrapper{
	margin-left: 117px !important;
}
.btn-warning{
	padding-top: 0px !important;
}

.btn-warning{
	background-color: #337ab7 !important;
    border-color: #337ab7 !important;
}
.btn-success{
	background-color: #5cb85c !important;
    border-color: #5cb85c !important;
}
.page-header{
	border-bottom: 3px solid #eee !important;
}

</style>
<div class="content-wrapper" id="page-wrapper">
<div class="container-fluid">

<div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header">Feedback Master</h1>
                        </div>
                        </div>
						<div class="row">
						 <div class="col-lg-12">
		  <a onclick=" add_feedback()" style="float: right;" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus"></i> ADD</a>


          </div>
                        <!-- /.col-lg-12 -->
                    </div>
  
  <br>


		
	
		
		<div class="row content">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    Feedback Master
                                </div>
  
  
 
   
    <div class="panel-body">
      <div class="table-responsive">
       <table class="dataTables-example table table-striped table-bordered table-hover" id="example1">
    <thead>
      <th>#</th>
      <th>Name</th>
      <th>Status</th>
      <th>Tools</th>
      </thead>
      <tbody>
      <?php
      $emp_sql=$con->query("SELECT * FROM feedback_master ");
      $i=1;
      while($emp_res = $emp_sql->fetch(PDO::FETCH_ASSOC))
      {
       ?>
      <tr>
      <td><?php echo $emp_res['id']; ?></td>
      <td><?php echo $emp_res['name']; ?></td>
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
	  <button class="btn btn-success btn-sm edit btn-flat" data-id="<?php echo $emp_res['id']; ?>" onclick="feedback_edit(<?php echo $emp_res['id']; ?>)"><i class="fa fa-edit"></i> Edit</button>
	  </td>
      </tr>
      <?php
      }
      ?>
      </tbody>
      </table>
	 
      </div>
<!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div><!-- /.container-fluid -->

<!-- /.content -->
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
		function add_feedback()
    {
    $.ajax({
    type:"POST",
    url:"/HRMS/HRMS/masters/feedback_master/new_feedback.php",
    success:function(data){
    $(".content").html(data);
    }
    })
  }
  function feedback_edit(v)
    {
    $.ajax({
    type:"POST",
    url:"/HRMS/HRMS/masters/feedback_master/edit_feedback.php?id="+v,
    success:function(data){
    $(".content").html(data);
    }
    })
  }
  
   
</script>