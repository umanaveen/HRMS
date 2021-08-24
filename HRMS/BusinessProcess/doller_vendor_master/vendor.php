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
                <h3 class="card-title"><font size="5">Vendor List</font> </h3>
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
                    <th>Vendor NAME</th>
					<th>Bank NAME</th>
					<th>Account No</th>
					<th>Swift Code</th>
					<th>IFSC Code</th>
					<th>STATUS</th>
					 <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
<?php

$sql=$con->query("SELECT * FROM `doller_vendor_mastor`");
$cnt=1;
 while($doller_vendor = $sql->fetch(PDO::FETCH_ASSOC))
{
	
?>
<tr>
<td><?php echo $cnt;?>.</td>
<td><?php echo $doller_vendor['vendor_name'];?></td>
<td><?php echo $doller_vendor['account_name'];?></td>
<td><?php echo $doller_vendor['account_no'];?></td>
<td><?php echo $doller_vendor['swift_code'];?></td>
<td><?php echo $doller_vendor['ifsc_code'];?></td>
<td>
	  <?php 
	  if($doller_vendor['status'] ==1)
	  {
		  
	  echo '<span style="color:green;text-align:center;"><b>Active</b></span>';
	  ?>
	  <?php }else {
		  
		 echo '<span style="color:red;text-align:center;"><b>INActive</b></span>';
		 ?>
      <?php }?>
	 
	  
     </td>
<td>

							<button class="btn btn-success btn-sm edit btn-flat" data-id="<?php echo $doller_vendor['id']; ?>" onclick="vendor_edit(<?php echo $doller_vendor['id']; ?>)"><i class="fa fa-edit"></i> Edit</button>
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

   function vendor_edit(v){
		//alert(v);
	$.ajax({
	type:"POST",
	url:"HRMS/BusinessProcess/doller_vendor_master/vendor_edit?id="+v,
	 
	success:function(data)
	{
		$("#main_content").html(data);
	}
	})
}

  
function add()
	{
		$.ajax({
		type:"POST",
		url:"HRMS/BusinessProcess/doller_vendor_master/vendor_add.php",
		success:function(data){
		$("#main_content").html(data);
		}
		})
	}
</script>
