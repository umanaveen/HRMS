<?php

include("../../user.php");
require '../../connect.php';
$userrole=$_SESSION['userrole'];
$userid=$_SESSION['candidateid'];

$staf=$con->query("select * from staff_master where candid_id='$userid'");
$sfetch=$staf->fetch();
$staid=$sfetch['id'];

$id=$_REQUEST['id'];
$stmt = $con->prepare("SELECT *,t.rating as overall_rating FROM candidate_form_details c left join `technical_team_details` t on c.id=t.candidate_id left join technical_team_commands m on t.id=m.technical_id left join z_department_master d on c.department=d.id left join designation_master dm on c.position=dm.id
WHERE c.id='$id'"); 
$stmt->execute(); 
$row = $stmt->fetch();

?>

<div class="container-fluid">
<div class="card mb-3">
<div class="card-header">
<i class="fa fa-table"></i> INTERVIEW FEEDBACK DETAILS EDIT
<a onclick="return back_ctc()" style="float: right;" data-toggle="modal" class="btn btn-danger"><i class="fa fa-plus"></i>Back</a>
</div>
<div class="card-body" id="printableArea">
<form method="POST" action="HRMS/interview_feedback/feedback_submit.php">
<input type="hidden" name="userrole" id="userrole" value="<?php echo  $userrole; ?>">
<table class="table table-bordered">
<tr>
<td><center><img src="../../HRMS/image/userlog/bluebase.png" alt="quadsel" style="width:100px;height:50px;"></center></td>
<td colspan="5"><center><b>Bluebase Software services Pvt Ltd</b></center></td>
</tr>
<tr>
<td>Candidate Name:</td>
<td colspan="5">
<input type="hidden" class="form-control" id="id" name="id"  value="<?php echo $id;?>" readonly>
<input type="hidden" class="form-control" id="user_id" name="user_id"  value="<?php echo  $staid;?>" readonly>
<input type="text" class="form-control" id="name" name="name"  value="<?php echo  $row['first_name'] . " ".$row['last_name'] ;?>"readonly ></td>

</tr>

<tr>
<td>POSITION:</td>
<td colspan="2"><input type="text" class="form-control" id="position" value="<?php echo  $row['designation_name'];?>" name="position"readonly></td>
<td>Department:</td>
<td colspan="2">
<input type="text" class="form-control" id="tech_department" value="<?php echo  $row['dept_name'];?>" name="tech_department" readonly> </td>
</tr>
<!--tr>
<td>Type:</td>
<td colspan="5"><select class="form-control" id="replacements" name="replacements" onchange="change()"><option value="">CHOOSE TYPE</option><option value="new">New</option><option value="replace">Replacement</option></select></td>
</tr>
<tr id="old_replace">
<td>Replaced Candidate Name:</td>
<td colspan="5"><input type="text" class="form-control" id="replaced_name" name="replaced_name" ></td>
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
</tr-->
<!--tr>
<td>Total Years of Experience</td>
<td colspan="5"><input type="text" class="form-control" id="tot_year_exp" name="tot_year_exp" readonly></td>
</tr>
<tr>
<td>Current CTC</td>
<td colspan="5"><input type="text" class="form-control" id="current_ctc" name="current_ctc" readonly></td>
</tr>
<tr>
<td>Expected CTC</td>
<td colspan="5"><input type="text" class="form-control" id="exp_ctc" name="exp_ctc" readonly></td>
</tr>
<tr>
<td>Notice period</td>
<td colspan="5"><input type="number" class="form-control" id="notice_period" name="notice_period"></td>
</tr>
<tr>
<td>Expected Date of Joining</td>
<td colspan="5"><input type="text" class="form-control" id="date_of_join" name="date_of_join" readonly></td>
</tr-->
<!--tr>
<td colspan="6"><center><b>Comments by Recruiter</b></center></td>
</tr>
<tr>
<td>Recruiter Name:</td>
<td colspan="5"><input type="text" class="form-control" id="recruiter_name" name="recruiter_name" readonly></td>
</tr-->
</table>
<?php

$sql=$con->query("SELECT *,s.emp_name as tech_person, c.candid_id as candid_id FROM candidate_round_details c join staff_master s on c.person_id=s.id where c.candid_id='$id' and c.person_id !=''");
$rows1 = $sql->fetch(PDO::FETCH_ASSOC);
?>
 <tr>
	  <input type="hidden" class="form-control" id="get_id1" name="get_id" value="<?php echo $rows1['candid_id']; ?>">
	 
<td>Technical Person Name:</td>
<td colspan="5"><input type="text" class="form-control" id="head_name" name="head_name" value="<?php echo  $rows1['tech_person']; ?>" readonly></td>
</tr>

<table class="table table-bordered" id="technical_page">
<h3><center>Technical Skill</center></h3>
<tr>
<td>Techniacl Skill:</td>
<td colspan="1"><input type="text" class="form-control" id="technical_question_1" name="technical_question[]"></td>
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
<td>Response:</td>

<td colspan="1"><select class="form-control" id="technicalanswer_1" name="technical_answer[]" onchange="change_replace()">
<option value="">CHOOSE TYPE</option>
<option value="5" >Excellent</option>
<option value="4">Good</option>
<option value="3">Average</option>
<option value="2">Ok</option>
<option value="1">Bad</option>
</select></td>
<td><input type="button" class="btn btn-success" id="new_row" name="new_row" onclick="check2()" value="Add"></td>
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
<option value="5" >Select for Next Level</option>
<!--option value="6">Waiting List</option-->
<option value="7">Rejected</option></select></td>

</tr>

<!--tr id="statushide">

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
<tr>
<td>Technical Department Person:</td>
<td colspan="5">
<select class="form-control" id="tech_dept_per" name="tech_dept_per" >
<option value="">Department Person</option>
<?php
$emp_sql1=$con->query("SELECT * FROM z_user_master where user_group_code='ROLE-007'");
     
      while($emp_res1 = $emp_sql1->fetch(PDO::FETCH_ASSOC))
      {
		  ?>
		  <option value="<?php echo $emp_res1['user_id'];?>"><?php echo $emp_res1['user_name'];?></option>
		  <?php
	  }
		  ?>
</select>
</td>
</tr-->
</table>
<input type="submit" name="submit" class="btn btn-primary btn-md" style="float:right;"></form>
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
alert("hii");
var len=$('#technical_page tr').length;	
var leng=$('#technical_page tr').length;	
len=len+1; 
leng=len-1;
$('#technical_page').append('<tr class="row_'+len+'"><td>Technical Skill:</td><td colspan="1"><input type="text" class="form-control" id="technicalquestion_'+len+'" name="technical_question[]"></td><td>Rating:</td><td colspan="5"><input type="radio" id="radio_'+len+'" name="performance_'+leng+'" value="1"<label for="performance"> 1</label>  <input type="radio" id="radio_'+len+'"  name="performance_'+leng+'" value="2"><label for="performance"> 2</label><input type="radio"  id="radio_'+len+'"  name="performance_'+leng+'" value="3"><label for="performance"> 3</label><input type="radio"  id="radio_'+len+'"  name="performance_'+leng+'" value="4"><label for="performance"> 4</label><input type="radio"  id="radio_'+len+'"  name="performance_'+leng+'" value="5"><label for="performance"> 5</label></td><td>Response:</td><td colspan="1"><select class="form-control" id="technicalanswer_'+len+'" name="technical_answer[]"><option value="">CHOOSE TYPE</option><option value="5" >Excellent</option><option value="4">Good</option><option value="3">Average</option><option value="2">Ok</option><option value="1">Bad</option></select></td></tr>'); 
}
function change()
{
var check=$('#replacements').val();
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

<script>
	function back_ctc()
	{
		alert("hii");
		/* $.ajax({
		type:"POST",
		url:"HRMS/interview_feedback/new.php",
		success:function(data){
		$("#main_content").html(data);
		}
		}) */
	}
</script>