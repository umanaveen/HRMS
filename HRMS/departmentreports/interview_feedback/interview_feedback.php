<?php
require '../../connect.php';
include("../../user.php");
$userrole=$_SESSION['userrole'];
?>
<div class="container-fluid">
<div class="card mb-3">
<div class="card-header">
<i class="fa fa-table"></i> Interview Feedback
<input type="button" style="float:right;" class="btn btn-warning" name="print" onclick="printDiv('printableArea')"  value="Print">
</div>
<div class="card-body" id="printableArea">

<?php if($userrole=='ROLE-002') { ?>	
<form method="POST" action="HRMS/interview_feedback/newinterview_submit.php">
<input type="hidden" name="userrole" id="userrole" value="<?php echo  $userrole; ?>">
<table class="table table-bordered">
<tr>
<td><center><img src="../../HRMS/image/userlog/bluebase.png" alt="quadsel" style="width:100px;height:50px;"></center></td>
<td colspan="5"><center><b>Bluebase Software services Pvt Ltd</b></center></td>
</tr>

<tr>

<td>Candidate Name:</td>
<td colspan="5"><select class="form-control" id="replacement" name="replacement" onchange="candidate_replacess(this.value)">
<option value="">CHOOSE CANDIDATE NAME</option>
<?php $CANDIDATE = $con->query("SELECT * FROM candidate_form_details where status=11");
while ($row = $CANDIDATE->fetch()) {?>
<option value="<?php echo $row['id']; ?>"> <?php echo $row['first_name']; ?> </option>
<?php } ?></select></td>

</tr>
<script>
function candidate_replacess(name)
{ alert(name);
	$.ajax({
		type:'GET',
		data:"name="+name ,
		url:'/reruitment/HRMS/interview_feedback/candidate_replace.php',
		success:function(data)
		{
			var splitData=data.split("=");			
			$("#position").val(splitData[0]);
			$("#tech_department").val(splitData[1]);
		}
}
</script>
<tr>
<td>POSITION:</td>
<td colspan="2"><input type="text" class="form-control" id="position" name="position" readonly></td>
<td>Department:</td>
<td colspan="2">
<input type="text" class="form-control" id="tech_department" name="tech_department" > </td>
</tr>
<tr>
<td>Type:</td>
<td colspan="5"><select class="form-control" id="replacement" name="replacement" onchange="change()"><option value="">CHOOSE TYPE</option><option value="new">New</option><option value="replace">Replacement</option></select></td>
</tr>
<tr id="old_replace">
<td>Candidate Name:</td>
<td colspan="2"><input type="text" class="form-control" id="new_name" name="new_name" ></td>
<td>Replaced Candidate Name:</td>
<td colspan="2"><input type="text" class="form-control" id="replaced_name" name="replaced_name" ></td>
</tr>
<tr>
<td>Location/site:</td>
<td colspan="5"><input type="text" class="form-control" id="site" name="site" ></td>
</tr>
<tr>
<td>Reason for waiting to leave the present job:</td>
<td colspan="5"><input type="text" class="form-control" id="Reason_leave" name="Reason_leave"></td>
</tr>
<tr>
<td>Reference Name</td>
<td colspan="5"><input type="text" class="form-control" id="reference" name="reference"></td>
</tr>
<tr>
<td>Total Years of Experience</td>
<td colspan="5"><input type="text" class="form-control" id="tot_year_exp" name="tot_year_exp"></td>
</tr>
<tr>
<td>Current CTC</td>
<td colspan="5"><input type="text" class="form-control" id="current_ctc" name="current_ctc"></td>
</tr>
<tr>
<td>Expected CTC</td>
<td colspan="5"><input type="text" class="form-control" id="exp_ctc" name="exp_ctc"></td>
</tr>
<tr>
<td>Notice period</td>
<td colspan="5"><input type="number" class="form-control" id="notice_period" name="notice_period"></td>
</tr>
<tr>
<td>Expected Date of Joining</td>
<td colspan="5"><input type="date" class="form-control" id="date_of_join" name="date_of_join"></td>
</tr>
<tr>
<td colspan="6"><center><b>Comments by Recruiter</b></center></td>
</tr>
<tr>
<td>Recruiter Name:</td>
<td colspan="5"><input type="text" class="form-control" id="recruiter_name" name="recruiter_name"></td>
</tr>
</table>
<table class="table table-bordered" id="recruiter_page">
<tr>
<td>Interpersonal Skill:</td>
<td colspan="1"><input type="text" class="form-control" id="recruiterquestion_1" name="recruiter_question[]"></td>
<td>Rating:</td><td colspan="5">
<input type="radio"  id="radio_1"  name="performance_0"   id="performance_1" value="1" onclick="RadioValue('1')">
<label for="performance"> 1</label>
<input type="radio" name="performance_0"  id="performance_1" value="2"  onclick="RadioValue('2')">
<label for="performance"> 2</label>
<input type="radio" name="performance_0"  id="performance_1" value="3"  onclick="RadioValue('3')">
<label for="performance"> 3</label>
<input type="radio" name="performance_0"  id="performance_1" value="4"  onclick="RadioValue('4')">
<label for="performance"> 4</label>
<input type="radio" name="performance_0"  id="performance_1" value="5"  onclick="RadioValue('5')">
<label for="performance"> 5</label></td>
<td>Response:</td><td colspan="1"><input type="text" class="form-control" id="recruiteranswer_1" name="recruiter_answer[]"></td>
<td><input type="button" class="btn btn-success" id="new_row" name="new_row" onclick="check1()" value="Add"></td>
</tr>
</table>
<table class="table table-bordered">
<tr>
<td>Overall Rating:</td>
<td colspan="5"><input type="text" class="form-control" id="ratings" name="ratings"></td>
</tr>
<tr>
<td>Remarks *:</td>
<td colspan="5"><input type="text" class="form-control" id="remarks" name="remarks"></td>
</tr>
<tr>
<td>Status *:</td>
<td colspan="5">
<select class="form-control" id="status_recruiter" name="status_recruiter" onchange="change_replace()">
<option value="">CHOOSE TYPE</option>
<option value="0" >Select for Next Level</option>
<option value="1">Waiting List</option>
<option value="3">Rejected</option></select></td>

</tr>

<tr id="statushide">

<td>Technical Department Assign:</td>
<td colspan="5">
<select class="form-control" id="technical_department" name="technical_department" >
<option value="">Choose Department</option>
<?php $stmt = $con->query("SELECT * FROM z_department_master where status=1");
while ($row = $stmt->fetch()) {?>
<option value="<?php echo $row['id']; ?>"> <?php echo $row['dept_name']; ?> </option>
<?php } ?>
</select>
</td>

</tr>
</table>
<input type="submit" name="submit" class="btn btn-primary btn-md" style="float:right;"></form>
<?php 
}
else if($userrole=='ROLE-004')
{?>
<table class="table table-bordered">
<tr>
<td><center><img src="../../HRMS/image/userlog/bluebase.png" alt="quadsel" style="width:100px;height:50px;"></center></td>
<td colspan="5"><center><b>Bluebase Software services Pvt Ltd</b></center></td>
</tr>
<tr>
<td>Candidate Name:</td>
<td colspan="4"><select class="form-control" id="cname" name="cname" ></td>
</tr>
<tr>
<td>POSITION:</td>
<td colspan="1"><input type="text" class="form-control" name="sposition" id="sposition" readonly="true"></td>
<td>Department:</td>
<td colspan="3"><input type="text" class="form-control" name="sdepartment" id="sdepartment" readonly="true"></td>
</tr>
<tr id="new_replace">
<td>candidate:</td>
<td colspan="5"><input type="text" readonly="true" class="form-control" id="snew_candidate" name="snew_candidate" ></td>
</tr>
<tr id="old_replace">
<td>Candidate Name:</td>
<td colspan="1"><input type="text" readonly="true" class="form-control" id="snew_name" name="snew_name" ></td>
<td>Replaced Candidate Name:</td>
<td colspan="2"><input type="text" readonly="true" class="form-control" id="sreplaced_name" name="sreplaced_name" ></td>
</tr>
<tr>
<td>Location/site:</td>
<td colspan="5"><input type="text" readonly="true" class="form-control" id="ssite" name="ssite" ></td>
</tr>
<tr>
<td>Reason for waiting to leave the present job:</td>
<td colspan="5"><input type="text" readonly="true" class="form-control" id="sReason_leave" name="sReason_leave"></td>
</tr>
<tr>
<td>Reference Name</td>
<td colspan="5"><input type="text" readonly="true" class="form-control" id="sreference" name="sreference"></td>
</tr>
<tr>
<td>Total Years of Experience</td>
<td colspan="5"><input type="text" readonly="true" class="form-control" id="stot_year_exp" name="stot_year_exp"></td>
</tr>
<tr>
<td>Current CTC</td>
<td colspan="5"><input type="text" readonly="true" class="form-control" id="sexp_salary" name="sexp_salary"></td>
</tr>
<tr>
<td>Expected CTC</td>
<td colspan="5"><input type="text" readonly="true" class="form-control" id="sexp_salary" name="sexp_salary"></td>
</tr>
<tr>
<td>Notice period</td>
<td colspan="5"><input type="number"  readonly="true" class="form-control" id="snop" name="snop"></td>
</tr>
<tr>
<td>Expected Date of Joining</td>
<td colspan="5"><input type="date"  readonly="true" class="form-control" id="sdate_of_join" name="sdate_of_join"></td>
</tr>
<tr>
<td colspan="6"><center><b>Comments by Recruiter</b></center></td>
</tr>
<tr>
<td>Recruiter Name:</td>
<td colspan="5"><input type="text" class="form-control" readonly="true" id="recruiter_name" name="recruiter_name"></td>
</tr>
<tr>
<td>Interpersonal Skill:</td>
<td colspan="1"><input type="text" class="form-control" readonly="true" id="srecruiterquestion" name="srecruiter_question"></td>
<td colspan="1">Rating:</td>
<td colspan="1"><input type="text" class="form-control" readonly="true" id="srating" name="srating"></td>
<td colspan="1">Response:</td><td colspan="1"><input type="text" class="form-control" readonly="true" id="sresponse" name="sresponse"></td>
</tr>
<tr>
<td>Overall Rating:</td>
<td colspan="5"><input type="text" class="form-control" readonly="true" id="ratings" name="ratings"></td>
</tr>
<tr>
<td>Remarks *:</td>
<td colspan="5"><input type="text" class="form-control" readonly="true" id="remarks" name="remarks"></td>
</tr>				
<tr>
<td colspan="6"><center><b>Comment by Technical Person</b></center></td>
</tr>
<tr><td>Technical Person Name</td>
<td colspan="5"><input type="text" class="form-control" id="command_technical_person" name="command_technical_person"></td>
</tr>
<table class="table table-bordered" id="technical_page">
<tr>
<td>Technical Skill:</td>
<td colspan="1"><input type="text" class="form-control" id="technicalquestion_1" name="technical_question[]"></td>
<td>Rating:</td><td colspan="5">
<input type="radio"  id="radio_1"  name="performance1"   id="performance1_1" value="1">
<label for="performance"> 1</label>
<input type="radio" name="performance1"  id="performance1_1" value="2">
<label for="performance"> 2</label>
<input type="radio" name="performance1"  id="performance1_1" value="3">
<label for="performance"> 3</label>
<input type="radio" name="performance1"  id="performance1_1" value="4">
<label for="performance"> 4</label>
<input type="radio" name="performance1"  id="performance1_1" value="5">
<label for="performance"> 5</label>
</td>
<td>Response:</td>
<td colspan="1">
<select class="form-control" id="technicalanswer_1" name="technical_answer[]" onchange="change_replace()">
<option value="">CHOOSE TYPE</option>
<option value="5" >Excellent</option>
<option value="4">Good</option>
<option value="3">Average</option>
<option value="2">Ok</option>
<option value="1">Bad</option>
</select>
</td>
<td><input type="button" class="btn btn-success" id="new_row" name="new_row" onclick="check2()" value="Add"></td>
</tr>
</table>
<table class="table table-bordered">
<tr>
<td>Overall Rating:</td>
<td colspan="5"><input type="text" class="form-control" id="rating" name="rating"></td>
</tr>
<tr>
<td>Remarks *:</td>
<td colspan="5"><input type="text" class="form-control" id="recruiter_name" name="recruiter_name"></td>
</tr>	
<tr>
<td>Status *:</td>
<td colspan="5">
<select class="form-control" id="status_recruiter" name="status_recruiter" onchange="change_replace()">
<option value="">CHOOSE TYPE</option>
<option value="1" >Select for Next Level</option>
<option value="0">Rejected</option></select></td>
</tr>

</table>
<?php 
}
else if($userrole=='ROLE-005')
{?>
<table class="table table-bordered">
<tr>
<td><center><img src="../../HRMS/image/userlog/bluebase.png" alt="quadsel" style="width:100px;height:50px;"></center></td>
<td colspan="5"><center><b>Bluebase Software services Pvt Ltd</b></center></td>
</tr>
<tr id="statushide">
<td>Candidate Name:</td>
<td colspan="5">
<select class="form-control" id="choosedcandidate" name="choosedcandidate" onchange="">
<option value="">Choose Candidate</option>
<?php $stmt = $con->query("SELECT ttd.id,epd.name FROM technical_team_details ttd join emp_personal_details epd on ttd.candidate_id=epd.id where ttd.head_status=1");
while ($row = $stmt->fetch()) {?>
<option value="<?php echo $row['id']; ?>"> <?php echo $row['name']; ?> </option>
<?php } ?>
</select>
</td>
</tr>
<tr>
<td>POSITION:</td>
<td colspan="2"><input type="text" readonly="true" class="form-control" id="position" name="position" ></td>
<td>Department:</td>
<td colspan="2">
<input type="text" readonly="true" class="form-control" id="tech_department" name="tech_department" ></td>
</tr>
<tr id="new_replace">
<td>candidate:</td>
<td colspan="5"><input type="text" class="form-control" readonly="true" id="new_candidate" name="new_candidate" ></td>
</tr>
<tr id="old_replace">
<td>Candidate Name:</td>
<td colspan="2"><input type="text" class="form-control" readonly="true" id="new_name" name="new_name" ></td>
<td>Replaced Candidate Name:</td>
<td colspan="2"><input type="text" class="form-control" readonly="true" id="replaced_name" name="replaced_name" ></td>
</tr>
<tr>
<td>Location/site:</td>
<td colspan="5"><input type="text" class="form-control" readonly="true" id="site" name="site" ></td>
</tr>
<tr>
<td>Reason for waiting to leave the present job:</td>
<td colspan="5"><input type="text" class="form-control" readonly="true" id="Reason_leave" name="Reason_leave"></td>
</tr>
<tr>
<td>Reference Name</td>
<td colspan="5"><input type="text" class="form-control" readonly="true" id="reference" name="reference"></td>
</tr>
<tr>
<td>Total Years of Experience</td>
<td colspan="5"><input type="text" class="form-control" readonly="true" id="tot_year_exp" name="tot_year_exp"></td>
</tr>
<tr>
<td>Current CTC</td>
<td colspan="5"><input type="text" class="form-control" readonly="true" id="exp_salary" name="exp_salary"></td>
</tr>
<tr>
<td>Expected CTC</td>
<td colspan="5"><input type="text" class="form-control"  readonly="true" id="exp_salary" name="exp_salary"></td>
</tr>
<tr>
<td>Notice period</td>
<td colspan="5"><input type="number" class="form-control" readonly="true" id="date_of_join" name="date_of_join"></td>
</tr>
<tr>
<td>Expected Date of Joining</td>
<td colspan="5"><input type="date" class="form-control" readonly="true" id="date_of_join" name="date_of_join"></td>
</tr>			
<tr>
<td colspan="6"><center><b>Comments by Recruiter</b></center></td>
</tr>
<tr>
<td>Recruiter Name:</td>
<td colspan="5"><input type="text" readonly="true" class="form-control" id="recruiter_name" name="recruiter_name"></td>
</tr>
<tr>
<td>Interpersonal Skill:</td>
<td colspan="1"><input type="text" readonly="true" class="form-control" id="recruiterquestion_1" name="recruiter_question[]"></td>
<td>Rating:</td><td colspan=""><input type="text" readonly="true" class="form-control" id="recruiterquestion_1" name="recruiter_question[]"></td>
<td>Response:</td><td colspan="1"><input type="text" readonly="true" class="form-control" id="recruiteranswer_1" name="recruiter_answer[]"></td> 
</tr>
<tr>
<td>Overall Rating:</td>
<td colspan="5"><input type="text" readonly="true" class="form-control" id="rating" name="rating"></td>
</tr>
<tr>
<td>Remarks *:</td>
<td colspan="5"><input type="text" readonly="true" class="form-control" id="remarks" name="remarks"></td>
</tr>
<tr>
<td colspan="6"><center><b>Comment by Technical Person</b></center></td>
</tr>
<tr><td>Technical Person Name</td>
<td colspan="5"><input type="text" class="form-control" readonly="true" id="command_technical_person" name="command_technical_person"></td>
</tr>
</table>
<table class="table table-bordered" id="technical_page">
<tr>
<td>Technical Skill:</td>
<td colspan="1"><input type="text" readonly="true" readonly="true" class="form-control" id="recruiterquestion_1" name="recruiter_question[]"></td>
<td>Rating:</td><td colspan="5"></td>
<td>Response:</td><td colspan="1"><input type="text" readonly="true" class="form-control" id="recruiteranswer_1" name="recruiter_answer[]"></td>
<td><input type="button" class="btn btn-success" id="new_row" readonly="true" name="new_row" onclick="check2()" value="Add"></td>
</tr>
</table>
<table class="table table-bordered">
<tr>
<td>Overall Rating:</td>
<td colspan="5"><input type="text" readonly="true" class="form-control" id="ratings" name="ratings"></td>
</tr>
<tr>
<td>Remarks *:</td>
<td colspan="5"><input type="text" readonly="true" class="form-control" id="remarks" name="remarks"></td>
</tr>
<tr>
<td colspan="6"><center><b>Comment by MD</b></center></td>					
</tr>
<tr>
<td>MD Comment:</td>
<td colspan="5"><textarea id="mdcomment" name="mdcomment" rows="6" cols="120"></textarea></td>
</tr>
<tr>
<td>Status *:</td>
<td colspan="5">
<select class="form-control" id="status_md" name="status_md" onchange="change_replace()">
<option value="0">CHOOSE TYPE</option>
<option value="1" >Selected</option>
<option value="2">Rejected</option></select></td>
</tr>
</table>
<?php 
}
else 
{
?>
<td><center><img src="../../HRMS/image/userlog/bluebase.png" alt="quadsel" style="width:100px;height:50px;"></center></td>
<td colspan="5"><center><b>Bluebase Software services Pvt Ltd</b></center></td>
</tr>

<tr>
<td>POSITION:</td>
<td colspan="2"><input type="text" readonly="true" class="form-control" id="position" name="position" ></td>
<td>Department:</td>
<td colspan="2">
<select class="form-control" readonly="true" id="tech_department" name="tech_department" >
<option value="">Choose Department</option>
<?php $stmt = $con->query("SELECT * FROM z_department_master where status=1");
while ($row = $stmt->fetch()) {?>
<option value="<?php echo $row['id']; ?>"> <?php echo $row['dept_name']; ?> </option>
<?php } ?>
</select></td>
</tr>
<tr>
<td>Type:</td>
<td colspan="5"><select class="form-control" readonly="true" id="replacement" name="replacement" onchange="change()"><option value="">CHOOSE TYPE</option><option value="new">New</option><option value="replace">Replacement</option></select></td>
</tr>
<tr id="new_replace">
<td>candidate:</td>
<td colspan="5"><input type="text" class="form-control" readonly="true" id="new_candidate" name="new_candidate" ></td>
</tr>
<tr id="old_replace">
<td>Candidate Name:</td>
<td colspan="2"><input type="text" class="form-control" readonly="true" id="new_name" name="new_name" ></td>
<td>Replaced Candidate Name:</td>
<td colspan="2"><input type="text" class="form-control" readonly="true" id="replaced_name" name="replaced_name" ></td>
</tr>
<tr>
<td>Location/site:</td>
<td colspan="5"><input type="text" class="form-control" readonly="true" id="site" name="site" ></td>
</tr>
<tr>
<td>Reason for waiting to leave the present job:</td>
<td colspan="5"><input type="text" class="form-control" readonly="true" id="Reason_leave" name="Reason_leave"></td>
</tr>
<tr>
<td>Reference Name</td>
<td colspan="5"><input type="text" class="form-control" readonly="true" id="reference" name="reference"></td>
</tr>
<tr>
<td>Total Years of Experience</td>
<td colspan="5"><input type="text" class="form-control" readonly="true" id="tot_year_exp" name="tot_year_exp"></td>
</tr>
<tr>
<td>Current CTC</td>
<td colspan="5"><input type="text" class="form-control" readonly="true" id="exp_salary" name="exp_salary"></td>
</tr>
<tr>
<td>Expected CTC</td>
<td colspan="5"><input type="text" class="form-control"  readonly="true" id="exp_salary" name="exp_salary"></td>
</tr>
<tr>
<td>Notice period</td>
<td colspan="5"><input type="number" class="form-control" readonly="true" id="date_of_join" name="date_of_join"></td>
</tr>
<tr>
<td>Expected Date of Joining</td>
<td colspan="5"><input type="date" class="form-control" readonly="true" id="date_of_join" name="date_of_join"></td>
</tr>
<tr>
<td colspan="6"><center><b>Comments by Recruiter</b></center></td>
</tr>
<tr>
<td>Recruiter Name:</td>
<td colspan="5"><input type="text" class="form-control" readonly="true" id="recruiter_name" name="recruiter_name"></td>
</tr>
</table>
<table class="table table-bordered" id="recruiter_page">
<tr>
<td>Interpersonal Skill:</td>
<td colspan="1"><input type="text" class="form-control" readonly="true" id="recruiterquestion_1" name="recruiter_question[]"></td>
<td>Rating:</td><td colspan="5">
<input type="radio"  id="radio_1"  name="performance" readonly="true"   id="performance_1" value="1" onclick="RadioValue('1')">
<label for="performance"> 1</label>
<input type="radio" name="performance"  id="performance_1" value="2"  onclick="RadioValue('2')">
<label for="performance"> 2</label>
<input type="radio" name="performance"  id="performance_1" value="3"  onclick="RadioValue('3')">
<label for="performance"> 3</label>
<input type="radio" name="performance"  id="performance_1" value="4"  onclick="RadioValue('4')">
<label for="performance"> 4</label>
<input type="radio" name="performance"  id="performance_1" value="5"  onclick="RadioValue('5')">
<label for="performance"> 5</label></td>
<td>Response:</td><td colspan="1"><input type="text" class="form-control" readonly="true" id="recruiteranswer_1" name="recruiter_answer[]"></td>
<td><input type="button" class="btn btn-success" id="new_row" readonly="true" name="new_row" onclick="check1()" value="Add"></td>
</tr>
</table>
<table class="table table-bordered">
<tr>
<td>Overall Rating:</td>
<td colspan="5"><input type="text" class="form-control" readonly="true" id="recruiter_name" name="recruiter_name"></td>
</tr>
<tr>
<td>Remarks *:</td>
<td colspan="5"><input type="text" class="form-control" readonly="true" id="recruiter_name" name="recruiter_name"></td>
</tr>
<tr>
<tr>
<td colspan="6"><center><b>Comment by Technical Person</b></center></td>
</tr>
<tr><td>Technical Person Name</td>
<td colspan="5"><input type="text" class="form-control" readonly="true" id="command_technical_person" name="command_technical_person"></td>
</tr>
<table class="table table-bordered" id="recruiter_page">
<tr>
<td>Technical Skill:</td>
<td colspan="1"><input type="text" class="form-control" readonly="true" id="recruiterquestion_1" name="recruiter_question[]"></td>
<td>Rating:</td><td colspan="5">
<input type="radio"  id="radio_1"  name="performance" readonly="true"  id="performance_1" value="1" onclick="RadioValue('1')">
<label for="performance"> 1</label>
<input type="radio" name="performance"  id="performance_1" value="2"  onclick="RadioValue('2')">
<label for="performance"> 2</label>
<input type="radio" name="performance"  id="performance_1" value="3"  onclick="RadioValue('3')">
<label for="performance"> 3</label>
<input type="radio" name="performance"  id="performance_1" value="4"  onclick="RadioValue('4')">
<label for="performance"> 4</label>
<input type="radio" name="performance"  id="performance_1" value="5"  onclick="RadioValue('5')">
<label for="performance"> 5</label></td>
<td>Response:</td><td colspan="1"><input type="text" class="form-control" readonly="true" id="recruiteranswer_1" name="recruiter_answer[]"></td>
<td><input type="button" class="btn btn-success" id="new_row" readonly="true" name="new_row" onclick="check1()" value="Add"></td>
</tr>
</table>
<table class="table table-bordered">
<tr>
<td>Overall Rating:</td>
<td colspan="5"><input type="text" class="form-control" readonly="true" id="tech_name" name="tech_name"></td>
</tr>
<tr>
<td>Remarks *:</td>
<td colspan="5"><input type="text" class="form-control" readonly="true" id="tech_name" name="tech_name"></td>
</tr>	

<tr>
<td colspan="6"><center><b>Comment by HR</b></center></td>
</tr>
<tr><td>HR Comment</td>
<td colspan="5"><textarea rows="5" cols="100" class="form-control" id="command_hr" name="command_hr"></textarea></td>
</tr>
<tr>
<td>Status *:</td>
<td colspan="5">
<select class="form-control" id="status_recruiter" name="status_recruiter" onchange="change_replace()">
<option value="0">CHOOSE TYPE</option>
<option value="1" >MD</option>
<option value="1" >HOD</option>
<option value="1" >Both MD & HOD</option>
<option value="2">Rejected</option></select></td>
</tr>

<?php }?>
</table>				

</div>
</div>
</div>
</div>
<script> 
function check1() // education
{
var len=$('#recruiter_page tr').length;	
var leng=$('#recruiter_page tr').length;	
len=len+1; 
leng=len-1;
$('#recruiter_page').append('<tr class="row_'+len+'"><td>Question:</td><td colspan="1"><input type="text" class="form-control" id="recruiterquestion_'+len+'" name="recruiter_question[]"></td><td>Rating:</td><td colspan="5"><input type="radio" id="radio_'+len+'" name="performance_'+leng+'" value="1"<label for="performance"> 1</label>  <input type="radio" id="radio_'+len+'"  name="performance_'+leng+'" value="2"><label for="performance"> 2</label><input type="radio"  id="radio_'+len+'"  name="performance_'+leng+'" value="3"><label for="performance"> 3</label><input type="radio"  id="radio_'+len+'"  name="performance_'+leng+'" value="4"><label for="performance"> 4</label><input type="radio"  id="radio_'+len+'"  name="performance_'+leng+'" value="5"><label for="performance"> 5</label></td><td>Response:</td><td colspan="1"><input type="text" class="form-control" id="recruiteranswer_'+len+'" name="recruiter_answer[]"></td></tr>'); 
}

function check2() // Technical
{  
var len=$('#technical_page tr').length;	
len=len+1; 
$('#technical_page').append('<tr class="row_'+len+'"><td>Technical Skill:</td><td colspan="1"><input type="text" class="form-control" id="technicalquestion_'+len+'" name="technical_question[]"></td><td>Rating:</td><td colspan="5"><input type="radio" id="radio_'+len+'" name="performance1" value="1"><label for="performance"> 1 </label>  <input type="radio" id="radio_'+len+'"  name="performance1" value="2"><label for="performance"> 2 </label><input type="radio"  id="radio_'+len+'"  name="performance1" value="3"><label for="performance"> 3</label><input type="radio"  id="radio_'+len+'"  name="performance1" value="4"><label for="performance"> 4</label><input type="radio"  id="radio_'+len+'"  name="performance1" value="5"><label for="performance"> 5</label></td><td>Response:</td><td colspan="1"><select class="form-control" id="technicalanswer_'+len+'" name="technical_answer[]"><option value="">CHOOSE TYPE</option><option value="5" >Excellent</option><option value="4">Good</option><option value="3">Average</option><option value="2">Ok</option><option value="1">Bad</option></select></td></tr>'); 
}
function change()
{
var check=$('#replacement').val();
if(check=='new')
{
document.getElementById('old_replace').style.visibility = "hidden"; 
}
else
{
document.getElementById('old_replace').style.visibility = "visible"; 
}
}

function change_replace()
{
var check1=$('#status_recruiter').val();
if(check1=='2')
{
document.getElementById('statushide').style.visibility = "hidden";
}
else if(check1=='1')
{
document.getElementById('statushide').style.visibility = "visible";
}
}
function RadioValue(v) 
{

var check1=$('#performance_1').val();
var res2 = r.split("_");
var id2=res2[1];
if(check1=='1')
{
document.getElementById("recruiteranswer_'+v1+'").value = "Bad";
}
else if(v=='2')
{
document.getElementById("recruiteranswer_1").value = "Ok";
}
else if(v=='3')
{
document.getElementById("recruiteranswer_1").value = "Average";
}
else if(v=='4')
{
document.getElementById("recruiteranswer_1").value = "Good";
}
else 
{
document.getElementById("recruiteranswer_1").value = "Excellent";
} 
}  
</script> 