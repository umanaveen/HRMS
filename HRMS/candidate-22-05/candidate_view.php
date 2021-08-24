<?php
require '../../connect.php';
$cid=$_REQUEST['id'];
$sql=$con->query("select * from candidate_form_details c left join company_master cm on c.company_name=cm.id join designation_master d on c.position=d.id join z_department_master dm on c.department=dm.id where c.id='$cid' order by c.id desc limit 1");
$fet=$sql->fetch();
?>
<div class="content-wrapper" style="padding-left: 50px;">
<a onclick="return back_ctc()" style="float: right;" data-toggle="modal" class="btn btn-danger"><i class="fa fa-plus"></i>Back</a>
   <form method="POST" enctype="multipart/form-data">
    <!-- Post -->
    <table class="table table-bordered">
        <tr>
        <td><center><img src="../../Recruitment/image/userlog/bluebase.png" alt="quadsel" style="width:100px;height:50px;"></center></td>
        <td colspan="5"><center><b>Bluebase Software services Pvt Ltd</b></center></td>
        </tr>
        <tr>
        <td colspan="6"><center><b>Application for Candidate</b></center></td>
        </tr>
		 <!--tr>
		<td>Company: *</td>
		<td colspan="5">
		<input type="text" class="form-control" id="companys" name="companys" value="<!?php echo $fet['companyname'];?>" readonly>
		 </td>
        </tr-->
        <tr>
        <td>Post Applied for: *</td>
        <td colspan="2">
		<input type="text" class="form-control" id="companys" name="companys" value="<?php echo $fet['designation_name'];?>" readonly>
		</td>
		<td>Department: *</td>
		<td colspan="2">
		<input type="text" class="form-control" id="companys" name="companys" value="<?php echo $fet['dept_name'];?>" readonly>
		</td>
        </tr>
        <tr>
        <td colspan="6"><center><b>Personal Details</b></center></td>
        </tr>
        <tr>
        <td>First Name: *</td>
        <td colspan="2"><input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo $fet['first_name'];?>" readonly ></td>
		<td>Last Name: *</td>
        <td colspan="2"><input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo $fet['last_name'];?>" readonly></td>
        </tr>
        <tr>
		<td>Gender:</td>
		<?php 
		if($fet['gender']="female")
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
        <td colspan="5"><input type="text" class="form-control" id="father_name" name="father_name" value="<?php echo $fet['father_name'];?>"readonly></td>
        </tr>
        <tr>
        <td>Date of Birth:</td>
        <td colspan="5"><input type="date" class="form-control" id="dob" name="dob" value="<?php echo $fet['dob'];?>"readonly></td>
        </tr>
        <tr>
        <td>Address Communication: *</td>
        <td colspan="5"><input type="text" class="form-control" id="address" name="address" value="<?php echo $fet['address'];?>"readonly></td>
        </tr>
        <tr>
        <td>Permanent Address:</td>
        <td colspan="5"><input type="text" class="form-control" id="paddress" name="paddress" value="<?php echo $fet['paddress'];?>" readonly></td>
        </tr>
        <tr>
        <td>Mobile Number: *</td>
        <td colspan="5"><input type="text" class="form-control" id="phone" name="phone" value="<?php echo $fet['phone'];?>" readonly></td>
        </tr>
       <tr>
        <td>Alternate Mobile Number: </td>
        <td colspan="5"><input type="text" class="form-control" id="a_phone" name="a_phone" value="<?php echo $fet['alternative_phone'];?>"readonly></td>
        </tr>
        <tr>
        <td>Email ID : *</td>
        <td colspan="5"><input type="text" class="form-control" id="mail" name="mail" value="<?php echo $fet['mail'];?>"readonly></td>
        </tr>
        <tr>
        <td>Aadhar Number: *</td>
        <td colspan="4"><input type="text" class="form-control" id="adharnumber" name="adharnumber" ovalue="<?php echo $fet['adharnumber'];?>"readonly></td>
        </tr>
        <tr>
        <td>Pan Number:</td>
        <td colspan="4"><input type="text" class="form-control" id="pannumber" name="pannumber" value="<?php echo $fet['pannumber'];?>"readonly></td>
        </tr>
        <tr>
        <td>Voter ID:</td>
        <td colspan="4"><input type="text" class="form-control" id="voternumber" name="voternumber" value="<?php echo $fet['voternumber'];?>"readonly></td>
        </tr>
		<tr>
        <td>Educational Details: *</td>
        <td colspan="4"><input type="text" class="form-control" id="educationalDetails" name="educationalDetails" value="<?php echo $fet['educationalDetails'];?>"readonly></td>
        </tr>
			<?php 
		if($fet['EmployeeStatus']="new")
		{
			?>
			<tr>
        <td>Employement Status:</td>
        <td colspan="4">	
			<input type="text" class="form-control" id="empstats" name="empstats" value="<?php echo "Fresher";?>"readonly>
				
		</td>
        </tr><tr id='employee_new'>
		<td>Year of Passout </td>
        <td colspan="4"><input type="text" class="form-control" id="year_of_pass" name="year_of_pass" value="<?php echo $fet['year_of_pass'];?>"readonly></td>
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
        <td colspan="2"><input type="text" class="form-control" id="companyname" name="companyname" value="<?php echo $fet['companyname'];?>"readonly></td>
		<td>No of Year Experience:</td>
        <td colspan="2"><input type="number" class="form-control" id="no_of_year" name="no_of_year" value="<?php echo $fet['no_of_year'];?>"readonly></td>
        </tr>
			<?php 
		}
			?>
        		
				<?php 
				$rsel=$con->query("select *,i.name as interviewname,q.name as qname from candidate_round_details c join interview_rounds i on c.round_id=i.id left join staff_master m on c.person_id=m.id left join question_name_master q on c.qn_id=q.id where c.candid_id='$cid' and c.status=1 or c.status=2 or c.status=3");
				$rfet=$rsel->fetch();
				$qname=$rfet['qname'];
				?>
	<tr>
		<td>Round </td>
		<td colspan="2">
		<input type="text" name="round" id="round" class="form-control" value="<?php echo $rfet['interviewname']; ?>" readonly>
		</td>
		<?php
		if($qname==' ')
		{
			?>
		<td>Allocated Person </td>
		<td colspan="2">
		<input type="text" name="round" id="round" class="form-control" value="<?php echo $rfet['emp_name']; ?>" readonly>
		</td>
		<?php
		}
		else
		{
		?>
		<td>Question Name </td>
		<td colspan="2">
		<input type="text" name="round" id="round" class="form-control" value="<?php echo $rfet['qname']; ?>" readonly>
		</td>		
	<?php		
		}
		?>
					
		<td colspan="4" id="change_qn">
		</td>
    </tr>
<tr>	
<?php 
$que=$con->query("select *,cf.qn_id as qid,c.id as id,c.status as status from candidate_form_details c right join candidate_round_details cf on c.id=cf.candid_id where c.id='$cid'");

//echo "select * from candidate_form_details where id='$eid'";
$row_qn = $que->fetch(PDO::FETCH_ASSOC);
$que->execute();
$counts = $que->rowCount();
$qn_name=$row_qn['qid'];

	
$sec=$con->query("select * from question_master where qn_name='$qn_name'");
$row_sec = $sec->fetch(PDO::FETCH_ASSOC);
$section=$row_sec['section'];

$res=$con->query("select * from candicate_results where ueser_id='$cid' and qn_name_id='$qn_name' group by ueser_id");
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
else{
	$cou[]="";
}


if($cou !="")
{
?>	
<table class="table table-bordered">
<h3><center>Apptitude & Logical Marks:</center></h3>
	<tr>  

<td colspan="2"><input type="text" class="form-control" id="pctc" name="pctc" value="<?php echo count($cou); ?>" readonly></td>
</tr> 
</table>
<?php	
}
else{
	
}
}

?>
</tr>
<tr id="statushide">
<?php
$sql=$con->query("SELECT s.emp_name as ename,c.candid_id,i.name as depname FROM candidate_round_details c join staff_master s on c.person_id=s.id join interview_rounds i on c.round_id=i.id where c.candid_id='$cid' and c.status=5
");


$cnt=1;
$k=0;
$rows1 = $sql->fetch(PDO::FETCH_ASSOC)
?>
<td>Technical Department Assign:</td>
<td colspan="5">
<input type="text" class="form-control" id="technical_department" name="technical_department" value="<?php echo  $rows1['depname']; ?>" readonly></td>
</tr>
<tr>
<td>Technical Department Person:</td>
<td colspan="5">
<input type="text" class="form-control" id="technical_department" name="technical_department" value="<?php echo  $rows1['ename']; ?>" readonly></td>

</tr>
</table>
<tr>
 <?php

$sql=$con->query("SELECT * FROM technical_team_details where candidate_id='$cid'");


$cnt=1;
$k=0;
while($rows1 = $sql->fetch(PDO::FETCH_ASSOC))

{
	
		?>
	  <tr>
	  <input type="hidden" class="form-control" id="get_id" name="get_id<?php echo $k;?>" value="<?php echo  $rows1['candidate_id']; ?>">
<!--td>Technical Person Name:</td>
<td colspan="5"><input type="text" class="form-control" id="head_name" name="head_name" value="<?php echo  $rows1['head_name']; ?>" readonly></td-->
</tr>
<?php
}
?>
 <table class="table table-bordered" id="recruiter_page">
<h3><center>Technical Skill</center></h3>
<tbody>

<?php

$sql=$con->query("SELECT * FROM  technical_team_commands where technical_id='$cid'");


$cnt=1;
$k=0;
while($rows2 = $sql->fetch(PDO::FETCH_ASSOC))

{
	
		?>
<tr>
 <input type="hidden" class="form-control" id="get_ids" name="get_ids" value="<?php echo  $rows2['id']; ?>">

<td>Question</td>
<td colspan="1"><input type="text" class="form-control" id="technical_question" name="technical_question[]" value="<?php echo  $rows2['skill']; ?>" readonly></td>
<td>Rating:</td>
<td colspan="5">
<?php if($rows2['rating']== 1)
{
	?>
	<input type="text" class="form-control"  value="<?php echo  $rows2['rating']; ?>" readonly>


<?php } else if($rows2['rating']== 2){?>
<input type="text" class="form-control"  value="<?php echo  $rows2['rating']; ?>" readonly>


<?php
} else if($rows2['rating']== 3){
?>
<input type="text" class="form-control"  value="<?php echo  $rows2['rating']; ?>" readonly>

<?php
} else if($rows2['rating']== 4) {

?>
<input type="text" class="form-control"  value="<?php echo  $rows2['rating']; ?>" readonly>

<?php
} else if($rows2['rating']== 5) {
?>
<input type="text" class="form-control"  value="<?php echo  $rows2['rating']; ?>" readonly>
<?php
}?></td>
<td>Response:</td><td colspan="1"><input type="text" class="form-control" id="technical_answer1" name="technical_answer[]" value="<?php echo  $rows2['response']; ?>" readonly></td>

</tr>
<?php 
$k++;
$cnt=$cnt+1;
 }?>
 </tbody>
  </table>
  <?php
  $techdeta=$con->query("select * from technical_team_details where candidate_id='$cid'");
  $fetdata=$techdeta->fetch(PDO::FETCH_ASSOC);
  $techdeta->execute();
  $rowcou=$techdeta->rowCount();
  if($rowcou !=0)
  {
  ?>
  <tr>
  <td>Rating:</td><td colspan="1"><input type="text" class="form-control" id="rating" name="rating" value="<?php echo  $fetdata['rating']; ?>" readonly></td>
  </tr>
 <tr>
  <td>Remarks:</td><td colspan="1"><input type="text" class="form-control" id="remarks" name="remarks" value="<?php echo  $fetdata['remarks']; ?>" readonly></td>
  </tr>
  <?php
  }
  else
  {
	  
  }
  ?>
  <?php

$sqll=$con->query("SELECT s.emp_name as ename,c.candid_id,i.name as depname FROM candidate_round_details c join staff_master s on c.person_id=s.id join interview_rounds i on c.round_id=i.id where c.candid_id='$cid' and c.status='13'");


$cnt=1;
$k=0;
while($rows11 = $sqll->fetch(PDO::FETCH_ASSOC))

{
	
		?>
	  <tr>
	  <input type="hidden" class="form-control" id="get_id" name="get_id<?php echo $k;?>" value="<?php echo  $rows11['candid_id']; ?>">
<td>HOD Name:</td>
<td colspan="5"><input type="text" class="form-control" id="head_name" name="head_name" value="<?php echo  $rows11['ename']; ?>" readonly></td>
</tr>
<?php
}
?>
<table class="table table-bordered" id="recruiter_page">
<h3><center>Interpersonal Skill</center></h3>
<tbody>

<?php

$sql2=$con->query("SELECT * FROM  final_technical_team_commands where technical_id='$cid'");


$cnt=1;
$k=0;
while($rows22 = $sql2->fetch(PDO::FETCH_ASSOC))

{
	
		?>
<tr>
 <input type="hidden" class="form-control" id="get_ids" name="get_ids" value="<?php echo  $rows22['id']; ?>">


<td colspan="1"><input type="text" class="form-control" id="technical_question" name="technical_question[]" value="<?php echo  $rows22['skill']; ?>" readonly></td>
<td>Rating:</td>
<td colspan="5"><input type="text" class="form-control"  value="<?php echo  $rows22['rating']; ?>" readonly>
</td>

<td>Response:</td><td colspan="1"><input type="text" class="form-control" id="technical_answer1" name="technical_answer[]" value="<?php echo  $rows22['response']; ?>" readonly></td>

</tr>
<?php 
$k++;
$cnt=$cnt+1;
 }?>
 </tbody>
  </table>
  
</tr>
<?php
  $techdeta1=$con->query("select * from final_technical_team_details where candidate_id='$cid'");
  $fetdata1=$techdeta1->fetch();
  $techdeta1->execute();
  $rowcou1=$techdeta1->rowCount();
  if($rowcou1 !=0)
  {
  ?>
  <tr>
  <td>Rating:</td><td colspan="1"><input type="text" class="form-control" id="rating" name="rating" value="<?php echo  $fetdata1['rating']; ?>" readonly></td>
  </tr>
 <tr>
  <td>Remarks:</td><td colspan="1"><input type="text" class="form-control" id="remarks" name="remarks" value="<?php echo  $fetdata1['remarks']; ?>" readonly></td>
  </tr>
  <?php
  }
  else
  {
	  
  }
  ?>
	<table class="table table-bordered">
<h3><center>MD COMMENTS</center></h3>
<?php
$mdsel=$con->query("select * from md_commands where candidate_id='$cid' and md_status='16'");
//echo "select * from md_commands where candidate_id='$id' and status='17'";
$mfet=$mdsel->fetch(PDO::FETCH_ASSOC);
?>
<tr>
<td>CTC :*</td>
<td colspan="5"><input type="text" class="form-control" id="ctc" name="ctc" value="<?php echo $mfet['ctc']; ?>" readonly></td>
</tr>
<tr>
<td>Remarks *:</td>
<td colspan="5"><input type="text" class="form-control" id="remarks_md" name="remarks_md" value="<?php echo $mfet['md_commands']; ?>" readonly></td>
</tr>	

        <!--tr>  
        <td colspan="6">
		<input type="hidden" name="cid" id="cid" value="<!?php echo $cid; ?>">
		<input type="button" class="btn btn-success" name="save"  onclick="candidate_update()" style="float:right;" value="save"></td>
        </tr-->
        </table>
        <!-- /.post -->
    </form>
    </div>
</div>

<!--script>
function candidate_update()
{
	var field=1;
	
	var data = $('form').serialize();
	$.ajax({
		type:'GET',
		data:"field=" +field, data,
		url:'/HRMS/HRMS/candidate/candidate_question_allocate.php',
		success:function(data)
		{
			if(data==0)
			{
				alert("Form Data has been Submitted ... Hr will contact you please wait");
				//window.location.href="login/logout.php";
				candidate_list();
			}
			else
			{
				alert("Form Data has not been Submitted");
				candidate_list();
			}	
		}       
	});
}
</script-->
<script>
function back_ctc()
{
		$.ajax({
		type:"POST",
		url:"HRMS/candidate/candidate_list.php",
		success:function(data){
		$("#main_content").html(data);
		}
		})
	}
</script>