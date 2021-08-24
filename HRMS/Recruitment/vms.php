<?php
require '../../connect.php';
include("../../user.php");
$candidateid=$_SESSION['candidateid'];
$userrole=$_SESSION['userrole'];
?>
<div  class="card card-primary">
              <div class="card-header">
                <h3 class="card-title"><font size="5"> Visitor Management System List</font></h3>
			<a onclick="add_vms()"  style="float: right;" data-toggle="modal" class="btn btn-dark"><i class="fa fa-plus"></i>  New Visirors</a>
			
              </div>
              <!-- /.card-header -->
              <div class="card-body">

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

echo '<span style="color:blue;text-align:center;"><b>PENDING</b></span>';
}
if(($VMS_res['vms_status']==2))  
{
echo '<span style="color:green;text-align:center;"><b>APPROVED</b></span>';

}
if(($VMS_res['vms_status']==3))  
{
echo '<span style="color:red;text-align:center;"><b>Rejected</b></span>';

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
    $("#main_content").html(data);
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
		$("#main_content").html(data);
	}
	})
}
   
</script>