<?php
require '../../connect.php';
$eid=$_REQUEST['id'];
$sql=$con->query("SELECT *,e.id as eid FROM `emp_assessment_login_detail` e join company_master c on e.company_name=c.id join z_department_master d on e.department=d.id where e.id='$eid'");

$dis = $sql->fetch(PDO::FETCH_ASSOC)
?>
   <form method="POST" enctype="multipart/form-data">
    <!-- Post -->
    <table class="table table-bordered">
        <tr>
        <td><center><img src="../../HRMS/image/userlog/bluebase.png" alt="quadsel" style="width:100px;height:50px;"></center></td>
        <td colspan="5"><center><b>Bluebase Software services Pvt Ltd</b></center></td>
        </tr>
        <tr>
        <td colspan="6"><center><b>Application for Candidate</b></center></td>
        </tr>
		 <tr>
		<td>Company:</td>
		<td colspan="5">
		<select class="form-control" id="companys" name="companys" >
		<?php 
		$cid=$dis['company_name'];
		$cmp=$con->query("SELECT * FROM company_master where id='$cid'");
		$cmp1 = $cmp->fetch(PDO::FETCH_ASSOC)
		?>
		<option value="<?php echo $cid;?>"><?php echo $cmp1['companyname'];?></option>
		<?php $stmt = $con->query("SELECT * FROM company_master where status=1 and id !='$cid'");
		while ($row = $stmt->fetch()) {?>
		<option value="<?php echo $row['id']; ?>"> <?php echo $row['companyname']; ?> </option>
		<?php } ?>
		</select></td>
        </tr>
        <tr>
               
		<td>Department:</td>
		<td colspan="2">
		<select class="form-control" id="tech_department" name="tech_department" >
		<?php 
		$did=$dis['department'];
		$dep=$con->query("SELECT * FROM z_department_master where id='$did'");
		$dep1 = $dep->fetch(PDO::FETCH_ASSOC)
		?>
		<option value="<?php echo $did;?>"><?php echo $dep1['dept_name'];?></option>
		<?php $stmt1 = $con->query("SELECT * FROM z_department_master where status=1 and id !='$did'");
		while ($row1 = $stmt1->fetch()) {?>
		<option value="<?php echo $row1['id']; ?>"> <?php echo $row1['dept_name']; ?> </option>
		<?php } ?>
		</select></td>
		<td colspan="2"></td>
        </tr>
        <tr>
        <td colspan="6"><center><b>Personal Details</b></center></td>
        </tr>
        <tr>
        <td>First Name:</td>
        <td colspan="2"><input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo $dis['first_name'];?>" required></td>
		<td>Last Name:</td>
        <td colspan="2"><input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo $dis['last_name'];?>"required></td>
        </tr>
        <tr>
		<td>Gender:</td>
		<?php 
		$gen=$dis['gender'];
		if($gen="male")
		{
			?>
			<td colspan="5">

		<label>
    <input type="radio" name="gender" value="male" checked>&nbsp;Male</label>
  <label>
    <input type="radio" name="gender" value="female">&nbsp;Female</label>
	</td>
			
		<?php
		}
		else{
			?>
			<td colspan="5">

		<label>
    <input type="radio" name="gender" value="male" >&nbsp;Male</label>
  <label>
    <input type="radio" name="gender" value="female" checked>&nbsp;Female</label>
	</td>
			
		<?php
		}
		?>
		
	</tr>
        <tr>
        <td>Father's Name:</td>
        <td colspan="5"><input type="text" class="form-control" id="father_name" name="father_name" value="<?php echo $dis['father_name'];?>" required></td>
        </tr>
        <tr>
        <td>Date of Birth:</td>
        <td colspan="5"><input type="date" class="form-control" id="dob" name="dob" value="<?php echo $dis['dob'];?>" required></td>
        </tr>
        <tr>
        <td>Address Communication:</td>
        <td colspan="5"><input type="text" class="form-control" id="address" name="address" value="<?php echo $dis['address'];?>" required></td>
        </tr>
        <tr>
        <td>Permanent Address:</td>
        <td colspan="5"><input type="text" class="form-control" id="paddress" name="paddress" value="<?php echo $dis['paddress'];?>"></td>
        </tr>
        <tr>
        <td>Telephone no. (Mobile/others):</td>
        <td colspan="5"><input type="text" class="form-control" id="phone" name="phone" value="<?php echo $dis['phone'];?>" required></td>
        </tr>
		<tr>
               
		<td>Question Type</td>
		<td >
		<select class="form-control" id="qn_type" name="qn_type" >
		<?php 
		$qn=$dis['qn_name_id'];
		$qns=$con->query("SELECT * FROM question_name_master where id='$qn'");
		$qndis = $qns->fetch(PDO::FETCH_ASSOC)
		?>
		<option value="<?php echo $qndis['id']; ?>"><?php echo $qndis['name']; ?></option>
		<?php $stmt2 = $con->query("SELECT * FROM question_name_master where status=1");
		while ($row2 = $stmt2->fetch()) {?>
		<option value="<?php echo $row2['id']; ?>"> <?php echo $row2['name']; ?> </option>
		<?php } ?>
		</select></td>
		<td colspan="2"></td>
        </tr>
		
		
        <!--tr>
        <td>Category (Email ID if any):</td>
        <td colspan="5"><input type="text" class="form-control" id="mail" name="mail"></td>
        </tr>
        <tr>
        <td>Aadhar Number:</td>
        <td colspan="4"><input type="text" class="form-control" id="adharnumber" name="adharnumber"></td>
        </tr>
        <tr>
        <td>Pan Number:</td>
        <td colspan="4"><input type="text" class="form-control" id="pannumber" name="pannumber"></td>
        </tr>
        <tr>
        <td>Voter ID:</td>
        <td colspan="4"><input type="text" class="form-control" id="voternumber" name="voternumber"></td>
        </tr>
		<tr>
        <td>Educational Details:</td>
        <td colspan="4"><input type="text" class="form-control" id="educationalDetails" name="educationalDetails"></td>
        </tr>
        <tr>
        <td>Employement Status:</td>
        <td colspan="4">	
		<select class="form-control" id="EmployeeStatus" name="EmployeeStatus" onchange="employeestatus(this.value)" required>
		<option value="">Choose Employeement Status</option>
		<option value="new">Fresher</option>
		<option value="experience">Experience</option>
		</td>
        </tr>
		<tr id='employee_new'>
		<td>Year of Passedout </td>
        <td colspan="4"><input type="text" class="form-control" id="year_of_pass" name="year_of_pass"></td>
        </tr>
		<tr id='employee_status'>
        <td>Company Name:</td>
        <td colspan="2"><input type="text" class="form-control" id="companyname" name="companyname"></td>
		<td>No of Year Experience:</td>
        <td colspan="2"><input type="number" class="form-control" id="no_of_year" name="no_of_year"></td>
        </tr-->
        <tr>  
        <td colspan="6">
		<input type="hidden" name="empid" id="empid" value="<?php echo $eid;?>">
		<input type="button" class="btn btn-success" name="save"  onclick="candidate_update()" style="float:right;" value="Update"></td>
        </tr>
        </table>
        <!-- /.post -->
    </form>

<script>
function employeestatus(value)
{
if(value=='new')
{
document.getElementById('employee_status').style.visibility = "hidden";
document.getElementById('employee_new').style.visibility = "visible";
}
else
{
document.getElementById('employee_status').style.visibility = "visible";
document.getElementById('employee_new').style.visibility = "hidden";
}
}

function candidate_update()
{	
	var field=1;
	var data = $('form').serialize();
	$.ajax({
		type:'GET',
		data:"field="+field, data,
		url:'/HRMS/HRMS/assessment_candidate/candidate_update.php',
		success:function(data)
		{
			if(data==0)
			{
				alert("Form Data has been Submitted.");
				//alert("Form Data has been Submitted ... Hr will conduct you please wait");
				//window.location.href="login/logout.php";
				assessment_employee();
			}
			else
			{
				alert("Form Data has not been Submitted");
				assessment_employee();
				
			}	
		}       
	});
}

</script>