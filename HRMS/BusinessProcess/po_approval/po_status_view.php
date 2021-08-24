<?php
require '../../../connect.php';
$quoteid=$_REQUEST['id'];
$sql=$con->query("select * from quote_generate where id='$quoteid'");
$fet=$sql->fetch();
 $fstatus=$fet['finance_status'];
 $sstatus=$fet['service_status'];
 $mstatus=$fet['marketing_status'];
?>
   <div class="card card-info">
              <div class="card-header">
                
				            
		<a onclick="return back()" style="float: right;" data-toggle="modal" class="btn btn-danger"></i>Back</a>
              </div>
			
   <form method="POST" enctype="multipart/form-data">
    <!-- Post -->
    <table class="table table-bordered">
        
        <tr>
			<td colspan="6"><center><b>Quote Detail</b></center></td>
        </tr>
	  
		<tr >
			<td>Quote number</td>
			<td colspan="5"><input type="text" class="form-control" name="quote_no" id="quote_no" value="<?php echo $fet['quote_no'];?>" readonly>
			</td>
		</tr>
		<tr>
			<td>Quote Date:</td>
			<td colspan="5"><input type="text" class="form-control" name="qdate" id="qdate" value="<?php echo $fet['quote_date']; ?>" readonly>
			</td>
		</tr>
		<tr>
			<td>Cost sheet no:</td>
			<td colspan="5"><input type="text" class="form-control" name="qdate" id="qdate" value="<?php echo $fet['cost_sheet_no']; ?>" readonly>
			</td>
		</tr>
		<tr>
			<td>Po:</td>
			<td colspan="5"><a href="/Qvision/Qvision/BusinessProcess/po_approval/uploads/<?php echo $fet['po'];?>" download="<?php echo $fet['po']; ?>"><?php echo $fet['po']; ?></a>
			</td>
		</tr>
		<tr>
			<td>Finance Person:</td>
			<?php 
			$fperso=$fet['finance_approved_by'];
			$sta=$con->query("select * from staff_master where candid_id='$fperso'");
			$sfet=$sta->fetch();
			?>
			<td colspan="5"><input type="text" class="form-control" name="qdate" id="qdate" value="<?php echo $sfet['emp_name']; ?>" readonly>
			</td>
		</tr>
	<?php 
		if($fstatus !='')
		{
			if($fstatus==1)
			{
				$fstas="Approved";
			}
			elseif($fstatus==2)
			{
				$fstas="Rejected";
			}
		if($sstatus==1)
		{
			$sstas="Approved";
		}
elseif($sstatus==2)
{
	$sstas="Rejected";
}		
	if($mstatus==1)
		{
			$mstas="Approved";
		}
elseif($mstatus==2)
{
	$mstas="Rejected";
}		
			?>
			<tr>
		<td>Finance Remarks:</td>
		<td colspan="5"><input type="text" name="remarks" id="remarks" class="form-control" value="<?php echo $fstas;?>" readonly></td>
		</tr>
			<?php 
		}
?>	
	<tr>
			<td>Service Person:</td>
			<?php 
			$sperso=$fet['service_approved_by'];
			$ssta=$con->query("select * from staff_master where candid_id='$sperso'");			
			$sefet=$ssta->fetch();
			?>
			<td colspan="5"><input type="text" class="form-control" name="qdate" id="qdate" value="<?php echo $sefet['emp_name']; ?>" readonly>
			</td>
		</tr>
			
<?php
if($sstatus !='')
{
	?>
	<tr>
		<td>Service Remarks:</td>
		<td colspan="5"><input type="text" name="remarks" id="remarks" class="form-control" value="<?php echo $sstas;?>" readonly></td>
		</tr>
	<?php
}
	?>
		<tr>
			<td>Marketing Person:</td>
			<?php 
			$sperso=$fet['marketing_approved_by'];
			$ssta=$con->query("select * from staff_master where candid_id='$sperso'");			
			$sefet=$ssta->fetch();
			?>
			<td colspan="5"><input type="text" class="form-control" name="qdate" id="qdate" value="<?php echo $sefet['emp_name']; ?>" readonly>
			</td>
		</tr>

		
<?php
if($mstatus !='')
{
	?>
	<tr>
		<td>Marketing Remarks:</td>
		<td colspan="5"><input type="text" name="remarks" id="remarks" class="form-control" value="<?php echo $mstas;?>" readonly></td>
		</tr>
	<?php
}
	?>
		</table>
		<?php 
		$cno=$fet['cost_sheet_no'];
		$cost=$con->query("select * from cost_sheet_entry where cost_sheet_no='$cno'");
		?>
		<table class="table table-bordered table-striped">
		<th>S.no</th>
		<th>Specification</th>
		<th>Quantity</th>
		<th>Unit</th>
		<th>Unit Rate</th>
		<th>Amount</th>
		<tbody>
		<?php 
		$i=1;
		while($dis=$cost->fetch())
		{
			?>
			<tr>
			<td>
			<?php echo $i;?>
			</td>
			<td><?php echo $dis['specification'];?></td>
			<td><?php echo $dis['qty'];?></td>
			<td><?php echo $dis['unit'];?></td>
			<td><?php echo $dis['unit_rate'];?></td>
			<td><?php echo $dis['total_price'];?></td>
			
			</tr>
			<?php
		$i++;
		}
		?>
		<tr>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td>Subtotal:</td>
		<?php 
		$cost1=$con->query("select * from cost_sheet_entry where cost_sheet_no='$cno'");
		$cfet=$cost1->fetch()?>
		<td>
		<?php echo $cfet['total_amt'];?></td>
		</tr>
		<tr>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td>Add GSt @<?php echo $cfet['gst_per'];?>%:
		</td>
		<td>
		<?php  
		$tot=$cfet['total_amt'];
		$gst=$cfet['gst_per'];
		echo $gst_amt=($tot*$gst)/100;
		?></td>
		</tr>
		<tr>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td>Grand Total:
		</td>
		<td>
		<?php  
		$tot=$cfet['total_amt'];
		$gst=$cfet['gst_per'];
		$gst_amt=($tot*$gst)/100;
		echo round($tot+$gst_amt);
		?></td>
		</tr>
		</tbody>
		
      </table>
    
        <!-- /.post -->
    </form>
    </div>

<script>
$(document).ready(function(){
	//alert("hii");
//document.getElementById('remark').style.visibility = "hidden";
$('#remark').hide();
})
</script>
<script>
function reject_po(v)
{
	//alert("hii");
	$('#remark').show();
	
	
}
function back()
	{
		po_status();
	}

	</script>
	<script>
function submit_po(v)
{
	//alert(v);
	var remark=$('#remarks').val();
	$.ajax({
		type:"post",
		data:"id="+v+"&remark="+remark,
		url:"Qvision/BusinessProcess/po_approval/po_reject.php?id="+v+"&remark="+remark,
		success:function(data)
		{
			if(data==1)
			{
				alert("Rejected Successfully");
				po_approve();
			}
			else
			{
				alert("not approved");
			}
		}
	});
}
</script>
<script>

function approve_po(v)
{
	//alert(v);
	$.ajax({
		type:"post",
		data:"id="+v,
		url:"Qvision/BusinessProcess/po_approval/po_submit.php?id="+v,
		success:function(data)
		{
			if(data==1)
			{
				alert("Approved Successfully");
				po_approve();
			}
			else
			{
				alert("not approved");
				po_approve();
			}
		}
	})
}
</script>



