<?php
require '../../connect.php';
?>
<div class="content-wrapper" id="main_content">
<div class="container-fluid">
  <div class="card mb-3">
    <div class="card-header">
      <i class="fa fa-table"></i> Recruitment Master
	  <input type="button" style="float:right;" class="btn btn-warning" name="print" onclick="printDiv('printableArea')"  value="Print">
	  </div>
    <div class="card-body" id="printableArea">
	 <form method="POST" action="Recruitment/Recruitment/new_submit.php" enctype="multipart/type">
		<table class="table table-bordered">
		<tr>
			<td><center><img src="../../Recruitment/image/userlog/bluebase.png" alt="quadsel" style="width:100px;height:50px;"></center></td>
			<td colspan="5"><center><b>Bluebase Software services Pvt Ltd</b></center></td>
		</tr>
		<tr>
			<td colspan="6"><center><b>Application for Employment</b></center></td>
		</tr>
		<tr>
			<td>Post Applied for:</td>
			<td colspan="5"><input type="text" class="form-control" id="position" name="position" ></td>
		</tr>
		<tr>
			<td colspan="6"><center><b>Personal Details</b></center></td>
		</tr>
		<tr>
			<td>Name of the candidate:</td>
			<td colspan="5"><input type="text" class="form-control" id="candidate_name" name="candidate_name" ></td>
		</tr>
		<tr>
			<td>Father's Name:</td>
			<td colspan="5"><input type="text" class="form-control" id="father_name" name="father_name" ></td>
		</tr>
		<tr>
			<td>Date of Birth:</td>
			<td colspan="5"><input type="date" class="form-control" id="dob" name="dob" ></td>
		</tr>
		<tr>
			<td>Address Communication:</td>
			<td colspan="5"><input type="text" class="form-control" id="address" name="address" ></td>
		</tr>
		<tr>
			<td>Permanent Address:</td>
			<td colspan="5"><input type="text" class="form-control" id="paddress" name="paddress" ></td>
		</tr>
		<tr>
			<td>Telephone no. (Mobile/others):</td>
			<td colspan="5"><input type="text" class="form-control" id="phone" name="phone" ></td>
		</tr>
		<tr>
			<td>Category (Email ID if any):</td>
			<td colspan="5"><input type="text" class="form-control" id="mail" name="mail"></td>
		</tr>
		<tr>
			<td>Aadhar Number:</td>
			<td colspan="4"><input type="text" class="form-control" id="adharnumber" name="adharnumber"></td>
			<td colspan="1"><input type="file" class="form-control" id="adharcard" name="adharcard"></td>
		</tr>
		<tr>
			<td>Pan Number:</td>
			<td colspan="4"><input type="text" class="form-control" id="pannumber" name="pannumber"></td>
			<td colspan="1"><input type="file" class="form-control" id="pancard" name="pancard"></td>
		</tr>
		<tr>
			<td>Voter ID:</td>
			<td colspan="4"><input type="text" class="form-control" id="voternumber" name="voternumber"></td>
			<td colspan="1"><input type="file" class="form-control" id="votercard" name="votercard"></td>
		</tr>
		<tr>
			<td>Resume:</td>
			<td colspan="5"><input type="file" class="form-control" id="resume" name="resume"></td>
		</tr>
		<tr>
			<td colspan="6"><center><b>Educational Qualifications (In descending order of qualifications attained)</b></center></td>
		</tr>
		</table>
		<table class="table table-bordered" id="new_tab">
		<tr>
		<th>Education</th>
		<th>Name of Institution/University</th>
		<th>Degree</th>
		<th>Field of Specialization</th>
		<th>Year of Passing</th>
		<th>Percentage</th>
		<th>Attachement</th>
		</tr>
		<tr>
		<td><input type="text" class="form-control" id="Examination_passed_1" name="examination_passed[]"></td>
		<td><input type="text" class="form-control" id="instute_1" name="instute[]"></td>
		<td><input type="text" class="form-control" id="degree_1" name="degree[]"></td>
		<td><input type="text" class="form-control" id="field_1" name="field[]"></td> 	
		<td><input type="text" class="form-control" id="passing_1" name="passing[]"></td>
		<td><input type="text" class="form-control" id="percentage_1" name="percentage[]"></td>
		<td><input type="file" class="form-control" id="attachment_1" name="attachment[]"></td>
		<td><input type="button" class="btn btn-success" id="new_row" name="new_row" onclick="check()" value="Add"></td>
		</tr>
		</table>
		<table  class="table table-bordered" id="new_tab1">
		<tr>
			<td colspan="10"><center><b>Certification Details</b></center></td>
		</tr>
		<tr>
			<td>Certification Name:</td>
			<td colspan="1"><input type="text" class="form-control" id="certifcatename_1" name="certifcatename[]"></td>
			<td>Certification Number:</td>
			<td colspan="1"><input type="text" class="form-control" id="certifcatnumber_1" name="certifcatenumber[]"></td>
			<td>Validity From:</td>
			<td colspan="1"><input type="date" class="form-control" id="validityfrom_1" name="validityfrom[]"></td>
			<td>Validity To:</td>
			<td colspan="1"><input type="date" class="form-control" id="validityto_1" name="validityto[]"></td>
			<td colspan="2"><input type="file" class="form-control" id="certifcatefile_1" name="certifcatefile[]"></td>
			<td><input type="button" class="btn btn-success" id="new_row" name="new_row" onclick="check1()" value="Add"></td>
		</tr>
		</table>
		
		<table class="table table-bordered" id="new_tab2">
		<tr>
			<td colspan="10"><center><b>Employment Details</b></center></td>
		</tr>
		<tr>
		<th>Name of the Organization</th>
		<th colspan="2">Designation (With Specific field Mentioned where Worked/working)</th>
		<th>From</th>
		<th>To</th>
		<th>Total Years of Experience</th>
		</tr>
		<tr>
		<td><input type="text" class="form-control" id="organization_1" name="organization[]"></td>
		<td colspan="2"><input type="text" class="form-control" id="Designation_1" name="designation[]"></td>
		<td><input type="date" class="form-control" id="From_1" name="from[]"></td>
		<td><input type="date" class="form-control" id="to_1" name="to[]"></td>
		<td><input type="text" class="form-control" id="yearofexperience_1" name="yearofexperience[]" readonly></td>
		<td><input type="button" class="btn btn-success" id="new_row" name="new_row" onclick="check2()" value="Add"></td>
		</tr>
		
		</table>
		<table class="table table-bordered">
		<tr>		
			<td> Overall Experience :</td>
			<td colspan="5"><input type="text" class="form-control" id="overallexp" name="overallexp"></td>
		</tr>
		</table>
		<table class="table table-bordered">
		<tr>		
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
		</tr>
		</table>
		<input type="submit" name="submit">
	</form>
    </div>
  </div>
</div>
</div> 
 <script>
  function check() // education
{
	var len=$('#new_tab tr').length;	
	len=len+1; 
	$('#new_tab').append('<tr class="row_'+len+'"><td><input type="text" class="form-control" id="Examination Passed_'+len+'" name="examination_passed[]"></td><td><input type="text" class="form-control" id="instute_'+len+'" name="instute[]"></td><td><input type="text" class="form-control" id="degree_'+len+'" name="degree[]"></td><td><input type="text" class="form-control" id="field_'+len+'" name="field[]"></td><td><input type="text" class="form-control" id="passing_'+len+'" name="passing[]"></td><td><input type="text" class="form-control" id="percentage_'+len+'" name="percentage[]"></td><td><input type="file" class="form-control" id="attachment_'+len+'" name="attachment[]"></td></tr>'); 
}
 function check1() // Certificate
{
	var len1=$('#new_tab1 tr').length;	
	len1=len1+1; 
	$('#new_tab1').append('<tr class="row_'+len1+'"><td>Certification Name:</td><td colspan="1"><input type="text" class="form-control" id="certifcatename_'+len1+'" name="certifcatename[]"></td><td>Certification Number:</td><td colspan="1"><input type="text" class="form-control" id="certifcatnumber_'+len1+'" name="certifcatenumber[]"></td><td>Validity From:</td><td colspan="1"><input type="date" class="form-control" id="validityfrom_'+len1+'" name="validityfrom[]"></td><td>Validity To:</td><td colspan="1"><input type="date" class="form-control" id="validityto_'+len1+'" name="validityto[]"></td><td colspan="1"><input type="file" class="form-control" id="certifcatefile_'+len1+'" name="certifcatefile[]"></td></tr>'); 
}
function check2() // Experience
{
	var len2=$('#new_tab2 tr').length;	
	len2=len2+1; 
	$('#new_tab2').append('<tr class="row_'+len2+'"><td><input type="text" class="form-control" id="organization_'+len2+'" name="organization[]"></td><td colspan="2"><input type="text" class="form-control" id="Designation_'+len2+'" name="Designation[]"></td><td><input type="date" class="form-control" id="From_'+len2+'" name="From[]"></td><td><input type="date" class="form-control" id="to_'+len2+'" name="to[]"></td><td colspan="1"><input type="text" class="form-control" id="yearofexperience_'+len2+'" name="yearofexperience[]" readonly></td></tr>'); 
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