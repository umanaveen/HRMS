<?php
require '../../connect.php';
include("../../user.php");
$id=$_REQUEST['id'];
$stmt = $con->prepare("SELECT client_master.status as client_master_status,z_department_master.*,candidate_form_details.*,enquiry.*,client_master.* FROM `client_master` 
INNER join z_department_master ON client_master.department_id=z_department_master.id
INNER JOIN candidate_form_details ON client_master.employee_id = candidate_form_details.id
 INNER join enquiry on client_master.org_name=enquiry.Company_name
where client_master.id='$id'"); 

$stmt->execute(); 
$row = $stmt->fetch();
?>

<div  class="card card-primary">
              <div class="card-header">
                <h3 class="card-title"><font size="5">CLIENT DETAILS FORM</font></h3>
				<a onclick="back_ctc()" style="float: right;" data-toggle="modal" class="btn btn-danger"></i>Back</a>
             </div>
<form method="POST" name="form" id="form" action="HRMS/masters/client_master/client_submit.php">

<table class="table table-bordered">
<tr>
<td><center><img src="../../Recruitment/image/userlog/bluebase.png" alt="quadsel" style="width:100px;height:50px;"></center></td>
<td colspan="5"><center><b>Bluebase Software services Pvt Ltd</b></center></td>
</tr>
<tr>
	<td>Company Name:</td>
	<td colspan="4">
	
	<input type="text" class="form-control" id="company_name" name="company_name" value="Bluebase Software Services Pvt Ltd" readonly>
	
	</td>
</tr>

<tr>
	<td>Department :</td>
	<td colspan="2">
	<input type="hidden" class="form-control" id="get_id" name="get_id" value="<?php echo  $id;?>" readonly>
	<input type="text" class="form-control" id="Department" name="Department" value="<?php echo  $row['dept_name'];?>" readonly>
		
	</td>
	
	<td>Employee :</td>
	<td colspan="2">

		<input type="text" class="form-control" id="employee" name="employee" value="<?php echo  $row['first_name'];?>" readonly>
	</td>
</tr>

<tr>
   <td>Client Org Name:</td>
   <td colspan="2"><input type="text" class="form-control" id="txt_org_name" name="txt_org_name" value="<?php echo  $row['org_name'];?>" readonly></td>
   <td>Client Org Type:</td>
   <td colspan="2">
   <?php if($row['org_type']==1){
	   ?>
	  
   <input type="text" class="form-control" id="client_type" name="client_type" value="Existing" readonly>
     <?php
   } else {
   ?>
   
   <input type="text" class="form-control" id="client_type" name="client_type" value="New" readonly>
   <?php
   }
   ?>
	</td>
</tr>
<tr>
   <td>Customer Name :</td>
   <td colspan="2"><input type="text" class="form-control" id="txt_client_name" name="txt_client_name" value="<?php echo  $row['Client'];?>" readonly></td>
   <td>Customer  Designation:</td>
   <td colspan="2"><input type="text" class="form-control" id="txt_client_desig" name="txt_client_desig" value="<?php echo  $row['Designation'];?>" readonly></td>
</tr>
<tr> 
</tr>
<tr>
   <td>Mobile No 1: * </td>
   <td colspan="2"><input type="text" class="form-control" id="txt_mobile1" name="txt_mobile1" value="<?php echo  $row['Mobile'];?>" readonly></td>
     <td>Mobile No2:</td>
   <td colspan="2"><input type="text" class="form-control" id="txt_mobile2" name="txt_mobile2" readonly></td>
</tr>
<tr>
   <td>Land Line No :</td>
   <td colspan="2"><input type="text" class="form-control" id="txt_landno" name="txt_landno" readonly></td>
</tr>

<tr>
   <td>Email Id 1: *</td>
   <td colspan="2"><input type="text" class="form-control" id="txt_mail_id1" name="txt_mail_id1" value="<?php echo  $row['email_id1'];?>" readonly></td>
     <td>Email Id 2:</td>
   <td colspan="2"><input type="text" class="form-control" id="txt_mail_id2" name="txt_mail_id2" readonly></td>
</tr>

<tr>
   <td>Company Address</td>
   <td colspan="2"><input type="text" class="form-control " id="txt_address1" name="txt_address1"  style="height:300px" style="w:300px" value="<?php echo  $row['Address'];?>" readonly></td>
   <td colspan="2"><input type="text" class="form-control" id="txt_address2" name="txt_address2" placeholder ="Address 2" readonly></td>
  
   
</tr>
<tr>
   <td></td>
   <td colspan="2"><input type="text" class="form-control " id="txt_area" name="txt_area" placeholder ="Area" readonly></td>
   <td colspan="2"><input type="text" class="form-control" id="txt_town" name="txt_town" placeholder ="Town / City" value="<?php echo  $row['Location'];?>" readonly></td>
</tr>
<tr>
   <td></td>
   <td colspan="2"><input type="text" class="form-control" id="txt_pincode" name="txt_pincode" placeholder ="Pincode" readonly></td>
   <td colspan="2"><input type="text" class="form-control" id="txt_district" name="txt_district" placeholder ="District" readonly></td>
</tr>
<tr>
   <td></td>
   <td colspan="2"><input type="text" class="form-control" id="txt_country" name="txt_state" placeholder ="State"readonly></td>
   <td colspan="2"><input type="text" class="form-control" id="txt_country" name="txt_country" placeholder ="Country" readonly></td>
</tr>
<tr>
   <td>GST NO</td>
   <td colspan="2"><input type="text" class="form-control" id="txt_gst_no" name="txt_gst_no" maxLength="15" readonly></td>
  
  

</tr>
<tr>
   <td>Website </td>
   <td colspan="2"><input type="text" class="form-control" id="txt_website" name="txt_website" readonly></td>
   <td colspan="2"> </td>
</tr>
<tr>
      
        </tr>
</table><center>
<?php if ( $row['client_master_status']==1){
	?>
 <input type="button" class="btn btn-success btn-lg"" id="save" name="save" onclick="approved()" value="Approve">

<input type="button" class="btn btn-danger btn-lg"" id="save" name="save" onclick="rejected()" value="Rejected">
<?php }
?>
</center>
</form>
 </div>
<script>
function back_ctc()
{
  enquiry()
}
function approved()
{
var id=$('#get_id').val();
//alert(id);
var data = $('form').serialize();
$.ajax({
type:'GET',
data:"id="+id,data,

url:'HRMS/CRM/accounts_approval.php',
success:function(data)
{
if(data==1)
{ 
alert('Not');
}
else
{
alert("Approved Successfully");
cost_sheet_approval()
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

url:'HRMS/CRM/accounts_rejected.php',
success:function(data)
{
if(data==1)
{ 
alert('Not');
}
else
{
alert("Approved Successfully");
cost_sheet_approval()
}
}           
});
}



</script>

