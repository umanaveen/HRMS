<?php
require '../../../connect.php';
$id=$_REQUEST['id'];
$stmt = $con->prepare("SELECT client_master.status as client_master_status,z_department_master.*,candidate_form_details.*,client_master.*,org_type_master.* FROM `client_master` INNER join z_department_master ON client_master.department_id=z_department_master.id INNER JOIN candidate_form_details ON client_master.employee_id = candidate_form_details.id  INNER JOIN org_type_master ON client_master.org_type=org_type_master.id where client_master.id='$id'");


$stmt->execute();  
$row = $stmt->fetch();
$sta = $row['status'];

$emp_id = $row['employee_id'];
?>
<div class="container-fluid">
<div class="card mb-3">
<div class="card-header">
<i class="fa fa-table"></i> Client DETAILS EDIT
<a onclick="return back_ctc()" style="float: right;" data-toggle="modal" class="btn btn-primary">Back</a>
</div>
<div class="card-body" id="printableArea">
<form role="form" name="" action="HRMS/masters/client_master/client_master_update.php" method="post" enctype="multipart/type">

<table class="table table-bordered">
<tr>
<td><center><img src="../../Recruitment/image/userlog/bluebase.png" alt="quadsel" style="width:100px;height:50px;"></center></td>
<td colspan="5"><center><b>Bluebase Software services Pvt Ltd</b></center></td>
</tr>
<tr>
<td colspan="5">
<tr>
	
	<input type="hidden" class="form-control" id="get_id" name="get_id" value="<?php echo  $id;?>" readonly>
	
</tr>
</td>
</tr>

 <tr>
		<td>Department :</td>
		<td colspan="2">
		<select class="form-control" id="Department" name="Department" >
		<option value="<?php echo $row['id'];?>"><?php echo $row['dept_name'];?></option>
		
		<?php $stmt = $con->query("SELECT * FROM z_department_master ");
		while ($dept = $stmt->fetch()) {?>
		<option value="<?php echo $dept['id']; ?>"> <?php echo $dept['dept_name']; ?> </option>
		<?php } ?>
		</select></td>
        
		<td>Employee :</td>
		<td colspan="2">
		 <select class="form-control" name="employee" id="employee" required>
		 <option value="<?php echo $row['id'];?>"><?php echo $row['first_name'];?></option>
		 </select></td>
        </tr>


<tr>
   <td>Client Org Name:</td>
   <td colspan="2"><input type="text" class="form-control" id="txt_org_name" name="txt_org_name" value="<?php echo $row['org_name'];?>"></td>
   <td>Client Org Type:</td>
   <td colspan="2">
     <select name="client_type" id="client_type" class="form-control">
		<option value="<?php echo $row['id'];?>"><?php echo $row['organization_type'];?></option>
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
   <td>Client Name:</td>
   <td colspan="2"><input type="text" class="form-control" id="txt_client_name" name="txt_client_name" value="<?php echo $row['client_name'];?>"></td>
   <td>Client Designation:</td>
   <td colspan="2"><input type="text" class="form-control" id="txt_client_desig" name="txt_client_desig" value="<?php echo $row['designation'];?>"></td>
</tr>
<tr> 
</tr>
<tr>
   <td>Mobile No1 : * </td>
   <td colspan="2"><input type="text" class="form-control" id="txt_mobile1" name="txt_mobile1" required value="<?php echo $row['mobile_no1'];?>"></td>
     <td>Mobile No2:</td>
   <td colspan="2"><input type="text" class="form-control" id="txt_mobile2" name="txt_mobile2" value="<?php echo $row['mobile_no2'];?>"></td>
</tr>

<tr>
   <td>Land Line No :</td>
   <td colspan="2"><input type="text" class="form-control" id="txt_landno" name="txt_landno" value="<?php echo $row['land_line_no'];?>"></td>
</tr>
<tr>
   <td>Email Id 1  : *</td>
   <td colspan="2"><input type="text" class="form-control" id="txt_mail_id1" name="txt_mail_id1" required value="<?php echo $row['email_id1'];?>"></td>
    <td>Email Id 2:</td>
   <td colspan="2"><input type="text" class="form-control" id="txt_mail_id2" name="txt_mail_id2" value="<?php echo $row['email_id2'];?>"></td>
</tr>

<tr>
   <td>Company Address</td>
   <td colspan="2"><input type="text" class="form-control " id="txt_address1" name="txt_address1" placeholder ="Enter Address 1" value="<?php echo $row['address1'];?>"></td>
   <td colspan="2"><input type="text" class="form-control" id="txt_address2" name="txt_address2" placeholder ="Enter Address 2" value="<?php echo $row['address1'];?>"></td>
</tr>
<tr>
   <td></td>
   <td colspan="2"><input type="text" class="form-control " id="txt_area" name="txt_area" placeholder ="Enter Area" value="<?php echo $row['area'];?>"></td>
   <td colspan="2"><input type="text" class="form-control" id="txt_town" name="txt_town" placeholder ="Enter Town / City" value="<?php echo $row['town_city'];?>"></td>
</tr>
<tr>
   <td></td>
   <td colspan="2"><input type="text" class="form-control" id="txt_pincode" name="txt_pincode" placeholder ="Enter Pincode" value="<?php echo $row['pincode'];?>"></td>
   <td colspan="2"><input type="text" class="form-control" id="txt_district" name="txt_district" placeholder ="Enter District" value="<?php echo $row['district'];?>"></td>
</tr>
<tr>
   <td></td>
   <td colspan="2"><input type="text" class="form-control" id="txt_country" name="txt_state" placeholder ="Enter State" value="<?php echo $row['state'];?>"></td>
   <td colspan="2"><input type="text" class="form-control" id="txt_country" name="txt_country" placeholder ="Enter Country" value="<?php echo $row['country'];?>"></td>
</tr>

<tr>
<td>Purchase Department</td>
<td colspan="2"><input type="text" class="form-control " id="pur_name" name="pur_name" placeholder ="Name" value="<?php echo $row['pur_name'];?>"></td>
<td colspan="2"><input type="text" class="form-control " id="pur_designation" name="pur_designation" placeholder ="Designation" value="<?php echo $row['pur_designation'];?>"></td>
</tr>
<tr>
<td></td>
<td colspan="2"><input type="text" class="form-control " id="pur_contact" name="pur_contact" placeholder ="Contact Number" value="<?php echo $row['pur_contact'];?>"></td>
<td colspan="2"><input type="text" class="form-control " id="pur_mail" name="pur_mail" placeholder ="MailId" value="<?php echo $row['pur_mail'];?>"></td>
</tr>



	
<tr>
<td>Branch</td>
<td><select name="pur_branch" id="pur_branch" class="form-control" onchange="purchase_branch(this.value)">
<option value="0">No </option>
<option value="1">Yes</option>
</td>
</tr>

<tr id="pur" style='display: none;'>
  <td>Purchase Branch Address</td>
   <td colspan="4"><input type="text" class="form-control " id="pur_address1" name="pur_address1"></td>
</tr>
<tr id="pur1" style='display: none;'>
   <td></td>
   <td colspan="2"><input type="text" class="form-control " id="pur_area" name="pur_area"></td>
   <td colspan="2"><input type="text" class="form-control" id="pur_town" name="pur_town"></td>
</tr>
<tr id="pur2" style='display: none;'>
   <td></td>
   <td colspan="2"><input type="text" class="form-control" id="pur_pincode" name="pur_pincode" ></td>
   <td colspan="2"><input type="text" class="form-control" id="pur_district" name="pur_district" ></td>
</tr>
<tr id="pur3" style='display: none;'>
   <td></td>
   <td colspan="2"><input type="text" class="form-control" id="pur_state" name="pur_state"></td>
   <td colspan="2"><input type="text" class="form-control" id="pur_country" name="pur_country"></td>
</tr>

	
<tr>
<td>Finance Department</td>
<td colspan="2"><input type="text" class="form-control " id="fin_name" name="fin_name" placeholder ="Name" value="<?php echo $row['fin_name'];?>"></td>
<td colspan="2"><input type="text" class="form-control " id="fin_designation" name="fin_designation" value="<?php echo $row['fin_designation'];?>"></td>
</tr>
<tr>
<td></td>
<td colspan="2"><input type="text" class="form-control " id="fin_contact" name="fin_contact" value="<?php echo $row['fin_contact'];?>"></td>
<td colspan="2"><input type="text" class="form-control " id="fin_mail" name="fin_mail" value="<?php echo $row['fin_mail'];?>"></td>
</tr>

	<tr>
<tr>
<td>Branch</td>
<td><select name="fin_branch" id="fin_branch" class="form-control">
<option value="0">No </option>
<option value="1">Yes</option>

</td>
</tr>
<tr id="fin" >
   <td>Finance Branch Address</td>
   <td colspan="4"><input type="text" class="form-control " id="fin_address1" name="fin_address1"value="<?php echo $row['fin_bran_address'];?>"></td>
</tr>
<tr id="fin1">
   <td></td>
   <td colspan="2"><input type="text" class="form-control " id="fin_area" name="fin_area" value="<?php echo $row['fin_bran_area'];?>"></td>
   <td colspan="2"><input type="text" class="form-control" id="fin_town" name="fin_town" value="<?php echo $row['fin_bran_city'];?>"></td>
</tr>
<tr id="fin2">
   <td></td>
   <td colspan="2"><input type="text" class="form-control" id="fin_pincode" name="fin_pincode" value="<?php echo $row['fin_bran_pincode'];?>"></td>
   <td colspan="2"><input type="text" class="form-control" id="fin_district" name="fin_district" value="<?php echo $row['fin_bran_district'];?>"></td>
</tr>
<tr id="fin3" >
   <td></td>
   <td colspan="2"><input type="text" class="form-control" id="fin_state" name="fin_state" value="<?php echo $row['fin_bran_state'];?>"></td>
   <td colspan="2"><input type="text" class="form-control" id="fin_country" name="fin_country" value="<?php echo $row['fin_bran_country'];?>"></td>
</tr>


	
</tr>




<tr>
   <td>GST NO</td>
   <td colspan="2"><input type="text" class="form-control" id="txt_gst_no" name="txt_gst_no" value="<?php echo $row['gst_no'];?>"></td>
<td>Status</td>
<td colspan="2">

<select class="form-control" name="status" id="status">
<?php

if($sta==0)
{
	?>
<option value="0">InActive</option>
<option value="1">Active</option>
<?php	
}
else{
	?>
	<option value="1">Active</option>
	<option value="0">InActive</option>
	<?php
}
?>

</select>
</td>
</tr>
<tr>
   <td>Website </td>
   <td colspan="2"><input type="text" class="form-control" id="txt_website" name="txt_website" value="<?php echo $row['website'];?>"></td>
   <td colspan="2"> </td>
</tr>
</table>

<input type="button" class="btn btn-primary btn-md"  style="float:right;" name="Update" onclick="role_update()" value="Update"> 
</form>
</div>
</div>
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
	
	else
		
	{
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
 function role_update()
    {
    var id=$('#get_id').val();
	//alert(id);
    var data = $('form').serialize();
    $.ajax({
    type:'GET',
    data:"id="+id, data,
    url: 'HRMS/masters/client_master/client_master_update.php',
    success:function(data)
    {
      if(data==1)
      { 
        alert('Not updated');
      
      }
      else
      {
        alert("Update Successfully");
		client_master()
      }
      
    }       
    });
    }
</script>