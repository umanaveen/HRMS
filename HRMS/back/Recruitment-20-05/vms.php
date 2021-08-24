<?php
require '../../connect.php';
include("../../user.php");
$candidateid=$_SESSION['candidateid'];
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
                            <!--h1 class="page-header">Staff Asset Master List</h1-->
                        </div>
                        </div>
						
					
					<div class="row content">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                   Visitor Management System
                                </div>
					
    <!-- Content Header (Page header) -->
    
    <!-- Main content -->
  <div class="row">
						 <div class="col-lg-12">
		  <a onclick=" add_vms()" style="float: right;" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus"></i> ADD</a>


          </div>
                        <!-- /.col-lg-12 -->
                    </div>
				
   <div class="panel-body">
      <div class="table-responsive">
       <table class="dataTables-example table table-striped table-bordered table-hover"  id="example1">
		 
   
    <thead>
	<th>S.NO</th>
      <th>GENERATED ID</th>
	        <th>DATE</th>
				        <th>FIRST NAME</th>
						<th>EMAIL</th>
						<th>MOBILE NUMBER</th>
						<th>PURPOSE</th>
						<th>DEPARTMENT</th>
						<th>EMPLOYEE</th>
						<th>STATUS</th>
<th>Action</th>
 
     
      <!--th>Tools</th-->
      </thead>
      <tbody>
      <?php
	  $candidateid=$_SESSION['candidateid'];
$userrole=$_SESSION['userrole'];
if($userrole=='ROLE-007' ){
      $VMS_sql=$con->query("SELECT vms.id as vms_id,vms.status as vms_status,vms.first_name as vms_name,vms.*,z_department_master.*,candidate_form_details. * FROM `vms` INNER JOIN z_department_master ON vms.Department=z_department_master.id INNER JOIN candidate_form_details ON vms.employee = candidate_form_details.id
where vms.employee='$candidateid' ");
	 } else {
		  $VMS_sql=$con->query("SELECT vms.id as vms_id,vms.status as vms_status,vms.first_name as vms_name,vms.*,z_department_master.*,candidate_form_details. * FROM `vms` INNER JOIN z_department_master ON vms.Department=z_department_master.id INNER JOIN candidate_form_details ON vms.employee = candidate_form_details.id
");
	 }
      $i=1;
      while($VMS_res = $VMS_sql->fetch(PDO::FETCH_ASSOC))
      {
       ?>
      <tr>
      <td><?php echo $i; ?></td>
	   <td>BB00<?php echo $VMS_res['vms_id']; ?></td>
      <td><?php echo $VMS_res['Date']; ?></td>
	       <td><?php echo $VMS_res['vms_name']; ?></td>
		   <td><?php echo $VMS_res['email']; ?></td>
		   <td><?php echo $VMS_res['mob_num']; ?></td>
		    <td><?php echo $VMS_res['Purpose']; ?></td>
			 <td><?php echo $VMS_res['dept_name']; ?></td>
			 <td><?php echo $VMS_res['first_name']; ?></td>
			 <td>
<?php if(($VMS_res['vms_status']==1))  
{

echo '<span style="color:RED;text-align:center;"><b>PENDING</b></span>';
}
if(($VMS_res['vms_status']==2))  
{
echo '<span style="color:green;text-align:center;"><b>APPROVED</b></span>';

}





?></td>
      <td>
	  <?php if($VMS_res['employee']==$candidateid){
		  ?>
	  <button class="btn btn-primary" data-id="<?php echo $VMS_res['vms_id']; ?>" onclick="vms_edit(<?php echo $VMS_res['vms_id']; ?>)"><i class="fa fa-eye"></i> </button>
	  <?php }
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
		function add_vms()
    {
    $.ajax({
    type:"POST",
    url:"/HRMS/HRMS/Recruitment/vms _add.php",
    success:function(data){
    $(".content").html(data);
    }
    })
  }
   function vms_edit(v){
	  //alert(v);
	$.ajax({
	type:"POST",
	url:"/HRMS/HRMS/Recruitment/vms_view.php?id="+v,
	
	success:function(data)
	{
		$(".content").html(data);
	}
	})
}
   
</script>