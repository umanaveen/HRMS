<?php
require '../../../connect.php';
include("../../../user.php");
$userrole=$_SESSION['userrole'];
?>
<div class="card card-info">
              <div class="card-header">
                
				              <center><h3 class="card-title"><b>CLIENT DETAILS FORM</b></h3></center>
		<a onclick="back_ctc()" style="float: right;" data-toggle="modal" class="btn btn-danger"></i>Back</a>
              </div>
			 

<form method="POST" name="form" id="form" action="HRMS/masters/client_master/client_submit.php">
<input type="hidden" name="userrole" id="userrole" value="<?php echo  $userrole; ?>">
<table class="table table-bordered">
<tr>
        <td><center><img src="/HRMS/HRMS/Recruitment/image/userlog/bluebase.png"  style="width:300px;height:150px;"></center></td>
        <td colspan="5"><center><h1><b>Bluebase Software services Pvt Ltd</b></h1></center></td>
        </tr>


<tr>
	<td>Department :</td>
	<td colspan="2">
		<select class="form-control" id="Department" name="Department">
		<option value="">Choose Type</option>
		<?php $stmt = $con->query("SELECT * FROM z_department_master");
		while ($row = $stmt->fetch()) {?>
		<option value="<?php echo $row['id']; ?>"> <?php echo $row['dept_name']; ?></option>
		<?php } ?>
		</select>
	</td>
	
	<td>Employee :</td>
	<td colspan="2">
	 <select class="form-control" name="employee" id="employee" required></select></td>
</tr>
<tr>
   <td>GST NO</td>
   <td colspan="2"><input type="text" class="form-control" id="txt_gst_no" name="txt_gst_no" maxLength="15"></td>
   <input type="hidden" name="txt_duplicate_gstno" id="txt_duplicate_gstno">
  

</tr>
<tr>
   <td>Client Org Name:</td>
   <td colspan="2"><input type="text" class="form-control" id="txt_org_name" name="txt_org_name" ></td>
   <td>Client Org Type:</td>
   <td colspan="2">
     <select name="client_type" id="client_type" class="form-control">
		<option value="">Select Type</option>
		<?php
		$sql=$con->query("SELECT * FROM org_type_master ");
		$i=1;
		while($cmp = $sql->fetch(PDO::FETCH_ASSOC))
		{
		  ?>
		  <option value="<?php echo $cmp['id'];?>"><?php echo $cmp['organization_type'];?></option>
		  <?php
		}
		  ?>
	  </select>
	</td>
</tr>
<tr>
   <td>Customer Name :</td>
   <td colspan="2"><input type="text" class="form-control" id="txt_client_name" name="txt_client_name" ></td>
   <td>Customer  Designation:</td>
   <td colspan="2"><input type="text" class="form-control" id="txt_client_desig" name="txt_client_desig" ></td>
</tr>
<tr> 
</tr>
<tr>
   <td>Mobile No1 : * </td>
   <td colspan="2"><input type="text" class="form-control" id="txt_mobile1" name="txt_mobile1" required></td>
     <td>Mobile No2:</td>
   <td colspan="2"><input type="text" class="form-control" id="txt_mobile2" name="txt_mobile2"></td>
</tr>

<tr>
   <td>Land Line No :</td>
   <td colspan="2"><input type="text" class="form-control" id="txt_landno" name="txt_landno"></td>
</tr>
<tr>
   <td>Email Id 1  : *</td>
   <td colspan="2"><input type="text" class="form-control" id="txt_mail_id1" name="txt_mail_id1" required></td>
    <td>Email Id 2:</td>
   <td colspan="2"><input type="text" class="form-control" id="txt_mail_id2" name="txt_mail_id2"></td>
</tr>

<tr>
   <td>Company Address</td>
   <td colspan="2"><input type="text" class="form-control " id="txt_address1" name="txt_address1" placeholder ="Address 1"></td>
   <td colspan="2"><input type="text" class="form-control" id="txt_address2" name="txt_address2" placeholder ="Address 2"></td>
</tr>
<tr>
   <td></td>
   <td colspan="2"><input type="text" class="form-control " id="txt_area" name="txt_area" placeholder ="Area"></td>
   <td colspan="2"><input type="text" class="form-control" id="txt_town" name="txt_town" placeholder ="Town / City"></td>
</tr>
<tr>
   <td></td>
   <td colspan="2"><input type="text" class="form-control" id="txt_pincode" name="txt_pincode" placeholder ="Pincode"></td>
   <td colspan="2"><input type="text" class="form-control" id="txt_district" name="txt_district" placeholder ="District"></td>
</tr>
<tr>
   <td></td>
   <td colspan="2"><input type="text" class="form-control" id="txt_country" name="txt_state" placeholder ="State"></td>
   <td colspan="2"><input type="text" class="form-control" id="txt_country" name="txt_country" placeholder ="Country"></td>
</tr>
<tr>
<td>Purchase Department</td>
<td colspan="2"><input type="text" class="form-control " id="pur_name" name="pur_name" placeholder ="Name"></td>
<td colspan="2"><input type="text" class="form-control " id="pur_designation" name="pur_designation" placeholder ="Designation"></td>
</tr>
<tr>
<td></td>
<td colspan="2"><input type="text" class="form-control " id="pur_contact" name="pur_contact" placeholder ="Contact Number"></td>
<td colspan="2"><input type="text" class="form-control " id="pur_mail" name="pur_mail" placeholder ="MailId"></td>
</tr>
<tr>
<td>Branch</td>
<td><select name="pur_branch" id="pur_branch" class="form-control" onchange="purchase_branch(this.value)">
<option value="">Select Branch</option>
<option value="1">Yes</option>
<option value="0">No </option>
</td>
</tr>

<tr id="pur" style='display: none;'>
  <td>Purchase Branch Address</td>
   <td colspan="4"><input type="text" class="form-control " id="pur_address1" name="pur_address1" placeholder ="Address 1"></td>
</tr>
<tr id="pur1" style='display: none;'>
   <td></td>
   <td colspan="2"><input type="text" class="form-control " id="pur_area" name="pur_area" placeholder ="Area"></td>
   <td colspan="2"><input type="text" class="form-control" id="pur_town" name="pur_town" placeholder ="Town / City"></td>
</tr>
<tr id="pur2" style='display: none;'>
   <td></td>
   <td colspan="2"><input type="text" class="form-control" id="pur_pincode" name="pur_pincode" placeholder ="Pincode"></td>
   <td colspan="2"><input type="text" class="form-control" id="pur_district" name="pur_district" placeholder ="District"></td>
</tr>
<tr id="pur3" style='display: none;'>
   <td></td>
   <td colspan="2"><input type="text" class="form-control" id="pur_state" name="pur_state" placeholder ="State"></td>
   <td colspan="2"><input type="text" class="form-control" id="pur_country" name="pur_country" placeholder ="Country"></td>
</tr>

<tr>
<td>Finance Department</td>
<td colspan="2"><input type="text" class="form-control " id="fin_name" name="fin_name" placeholder ="Name"></td>
<td colspan="2"><input type="text" class="form-control " id="fin_designation" name="fin_designation" placeholder ="Designation"></td>
</tr>
<tr>
<td></td>
<td colspan="2"><input type="text" class="form-control " id="fin_contact" name="fin_contact" placeholder ="Contact Number"></td>
<td colspan="2"><input type="text" class="form-control " id="fin_mail" name="fin_mail" placeholder ="MailId"></td>
</tr>
<tr>
<td>Branch</td>
<td><select name="fin_branch" id="fin_branch" class="form-control" onchange="finance_branch(this.value)">
<option value="">Select Branch</option>
<option value="1">Yes</option>
<option value="0">No </option>
</td>
</tr>

<tr id="fin" style='display: none;'>
   <td>Finance Branch Address</td>
   <td colspan="4"><input type="text" class="form-control " id="fin_address1" name="fin_address1" placeholder ="Address 1"></td>
</tr>
<tr id="fin1" style='display: none;'>
   <td></td>
   <td colspan="2"><input type="text" class="form-control " id="fin_area" name="fin_area" placeholder ="Area"></td>
   <td colspan="2"><input type="text" class="form-control" id="fin_town" name="fin_town" placeholder ="Town / City"></td>
</tr>
<tr id="fin2" style='display: none;'>
   <td></td>
   <td colspan="2"><input type="text" class="form-control" id="fin_pincode" name="fin_pincode" placeholder ="Pincode"></td>
   <td colspan="2"><input type="text" class="form-control" id="fin_district" name="fin_district" placeholder ="District"></td>
</tr>
<tr id="fin3" style='display: none;'>
   <td></td>
   <td colspan="2"><input type="text" class="form-control" id="fin_state" name="fin_state" placeholder ="State"></td>
   <td colspan="2"><input type="text" class="form-control" id="fin_country" name="fin_country" placeholder ="Country"></td>
</tr>

<tr>
   
   <td>Status</td>
<td colspan="2">
<select class="form-control" name="status" id="status">
<option value="">Select Status</option>
<option value="1">Active</option>
<option value="0">InActive</option>
</select>
</td>
</tr>
<tr>
   <td>Website </td>
   <td colspan="2"><input type="text" class="form-control" id="txt_website" name="txt_website"></td>
   <td colspan="2"> </td>
</tr>
</table>

<input type="submit" name="submit" class="btn btn-primary btn-md" style="float:left;">
<br/>
</form>
</div>
<script>
function back_ctc()
{
  $.ajax({
    type:"POST",
    url:"/HRMS/HRMS/masters/client_master/client_master.php",
    success:function(data){
      $("#main_content").html(data);
    }
  })
}


		$(document).ready(function() {
		//	$('#pur').hide();
			//$('#fin').hide();
			
			$('#Department').on('change', function() {
				var department_id = this.value;
				//alert(department_id);
				$.ajax({
				url: "/HRMS/HRMS/masters/client_master/find_emp.php",
				type: "POST",
				data: {
				department_id: department_id
				},
				cache: false,
				success: function(result){
				$("#employee").html(result);
				}
				});
			});
	    });

</script>

<script>
$("#form").submit(function(e){
			var dupgst = Number($('#txt_duplicate_gstno').val());
			if(dupgst > 0){
				alert("Sorry, This GST Number Already Exist. Duplicate Entry does not Allowed");
				e.preventDefault();
				return false;
			}
});

$("#txt_gst_no").change(function(e){
	var value = $(this).val();
	//alert(value)
	$('#txt_duplicate_gstno').val('');
	var maxLength = $(this).attr("maxLength");
	if(value.length != maxLength) {
		alert("Sorry, Invalid GST Number. Please Enter Valid GST Number");
		e.preventDefault();
		return false;
	}else {
		$.ajax({ 
			type: 'POST', 
			url: 'HRMS/masters/client_master/check_gstno.php', 
			data: { gst: value }, 
			success: function (data) {  //alert(data);
				var Res = Number(data);
				if(Res > 0){
					alert("Sorry, This GST Number Already Exist. Duplicate Entry does not Allowed");
					$('#txt_duplicate_gstno').val(Res);
					$('#txt_gst_no').val('');
				}
			}
		});
	}
});
</script>
<script>
function purchase_branch(v)
{
	
	var val=v;
	if(val==1)
	{
		$('#pur').show();
		$('#pur1').show();
		$('#pur2').show();
		$('#pur3').show();
	}
	else{
		$('#pur').hide();
		$('#pur1').hide();
		$('#pur2').hide();
		$('#pur3').hide();
	}
	

}
function finance_branch(v)
{
	
	var val=v;
	if(val==1)
	{
		$('#fin').show();
		$('#fin1').show();
		$('#fin2').show();
		$('#fin3').show();
	}
	else{
		$('#fin').hide();
		$('#fin1').hide();
		$('#fin2').hide();
		$('#fin3').hide();
	}
	

}
</script>