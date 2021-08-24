<?php
require '../../connect.php';
include("../../user.php");
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
                            <h1 class="page-header">Weekly Review</h1>
                        </div>
                        </div>
						
					
					<div class="row content">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                     
                                </div>
					
    <!-- Content Header (Page header) -->
    
    <!-- Main content -->
  <div class="row">
							 <div class="col-lg-12">
		  <a onclick=" add_review()" style="float: right;" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus"></i> ADD</a>


          </div>
                        <!-- /.col-lg-12 -->
                    </div>
				
   <div class="panel-body">
      <div class="table-responsive">
       <table class="dataTables-example table table-striped table-bordered table-hover"  id="example1">
		 
   
    <thead>
      <th>ID</th>
	  <th>Employee Name</th>      
	  <th>Week1</th>
	  <th>Week2</th>
	  <th>Week3</th>
	  <th>Week4</th>
     <th>Action</th>
      <!--th>Tools</th-->
      </thead>
      <tbody>
      <?php
      $emp_sql=$con->query("SELECT *,w.id as wid from weekly_review w join staff_master s on w.staff_id=s.id where w.status=1");
	  
	 //echo "SELECT sm.emp_name,s.stationaries,s.system_or_laptop,s.id_card,s.cug,s.access_card,s.erp_access,s.mail_id,s.id AS sid FROM staff_asset s join staff_master sm on s.emp_name=sm.id";
      $i=1;
      while($emp_res = $emp_sql->fetch(PDO::FETCH_ASSOC))
      {
       ?>
      <tr>
      <td><?php echo $i; ?></td>
      <td><?php echo $emp_res['emp_name']; ?></td>
	        <td><?php echo $emp_res['week1'];?>
	        <td><?php echo $emp_res['week2'];?>
	        <td><?php echo $emp_res['week3'];?>
	        <td><?php echo $emp_res['week4'];?>
	  
	 
      <td>
	  <button class="btn btn-success btn-sm edit btn-flat" data-id="<?php echo $emp_res['wid']; ?>" onclick="emp_weekly_review(<?php echo $emp_res['wid']; ?>)"><i class="fa fa-edit"></i> Edit</button>
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
	
  function add_review(v)
    {
    $.ajax({
    type:"POST",
    url:"/HRMS/HRMS/performance_analysis/add_weekly_review.php?id="+v,
    success:function(data){
    $("#main_content").html(data);
    }
    })
  }
  function emp_weekly_review(v)
    {
    $.ajax({
    type:"POST",
    url:"/HRMS/HRMS/performance_analysis/employee_weekly_review.php?id="+v,
    success:function(data){
    $("#main_content").html(data);
    }
    })
  }
  
   
</script>