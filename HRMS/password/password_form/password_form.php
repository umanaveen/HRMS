<?php
require '../../../connect.php';
include("../../../user.php");
$userrole=$_SESSION['userrole'];
$candidateid=$_SESSION['candidateid'];
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
td {
  font-size: 20px;
}
</style>
<div  class="card card-primary">
              <div class="card-header">
                <h3 class="card-title"><font size="5">Password Master List</font> </h3>
			<a onclick="add()" style="float: right;" data-toggle="modal" class="btn btn-dark"><i class="fa fa-plus"></i> ADD</a>
			<br>
			<br>
              </div>
              <!-- /.card-header --><br>
			  
              <div class="card-body">
			 
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>#</th>
                    <th> Type</th>
                    <th> NAME</th>
					 <th>Action</th>
				  </tr>
                  </thead>
                   <tbody>
<?php
$sql=$con->query("SELECT * FROM `password_recovery`
inner join password_master on password_recovery.password_master_id=password_master.password_id
   where 
password_recovery.created_on='$candidateid'");
$cnt=1;
 while($products_master = $sql->fetch(PDO::FETCH_ASSOC))
{
	?>
<tr>
<td><?php echo $cnt;?>.</td>
<td><?php echo $products_master['name'];?></td>
<td><?php echo $products_master['organization'];?></td>
<td>
<button class="btn btn-info" data-id="<?php echo $products_master['id']; ?>" onclick="password_view(<?php echo $products_master['id']; ?>)"><i class="fa fa-eye"></i></button>
 <button class="btn btn-success" data-id="<?php echo $products_master['id']; ?>" onclick="password_edit(<?php echo $products_master['id']; ?>)"><i class="fa fa-edit"></i> EDIT </button>
</td>
</tr>
<?php 
$cnt=$cnt+1;
 }?></tbody>
                      </table>
				
				
              </div>
              <!-- /.card-body -->
            </div>
			<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });

   function product_edit(v){
		alert(v);
	$.ajax({
	type:"POST",
	
	url:"HRMS/password/password_master/password_master_edit?id="+v,
	 
	success:function(data)
	{
		$("#main_content").html(data);
	}
	})
}
function back()
	
	{
		 password_masters()

	}
  
function add()
	{
		$.ajax({
		type:"POST",
		 url:"HRMS/password/password_form/password_form_add.php",
		
		success:function(data){
		$("#main_content").html(data);
		}
		})
	}
  function password_view(v){
	//  alert(v);
	$.ajax({
	type:"POST",
  url:"HRMS/password/password_form/password_view.php?id="+v,
	success:function(data)
	{
		$("#main_content").html(data);
	}
	})
}
function password_edit(v){
	//  alert(v);
	$.ajax({
	type:"POST",
  url:"HRMS/password/password_form/password_edit.php?id="+v,
	success:function(data)
	{
		$("#main_content").html(data);
	}
	})
}
</script>
