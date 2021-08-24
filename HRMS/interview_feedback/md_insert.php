<?php
require '../../connect.php';
include("../../user.php");
$userid=$_SESSION['candidateid'];
$staf=$con->query("select * from staff_master where candid_id='$userid'");
$sfetch=$staf->fetch();
$staid=$sfetch['id'];
 $id=$_REQUEST['id'];

$stmt = $con->prepare("select *,c.id as candidate_id from candidate_form_details c
left JOIN z_department_master d ON c.department = d.id left join designation_master dm on c.position=dm.id left join candidate_round_details r on c.id=r.candid_id
where c.id='$id'"); 

$stmt->execute(); 
$row = $stmt->fetch();

?>
 <div class="card card-info">
              <div class="card-header">
                
				              <center><h3 class="card-title"><b>INTERVIEW FEEDBACK DETAILS EDIT</b></h3></center>
		<a onclick="return back()" style="float: right;" data-toggle="modal" class="btn btn-danger"></i>Back</a>
              </div>

<form role="form" action="" method="post" enctype="multipart/type">

<table class="table table-bordered">
  <tr>
        <td><center><img src="/HRMS/HRMS/Recruitment/image/userlog/bluebase.png"  style="width:300px;height:150px;"></center></td>
        <td colspan="5"><center><h1><b>Bluebase Software services Pvt Ltd</b></h1></center></td>
        </tr>
<tr>
<td>Candidate Name:</td>
<input type="hidden" class="form-control" id="id" name="id" value="<?php echo  $id;?>"readonly>
<input type="hidden" class="form-control" id="user_id" name="user_id" value="<?php echo  $staid;?>"readonly>
<td colspan="5"><input type="text" class="form-control" id="name" name="name" value="<?php echo  $row['first_name'] ." ". $row['first_name'];?>"readonly></td>

</tr>
<tr>
<td>POSITION:</td>
<td colspan="2"><input type="text" class="form-control" id="position" name="position" value="<?php echo  $row['designation_name'];?>"readonly></td>
<td>Department:</td>

<td colspan="2"><input type="text" class="form-control" id="dept_name" name="dept_name" value="<?php echo  $row['dept_name'];?>"readonly></td>
</tr>

<tr>
        <td colspan="6"><center><b>Personal Details</b></center></td>
        </tr>
        <tr>
        <td>First Name: *</td>
        <td colspan="2"><input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo $row['first_name'];?>" readonly ></td>
		<td>Last Name: *</td>
        <td colspan="2"><input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo $row['last_name'];?>" readonly></td>
        </tr>
		<tr>
		<td>Gender:</td>
		<?php 
		if($row['gender']="female")
		{
			?>
			<td colspan="5"> 
		
		<label>
		<input type="radio" name="gender" value="female" checked="true">&nbsp;Female</label>
		</td>
		<?php
		}
		else
		{
			?>
			<td colspan="5"> 
		<label>
		<input type="radio" name="gender" value="male" checked>&nbsp;Male</label>
		
		</td>
		<?php
		}
		?>
		<tr>
        <td>Father's Name:</td>
        <td colspan="5"><input type="text" class="form-control" id="father_name" name="father_name" value="<?php echo $row['father_name'];?>"readonly></td>
        </tr>
        <tr>
        <td>Date of Birth:</td>
        <td colspan="5"><input type="date" class="form-control" id="dob" name="dob" value="<?php echo $row['dob'];?>"readonly></td>
        </tr>
        <tr>
        <td>Address Communication: *</td>
        <td colspan="5"><input type="text" class="form-control" id="address" name="address" value="<?php echo $row['address'];?>"readonly></td>
        </tr>
        <tr>
        <td>Permanent Address:</td>
        <td colspan="5"><input type="text" class="form-control" id="paddress" name="paddress" value="<?php echo $row['paddress'];?>" readonly></td>
        </tr>
        <tr>
        <td>Mobile Number: *</td>
        <td colspan="5"><input type="text" class="form-control" id="phone" name="phone" value="<?php echo $row['phone'];?>" readonly></td>
        </tr>
       <tr>
        <td>Alternate Mobile Number: </td>
        <td colspan="5"><input type="text" class="form-control" id="a_phone" name="a_phone" value="<?php echo $row['alternative_phone'];?>"readonly></td>
        </tr>
        <tr>
        <td>Email ID : *</td>
        <td colspan="5"><input type="text" class="form-control" id="mail" name="mail" value="<?php echo $row['mail'];?>"readonly></td>
        </tr>
        <tr>
        <td>Aadhar Number: *</td>
        <td colspan="4"><input type="text" class="form-control" id="adharnumber" name="adharnumber" value="<?php echo $row['adharnumber'];?>"readonly></td>
        </tr>
        <tr>
        <td>Pan Number:</td>
        <td colspan="4"><input type="text" class="form-control" id="pannumber" name="pannumber" value="<?php echo $row['pannumber'];?>"readonly></td>
        </tr>
        <tr>
        <td>Voter ID:</td>
        <td colspan="4"><input type="text" class="form-control" id="voternumber" name="voternumber" value="<?php echo $row['voternumber'];?>"readonly></td>
        </tr>
		<tr>
        <td>Educational Details: *</td>
        <td colspan="4"><input type="text" class="form-control" id="educationalDetails" name="educationalDetails" value="<?php echo $row['educationalDetails'];?>"readonly></td>
        </tr>
			<?php 
		if($row['EmployeeStatus']="new")
		{
			?>
			<tr>
        <td>Employement Status:</td>
        <td colspan="4">	
			<input type="text" class="form-control" id="empstats" name="empstats" value="<?php echo "Fresher";?>"readonly>
				
		</td>
        </tr><tr id='employee_new'>
		<td>Year of Passout </td>
        <td colspan="4"><input type="text" class="form-control" id="year_of_pass" name="year_of_pass" value="<?php echo $row['year_of_pass'];?>"readonly></td>
        </tr>
			<?php 
		}
		else
		{
			?>
			<tr>
        <td>Employement Status:</td>
        <td colspan="4">	
			<input type="text" class="form-control" id="empstats" name="empstats" value="<?php echo "Experience";?>"readonly>
				
		</td>
        </tr>
		<tr id='employee_status'>
        <td>Company Name:</td>
        <td colspan="2"><input type="text" class="form-control" id="companyname" name="companyname" value="<?php echo $row['companyname'];?>"readonly></td>
		<td>No of Year Experience:</td>
        <td colspan="2"><input type="number" class="form-control" id="no_of_year" name="no_of_year" value="<?php echo $row['no_of_year'];?>"readonly></td>
        </tr>
			<?php 
		}
			?>

		</tr>
<?php 
$que=$con->query("select *,cf.qn_id as qid,c.id as id,c.status as status from candidate_form_details c right join candidate_round_details cf on c.id=cf.candid_id where c.id='$id'");

//echo "select * from candidate_form_details where id='$eid'";
$row_qn = $que->fetch(PDO::FETCH_ASSOC);
$que->execute();
$counts = $que->rowCount();
$qn_name=$row_qn['qid'];

	
$sec=$con->query("select * from question_master where qn_name='$qn_name'");
$row_sec = $sec->fetch(PDO::FETCH_ASSOC);
$section=$row_sec['section'];

$res=$con->query("select * from candicate_results where ueser_id='$id' and qn_name_id='$qn_name' group by ueser_id");
//echo "select * from candicate_results where ueser_id='$eid' and qn_name_id='$qn_name'";
$i=1;
while($row = $res->fetch(PDO::FETCH_ASSOC))
{
$qn=$row['question'];
$ans=$row['answer'];

$qn_mas=$con->query("select * from question_master where id='$qn' and answer_key='$ans'");
//echo "select * from question_master where id='$qn' and answer_key='$ans'";
//echo "select * from assessment_qn_master where id='$qn' and  answer_key='$ans' and section='$section'";
$row_answers = $qn_mas->fetch(PDO::FETCH_ASSOC);

$correct_answer=$row_answers['answer_key'];
 $row_count =$qn_mas->rowCount();

$qn_count=$i++;
if($row_count !=0)
{
 $cou[]=$row_count;
}
else
{
	$cou=0;
}
if($cou !="")
{
?>	
<table class="table table-bordered">
<h3><center>Apptitude & Logical Marks:</center></h3>
	<tr>  
	<td>Marks Scored:</td>
<td colspan="2"><input type="text" class="form-control" id="pctc" name="pctc" value="<?php echo count($cou); ?>" readonly></td>
</tr> 
</table>
<?php	
}
else{
	
}
}
?>
</table>
<table class="table table-bordered">

<h3><center>Technical Department:</center></h3>

<tr id="statushide">
<?php
$sql=$con->query("SELECT s.emp_name as ename,c.candid_id,i.name as depname FROM candidate_round_details c join staff_master s on c.person_id=s.id join interview_rounds i on c.round_id=i.id where c.candid_id='$id' and c.status=5
");


$cnt=1;
$k=0;
$rows1 = $sql->fetch(PDO::FETCH_ASSOC)
?>
<td>Technical Department Assign:</td>
<td colspan="2">
<input type="text" class="form-control" id="technical_department" name="technical_department" value="<?php echo  $rows1['depname']; ?>" readonly></td>
</tr>
<tr>
<td>Technical Department Person:</td>
<td colspan="2">
<input type="text" class="form-control" id="technical_department" name="technical_department" value="<?php echo  $rows1['ename']; ?>" readonly></td>

</tr>
</table>
 <table class="table table-bordered" id="recruiter_page">
<h3><center>Technical Skill Feedback Details</center></h3>
<tbody>

<?php

$sql=$con->query("SELECT s.emp_name as ename,c.candid_id,i.name as depname,c.*,s.*,i.*,d.*,r.* FROM candidate_round_details c 
join staff_master s on c.person_id=s.id join interview_rounds i on c.round_id=i.id 

JOIN domain_entries d ON c.candid_id=d.candids_id
join interview_round_name r on d.round_name_id=r.id where c.candid_id='$id' and c.status=5");


$cnt=1;
$k=0;
while($rows2 = $sql->fetch(PDO::FETCH_ASSOC))

{
	
		?>
<tr>

<td><?php echo  $rows2['Sec_name']; ?></td>
<td colspan="2">
<input type="text" class="form-control" id="section_name1" name="section_name1" value="<?php echo  $rows2['feedback']; ?>" readonly></td>




</tr>
<?php 
$k++;
$cnt=$cnt+1;
 }?>
 </tbody>
  </table>

	 
 <table class="table table-bordered">
<h3><center>HOD Department</center></h3>
 
  <?php

$sqll=$con->query("SELECT s.emp_name as ename,c.candid_id,i.name as depname FROM candidate_round_details c join staff_master s on c.person_id=s.id join interview_rounds i on c.round_id=i.id where c.candid_id='$id' and c.status='13'");


$cnt=1;
$k=0;
while($rows11 = $sqll->fetch(PDO::FETCH_ASSOC))

{
	
		?>
	  <tr>
	  
	 
<td>HOD NAME:</td>
<td colspan="2"><input type="text" class="form-control" id="head_name" name="head_name" value="<?php echo  $rows11['ename']; ?>" readonly></td>
</tr>
</table>
<?php
}
?>



<table class="table table-bordered" id="recruiter_page">
<h3><center>HOD Round Feedback Details</center></h3>
<tbody>

<?php

$sql=$con->query("SELECT s.emp_name as ename,c.candid_id,i.name as depname,c.*,s.*,i.*,d.*,r.* FROM candidate_round_details c 
join staff_master s on c.person_id=s.id 
join interview_rounds i on c.round_id=i.id 

JOIN domain_entries_hod d ON c.candid_id=d.candids_id
join interview_round_name r on d.round_name_id=r.id where c.candid_id='$id' and c.status='13'");


$cnt=1;
$k=0;
while($rows2 = $sql->fetch(PDO::FETCH_ASSOC))

{
	
		?>
<tr>

<td><?php echo  $rows2['Sec_name']; ?></td>
<td colspan="2">
<input type="text" class="form-control" id="section_name1" name="section_name1" value="<?php echo  $rows2['feedback']; ?>" readonly></td>




</tr>
<?php 
$k++;
$cnt=$cnt+1;
 }?>
 </tbody>
  </table>
  
  
<table class="table table-bordered">
<h3><center>HR Department</center></h3>
 
  <?php

$sqll=$con->query("SELECT s.emp_name as ename,c.candid_id,i.name as depname FROM candidate_round_details c join staff_master s on c.person_id=s.id join interview_rounds i on c.round_id=i.id where c.candid_id='$id' and c.status='35'");


$cnt=1;
$k=0;
while($rows11 = $sqll->fetch(PDO::FETCH_ASSOC))

{
	
		?>
	  <tr>
	  
	 
<td>HR NAME:</td>
<td colspan="2"><input type="text" class="form-control" id="head_name" name="head_name" value="<?php echo  $rows11['ename']; ?>" readonly></td>
</tr>
</table>
<?php
}
?>



<table class="table table-bordered" id="recruiter_page">
<h3><center>HR Round Feedback Details</center></h3>
<tbody>

<?php

$sql=$con->query("SELECT s.emp_name as ename,c.candid_id,i.name as depname,c.*,s.*,i.*,d.*,r.* FROM candidate_round_details c 
join staff_master s on c.person_id=s.id 
join interview_rounds i on c.round_id=i.id 

JOIN hr_domain_entries d ON c.candid_id=d.candids_id
join interview_round_name r on d.round_name_id=r.id where c.candid_id='$id' and c.status='35'");

$cnt=1;
$k=0;
while($rows2 = $sql->fetch(PDO::FETCH_ASSOC))

{
	
		?>
<tr>

<td><?php echo  $rows2['Sec_name']; ?></td>
<td colspan="2">
<input type="text" class="form-control" id="section_name1" name="section_name1" value="<?php echo  $rows2['feedback']; ?>" readonly></td>




</tr>
<?php 
$k++;
$cnt=$cnt+1;
 }?>
 </tbody>
  </table>
 
  <table class="table table-bordered">
<h3><center>MD Interview Feedback</center></h3>
<tbody>

<?php

$sql=$con->query("SELECT interview_rounds.id AS interviewroundid,interview_round_name.id AS intername_id,candidate_round_details.*,interview_rounds.*,interview_round_name.* FROM `candidate_round_details` 
INNER JOIN interview_rounds ON candidate_round_details.round_id=interview_rounds.id 
INNER JOIN interview_round_name ON interview_rounds.id=interview_round_name.inter_id 
WHERE candidate_round_details.candid_id='$id' AND candidate_round_details.status='3'
");

$cnt=0;

while($rows = $sql->fetch(PDO::FETCH_ASSOC))
{
?>
<tr>
<input type="hidden" class="form-control" id="count" name="count[]"  value="<?php echo count($cnt);?>" readonly>
<input type="hidden" class="form-control" id="interviewroundid" name="interviewroundid<?php echo $cnt; ?>"  value="<?php echo $rows['interviewroundid'];?>" readonly>
<input type="hidden" class="form-control" id="intername_id" name="intername_id<?php echo $cnt; ?>"  value="<?php echo $rows['intername_id'];?>" readonly>
<td><?php echo  $rows['Sec_name']; ?></td>
<td><input type="text" class="form-control" id="section_name1<?php echo $cnt; ?>" name="section_name<?php echo $cnt; ?>" ></td>


</tr>
<?php 
$cnt++;
 }?>
 </tbody>
 
      </table>
  <table class="table table-bordered">
<tr>
<td>Status *:</td>
<td colspan="5">
<select class="form-control" id="md_recruiter" name="md_recruiter" onchange="change_replace()">
<option value="">CHOOSE TYPE</option>
<option value="16" >Selected</option>
<!--option value="17">Waiting</option-->
<option value="18">Rejected</option></select></td>
</tr>
  </table>
<table class="table table-bordered">
<td colspan="6"><input type="button" class="btn btn-primary btn-md"  style="float:right;" name="Update" onclick="round_update()" value="Update"></td>
</table>
</form>
</div>


<script>
	function back_ctc()
	{
		$.ajax({
		type:"POST",
		url:"HRMS/interview_feedback/new.php",
		success:function(data){
		$("#main_content").html(data);
		}
		})
	}
	function check2() // Technical
{  
var len=$('#technical_page tr').length;	
len=len+1; 
$('#technical_page').append('<tr class="row_'+len+'"><td>Technical Skill:</td><td colspan="1"><input type="text" class="form-control" id="technicalquestion_'+len+'" name="technical_question[]"></td><td>Rating:</td><td colspan="5"><input type="radio" id="radio_'+len+'" name="performance1" value="1"><label for="performance"> 1 </label>  <input type="radio" id="radio_'+len+'"  name="performance1" value="2"><label for="performance"> 2 </label><input type="radio"  id="radio_'+len+'"  name="performance1" value="3"><label for="performance"> 3</label><input type="radio"  id="radio_'+len+'"  name="performance1" value="4"><label for="performance"> 4</label><input type="radio"  id="radio_'+len+'"  name="performance1" value="5"><label for="performance"> 5</label></td><td>Response:</td><td colspan="1"><select class="form-control" id="technicalanswer_'+len+'" name="technical_answer[]"><option value="">CHOOSE TYPE</option><option value="5" >Excellent</option><option value="4">Good</option><option value="3">Average</option><option value="2">Ok</option><option value="1">Bad</option></select></td></tr>'); 
}
 
  function round_update()
    {
    var id=$('#id').val();
	var user_id=$('#user_id').val();
	var interviewroundid=$('#interviewroundid').val();
	var intername_id=$('#intername_id').val();
	/* alert(id);
		alert(user_id);
			alert(interviewroundid);
				alert(intername_id); */
    var data = $('form').serialize();
    $.ajax({
    type:'GET',
  data:"id="+id+"&user_id="+user_id+"&interviewroundid="+interviewroundid+"&intername_id="+intername_id, data,
    url:'HRMS/interview_feedback/md_submit.php',

    success:function(data)
    {
      if(data==1)
      { 
        alert('Not updated');
      
      }
      else
      {
        alert("Update Successfully");
		feedback()
      }
      
    }       
    });
    }
    </script>