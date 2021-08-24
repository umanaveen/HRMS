<?php
require '../../connect.php';
 $id=$_REQUEST['id'];

$stmt = $con->prepare("select *,c.id as candidate_id from candidate_form_details c
INNER JOIN z_department_master d ON c.department = d.id  join designation_master dm on c.position=dm.id join candidate_round_details r on c.id=r.candid_id
where c.id='$id'"); 
$stmt->execute(); 
$row = $stmt->fetch();

?>

<div class="container-fluid">
<div class="card mb-3">
<div class="card-header">
<i class="fa fa-table"></i> INTERVIEW FEEDBACK DETAILS VIEW
<a onclick="return back_ctc()" style="float: right;" data-toggle="modal" class="btn btn-danger"></i>Back</a>
</div>
<div class="card-body" id="printableArea">
<form role="form" name="" action="" method="post" enctype="multipart/type">

<table class="table table-bordered">
<tr>
<td><center><img src="../../HRMS/image/userlog/bluebase.png" alt="quadsel" style="width:100px;height:50px;"></center></td>
<td colspan="5"><center><b>Bluebase Software services Pvt Ltd</b></center></td>
</tr>
<tr>
<td>Candidate Name:</td>
<td colspan="5"><input type="text" class="form-control" id="name" name="name" value="<?php echo  $row['first_name']." ". $row['last_name'];?>"readonly></td>

</tr>
<tr>
<td>POSITION:</td>
<td colspan="2"><input type="text" class="form-control" id="position" name="position" value="<?php echo  $row['designation_name'];?>"readonly></td>
<td>Department:</td>
<td colspan="2">

<input type="text" class="form-control" id="tech_department" name="tech_department" value="<?php echo  $row['dept_name'];?>"readonly>
</td>
</tr>
<!--tr>
<td>Type:</td>
<td colspan="5">

<input type="text" class="form-control" id="replacements" name="replacements" value="<?php echo  $row['replacement'];?>"readonly>
</td>
</tr>


<tr>
<td>Replaced Candidate Name:</td>
<td colspan="2"><input type="text" class="form-control" id="replaced_name" name="replaced_name" value="<?php echo  $row['replaced_name']; ?>" readonly></td>
</tr>

<tr>
<td>Location/site:</td>
<td colspan="5"><input type="text" class="form-control" id="site" name="site" value="<?php echo  $row['site']; ?>" readonly></td>
</tr>

<tr>
<td>Reason for waiting to leave the present job:</td>
<td colspan="5"><input type="text" class="form-control" id="Reason_leave" name="Reason_leave" value="<?php echo  $row['reason_leave']; ?>" readonly></td>
</tr>
<tr>
<td>Reference Name</td>
<td colspan="5"><input type="text" class="form-control" id="reference" name="reference" value="<?php echo  $row['reference']; ?>" readonly></td>
</tr-->

<tr>
<td>Total Years of Experience</td>
<td colspan="5"><input type="text" class="form-control" id="tot_year_exp" name="tot_year_exp" value="" readonly></td>
</tr>


<!--tr>
<td>Notice period</td>
<td colspan="5"><input type="number" class="form-control" id="notice_period" name="notice_period" value="<?php echo  $row['notice_period']; ?>" readonly></td>
</tr-->

<tr>
<td>Expected Date of Joining</td>
<td colspan="5"><input type="text" class="form-control" id="date_of_join" name="date_of_join" value="" readonly></td>
</tr>

<!--tr>
<td colspan="6"><center><b>Comments by Recruiter</b></center></td>
</tr>

<tr>
<td>Recruiter Name:</td>
<td colspan="5"><input type="text" class="form-control" id="recruiter_name" name="recruiter_name" value="<?php echo  $row['recruiter_name']; ?>" readonly></td>
</tr>
</table>
<table class="table table-bordered">
<tr>
<td>Overall Rating:</td>
<td colspan="5"><input type="text" class="form-control" id="ratings" name="ratings" value="<?php echo  $row['ratings']; ?>" readonly></td>
</tr>
<tr>
<td>Remarks *:</td>
<td colspan="5"><input type="text" class="form-control" id="remarks" name="remarks" value="<?php echo  $row['remarks']; ?>" readonly></td>
</tr>
<tr>
<td>Status *:</td>
<td colspan="5">
<select class="form-control" id="status_recruiter" name="status_recruiter" readonly>
<?php
if($row['status_recruiter'] == 0){
	?>
	
<option value="">Select for Next Level</option>
<?php
}
else if($row['status_recruiter'] == 1){
	?>
	<option value="">Waiting List</option>
	<?php
} else {
?>
<option value="">Rejected</option>
<?php
}
?>
</select></td>
</tr>

<tr id="statushide">

<td>Technical Department Assign:</td>
<td colspan="5">
<select class="form-control" id="technical_department" name="technical_department" readonly>
<option value=""><?php echo $row['tech_department']; ?> </option>

</select>
</td>

</tr>
</table>
 <table class="table table-bordered" id="recruiter_page">
<h3><center>Interpersonal Skill</center></h3>
<tbody>

<!?php

$sql=$con->query("SELECT * FROM  recruiter_commands where candidate_id='$id'");


$cnt=1;
while($rows = $sql->fetch(PDO::FETCH_ASSOC))

{
	
		?>
<tr>
<input type="hidden" class="form-control" id="get_id" name="get_id" value="<?php echo  $rows['candidate_id']; ?>">
<td>Question</td>
<td colspan="1"><input type="text" class="form-control" id="recruiterquestion_1" name="recruiter_question[]" value="<?php echo  $rows['skill_question']; ?>" readonly></td>

<td>Rating:</td>
<td colspan="5">
<!?php if($rows['rating']== 1)
{
	?>
	<input type="text" class="form-control"  value="<?php echo  $rows['rating']; ?>" readonly>


<!?php } else if($rows['rating']== 2){?>
<input type="text" class="form-control"  value="<?php echo  $rows['rating']; ?>" readonly>


<!?php
} else if($rows['rating']== 3){
?>
<input type="text" class="form-control"  value="<?php echo  $rows['rating']; ?>" readonly>

<!?php
} else if($rows['rating']== 4) {

?>
<input type="text" class="form-control"  value="<?php echo  $rows['rating']; ?>" readonly>

<!?php
} else if($rows['rating']== 5) {
?>
<input type="text" class="form-control"  value="<?php echo  $rows['rating']; ?>" readonly>
<!?php
}?></td>
<td>Response:</td><td colspan="1"><input type="text" class="form-control" id="recruiteranswer_1" name="recruiter_answer[]" value="<?php echo  $rows['response']; ?>" readonly></td>

</tr>
<!?php 
$cnt=$cnt+1;
 }?>
 </tbody-->
 
      </table>
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
</table>
	 <?php

$sql=$con->query("SELECT s.emp_name as ename,c.candid_id FROM candidate_round_details c join staff_master s on c.person_id=s.id where c.candid_id='$id' and c.status=5");


$cnt=1;
$k=0;
$rows1 = $sql->fetch(PDO::FETCH_ASSOC)
	
		?>
<tr>
<input type="hidden" class="form-control" id="get_id" name="get_id<?php echo $k;?>" value="<?php echo  $rows1['candid_id']; ?>">
<td>Technical Person Name:
<td colspan="3"><input type="text" class="form-control" id="head_name" name="head_name" value="<?php echo  $rows1['ename']; ?>" readonly></td>
</tr>

 <table class="table table-bordered" id="recruiter_page">
<h3><center>Technical Skill</center></h3>
<tbody>

<?php

$sql=$con->query("SELECT * FROM  technical_team_commands where technical_id='$id'");


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
 }
?>

<?php










$sql=$con->query("SELECT s.emp_name as ename,c.candid_id FROM candidate_round_details c join staff_master s on c.person_id=s.id where c.candid_id='$id' and c.status=13");


$cnt=1;
$k=0;
$rows1 = $sql->fetch(PDO::FETCH_ASSOC)

	
		?>
		</table>
 <tr>
<input type="hidden" class="form-control" id="get_id" name="get_id<?php echo $k;?>" value="<?php echo  $rows1['candid_id']; ?>">
<td>HOD Name: </td>
<td colspan="3"><input type="text" class="form-control" id="head_name" name="head_name" value="<?php echo  $rows1['ename']; ?>" readonly></td>
</tr>
<table class="table table-bordered" id="recruiter_page">
<h3><center>Interpersonal Skill</center></h3>
<tbody>

<?php

$sql=$con->query("SELECT * FROM  final_technical_team_commands where technical_id='$id'");


$cnt=1;
$k=0;
while($rows2 = $sql->fetch(PDO::FETCH_ASSOC))

{
	
		?>
<tr>
 <input type="hidden" class="form-control" id="get_ids" name="get_ids<?php echo $k;?>" value="<?php echo  $rows2['id']; ?>">


<td colspan="1"><input type="text" class="form-control" id="technical_question" name="technical_question[]" value="<?php echo  $rows2['skill']; ?>" readonly></td>

<td>Rating:</td><td colspan="5">
<?php if($rows2['rating']== 1)
{
	?>
<input type="radio"  id="radio_1"  name="performances_<?php echo $k;?>"   id="performance_1" value="1"  checked>
<label for="performance"> 1</label>
<input type="radio" name="performances_<?php echo $k;?>" id="performance_1" value="2"  onclick="RadioValue('2')">
<label for="performance"> 2</label>
<input type="radio" name="performances_<?php echo $k;?>"  id="performance_1" value="3"  onclick="RadioValue('3')">
<label for="performance"> 3</label>
<input type="radio" name="performances_<?php echo $k;?>"  id="performance_1" value="4"  onclick="RadioValue('4')">
<label for="performance"> 4</label>
<input type="radio" name="performances_<?php echo $k;?>"  id="performance_1" value="5"  onclick="RadioValue('5')">
<label for="performance"> 5</label></td>

<?php } else if($rows2['rating']== 2){?>
<td colspan="5">
<input type="radio"  id="radio_1"  name="performances_<?php echo $k;?>"   id="performance_1" value="1" "RadioValue('1')" >
<label for="performance"> 1</label>
<input type="radio" name="performances_<?php echo $k;?>"  id="performance_1" value="2"  onclick="RadioValue('2')" checked>
<label for="performance"> 2</label>
<input type="radio" name="performances_<?php echo $k;?>"  id="performance_1" value="3"  onclick="RadioValue('3')">
<label for="performance"> 3</label>
<input type="radio" name="performances_<?php echo $k;?>"  id="performance_1" value="4"  onclick="RadioValue('4')">
<label for="performance"> 4</label>
<input type="radio" name="performances_<?php echo $k;?>"  id="performance_1" value="5"  onclick="RadioValue('5')">
<label for="performance"> 5</label></td>

<?php
} else if($rows2['rating']== 3){
?>
<td colspan="5">
<input type="radio"  id="radio_1"  name="performances_<?php echo $k;?>"  id="performance_1" value="1" "RadioValue('1')" >
<label for="performance"> 1</label>
<input type="radio" name="performances_<?php echo $k;?>"  id="performance_1" value="2"  onclick="RadioValue('2')" >
<label for="performance"> 2</label>
<input type="radio" name="performances_<?php echo $k;?>"  id="performance_1" value="3"  onclick="RadioValue('3')" checked>
<label for="performance"> 3</label>
<input type="radio" name="performances_<?php echo $k;?>"  id="performance_1" value="4"  onclick="RadioValue('4')">
<label for="performance"> 4</label>
<input type="radio" name="performances_<?php echo $k;?>"  id="performance_1" value="5"  onclick="RadioValue('5')">
<label for="performance"> 5</label></td>

<?php
} else if($rows2['rating']== 4) {

?>
<td colspan="5">
<input type="radio"  id="radio_1"  name="performances_<?php echo $k;?>"   id="performance_1" value="1" "RadioValue('1')" >
<label for="performance"> 1</label>
<input type="radio" name="performances_<?php echo $k;?>"  id="performance_1" value="2"  onclick="RadioValue('2')" >
<label for="performance"> 2</label>
<input type="radio" name="performances_<?php echo $k;?>" id="performance_1" value="3"  onclick="RadioValue('3')">
<label for="performance"> 3</label>
<input type="radio" name="performances_<?php echo $k;?>" id="performance_1" value="4"  onclick="RadioValue('4')" checked>
<label for="performance"> 4</label>
<input type="radio" name="performances_<?php echo $k;?>"  id="performance_1" value="5"  onclick="RadioValue('5')">
<label for="performance"> 5</label></td>

<?php
} else if($rows2['rating']== 5) {
?>
<td colspan="5">
<input type="radio"  id="radio_1"  name="performances_<?php echo $k;?>"  id="performance_1" value="1" "RadioValue('1')" >
<label for="performance"> 1</label>
<input type="radio" name="performances_<?php echo $k;?>"  id="performance_1" value="2"  onclick="RadioValue('2')" >
<label for="performance"> 2</label>
<input type="radio" name="performances_<?php echo $k;?>" id="performance_1" value="3"  onclick="RadioValue('3')">
<label for="performance"> 3</label>
<input type="radio" name="performances_<?php echo $k;?>"  id="performance_1" value="4"  onclick="RadioValue('4')">
<label for="performance"> 4</label>
<input type="radio" name="performances_<?php echo $k;?>"  id="performance_1" value="5"  onclick="RadioValue('5')" checked>
<label for="performance"> 5</label></td>
<?php
}?>
<td>Response:</td><td colspan="1">
<?php
$res=$rows2['response']; 
if($res==1)
{
	?>
	<input type="textbox" class="form-control" id="technicalanswer_1" name="technical_answer" value="<?php echo "Bad";?>"readonly>
<?php
}
elseif($res==2)
{
?>	
	<input type="textbox" class="form-control" id="technicalanswer_1" name="technical_answer" value="<?php echo "Ok";?>"readonly>
<?php
}
elseif($res==3)
{
?>	
	<input type="textbox" class="form-control" id="technicalanswer_1" name="technical_answer" value="<?php echo "Average";?>"readonly>
<?php
}
elseif($res==4)
{
?>	
	<input type="textbox" class="form-control" id="technicalanswer_1" name="technical_answer" value="<?php echo "Good";?>"readonly>
<?php
}
elseif($res==5)
{
?>	
	<input type="textbox" class="form-control" id="technicalanswer_1" name="technical_answer" value="<?php echo "Excellent";?>" readonly>
<?php
}
?>

<!--input type="text" class="form-control" id="technical_answer" name="technical_answer[]" value="<?php echo  $rows2['response']; ?>" -->
</td>

</tr>
<?php 
$k++;
$cnt=$cnt+1;
 }?>
 </tbody> 
      </table>
<?php 
$sql=$con->query("SELECT * FROM final_technical_team_details where candidate_id='$id'");
$rows3 = $sql->fetch(PDO::FETCH_ASSOC);

?>
<table class="table table-bordered">
<tr>
<td>Overall Rating:</td>
<td colspan="5"><input type="text" class="form-control" id="rating" name="rating" value="<?php echo $rows3['rating']; ?>" readonly></td>
</tr>
<tr>
<td>Feedback *:</td>
<td colspan="5"><input type="text" class="form-control" id="remarks" name="remarks" value="<?php echo $rows3['remarks']; ?>" readonly></td>
</tr>	
</table>
 <!--table class="table table-bordered" id="recruiter_page">
<h3><center>Technical Skill</center></h3>
<tbody>

<!?php

$sql=$con->query("SELECT * FROM  final_technical_team_commands where technical_id='$id'");


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
<!?php if($rows2['rating']== 1)
{
	?>
	<input type="text" class="form-control"  value="<?php echo  $rows2['rating']; ?>" readonly>


<!?php } else if($rows2['rating']== 2){?>
<input type="text" class="form-control"  value="<?php echo  $rows2['rating']; ?>" readonly>


<!?php
} else if($rows2['rating']== 3){
?>
<input type="text" class="form-control"  value="<?php echo  $rows2['rating']; ?>" readonly>

<!?php
} else if($rows2['rating']== 4) {

?>
<input type="text" class="form-control"  value="<?php echo  $rows2['rating']; ?>" readonly>

<!?php
} else if($rows2['rating']== 5) {
?>
<input type="text" class="form-control"  value="<?php echo  $rows2['rating']; ?>" readonly>
<!?php
}?></td>
<td>Response:</td><td colspan="1"><input type="text" class="form-control" id="technical_answer1" name="technical_answer[]" value="<?php echo  $rows2['response']; ?>" readonly></td>

</tr> 
<!?php 
$k++;
$cnt=$cnt+1;
 }
 
 
 ?>
 </tbody>
 
      </table-->
</form>
</div>
</div>
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

    </script>