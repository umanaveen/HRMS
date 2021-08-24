<?php
require '../../../connect.php';
include("../../../user.php");
$id=$_REQUEST['id'];
$stmt = $con->prepare("SELECT client_master.status as client_master_status,z_department_master.*,candidate_form_details.*,enquiry.*,client_master.*,org_type_master.* FROM `client_master` INNER join z_department_master ON client_master.department_id=z_department_master.id INNER JOIN candidate_form_details ON client_master.employee_id = candidate_form_details.id INNER join enquiry on client_master.org_name=enquiry.Company_name INNER JOIN org_type_master ON client_master.org_type=org_type_master.id where client_master.id='$id'"); 

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
		<td><h4><b>Account Manager</b></h4></td>
	
	
	
	
	
</tr>

<tr>
	<td>Department</td>
	<td colspan="2">
	<input type="hidden" class="form-control" id="get_id" name="get_id" value="<?php echo  $id;?>" readonly>
	<input type="text" class="form-control" id="Department" name="Department" value="<?php echo  $row['dept_name'];?>" readonly>
		
	</td>
	
	<td>Employee</td>
	<td colspan="2">

		<input type="text" class="form-control" id="employee" name="employee" value="<?php echo  $row['first_name'];?>" readonly>
	</td>
</tr>
<tr>
   <td>GST NO</td>
   <td colspan="2"><input type="text" class="form-control" id="txt_gst_no" name="txt_gst_no" maxLength="15" value="<?php echo  $row['gst_no'];?>" readonly></td>
  
  

</tr>
<tr>
   <td>Client Org Name</td>
   <td colspan="2"><input type="text" class="form-control" id="txt_org_name" name="txt_org_name" value="<?php echo  $row['org_name'];?>" readonly></td>
    <td>Client Org Type</td>
   
     <td colspan="2"><input type="text" class="form-control" id="client_type" name="client_type" value="<?php echo  $row['organization_type'];?>" readonly></td>
	</td>

   
</tr>
<tr>
   <td>Customer Name </td>
   <td colspan="2"><input type="text" class="form-control" id="txt_client_name" name="txt_client_name" value="<?php echo  $row['Client'];?>" readonly></td>
   <td>Customer  Designation</td>
   <td colspan="2"><input type="text" class="form-control" id="txt_client_desig" name="txt_client_desig" value="<?php echo  $row['Designation'];?>" readonly></td>
</tr>
<tr> 
</tr>
<tr>
   <td>Mobile No 1 * </td>
   <td colspan="2"><input type="text" class="form-control" id="txt_mobile1" name="txt_mobile1" value="<?php echo  $row['Mobile'];?>" readonly></td>
     <td>Mobile No2</td>
   <td colspan="2"><input type="text" class="form-control" id="txt_mobile2" name="txt_mobile2" value="<?php echo  $row['mobile_no2'];?>" readonly></td>
</tr>
<tr>
   <td>Land Line No</td>
   <td colspan="2"><input type="text" class="form-control" id="txt_landno" name="txt_landno" value="<?php echo  $row['land_line_no'];?>" readonly></td>
</tr>

<tr>
   <td>Email Id 1*</td>
   <td colspan="2"><input type="text" class="form-control" id="txt_mail_id1" name="txt_mail_id1" value="<?php echo  $row['email_id1'];?>" readonly></td>
     <td>Email Id 2</td>
   <td colspan="2"><input type="text" class="form-control" id="txt_mail_id2" name="txt_mail_id2" value="<?php echo  $row['email_id2'];?>" readonly></td>
</tr>

<tr>
   <td>Company Address</td>
   <td colspan="2"><input type="text" class="form-control " id="txt_address1" name="txt_address1"  value="<?php echo  $row['Address'];?>" readonly></td>
   <td colspan="2"><input type="text" class="form-control" id="txt_address2" name="txt_address2" placeholder ="Address 2" value="<?php echo  $row['address2'];?>" readonly></td>
  
   
</tr>
<tr>
   <td></td>
   <td colspan="2"><input type="text" class="form-control " id="txt_area" name="txt_area" placeholder ="Area" value="<?php echo  $row['area'];?>" readonly></td>
   <td colspan="2"><input type="text" class="form-control" id="txt_town" name="txt_town" placeholder ="Town / City" value="<?php echo  $row['town_city'];?>" readonly></td>
</tr>
<tr>
   <td></td>
   <td colspan="2"><input type="text" class="form-control" id="txt_pincode" name="txt_pincode" placeholder ="Pincode" value="<?php echo  $row['pincode'];?>" readonly></td>
   <td colspan="2"><input type="text" class="form-control" id="txt_district" name="txt_district" placeholder ="District" value="<?php echo  $row['district'];?>" readonly></td>
</tr>
<tr>
   <td></td>
   <td colspan="2"><input type="text" class="form-control" id="txt_country" name="txt_state" placeholder ="State" value="<?php echo  $row['state'];?>" readonly></td>
   <td colspan="2"><input type="text" class="form-control" id="txt_country" name="txt_country" placeholder ="Country" value="<?php echo  $row['country'];?>" readonly></td>
</tr>

<tr>
<td>Purchase Department</td>
<td colspan="2"><input type="text" class="form-control " id="pur_name" name="pur_name" placeholder ="Name" value="<?php echo  $row['pur_name'];?>" readonly></td>
<td colspan="2"><input type="text" class="form-control " id="pur_designation" name="pur_designation" placeholder ="Designation" value="<?php echo  $row['pur_designation'];?>" readonly></td>
</tr>
<tr>
<td></td>
<td colspan="2"><input type="text" class="form-control " id="pur_contact" name="pur_contact" placeholder ="Contact Number"value="<?php echo  $row['pur_contact'];?>" readonly></td>
<td colspan="2"><input type="text" class="form-control " id="pur_mail" name="pur_mail" placeholder ="MailId" value="<?php echo  $row['pur_mail'];?>" readonly></td>
</tr>

<tr id="pur1" style='display: none;'>
   <td></td>
   <td colspan="2"><input type="text" class="form-control " id="pur_area" name="pur_area" placeholder ="Area" value="<?php echo  $row['pur_bran_area'];?>" readonly></td>
   <td colspan="2"><input type="text" class="form-control" id="pur_town" name="pur_town" placeholder ="Town / City" value="<?php echo  $row['pur_bran_city'];?>" readonly></td>
</tr>
<tr id="pur2" style='display: none;'>
   <td></td>
   <td colspan="2"><input type="text" class="form-control" id="pur_pincode" name="pur_pincode" placeholder ="Pincode" value="<?php echo  $row['pur_bran_pincode'];?>" readonly></td>
   <td colspan="2"><input type="text" class="form-control" id="pur_district" name="pur_district" placeholder ="District" value="<?php echo  $row['pur_bran_district'];?>" readonly></td>
</tr>
<tr id="pur3" style='display: none;'>
   <td></td>
   <td colspan="2"><input type="text" class="form-control" id="pur_state" name="pur_state" placeholder ="State" value="<?php echo  $row['pur_bran_state'];?>" readonly></td>
   <td colspan="2"><input type="text" class="form-control" id="pur_country" name="pur_country" placeholder ="Country" value="<?php echo  $row['pur_bran_country'];?>" readonly></td>
</tr>
<tr>
<td>Finance Department</td>
<td colspan="2"><input type="text" class="form-control " id="fin_name" name="fin_name" placeholder ="Name" value="<?php echo  $row['fin_name'];?>" readonly></td>
<td colspan="2"><input type="text" class="form-control " id="fin_designation" name="fin_designation" placeholder ="Designation" value="<?php echo  $row['fin_designation'];?>" readonly></td>
</tr>
<tr>
<td></td>
<td colspan="2"><input type="text" class="form-control " id="fin_contact" name="fin_contact" placeholder ="Contact Number"value="<?php echo  $row['fin_contact'];?>" readonly></td>
<td colspan="2"><input type="text" class="form-control " id="fin_mail" name="fin_mail" placeholder ="MailId" value="<?php echo  $row['fin_mail'];?>" readonly></td>
</tr>


<tr id="fin" style='display: none;'>
   <td>Finance Branch Address</td>
   <td colspan="4"><input type="text" class="form-control " id="fin_address1" name="fin_address1" placeholder ="Address 1"value="<?php echo  $row['fin_bran_address'];?>" readonly></td>
</tr>
<tr id="fin1" style='display: none;'>
   <td></td>
   <td colspan="2"><input type="text" class="form-control " id="fin_area" name="fin_area" placeholder ="Area" value="<?php echo  $row['fin_bran_area'];?>" readonly></td>
   <td colspan="2"><input type="text" class="form-control" id="fin_town" name="fin_town" placeholder ="Town / City" value="<?php echo  $row['fin_bran_city'];?>" readonly></td>
</tr>
<tr id="fin2" style='display: none;'>
   <td></td>
   <td colspan="2"><input type="text" class="form-control" id="fin_pincode" name="fin_pincode" placeholder ="Pincode" value="<?php echo  $row['fin_bran_pincode'];?>" readonly></td>
   <td colspan="2"><input type="text" class="form-control" id="fin_district" name="fin_district" placeholder ="District" value="<?php echo  $row['fin_bran_district'];?>" readonly></td>
</tr>
<tr id="fin3" style='display: none;'>
   <td></td>
   <td colspan="2"><input type="text" class="form-control" id="fin_state" name="fin_state" placeholder ="State" value="<?php echo  $row['fin_bran_state'];?>" readonly></td>
   <td colspan="2"><input type="text" class="form-control" id="fin_country" name="fin_country" placeholder ="Country" value="<?php echo  $row['fin_bran_country'];?>" readonly> </td>
</tr>
<tr>
   <td>Website </td>
   <td colspan="2"><input type="text" class="form-control" id="txt_website" name="txt_website" value="<?php echo  $row['website'];?>" readonly></td>
   <td colspan="2"> </td>
</tr>
<tr>
      
        </tr>
</table><center>

</center>
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



</script>

