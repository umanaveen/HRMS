<?php
require '../../../connect.php';
require '../../../user.php';
$candidateid=$_SESSION['candidateid'];
$userrole=$_SESSION['userrole'];

$sql=$con->query("select * from staff_master where candid_id='$candidateid' and head_status='1'");
$count=$sql->rowcount();
if($count==1)
{
	$quote=$con->query("select * from quote_generate where po_upload_status='1' ");
}
else
{
	
	$quote="";
}
?>
<div  class="card card-primary">
     <div class="card-header">
	<h2 class="card-title"><font size="5"><b>Quote List</b></font> </h2></div>
	<div class="card-body">
    <table id="example1" class="table table-bordered table-striped">
      <thead>
		  <th>#</th>
		  <th>Quote Number</th>
		  <th>Quote Date</th>
		  <th>Cost Sheet Number</th>
		  <th>Status</th>
		  <th>Action</th>
      </thead>
      <tbody>
      <?php
//$candidateid=$_SESSION['candidateid'];
//$userrole=$_SESSION['userrole'];
	
     $cnt=1;
	 if($count==1)
{
	$quote=$con->query("select * from quote_generate where po_upload_status='1' ");

      while($quote_list = $quote->fetch(PDO::FETCH_ASSOC))
	  {
		  ?>
      <tr>
	  <td><?php echo $cnt;?>.</td>
      <td><?php echo $quote_list['quote_no']; ?></td>
      <td><?php echo $quote_list['quote_date']; ?></td>
      <td><?php echo $quote_list['cost_sheet_no']; ?></td>	
<td><?php $fstatus=$quote_list['finance_status'];
if($fstatus==1)
{
	echo "Approved";
}
elseif($fstatus==2)
{
	echo "Rejected";
}
?></td>	  
	<td>  

	<button class="btn btn-info" data-id="<?php echo $quote_list['id']; ?>" onclick="po_view(<?php echo $quote_list['id']; ?>)"><i class="fa fa-eye"></i></button>
	</td>
      </tr>
      <?php
	  $cnt=$cnt+1;
      }
}
      ?>
      </tbody>
      </table>

     
     </div>

<script>


function po_view(v)
{
	  //alert(v);
	$.ajax({
	type:"POST",
	url:"Qvision/BusinessProcess/po_approval/po_approve.php?id="+v,
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
