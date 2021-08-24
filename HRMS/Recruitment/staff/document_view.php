
<?php
require '../../../connect.php';
require '../../../user.php';
$staffid=$_REQUEST['id'];
$sel=$con->query("select * from staff_master where id='$staffid'");
$sel_fet=$sel->fetch();
$candidateid=$sel_fet['candid_id'];
$sql1=$con->query("select * from candidate_form_details  where id='$candidateid'");
//echo "select * from candidate_form_details  where id='$candidateid'";
$data1=$sql1->fetch();
$sel_personal=$con->query( "select * from emp_personal_details where emp_id='$candidateid'");
$data=$sel_personal->fetch();
?>
<style>
#page-wrapper{
	margin-left: 117px !important;
}
</style>
 <div class="card card-info">
              <div class="card-header">
<div class="card-header p-2">
<ul class="nav nav-pills">
<li class="nav-item"><a class="nav-link active" href="#for_employment" data-toggle="tab">Application for Employment</a></li>
<li class="nav-item"><a class="nav-link" href="#education_qualification" data-toggle="tab">Educational Qualifications</a></li>
<li class="nav-item"><a class="nav-link" href="#certification_details" data-toggle="tab">Certification Details</a></li>
<li class="nav-item"><a class="nav-link" href="#employment_details" data-toggle="tab">Employment Details</a></li>
<li class="nav-item"><a class="nav-link" href="#" onclick="return theFunction('<?php echo $candidateid; ?>');" data-toggle="tab">Staff Salary</a></li>
<li class="nav-item"><a class="nav-link" href="#" onclick="return Leave_master('<?php echo $candidateid; ?>');" data-toggle="tab">Leaves</a></li>
<li class="nav-item"><input type="button" name="back" id="back" data-toggle="tab" class="btn btn-danger" value="Back" onclick="go_back()"></a></li>
</ul>

</div>
</div><!-- /.card-header -->

<div id="myid">
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
        <td colspan="6"><center><b>Application for Employment</b></center></td>
        </tr>
        <!--tr>
        <td>Post Applied for:</td>
        <td colspan="5"><input type="text" class="form-control" id="position" name="position" value="<?php echo $data['position'];?>" readonly ></td>
        </tr-->
        <tr>
        <td colspan="6"><center><b>Personal Details</b></center></td>
        </tr>
        <tr>
        <td>Name of the candidate:</td>
        <td colspan="5"><input type="text" class="form-control" id="candidate_name" name="candidate_name" value="<?php echo $data['name'];?>" readonly></td>
        </tr>
        <tr>
        <td>Father's Name:</td>
        <td colspan="5"><input type="text" class="form-control" id="father_name" name="father_name" value="<?php echo $data['fathers_name'];?>" readonly ></td>
        </tr>
        <tr>
        <td>Date of Birth:</td>
        <td colspan="5"><input type="date" class="form-control" id="dob" name="dob" value="<?php echo $data['DOB'];?>" readonly></td>
        </tr>
        <tr>
        <td>Address Communication:</td>
        <td colspan="5"><input type="text" class="form-control" id="address" name="address" value="<?php echo $data['communication_address'];?>" readonly ></td>
        </tr>
        <tr>
        <td>Permanent Address:</td>
        <td colspan="5"><input type="text" class="form-control" id="paddress" name="paddress" value="<?php echo $data['permanent_address'];?>" readonly></td>
        </tr>
        <tr>
        <td>Telephone no. (Mobile/others):</td>
        <td colspan="5"><input type="text" class="form-control" id="phone" name="phone" value="<?php echo $data['mobile_num'];?>" readonly></td>
        </tr>
         <tr>
        <td>Emergency contact no. (Mobile/others):</td>
        <td colspan="5"><input type="text" class="form-control" id="emergency_num" name="emergency_num" value="<?php echo $data['emergency_num'];?>" readonly></td>
        </tr>
        <tr>
        <td>Emergency Contact Person:</td>
        <td colspan="5"><input type="text" class="form-control" id="emergency_person" name="emergency_person" value="<?php echo $data['contact_person'];?>" readonly></td>
        </tr>
        <tr>
        <td>Contact Person Relationship:</td>
        <td colspan="5"><input type="text" class="form-control" id="relation" name="relation" value="<?php echo $data['emergency_contact_relationship'];?>" readonly></td>
        </tr>
        <tr>
        <td>Category (Email ID if any):</td>
        <td colspan="5"><input type="text" class="form-control" id="email_id" name="email_id" value="<?php echo $data['email_id'];?>" readonly></td>
        </tr>
       <tr>
        <td>Account number:</td>
        <td colspan="5"><input type="text" class="form-control" id="acc_number" name="acc_number" value="<?php echo $data['acc_number'];?>" readonly></td>
        </tr>
        <tr>
        <td>IFSC code:</td>
        <td colspan="5"><input type="text" class="form-control" id="ifsc" name="ifsc" value="<?php echo $data['ifsc'];?>" readonly></td>
        </tr>
        <tr>
        <td>Account holder name:</td>
        <td colspan="5"><input type="text" class="form-control" id="acc_name" name="acc_name" value="<?php echo $data['acc_holder_name'];?>" readonly></td>
        </tr>
       
        <tr>
        <td>Aadhar Number:</td>
        <td colspan="4"><input type="text" class="form-control" id="adharnumber" name="adharnumber" value="<?php echo $data['adharcard_number'];?>" readonly></td>
        <td colspan="1"><a href="hrms/recruitment/uploads/<?php echo $data['aadhar_num']; ?>" download="<?php echo $data['aadhar_num']; ?>"><?php echo $data['aadhar_num']; ?></a></td>
        </tr>
        <tr>
        <td>Pan Number:</td>
        <td colspan="4"><input type="text" class="form-control" id="pannumber" name="pannumber" value="<?php echo $data['pan_number'];?>"readonly></td>
        <td colspan="1"><a href="hrms/recruitment/uploads/<?php echo $data['pan_num']; ?>" download="<?php echo $data['pan_num']; ?>"><?php echo $data['pan_num']; ?></td>
        </tr>
        <tr>
        <td>Voter ID:</td>
        <td colspan="4"><input type="text" class="form-control" id="voternumber" name="voternumber" value="<?php echo $data['Voter_no'];?>" readonly></td>
        <td colspan="1"><a href="hrms/recruitment/uploads/<?php echo $data['voter_id']; ?>" download="<?php echo $data['voter_id']; ?>"><?php echo $data['voter_id']; ?></td>
        </tr>
        <tr>
        <td>Resume:</td>
        <td colspan="5"><a href="hrms/recruitment/uploads/<?php echo $data['resume']; ?>" download="<?php echo $data['resume']; ?>"><?php echo $data['resume']; ?></td>
        </tr>
        <!--tr>  
        <td colspan="6">
		<input type="hidden" name="cid" id="cid" value="<?php echo $candidateid;?>">
		<input type="button" class="btn btn-success" name="save" onclick="employee_personal()" value="save"></td>
        </tr-->
        </table>
        <!-- /.post -->
    </form>
    </div>

<?php 
$sel=$con->query("select * from emp_qualification where emp_id='$candidateid'");

?>
    <div class="tab-pane" id="education_qualification">
    <table class="table table-bordered" id="new_tab">
    <tr>
    <td colspan="6"><center><b>Educational Qualifications (In descending order of qualifications attained)</b></center></td>
    </tr>
    <tr>
      <th>#</th>
      <th>Education</th>
      <th>Name of Institution/University</th>
      <th>Degree</th>
      <th>Field of Specialization</th>
      <th>Year of Passing</th>
      <th>Percentage</th>
      <th>Attachement</th>
    </tr>
    <?php 	
		$i=1;
	while($row=$sel->fetch())
	{
	?>
    
    <tr>
      <td><?php echo $i;?><!--input type="checkbox" class="chk" name="chk[]" id="chk_1" value="1" style="width:15px;height:20px;"/--></td>
      <td><input type="text" class="form-control" id="Examination_passed_1" name="examination_passed[]" value="<?php echo $row['education']; ?>" readonly></td>
      <td><input type="text" class="form-control" id="instute_1" name="instute[]" value="<?php echo $row['institution_name']; ?>"readonly></td>
      <td><input type="text" class="form-control" id="degree_1" name="degree[]" value="<?php echo $row['degree']; ?>"readonly></td>
      <td><input type="text" class="form-control" id="field_1" name="field[]" value="<?php echo $row['field_of_specialization']; ?>"readonly></td> 	
      <td><input type="text" class="form-control" id="passing_1" name="passing[]" value="<?php echo $row['year_of_passing']; ?>"readonly></td>
      <td><input type="text" class="form-control" id="percentage_1" name="percentage[]" value="<?php echo $row['percentage']; ?>"readonly></td>
      <td><a href="hrms/recruitment/uploads/<?php echo $row['attachment']; ?>" download="<?php echo $row['attachment']; ?>"><?php echo $row['attachment']; ?></a></td>
      <!--td><input type="button" class="btn btn-success" id="new_row" name="new_row" onclick="check()" value="Add">
      <input type="button" class="btn btn-danger" id="certificate_row_remove" onclick="certificate_row_remove()" value="Remove">
    </td-->
    </tr>
   <?php
   $i++;
	}
	?>
    
    </table>
    <!--table>
    <tr><td>
	<input type="hidden" name="cid" id="cid" value="<?php echo $candidateid;?>">
	<input type="submit" name="edu_save" value="save" class="btn btn-success" ></td></tr>
    </table-->
   
    <!-- /.tab-pane -->
    </div>
    
	<?php 
	$cer=$con->query("select * from emp_certification where emp_id='$candidateid'");
	?>
   <div class="tab-pane" id="certification_details">
    <table class="table table-bordered" id="new_tab1">
    <tr>
    <td colspan="6"><center><b>Certification Details</b></center></td>
    </tr>
    <tr>
      <th>#</th>
      <th>Certification Name:</th>
      <th>Certification Number:</th>
      <th>Validity From:</th>
      <th>Validity To:</th>
	  <th>Attachement</th>
    </tr>
	<?php 	
		$i=1;
    while($dis=$cer->fetch())
	{
		$vfrom=$dis['validity_from'];
		$vto=$dis['validity_to'];
		?>
    <tr>
      <td><?php echo $i;?><!--input type="checkbox" class="chk" name="chk[]" id="chk_1" value="1" style="width:15px;height:20px;"/--></td>
     <td><input type="text" class="form-control" id="certifcatename_1" name="certifcatename[]" value="<?php echo $dis['certification_name']; ?>" readonly></td>
      <td><input type="text" class="form-control" id="certifcatnumber_1" name="certifcatenumber[]" value="<?php echo $dis['certification_number']; ?>"readonly></td>
      <td><input type="text" class="form-control" id="validityfrom_1" name="validityfrom[]" value="<?php echo date('d-m-Y',strtotime($vfrom)); ?>"readonly></td>
      <td><input type="text" class="form-control" id="validityto_1" name="validityto[]" value="<?php echo date('d-m-Y',strtotime($vto)); ?>"readonly></td>
      <td><a href="hrms/recruitment/certificates/<?php echo $dis['attachment']; ?>"><?php echo $dis['attachment']; ?></a></td>
      <!--td><input type="button" class="btn btn-success" id="new_row1" name="new_row1" onclick="check1()" value="Add">
      <input type="button" class="btn btn-danger" id="certificate_row1_remove" onclick="certificate_row1_remove()" value="Remove">
    </td-->
    </tr>  
<?php
$i++;
	}
?>	
     </table>
    <!--table>
    <tr><td><input type="button" name="save" value="save" onclick="emp_certificate_save()"></td></tr>
    </table-->
    
    <!-- /.tab-pane -->
    </div>
    <!-- /.tab-pane -->
	<?php
	$detail=$con->query("select * from emp_exp_detail where emp_id='$candidateid'");
	//echo "select * from emp_exp_details where emp_id='$candidateid'";
	?>
	
    <div class="tab-pane" id="employment_details">
    <table class="table table-bordered" id="new_tab2">
    <tr>
    <td colspan="10"><center><b>Employment Details</b></center></td>
    </tr>
    <tr>
	<th>#</th>
    <th>Name of the Organization</th>
    <th colspan="2">Designation (With Specific field Mentioned where Worked/working)</th>
    <th>From</th>
    <th>To</th>
    <th>Total Years of Experience</th>
    </tr>
	<?php 
	
		$totalexp=0;
		$i=1;
	while($edetail=$detail->fetch())
	{
		$fdate=$edetail['from_date'];
		$tdate=$edetail['to_date'];
		$texp=$edetail['total_experience'];
	?>
    <tr>
	<td><?php echo $i;?><!--input type="checkbox" class="chk" name="chk[]" id="chk_1" value="1" style="width:15px;height:20px;"/--></td>
    <td><input type="text" class="form-control" id="organization_1" name="organization[]" value="<?php echo $edetail['organization_name']; ?>"readonly></td>
    <td colspan="2"><input type="text" class="form-control" id="Designation_1" name="designation[]" value="<?php echo $edetail['designation']; ?>"readonly></td>
    <td><input type="text" class="form-control" id="From_1" name="from[]" value="<?php echo date('d-m-Y',strtotime($fdate)); ?>"readonly></td>
    <td><input type="text" class="form-control" id="to_1" name="to[]" value="<?php echo date('d-m-Y',strtotime($tdate)); ?>"readonly></td>
    <td><input type="text" class="form-control" id="yearofexperience_1" name="yearofexperience[]" value="<?php echo $edetail['total_experience']; ?>"readonly></td>
    <!--td><input type="button" class="btn btn-success" id="new_row" name="new_row" onclick="check2()" value="Add">
	   <input type="button" class="btn btn-danger" id="certificate_row2_remove" onclick="certificate_row2_remove()" value="Remove"></td-->
    </tr>
<?php
$i++;
$totalexp=$totalexp+$texp;
	}
	?>
    </table>
    <table class="table table-bordered">
    <tr>		
    <td> Overall Experience :</td>
    <td colspan="5"><input type="text" class="form-control" id="overallexp" name="overallexp" value="<?php echo $totalexp;?>"readonly></td>
    </tr>
    </table>
	<?php 
	$detail1=$con->query("select * from candidate_reference_details where emp_id='$candidateid'");
	$emplmnt_data=$detail1->fetch();
	?>
	<table class="table table-bordered">
	 <th></th>
	 <th>Reference 1</th>
	 <th>Reference 2</th>
    <tr>		
    <td> Reference Name </td>
    <td ><input type="text" class="form-control" id="reference1" name="reference1"  value="<?php echo $emplmnt_data['reference1']; ?>"readonly></td>
    <td ><input type="text" class="form-control" id="reference2" name="reference2" value="<?php echo $emplmnt_data['reference2']; ?>"readonly></td>
    </tr>
    <tr>		
    <td>Organization Name:</td>
    <td ><input type="text" class="form-control" id="ref_organization1" name="ref_organization1" value="<?php echo $emplmnt_data['ref_organization1']; ?>"readonly></td>
    <td ><input type="text" class="form-control" id="ref_organization2" name="ref_organization2" value="<?php echo $emplmnt_data['ref_organization2']; ?>"readonly></td>
    </tr>
     <tr>		
    <td>Contact Number:</td>
    <td ><input type="text" class="form-control" id="con_number1" name="con_number1"readonly value="<?php echo $emplmnt_data['con_number1']; ?>"></td>
    <td ><input type="text" class="form-control" id="con_number2" name="con_number2"readonly value="<?php echo $emplmnt_data['con_number2']; ?>"></td>
    </tr>
     <tr>		
    <td>Designation:</td>
    <td ><input type="text" class="form-control" id="ref_designation1" name="ref_designation1" value="<?php echo $emplmnt_data['ref_designation1']; ?>"readonly></td>
    <td ><input type="text" class="form-control" id="ref_designation2" name="ref_designation2" value="<?php echo $emplmnt_data['ref_designation2']; ?>"readonly></td>
    </tr>
    <tr>		
    <td>Mailid:</td>
    <td><input type="text" class="form-control" id="ref_mail1" name="ref_mail1" value="<?php echo $emplmnt_data['ref_mail1']; ?>"readonly></td>
    <td><input type="text" class="form-control" id="ref_mail2" name="ref_mail2" value="<?php echo $emplmnt_data['ref_mail2']; ?>"readonly></td>
    </tr>
    
    </table>
	
    <table class="table table-bordered">
    <!--tr>		
    <td> Reference Name & Number :</td>
    <td colspan="5"><input type="text" class="form-control" id="reference" name="reference"></td>
    </tr>
    <tr>		
    <td>Signature:</td>
    <td colspan="5"><input type="text" class="form-control" id="signature" name="signature"></td>
    </tr>
    <tr>		
    <td>Date:</td>
    <td colspan="5"><input type="date" class="form-control" id="interview_date" name="interview_date"></td>
    </tr-->
    </table>
    <!--input type="submit" name="submit"-->
    </div>
    <!-- /.tab-pane -->
    </div>
    <!-- /.tab-content -->
    </div><!-- /.card-body -->
	
	</div>
    </div>
    <!-- /.nav-tabs-custom -->
    </>
    <!-- /.col -->
    </div>
    <!-- /.row -->
    </div><!-- /.container-fluid -->
    </section>
<script type="text/javascript">
    function theFunction(v){
		
		$.ajax({
		type:"GET",
		url:"HRMS/Recruitment/staff/staff_salary/staff_salary_main.php?canid=" +v,
		success:function(data)
		{
			$('#myid').html(data);
		}
		});
    }
</script>

<script>
function go_back()
{
	//alert("back");
	staff_list();
}
</script>

    
<script> 
function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}
</script> 