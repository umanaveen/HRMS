<?php
require '../connect.php';
require '../user.php';
$candidateid=$_SESSION['candidateid'];
$userrole=$_SESSION['userrole'];
?>
<div  class="card card-primary">
	<div class="card-header">
	<h2 class="card-title"><font size="5"><b>PO Unposted List</b></font> </h2>
	</div>
	<div class="card-body">
    <table id="example1" class="table table-bordered table-striped">
		<thead>
		<th>#</th>
		<th>category_code</th>
		<th>purpose_code</th>
		<th>approve_date</th>
		<th>enquiry_id</th>
		<th>work_order_no</th>
		<th>status</th>
		<th>Action</th>
		</thead>		
		<tbody>
		<?php
		
		$cnt=1;
		$quote=$con->query("select * from  po_approve_unposted_data");

		while($quote_list = $quote->fetch(PDO::FETCH_ASSOC))
		{
		
			?>
			<tr>
			<td><?php echo $cnt;?>.</td>
			<td><?php echo $quote_list['voucher_category_code']; ?></td>
			<td><?php echo $quote_list['voucher_purpose_code']; ?></td>
			<td><?php echo $quote_list['approve_date']; ?></td>
			<td><?php echo $quote_list['enquiry_id']; ?></td>
			<td><?php echo $quote_list['work_order_no']; ?></td>
			<td>

			<?php if($quote_list['status']==1)
			{
				echo '<span style="color:red;text-align:center;"><b>Pending</b></span>';
			}
			if($quote_list['status']==2)
			{
				echo '<span style="color:green;text-align:center;"><b>Approved</b></span>';
			}
			?>
	  
		</td>
		<td>
		<button class="btn btn-info" data-id="<?php echo $quote_list['id']; ?>" onclick="po_unposted_post(<?php echo $quote_list['enquiry_id']; ?>)" value="">
		<i class="fa fa-pen">  Post</i>
		</button>
		</td>
		</tr>
		<?php
		$cnt=$cnt+1;
		}
      ?>
      </tbody>
	</table>     
    </div>
</div>

<script>
function po_unposted_post(v)
{
	alert(v);
	$.ajax({
	type:"POST",	
	url:"Accounts/po_voucher_creation_function.php?enquiry_id="+v,
	success:function(data)
	{
		$("#main_content").html(data);
	}
	})
}

</script>
