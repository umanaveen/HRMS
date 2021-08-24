<?php
require '../../connect.php';
include("../../user.php");
/* $candidateid=$_SESSION['candidateid'];
$userrole=$_SESSION['userrole']; */
?>
<div  class="card card-primary">
              <div class="card-header">
                <h3 class="card-title"><font size="5"> User Role</font></h3>
			<a onclick="return add_role()"  style="float: right;" data-toggle="modal" class="btn btn-dark"><i class="fa fa-plus"></i> ADD</a>
			
              </div>
              <!-- /.card-header -->
              <div class="card-body">
       <table class="dataTables-example table table-striped table-bordered table-hover"  id="example1">
		 
   
    <thead>
	<th>S.NO</th>
      <th>Code</th>
	            <th>Role Name</th>
				 <th>EMP NAME</th>
<th>Status</th>				        
<th>Action</th>
 
     
      <!--th>Tools</th-->
      </thead>
      <tbody>
      <?php
	  
      $assets_sql=$con->query("SELECT user_role_mapping.id as user_role_id,user_role_mapping.*,z_role_master.*,z_user_master.* FROM `user_role_mapping`
	  INNER JOIN z_role_master ON user_role_mapping.rolemaster_id=z_role_master.id 
INNER join z_user_master ON user_role_mapping.employee_id=z_user_master.candidate_id order by user_role_id desc");
	   $i=1;
      while($assets_res = $assets_sql->fetch(PDO::FETCH_ASSOC))
      {
       ?>
      <tr>
      <td><?php echo $i; ?></td>
	   <td><?php echo $assets_res['code']; ?></td>
      <td><?php echo $assets_res['role_name']; ?></td>
	     <td><?php echo $assets_res['full_name']; ?></td>
			 <td>
<?php if(($assets_res['status']==1))  
{

echo '<span style="color:green;text-align:center;"><b>Active</b></span>';
}
if(($assets_res['status']==2))  
{
echo '<span style="color:red;text-align:center;"><b>Pending</b></span>';
}

?></td>
     <td>
	 
	  <button class="btn btn-success" data-id="<?php echo $assets_res['user_role_id']; ?>" onclick="role_edit(<?php echo $assets_res['user_role_id']; ?>)"><i class="fa fa-edit"></i> EDIT</button>
	  
	 
	  </td>
      </tr>
      <?php
	  $i++;
      }
      ?>
      </tbody>
      </table>
	 
    </div>
              <!-- /.card-body -->
            </div>
<script>
            $(document).ready(function() {
                $('.dataTables-example').DataTable({
                        responsive: true
                });
            });
        </script>
<script>
		function add_role()
    {
    $.ajax({
    type:"POST",
	url:"HRMS/user_role/role_add.php",
	success:function(data){
    $("#main_content").html(data);
    }
    })
  }
  
   function role_edit(v){
	 // alert(v);
	$.ajax({
	type:"POST",
	url:"HRMS/user_role/role_edit.php?id="+v,
    success:function(data)
	{
		$("#main_content").html(data);
	}
	})
}
     
        
</script>