<?php
require '../../../connect.php';
include("../../../user.php");
 $id=$_REQUEST['id'];

$stmt = $con->prepare("SELECT * FROM `doller_vendor_mastor` WHERE id='$id'"); 
$stmt->execute(); 
$row = $stmt->fetch();
$sta = $row['status'];
$vendor_type = $row['vendor_type'];
?>
<section class="content">
<div class="container-fluid">
<div class="row">
<div class="col-md-12">
<div class="card">
<div class="card-header">
<i class="fa fa-table"></i>Vendor Edit
<a onclick="return back_ctc()" style="float: right;" data-toggle="modal" class="btn btn-primary"><i class="fa fa-plus"></i>Back</a>
</div>
<div class="card-body">
<div class="tab-content">

    <div class="active tab-pane" id="for_employment">
    <form method="POST" enctype="multipart/form-data">
    <!-- Post -->
   <table class="table table-bordered">
        <tr>
        <td><center><img src="../../Recruitment/image/userlog/bluebase.png" alt="quadsel" style="width:100px;height:50px;"></center></td>
        <td colspan="5"><center><b>Bluebase Software services Pvt Ltd</b></center></td>
        </tr>
      
        <tr>
        <td colspan="6"><center><b>Add Vendor</b></center></td>
        </tr>
		<input type="hidden" class="form-control" id="get_id" name="get_id" value="<?php echo  $row['id']; ?>">
       
        <tr>
        <td>Vendor Name</td>
        <td colspan="2"><input type="text" class="form-control" placeholder="Enter Vendor Name" id="txt_vendor_name" name="txt_vendor_name" value="<?php echo $row['vendor_name'];?>"></td>
		<td colspan="2">
		    <select id="vendor_type" name="vendor_type" class="form-control"  placeholder="select vendor type" >
			<?php
				if($vendor_type==1){?>
				<option value="1">INR</option>
				<?php }elseif($vendor_type==2){ ?>
				<option value="2">$</option>
				<?php } ?>
				<option>----Select Vendor Type</option>
				<option value="1">INR</option>
				<option value="2">$</option>
			
		    </select>
		</td>
        </tr>
      
	    <tr>
		   <td>Vendor Address</td>
		   <td colspan="2"><input type="text" class="form-control " id="txt_address1" name="txt_address1" placeholder ="Address 1" value="<?php echo $row['address1'];?>"></td>
		   <td colspan="2"><input type="text" class="form-control" id="txt_address2" name="txt_address2" placeholder ="Address 2" value="<?php echo $row['address2'];?>"></td>
		</tr>
		<tr>
		   <td></td>
		   <td colspan="2"><input type="text" class="form-control " id="txt_area" name="txt_area" placeholder ="Area" value="<?php echo $row['area'];?>"></td>
		   <td colspan="2"><input type="text" class="form-control" id="txt_town" name="txt_town" placeholder ="Town / City" value="<?php echo $row['town_city'];?>"></td>
		</tr>
		<tr>
		   <td></td>
		   
		   <td colspan="2"><input type="text" class="form-control" id="txt_district" name="txt_district" placeholder ="District" value="<?php echo $row['state'];?>"></td>
		    <td colspan="2"><input type="text" class="form-control" id="txt_country" name="txt_state" placeholder ="State" value="<?php echo $row['district'];?>"></td>
		</tr>
		<tr>
		   <td></td>
		   
		   <td colspan="2"><input type="text" class="form-control" id="txt_country" name="txt_country" placeholder ="Country" value="<?php echo $row['country'];?>"></td>
		   <td colspan="2"><input type="text" class="form-control" id="txt_pincode" name="txt_pincode" placeholder ="Pincode" value="<?php echo $row['pincode'];?>"></td>
		</tr>
       
		
		<tr>
		   <td>Bank Details</td>
		   <td colspan="2"><input type="text" class="form-control " id="txt_account_name" name="txt_account_name" placeholder ="Bank Account Name"value="<?php echo $row['account_name'];?>"></td>
		   <td colspan="2"><input type="text" class="form-control" id="txt_account_no" name="txt_account_no" placeholder ="Bank Account No" value="<?php echo $row['account_no'];?>"></td>
		</tr>
		<tr>
		   <td></td>
		   <td colspan="2"><input type="text" class="form-control " id="txt_swift_code" name="txt_swift_code" placeholder ="Swift Code" value="<?php echo $row['swift_code'];?>"></td>
		   <td colspan="2"><input type="text" class="form-control" id="txt_ifsc_code" name="txt_ifsc_code" placeholder ="IFSC Code" value="<?php echo $row['ifsc_code'];?>"></td>
		</tr>
		<tr>
		   <td></td>
		   <td colspan="2"><input type="email" class="form-control" id="txt_mailid" name="txt_mailid" placeholder ="Mail Id" value="<?php echo $row['mail_id'];?>"></td>
		    <td >
			<select class="form-control" name="status" id="status">
				<?php
				if($sta==0){?>
				<option value="0">InActive</option>
				<option value="1">Active</option>
				<?php }else{ ?>
				<option value="1">Active</option>
				<option value="0">InActive</option>
				<?php } ?>
            </select>
			</td>
		</tr>
		
        <td colspan="6"><input type="button" class="btn btn-success" name="save" onclick="update_vendor()" value="save"></td>
        </tr>
        </table>
        <!-- /.post -->
    </form>
    </div>

    <script>
	function back_ctc()
{
  $.ajax({
    type:"POST",
    url:"HRMS/BusinessProcess/doller_vendor_master/vendor.php",
    success:function(data){
      $("#main_content").html(data);
    }
  })
}
	
	
    function update_vendor()
    {
    var id=0;
	//alert(id);
	 var id=$('#get_id').val();
    var data = $('form').serialize();
//alert(data);
    $.ajax({
    type:'GET',
    data:"id="+id, data,
     url:"HRMS/BusinessProcess/doller_vendor_master/vendor_update.php",
    success:function(data)
    {      
        alert("Updated Successfully");
	vendor_master()

		          
    }       
    });
    }
	
	function back()

	{
		vendor_master()

	}
    </script>
