<?php
require '../../../connect.php';
$resourceid=$_REQUEST['id'];
$sql=$con->query("SELECT * FROM resource_form_detail s left join designation_master d on s.position=d.id join source_master sm on s.source=sm.id where s.id='$resourceid' and s.status='1'");
/* echo "SELECT * FROM resource_form_detail s left join designation_master d on s.position=d.id join source_master sm on s.source=sm.id where s.id='$resourceid'"; */
$fet=$sql->fetch();
?>
  <div class="card card-info">
              <div class="card-header">
                
				              <center><h3 class="card-title"><b>Interview Schedule</b></h3></center>
		<a onclick="return back()" style="float: right;" data-toggle="modal" class="btn btn-danger"></i>Back</a>
              </div>
   <form method="POST" enctype="multipart/form-data">
    <!-- Post -->
    <table class="table table-bordered">
         <tr>
        <td><center><img src="/HRMS/HRMS/Recruitment/image/userlog/bluebase.png"  style="width:300px;height:150px;"></center></td>
        <td colspan="5"><center><h1><b>Bluebase Software services Pvt Ltd</b></h1></center></td>
        </tr>
        <tr>
			<td colspan="6"><center><b>Resource Form</b></center></td>
        </tr>
	   <tr>
		    <td >Source: *</td>
			<td colspan="5">
			<input type="text" class="form-control" name="source" id="source" value="<?php echo $fet['name']; ?>" readonly>
			</td>
      </tr>
		<tr id="cname">
			<td>Consultant Name:</td>
			<td colspan="5"><input type="text" class="form-control" name="consl_name" id="consl_name" value="<?php echo $fet['consultant_name']; ?>" readonly>
			</td>
		</tr>
		<tr>
			<td>Date:</td>
			<td colspan="5"><input type="date" class="form-control" name="consl_date" id="consl_date" value="<?php echo $fet['date']; ?>"readonly >
			</td>
		</tr>
		
        <tr>
			<td>Post Applied for: *</td>
			<td colspan="5">
				<input type="text" class="form-control" name="position" id="position" value="<?php echo $fet['designation_name']; ?>"readonly >
			<!--input type="text" class="form-control" id="position" name="position" required -->
			</td>
				<!--td>Department: *</td>
				<td colspan="2">
					<select class="form-control" id="tech_department" name="tech_department" required >
					<option value="">Choose Department</option>
					<!?php $stmt = $con->query("SELECT * FROM z_department_master where status=1");
					while ($row = $stmt->fetch()) {?>
					<option value="<!?php echo $row['id']; ?>"> <!?php echo $row['dept_name']; ?> </option>
					<!?php } ?>
					</select>
				</td-->
        </tr>
        <tr>
			<td colspan="6"><center><b>Personal Details</b></center></td>
        </tr>
        <tr>
			<td>First Name: *</td>
			<td colspan="2"><input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo $fet['first_name']; ?>"readonly></td>
			<td>Last Name: *</td>
			<td colspan="2"><input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo $fet['last_name']; ?>"readonly></td>
        </tr>
    <tr>
			<td>Gender:</td>
			<td colspan="5">
<?php 
if($fet['gender']=="male")
{
?>
	
			<label>
		<input type="radio" name="gender" value="male" checked>&nbsp;Male</label>
	  	
<?php
}
else
{
?>	
	  <label>
		<input type="radio" name="gender" value="female" checked>&nbsp;Female</label>
<?php
}
?>
		</td>
	</tr>
        <!--tr>
        <td>Father's Name:</td>
        <td colspan="5"><input type="text" class="form-control" id="father_name" name="father_name" ></td>
        </tr>
        <tr>
        <td>Date of Birth:</td>
        <td colspan="5"><input type="date" class="form-control" id="dob" name="dob" ></td>
        </tr>
        <tr-->
        <!--td>Address Communication: *</td>
        <td colspan="5"><input type="text" class="form-control" id="address" name="address" required></td>
        </tr>
        <tr>
        <td>Permanent Address:</td>
        <td colspan="5"><input type="text" class="form-control" id="paddress" name="paddress" ></td>
        </tr-->
        <tr>
        <td>Mobile Number: *</td>
        <td colspan="5"><input type="text" class="form-control" id="phone" name="phone" value="<?php echo $fet['mobile']; ?>"readonly></td>
        </tr>
        <tr>
        <td>WhatsApp Number: </td>
        <td colspan="5"><input type="text" class="form-control" id="whatsapp" name="whatsapp" value="<?php echo $fet['whatsapp']; ?>"readonly></td>
        </tr>
        <tr>
        <td>Email ID : *</td>
        <td colspan="5"><input type="text" class="form-control" id="mail" name="mail" value="<?php echo $fet['mail']; ?>"readonly></td>
        </tr>
        <tr>
        <td>Aadhar Number: *</td>
        <td colspan="4">
		<input type="text" class="form-control" id="adharnumber" name="adharnumber" value="<?php echo $fet['aadhar_no']; ?>"readonly>
		</td>
        </tr>
        <!--tr>
        <td>Pan Number:</td>
        <td colspan="4"><input type="text" class="form-control" id="pannumber" name="pannumber" onchange="panvalid(this.value)"></td>
        </tr>
        <tr>
        <td>Voter ID:</td>
        <td colspan="4"><input type="text" class="form-control" id="voternumber" name="voternumber"></td>
        </tr-->
		<tr>
		<td colspan="6"><center><b>Educational Qualification</center></b></td>
		</tr>
		<tr>
        <td>Degree: *</td>
        <td colspan="4"><input type="text" class="form-control" id="degree" name="degree" value="<?php echo $fet['degree']; ?>"readonly>
		</td>
        </tr>
       <tr>
        <td>University: *</td>
        <td colspan="4"><input type="text" class="form-control" id="university" name="university" value="<?php echo $fet['university']; ?>"readonly>
		</td>
        </tr>
        
		<tr id='employee_new'>
		<td>Year of Passout </td>
        <td colspan="4"><input type="text" class="form-control" id="year_of_pass" name="year_of_pass" value="<?php echo $fet['year_of_pass']; ?>"readonly></td>
        </tr>
		<tr id='employee_new1'>
		<td>Percentage</td>
        <td colspan="4"><input type="text" class="form-control" id="percentage" name="percentage" value="<?php echo $fet['percentage']; ?>"readonly></td>
        </tr>
		<tr>
        <td>Employement Status:</td>
        <td colspan="4">	
		<input type="text" class="form-control" id="emp_status" name="emp_status" value="<?php echo $fet['employement_status']; ?>"readonly>
		</td>
        </tr>	
<?php 
if($fet['employement_status']=="Experience")
{
	?>
	<tr id='employee_status'>
        <td>Company Name:</td>
        <td colspan="2"><input type="text" class="form-control" id="companyname" name="companyname" value="<?php echo $fet['company_name']; ?>"readonly></td>
		<td>No of Year Experience:</td>
        <td colspan="2"><input type="number" class="form-control" id="no_of_year" name="no_of_year" value="<?php echo $fet['year_experience']; ?>"readonly></td>
        </tr>
		<tr id='employee_status1'>
        <td>Total Experience:</td>
        <td colspan="2"><input type="text" class="form-control" id="total_exp" name="total_exp" value="<?php echo $fet['total_experience']; ?>"readonly></td>
		<td>Relevant Experience:</td>
        <td colspan="2"><input type="number" class="form-control" id="rel_exp" name="rel_exp" value="<?php echo $fet['relevant_experience']; ?>"readonly></td>
        </tr>
	<?php
}
else
{
	?>
	
<?php
}
?>		
		<tr>
		<td>Expected CTC: </td>
        <td colspan="4"><input type="text" class="form-control" id="exp_ctc" name="exp_ctc" value="<?php echo $fet['exp_ctc']; ?>"readonly></td>
        </tr>
		<tr>
		<td>Current CTC: </td>
        <td colspan="4"><input type="text" class="form-control" id="current_ctc" name="current_ctc" value="<?php echo $fet['current_ctc']; ?>"readonly></td>
        </tr>
		<tr>
		<td colspan="6"><center><b>Certification Details</center></b></td>
		</tr>
		<tr>
        <td>Certification:</td>
        <td colspan="4">	
		<input type="number" class="form-control" id="cer_status" name="cer_status" value="<?php echo $fet['certification_status']; ?>"readonly>
		</td>
        </tr>		
		<?php 
		if($fet['certification_status']=="yes")
		{
			?>
			<tr id='certificate_status'>
        <td>Certificate:</td>
        <td colspan="2"><input type="text" class="form-control" id="certificate" name="certificate" value="<?php echo $fet['certification']; ?>"readonly></td>
		</tr >
		<tr id='validity'>
		<td>Validity:</td>
        <td colspan="2"><input type="text" class="form-control" id="validity" name="validity" value="<?php echo $fet['validity']; ?>"readonly></td>
		<td>Certified From:</td>
        <td colspan="2"><input type="text" class="form-control" id="cer_from" name="cer_from" value="<?php echo $fet['certified_from']; ?>"readonly></td>		
        </tr>
		<?php
		}
		else
		{
			
		}
		?>
			<tr>
		<td colspan="6"><center><b>Interview Schedule</center></b></td>
		</tr>
		<tr id="do">
		<td>Feed back:</td>
        <td colspan="5">
		<select  class="form-control" id="feedback" name="feedback" onchange="get_date(this.value)">
		<option value="">Select feedback</option>
		<?php
		$sel=$con->query("select * from feedback_master where status=1");
		while($dis=$sel->fetch())
		{
		?>	
		<option value="<?php echo $dis['id'];?>"><?php echo $dis['name'];?></option>
		<?php	
		}
		?>
		</select>
		</td>		
		</tr>
		 <tr id='int_date'>
        <td>Interview Date:</td>
        <td colspan="5"><input type="datetime-local" class="form-control" id="interview_date" name="interview_date"></td>
		</tr>
		<tr>
		<td>Remarks :*</td>
		<td colspan="5"><input type="text" class="form-control" id="remarks" name="remarks"required></td>
		</tr>		
        <tr>  
		<td><input type="hidden" name="rid" id="rid" value="<?php echo $resourceid;?>"></td>
        <td colspan="6"><input type="button" class="btn btn-success" name="save" onclick="schedule_insert()" style="float:right;" value="Update"></td>
        </tr>
        </table>
        <!-- /.post -->
    </form>
    </div>


<script>
 $(document).ready (function()
 {
	document.getElementById('int_date').style.visibility="hidden";
});

/* $(document).ready (function(){
	document.getElementById('int_date').style.visibility = "hidden";

}); */

function get_date(v)
{
	var feed=$('#feedback').val();
	if(feed==2)
	{
		document.getElementById('int_date').style.visibility="visible";
	}
	else if(feed==1 || feed==3)
	{
		document.getElementById('int_date').style.visibility = "hidden";
	}
}

function schedule_insert()
{
	
	var data=$('form').serialize();
	$.ajax({
		
		type:"GET",
		data: data,
		url:"/HRMS/HRMS/resource/resource_form/schedule_insert.php",
		success:function(data)
		{
			alert("scheduled scccessfully");
			resource_list();
		}
	})
}
function back()
	{
		resource_list();
	}
</script>
