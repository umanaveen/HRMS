<?php
require '../../connect.php';
$cid=$_REQUEST['id'];
$sql=$con->query("select c.status as candidate_status,cm.*,c.*,d.*,dm.* from candidate_form_details c left join company_master cm on c.company_name=cm.id left join designation_master d on c.position=d.id left join z_department_master dm on c.department=dm.id where c.id='$cid' order by c.id desc limit 1");
$fet=$sql->fetch();
?><div  class="card card-primary">
              <div class="card-header">
                <h3 class="card-title"><font size="5">Candidate View</font></h3>
				<a onclick="return back_ctc()" style="float: right;" data-toggle="modal" class="btn btn-danger"></i>Back</a>
              </div>


   <form method="POST" enctype="multipart/form-data">
    <!-- Post -->
    <table class="table table-bordered">
       <tr>
        <td><center><img src="/HRMS/HRMS/Recruitment/image/userlog/bluebase.png"  style="width:300px;height:150px;"></center></td>
        <td colspan="5"><center><h1><b>Bluebase Software services Pvt Ltd</b></h1></center></td>
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
        <td colspan="4"><input type="text" class="form-control" id="adharnumber" name="adharnumber" value="<?php echo $fet['adharnumber'];?>"readonly></td>
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
		<tr>
		<td>Photo:<td>
		<td><a href="/HRMS/HRMS/candidate/photo/<?php echo $fet['photo'];?>" download="<?php echo $fet['photo']; ?>"><?php echo $fet['photo']; ?></a></td>
		</tr>
		<tr>
		<td>Resume:<td>
		<td><a href="/HRMS/HRMS/candidate/uploads/<?php echo $fet['resume'];?>" download="<?php echo $fet['resume']; ?>"><?php echo $fet['resume']; ?></a></td>
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
</tr>

<table class="table table-bordered">
<h3><center>Technical Dept</center></h3>
<tr id="statushide">
<?php
$sql=$con->query("SELECT s.emp_name as ename,c.candid_id,i.name as depname FROM candidate_round_details c join staff_master s on c.person_id=s.id join interview_rounds i on c.round_id=i.id where c.candid_id='$cid' and c.status=5
");


$cnt=1;
$k=0;

while($rows1 = $sql->fetch(PDO::FETCH_ASSOC))
{
	?>
	<td>Technical Department Assign:</td>
<td colspan="2">
<input type="text" class="form-control" id="technical_department" name="technical_department" value="<?php echo  $rows1['depname']; ?>" readonly></td>
</tr>
<tr>
<td>Technical Department Person:</td>
<td colspan="2">
<input type="text" class="form-control" id="technical_department" name="technical_department" value="<?php echo  $rows1['ename']; ?>" readonly></td>

	<?php
}
?>

</tr>
</table>
</table>
<?php if($fet['candidate_status']=='5' ||$fet['candidate_status']=='13' ||$fet['candidate_status']=='16'){
	?>

<table class="table table-bordered" id="recruiter_page">
<h3><center>Technical Skill Feedback Details</center></h3>
<tbody>
<?php
$sql=$con->query("SELECT s.emp_name as ename,c.candid_id,i.name as depname,c.*,s.*,i.*,d.*,r.* FROM candidate_round_details c 
join staff_master s on c.person_id=s.id join interview_rounds i on c.round_id=i.id 

JOIN domain_entries d ON c.candid_id=d.candids_id
join interview_round_name r on d.round_name_id=r.id where c.candid_id='$cid' and c.status=5");
$cnt=1;
$k=0;
while($rows2 = $sql->fetch(PDO::FETCH_ASSOC))
{
?>
<tr>
<tr>
<td><?php echo  $rows2['Sec_name']; ?></td>
<td colspan="2">
<input type="text" class="form-control" id="section_name1" name="section_name1" value="<?php echo  $rows2['feedback']; ?>" readonly></td>
</tr>
</tr>
<?php 
$k++;
$cnt=$cnt+1;
 }?>
 </tbody>
  </table>
 
<?php } ?>
 <table class="table table-bordered">
<h3><center>HOD Department</center></h3>
 
  <?php

$sqll=$con->query("SELECT s.emp_name as ename,c.candid_id,i.name as depname FROM candidate_round_details c join staff_master s on c.person_id=s.id join interview_rounds i on c.round_id=i.id where c.candid_id='$cid' and c.status='13'");


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
<?php if($fet['candidate_status']=='13' ||$fet['candidate_status']=='16'){
	?>

<table class="table table-bordered" id="recruiter_page">
<h3><center>HOD Round Feedback Details</center></h3>
<tbody>

<?php

$sql=$con->query("SELECT s.emp_name as ename,c.candid_id,i.name as depname,c.*,s.*,i.*,d.*,r.* FROM candidate_round_details c 
join staff_master s on c.person_id=s.id 
join interview_rounds i on c.round_id=i.id 

JOIN domain_entries_hod d ON c.candid_id=d.candids_id
join interview_round_name r on d.round_name_id=r.id where c.candid_id='$cid' and c.status='13'");


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
<?php } ?>

   <table class="table table-bordered">
<h3><center>MD</center></h3>
 
  <?php

$sqll=$con->query("SELECT s.emp_name as ename,c.candid_id,i.name as depname FROM candidate_round_details c join staff_master s on c.person_id=s.id join interview_rounds i on c.round_id=i.id where c.candid_id='$cid' and c.status='16'");


$cnt=1;
$k=0;
while($rows11 = $sqll->fetch(PDO::FETCH_ASSOC))

{
	
		?>
	  <tr>
	  
	 
<td>MD NAME:</td>
<td colspan="2"><input type="text" class="form-control" id="head_name" name="head_name" value="<?php echo  $rows11['ename']; ?>" readonly></td>
</tr>
</table>
<?php
}
?>
<?php if($fet['candidate_status']=='16'){
	?>
 <table class="table table-bordered" id="recruiter_page">
<h3><center>MD Round Feedback Details</center></h3>
<tbody>

<?php

$sql=$con->query("SELECT s.emp_name as ename,c.candid_id,i.name as depname,c.*,s.*,i.*,d.*,r.* FROM candidate_round_details c 
join staff_master s on c.person_id=s.id 
join interview_rounds i on c.round_id=i.id 

JOIN domain_entries_md d ON c.candid_id=d.candids_id
join interview_round_name r on d.round_name_id=r.id where c.candid_id='$cid' and c.status='16'");


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
<?php } ?>

<table class="table table-bordered" id="recruiter_page">

<tbody>

<tr>
<td>Remarks</td>
<td colspan="2"><input type="text" class="form-control" id="reject_remark" name="reject_remark" ></td>
</tr>

<tr>

		<td><input type="button" class="btn btn-success" name="save" id="<?php echo $cid;?>" onclick="reject_update(this.id)" style="float:right;" value="Update"></td>
</tr>
</tbody>
</table>
    </form>
    </div>



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
	
	
	  
	function reject_update(v)
	{
		var reject_remark=$('#reject_remark').val();
		
		
	$.ajax({
	type:"POST",
	url:"HRMS/candidate/candidate_reject_update.php?id="+v+"&reject_remark="+reject_remark,
	success:function(data)
	{
		alert("Updated successfully");
		interview_candidate_list();
		//$('#table_view').html(data);
	}
	})
	}
</script>