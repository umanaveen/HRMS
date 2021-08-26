<?php
require '../../../connect.php';
$quoteid=$_REQUEST['id'];

$sql=$con->query("SELECT * FROM `po_upload`
 INNER JOIN quotation ON po_upload.enquiry_id=quotation.Enquire_id 
 WHERE Po_id='$quoteid'
");
$fet=$sql->fetch();
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
			<td colspan="5">
			<input type="hidden" class="form-control" name="get_id" id="get_id" value="<?php echo $quoteid;?>" readonly>
			<input type="text" class="form-control" name="cost_sheet_number" id="cost_sheet_number" value="<?php echo $fet['cost_sheet_number'];?>" readonly>
			</td>
		</tr>
		<tr>
			<td>proposal:</td>
			<td colspan="5"><input type="text" class="form-control" name="proposal" id="proposal" value="<?php echo $fet['proposal']; ?>" readonly>
			</td>
		</tr>
		<tr>
			<td>Client:</td>
			<td colspan="5"><input type="text" class="form-control" name="Client" id="Client" value="<?php echo $fet['Client']; ?>" readonly>
			</td>
		</tr>
		<tr>
			<td>Po:</td>
			<td colspan="5"><a href="/HRMS/HRMS/BusinessProcess/po_approval/image/<?php echo $fet['image'];?>" download="<?php echo $fet['image']; ?>"><?php echo $fet['image']; ?></a>
			</td>
		</tr>
		</table>
		
		
		
		</tbody>
		
      </table>
    
		<center>
<?php if ($fet['po_status']==1){
	?>
 <input type="button" class="btn btn-success btn-lg"" id="save" name="save" onclick="approved()" value="Approve">

<input type="button" class="btn btn-danger btn-lg"" id="save" name="save" onclick="rejected()" value="Rejected">
<?php }
?>
</center>
	 
		
        </table>
        <!-- /.post -->
    </form>
    </div>

<script>

</script>
<script>

function back()
	{
		 po_approval();
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



function approved()
{
var id=$('#get_id').val();
//alert(id);
var data = $('form').serialize();
$.ajax({
type:'GET',
data:"id="+id,data,

url:'HRMS/BusinessProcess/po_approval/accounts_approval.php',
success:function(data)
{
if(data==1)
{ 
alert('Not');
}
else
{
alert("Approved Successfully");
po_approval()
}
}           
});
}
function rejected()
{
var id=$('#get_id').val();
//alert(id);
var data = $('form').serialize();
$.ajax({
type:'GET',
data:"id="+id,data,

url:'HRMS/BusinessProcess/po_approval/accounts_rejected.php',
success:function(data)
{
if(data==1)
{ 
alert('Not');
}
else
{
alert("Rejected Successfully");
po_approval()
}
}           
});
}
</script>



