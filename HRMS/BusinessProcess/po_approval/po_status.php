<?php
require '../../../connect.php';
require '../../../user.php';
$candidateid=$_SESSION['candidateid'];
$userrole=$_SESSION['userrole'];



?>
<div  class="card card-primary">
     <div class="card-header">
	<h2 class="card-title"><font size="5"><b>PO Status</b></font> </h2></div>
	<div class="card-body">
    <table id="example1" class="table table-bordered table-striped">
      <thead>
		  <th>#</th>
		  <th>proposal</th>
		   <th>Client</th>
		  <th>Quote Number</th>
		  <th>Work Order  Number</th>
		 <th>Status</th>
		  <th>Action</th>
      </thead>
      <tbody>
      <?php
//$candidateid=$_SESSION['candidateid'];
//$userrole=$_SESSION['userrole'];
	
     $cnt=1;

	$quote=$con->query("select * from  quotation
	inner join po_upload on quotation.Enquire_id=po_upload.enquiry_id");

      while($quote_list = $quote->fetch(PDO::FETCH_ASSOC))
	  {
		  ?>
      <tr>
	  <td><?php echo $cnt;?>.</td>
      <td><?php echo $quote_list['proposal']; ?></td>
	  <td><?php echo $quote_list['Client']; ?></td>
	  <td><?php echo $quote_list['cost_sheet_number']; ?></td>
	 
	  <td><?php echo "BBWO".$quote_list['workorder_number']; ?></td>
	  
     <td><?php if($quote_list['po_status']==1)
		{

echo '<span style="color:red;text-align:center;"><b>Pending</b></span>';
}
if($quote_list['po_status']==2)
{

echo '<span style="color:green;text-align:center;"><b>Approved</b></span>';
}
	  ?>
	 </td>
	<td>  

	<button class="btn btn-info" data-id="<?php echo $quote_list['Po_id']; ?>" onclick="po_status_view(<?php echo $quote_list['Po_id']; ?>)"><i class="fa fa-eye"></i></button>
	</td>
      </tr>
      <?php
	  $cnt=$cnt+1;
      }

      ?>
      </tbody>
      </table>

     
     </div>

<script>


function po_status_view(v)
{
	  //alert(v);
	$.ajax({
	type:"POST",
	
	url:"HRMS/BusinessProcess/po_approval/po_approve.php?id="+v,
	success:function(data)
	{
		$("#main_content").html(data);
	}
	})
}
function back_ctc()
	{
		lead()
	}
	
	$(function () 
	{
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

	
    </script>
