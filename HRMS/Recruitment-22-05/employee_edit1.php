<?php
require '../../connect.php';
echo $id=$_REQUEST['id'];

$stmt = $con->prepare("SELECT position,candidate_name, father_name, dob, address, paddress, phone, mail, adharnumber, adharcard, pannumber, pancard, voternumber, votercard, resume, created_by, created_on, modified_by, modified_on FROM ctc_approval_table WHERE id='$id'"); 
$stmt->execute(); 
$row = $stmt->fetch();

?>
<section class="content">
<div class="container-fluid">
<div class="row">
<div class="col-md-12">
<div class="card">
<div class="card-header p-2">
<ul class="nav nav-pills">
<li class="nav-item"><a class="nav-link active" href="#for_employment" data-toggle="tab">Application for Employment</a></li>
<li class="nav-item"><a class="nav-link" href="#education_qualification" data-toggle="tab">Educational Qualifications</a></li>
<li class="nav-item"><a class="nav-link" href="#certification_details" data-toggle="tab">Certification Details</a></li>
<li class="nav-item"><a class="nav-link" href="#employment_details" data-toggle="tab">Employment Details</a></li>
</ul>
</div><!-- /.card-header -->
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
        <td colspan="6"><input type="button" class="btn btn-success" name="save" onclick="employee_personal()" value="save"></td>
        </tr>
        </table>
        <!-- /.post -->
    </form>
    </div>

    <script>
    function employee_personal()
    {
    var id=0;
    var data = $('form').serialize();
    $.ajax({
    type:'GET',
    data:"id="+id, data,
    url:'/Recruitment/Recruitment/Recruitment/employee_personal_insert.php',
    success:function(data)
    {
      if(data==1)
      { 
        alert('Entry Successfully');
        add_employee()
      }
      else
      {
        alert("No Data choose");
      }
      
    }       
    });
    }
    </script>

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
    
    <form method="POST" id="emp_education" enctype="multipart/form-data">
    <tr>
      <td><input type="checkbox" class="chk" name="chk[]" id="chk_1" value="1" style="width:15px;height:20px;"/></td>
      <td><input type="text" class="form-control" id="Examination_passed_1" name="examination_passed[]"></td>
      <td><input type="text" class="form-control" id="instute_1" name="instute[]"></td>
      <td><input type="text" class="form-control" id="degree_1" name="degree[]"></td>
      <td><input type="text" class="form-control" id="field_1" name="field[]"></td> 	
      <td><input type="text" class="form-control" id="passing_1" name="passing[]"></td>
      <td><input type="text" class="form-control" id="percentage_1" name="percentage[]"></td>
      <td><input type="file" class="form-control" id="attachment_1" name="attachment[]"></td>
      <td><input type="button" class="btn btn-success" id="new_row" name="new_row" onclick="check()" value="Add">
      <input type="button" class="btn btn-danger" id="certificate_row_remove" onclick="certificate_row_remove()" value="Remove">
    </td>
    </tr>
   
    
    </table>
    <table>
    <tr><td><input type="button" name="save" value="save" onclick="emp_education_save()"></td></tr>
    </table>
    </form>
    <!-- /.tab-pane -->
    </div>
  
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
    
    <form method="POST" id="emp_education" enctype="multipart/form-data">
    <tr>
      <td><input type="checkbox" class="chk" name="chk[]" id="chk_1" value="1" style="width:15px;height:20px;"/></td>
     <td><input type="text" class="form-control" id="certifcatename_1" name="certifcatename[]"></td>
      <td><input type="text" class="form-control" id="certifcatnumber_1" name="certifcatenumber[]"></td>
      <td><input type="date" class="form-control" id="validityfrom_1" name="validityfrom[]"></td>
      <td><input type="date" class="form-control" id="validityto_1" name="validityto[]"></td>
      <td><input type="file" class="form-control" id="certifcatefile_1" name="certifcatefile[]"></td>
      <td><input type="button" class="btn btn-success" id="new_row1" name="new_row1" onclick="check1()" value="Add">
      <input type="button" class="btn btn-danger" id="certificate_row1_remove" onclick="certificate_row1_remove()" value="Remove">
    </td>
    </tr>   
     </table>
    <table>
    <tr><td><input type="button" name="save" value="save" onclick="emp_certificate_save()"></td></tr>
    </table>
    </form>
    <!-- /.tab-pane -->
    </div>
    <!-- /.tab-pane -->
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
    <tr>
	<td><input type="checkbox" class="chk" name="chk[]" id="chk_1" value="1" style="width:15px;height:20px;"/></td>
    <td><input type="text" class="form-control" id="organization_1" name="organization[]"></td>
    <td colspan="2"><input type="text" class="form-control" id="Designation_1" name="designation[]"></td>
    <td><input type="date" class="form-control" id="From_1" name="from[]"></td>
    <td><input type="date" class="form-control" id="to_1" name="to[]"></td>
    <td><input type="text" class="form-control" id="yearofexperience_1" name="yearofexperience[]" readonly></td>
    <td><input type="button" class="btn btn-success" id="new_row" name="new_row" onclick="check2()" value="Add">
	   <input type="button" class="btn btn-danger" id="certificate_row2_remove" onclick="certificate_row2_remove()" value="Remove"></td>
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
<input type="button" class="btn btn-primary btn-md"  style="float:right;" name="Update" onclick="ctc_update()" value="Update"> 
</form>
</div>
</div>
</div>
<script>
	function back_ctc()
	{
		$.ajax({
		type:"POST",
		url:"Recruitment/ctcapproval/CTC_view.php",
		success:function(data){
		$("#main_content").html(data);
		}
		})
	}
    function ctc_update()
    {
    var id=<?php echo $id; ?>;
    var data = $('form').serialize();
    $.ajax({
    type:'GET',
    data:"id="+id, data,
    url:'Recruitment/ctcapproval/approval_submit.php',
    success:function(data)
    {
      if(data==1)
      { 
        alert('Update Successfully');
        add_employee()
      }
      else
      {
        alert("No Data choose");
      }
      
    }       
    });
    }
    </script>