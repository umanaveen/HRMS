<?php
require '../../../connect.php';
include("../../../user.php");
$userrole=$_SESSION['userrole'];
?>
<div  class="card card-primary">
              <div class="card-header">
                <h3 class="card-title"><font size="5">Client List</font></h3>
			<a onclick="add_client()"  style="float: right;" data-toggle="modal" class="btn btn-dark"><i class="fa fa-plus"></i>  ADD</a>
			
              </div>
  
              <div class="card-body">

		
		 
		 
    <table id="example1" class="dataTables-example table table-bordered">
    <thead>
     
     <th>#</th>
	  <th>Company Name</th>
      <th>Client Name</th>
	  <th>Client Org Name</th>
	  <th>Mobile No</th>
	  <th>Mail Id</th>
	  <th>Gst No</th>
      <th>Status</th>
      <th>Action</th>
      </thead>
      <tbody>
      <?php
      $emp_sql=$con->query("SELECT * FROM client_master");
      $i=1;
      while($emp_res = $emp_sql->fetch(PDO::FETCH_ASSOC))
      {
       ?>
      <tr>
      <td><?php echo $i; ?></td>
      <td><?php echo $emp_res['org_name']; ?></td>
	  <td><?php echo $emp_res['client_name']; ?></td>
	  <td><?php echo $emp_res['org_name']; ?></td>
	  <td><?php echo $emp_res['mobile_no1']; ?></td>
	  <td><?php echo $emp_res['email_id1']; ?></td>
	  <td><?php echo $emp_res['gst_no']; ?></td>
	  <td>
	  <?php
	  if($emp_res['status']==1)
	  {
		  echo "Active"; 
	  }
	  else
	  {
		  echo "Inactive";
	  }
	  ?>
	  </td>
      <td>
	  <button class="btn btn-info" data-id="<?php echo $emp_res['id']; ?>" onclick="client_view(<?php echo $emp_res['id']; ?>)"><i class="fa fa-eye"></i></button>
	  <button class="btn btn-success btn-sm edit btn-flat" data-id="<?php echo $emp_res['id']; ?>" onclick="client_edit(<?php echo $emp_res['id']; ?>)"><i class="fa fa-edit"></i> Edit</button>
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
		function add_client()
    {
    $.ajax({
    type:"POST",
    url:"/HRMS/HRMS/masters/client_master/client_master_add.php",
    success:function(data){
    $("#main_content").html(data);
    }
    })
  }
  function client_edit(v)
    {
    $.ajax({
    type:"POST",
    url:"/HRMS/HRMS/masters/client_master/client_master_edit.php?id="+v,
    success:function(data){
    $("#main_content").html(data);
    }
    })
  }
  function client_view(v)
    {
    $.ajax({
    type:"POST",
    url:"/HRMS/HRMS/masters/client_master/client_master_view.php?id="+v,
    success:function(data){
    $("#main_content").html(data);
    }
    })
  }
   
</script>