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
     <div class="card card-info">
              <div class="card-header">
                
				              <center><h3 class="card-title"><b>INTERVIEW FEEDBACK DETAILS EDIT</b></h3></center>
		<a onclick="return back()" style="float: right;" data-toggle="modal" class="btn btn-danger"></i>Back</a>
              </div>
<form role="form" name="" action="" method="post" enctype="multipart/type">
<form method="POST" action="HRMS/interview_feedback/feedback_submit.php">
<input type="hidden" name="userrole" id="userrole" value="<?php echo  $userrole; ?>">
<table class="table table-bordered">
 <tr>
        <td><center><img src="/HRMS/HRMS/Recruitment/image/userlog/bluebase.png"  style="width:300px;height:150px;"></center></td>
        <td colspan="5"><center><h1><b>Bluebase Software services Pvt Ltd</b></h1></center></td>
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
		
		</tr>
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
			<?php

$sql=$con->query("SELECT *,s.emp_name as tech_person, c.candid_id as candid_id FROM candidate_round_details c join staff_master s on c.person_id=s.id where c.candid_id='$id' and c.person_id !=''");
$rows1 = $sql->fetch(PDO::FETCH_ASSOC);
?>
 <tr>
	  <input type="hidden" class="form-control" id="get_id1" name="get_id" value="<?php echo $rows1['candid_id']; ?>">
	 
<td>Technical Person Name:</td>
<td colspan="5"><input type="text" class="form-control" id="head_name" name="head_name" value="<?php echo  $rows1['tech_person']; ?>" readonly></td>
</tr>
</table>

  <table class="table table-bordered">
<h3><center>Interview Feedback</center></h3>
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
<input type="button" class="btn btn-primary btn-md"  style="float:right;" name="Update" onclick="round_update()" value="Update"> </form>
</div>


<script> 


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

function back()
    {
    $.ajax({
    type:"POST",
    url:"/hrms/HRMS/interview_feedback/new.php",
    success:function(data){
 $("#main_content").html(data);
    }
    })
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
    url:'HRMS/interview_feedback/feedback_submit.php',

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