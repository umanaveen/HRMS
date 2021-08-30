<?php
require '../../../connect.php';
include("../../../user.php");
$userrole=$_SESSION['userrole'];

?>
<style>
td {
  font-size: 20px;
}
</style>
<div  class="card card-primary">
              <div class="card-header">
                <h3 class="card-title"><font size="5">Calls List</font> </h3>
			<a onclick="add()" style="float: right;" data-toggle="modal" class="btn btn-primary"><i class="fa fa-plus"></i> ADD</a>
			<br>
			<br>
              </div>
              <!-- /.card-header --><br>
			  
              <div class="card-body">
			 
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>#</th>
                    <th> Organisation</th>
                    <th> Client</th>
                    <th> Contact</th>
                    <th> Email</th>
                    <th> Website</th>
                    <th> Address</th>
                    <th> City</th>
                    <th> State</th>
                    <!--th> Country</th>
					<th>STATUS</th-->
                    
					 <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
<?php

$sql=$con->query("SELECT * FROM `crm_calls`");
$cnt=1;
 while($products_master = $sql->fetch(PDO::FETCH_ASSOC))
{
	
?>
<tr>
<td><?php echo $cnt;?>.</td>
<td><?php echo $products_master['client_org'];?></td>
<td><?php echo $products_master['client_name'];?></td>
<td><?php echo $products_master['contact'];?></td>
<td><?php echo $products_master['email'];?></td>
<td><?php echo $products_master['website'];?></td>
<td><?php echo $products_master['address'];?></td>
<td><?php echo $products_master['city'];?></td>
<!--td><!?php echo $products_master['state'];?></td>
<td><!?php echo $products_master['country'];?></td-->
<td>
	  <?php 
	  if($products_master['status'] ==1)
	  {
		  
	  echo '<span style="color:green;text-align:center;"><b>Active</b></span>';
	  ?>
	  <?php }else {
		  
		 echo '<span style="color:red;text-align:center;"><b>INActive</b></span>';
		 ?>
      <?php }?>
	 
	  
     </td>
<td>

							<button class="btn btn-success btn-sm edit btn-flat" data-id="<?php echo $products_master['id']; ?>" onclick="calls_feedback(<?php echo $products_master['id']; ?>)"><i class="fa fa-edit"></i> Feedback</button>
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

   function calls_feedback(v){
		//alert(v);
	$.ajax({
	type:"POST",
	url:"HRMS/CRM/Calls/calls_feedback?id="+v,
	 
	success:function(data)
	{
		$("#main_content").html(data);
	}
	})
}
function back()
	
	{
 calls_master()

	}
  
function add()
	{
		$.ajax({
		type:"POST",
		url:"HRMS/CRM/Calls/calls_add.php",
		success:function(data){
		$("#main_content").html(data);
		}
		})
	}
</script>
