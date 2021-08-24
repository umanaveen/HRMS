<?php
require '../../connect.php';
include("../../user.php");
$id=$_REQUEST['id'];
$stmt = $con->prepare("SELECT enquiry.id as enquiry_id,enquiry.status as enquiry_status,enquiry.mail as enquiry_mailid,z_department_master.id as dep_id,candidate_form_details.id as candi_id,enquiry.*,calls_master.*,z_department_master.*,candidate_form_details.*  FROM `enquiry`
	   INNER JOIN calls_master ON enquiry.Call_type=calls_master.id
	  INNER join z_department_master ON enquiry.Department=z_department_master.id
	  INNER JOIN candidate_form_details ON enquiry.employee=candidate_form_details.id
where enquiry.id='$id'"); 

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
	
	
		<input type="hidden" class="form-control" id="id" name="id" value="<?php echo  $id;?>">
	
	
</tr>

<tr>
	<td>Department</td>
	<td colspan="2">
	<input type="hidden" class="form-control" id="Department_id" name="Department_id" value="<?php echo  $row['dep_id'];?>">
	<input type="text" class="form-control" id="Department" name="Department" value="<?php echo  $row['dept_name'];?>">
		
	</td>
	
	<td>Employee</td>
	<td colspan="2">
	<input type="hidden" class="form-control" id="employee_id" name="employee_id" value="<?php echo  $row['candi_id'];?>">
		<input type="text" class="form-control" id="employee" name="employee" value="<?php echo  $row['first_name'];?>">
	</td>
</tr>
<tr>
   <td>GST NO</td>
   <td colspan="2"><input type="text" class="form-control" id="txt_gst_no" name="txt_gst_no" maxLength="15" required></td>
   <input type="hidden" name="txt_duplicate_gstno" id="txt_duplicate_gstno">
  

</tr>
<tr>
   <td>Client Org Name</td>
   <td colspan="2"><input type="text" class="form-control" id="txt_org_name" name="txt_org_name" value="<?php echo  $row['Company_name'];?>" ></td>
  
   
   <td>Client Org Type<font color="red">*</font>:</td>
   <td colspan="2">
     <select name="client_type_id" id="client_type_id" class="form-control">
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
   <td>Customer Name</td>
   <td colspan="2"><input type="text" class="form-control" id="txt_client_name" name="txt_client_name" value="<?php echo  $row['Client'];?>"></td>
   <td>Customer  Designation</td>
   <td colspan="2"><input type="text" class="form-control" id="txt_client_desig" name="txt_client_desig" value="<?php echo  $row['Designation'];?>"></td>
</tr>
<tr> 
</tr>
<tr>
   <td>Mobile No 1* </td>
   <td colspan="2"><input type="text" class="form-control" id="txt_mobile1" name="txt_mobile1" value="<?php echo  $row['Mobile'];?>"></td>
     <td>Mobile No2</td>
   <td colspan="2"><input type="text" class="form-control" id="txt_mobile2" name="txt_mobile2"></td>
</tr>
<tr>
   <td>Land Line No</td>
   <td colspan="2"><input type="text" class="form-control" id="txt_landno" name="txt_landno"></td>
</tr>

<tr>
   <td>Email Id 1*</td>
   <td colspan="2"><input type="text" class="form-control" id="txt_mail_id1" name="txt_mail_id1" value="<?php echo  $row['enquiry_mailid'];?>"></td>
     <td>Email Id 2</td>
   <td colspan="2"><input type="text" class="form-control" id="txt_mail_id2" name="txt_mail_id2"></td>
</tr>

<tr>
   <td>Company Address</td>
   <td colspan="2"><input type="text" class="form-control " id="txt_address1" name="txt_address1"   value="<?php echo  $row['Address'];?>"></td>
   <td colspan="2"><input type="text" class="form-control" id="txt_address2" name="txt_address2" placeholder ="Address 2"></td>
  
   
</tr>
<tr>
   <td></td>
   <td colspan="2"><input type="text" class="form-control " id="txt_area" name="txt_area" placeholder ="Area"></td>
   <td colspan="2"><input type="text" class="form-control" id="txt_town" name="txt_town" placeholder ="Town / City" value="<?php echo  $row['Location'];?>"></td>
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
   <td>Website </td>
   <td colspan="2"><input type="text" class="form-control" id="txt_website" name="txt_website"></td>
   <td colspan="2"> </td>
</tr>
<tr>
        <td colspan="8"><input type="button" class="btn btn-success" name="save" onclick="insert_client()" value="save"></td>
        </tr>
</table>


</form>
 </div>
<script>
function back_ctc()
{
 lead()
}



function insert_client()
    {
    var id=0;
	//alert(id);
    var data = $('form').serialize();
//alert(data);
    $.ajax({
    type:'GET',
    data:"id="+id, data,
    url:'HRMS/CRM/insert_client.php',	
    success:function(data)
    {      
        alert("Entry Successfully");
		lead()
		          
    }       
    });
    }
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
$('#form').validate({ // initialize the plugin
            rules: {
          client_type_id:{ required: true},
         }
      });
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