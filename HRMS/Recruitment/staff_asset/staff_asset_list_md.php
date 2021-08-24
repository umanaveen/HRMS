<?php
require '../../../connect.php';
include("../../../user.php");
$userrole=$_SESSION['userrole'];
$candidateid=$_SESSION['candidateid'];

$staff=$con->query("select * from staff_master where candid_id='$candidateid'");
$sfet=$staff->fetch();
$staff_id=$sfet['id'];
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
                            <h1 class="page-header">Staff Asset List</h1>
                        </div>
                        </div>
						
					
					<div class="row content">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    Staff Asset  
                                </div>
					
    <!-- Content Header (Page header) -->
    
    <!-- Main content -->
  <div class="row">
						 <div class="col-lg-12">
		  <!--a onclick=" add_staff_asset()" style="float: right;" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus"></i> ADD</a-->


          </div>
                        <!-- /.col-lg-12 -->
                    </div>
				
   <div class="panel-body">
      <div class="table-responsive">
       <table class="dataTables-example table table-striped table-bordered table-hover"  id="example1">
		 
   
    <thead>
      <th>ID</th>
	  <th>Employee Name</th>
      
	  <th>Access</th>
	  <th>Status</th>
     <th>Action</th>
      <!--th>Tools</th-->
      </thead>
      <tbody>
      <?php
	  if($staff_id=='')
	  {
		 $emp_sql=$con->query("SELECT sm.emp_name,a.asset_master_id,a.id as sid,a.status as status FROM staff_access_request a join staff_master sm on a.staff_id=sm.id where a.status!=1"); 
	  }
      else
	  {
		  $emp_sql=$con->query("SELECT sm.emp_name,a.asset_master_id,a.id as sid,a.status as status FROM staff_access_request a join staff_master sm on a.staff_id=sm.id where a.status=4 and a.staff_id='$staff_id'");
	  }
	  
	  //echo "SELECT sm.emp_name,a.asset_master_id,a.id as sid,a.status as status FROM staff_access_request a join staff_master sm on a.staff_id=sm.id where a.status!=1 and a.staff_id='$staff_id'";
	 //echo "SELECT sm.emp_name,s.stationaries,s.system_or_laptop,s.id_card,s.cug,s.access_card,s.erp_access,s.mail_id,s.id AS sid FROM staff_asset s join staff_master sm on s.emp_name=sm.id";
      $i=1;
      while($emp_res = $emp_sql->fetch(PDO::FETCH_ASSOC))
      {
       ?>
      <tr>
      <td><?php echo $i; ?></td>
      <td><?php echo $emp_res['emp_name']; ?></td>
	        <td><?php 
			$aids=$emp_res['asset_master_id'];
			$ass=$con->query("select * from assets_master where id in($aids)");
			while($afet=$ass->fetch())
			{
				 $dat= $afet['name'];
				 echo $dat.",";
			}
		
		
 ?></td>
 <td>
  <?php 
	  if($emp_res['status']==1)
	  {
		  echo"Pending";
	  }
	  elseif($emp_res['status']==2)
	  {
		  echo"Allocated";
	  }
	  elseif($emp_res['status']==3)
	  {
		  echo"Accepted";
	  }
	 elseif($emp_res['status']==4)
	  {
		  echo"Head Approved";
	  }
	  ?>
 </td>
      <td>
	  <?php 
	 
	 if($emp_res['status']==4)
	  {
	  ?>
	  <button class="btn btn-success btn-sm edit btn-flat" data-id="<?php echo $emp_res['sid']; ?>" onclick="staff_asset_view(<?php echo $emp_res['sid']; ?>)"><i class="fa fa-edit"></i> View</button>
	  </td>
	  <?php 
	  }
	  ?>
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
	 	function staff_asset_view(v)
    {
    $.ajax({
    type:"POST",
    url:"/HRMS/HRMS/Recruitment/staff_asset/staff_asset_view.php?id="+v,
    success:function(data){
    $("#main_content").html(data);
    }
    })
  } 
  function staff_asset_page(v)
    {
    $.ajax({
    type:"POST",
    url:"/HRMS/HRMS/Recruitment/staff_asset/staff_asset_accept.php?id="+v,
    success:function(data){
    $("#main_content").html(data);
    }
    })
  }
  
   
</script>