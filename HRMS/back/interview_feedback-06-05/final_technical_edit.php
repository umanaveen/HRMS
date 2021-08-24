<?php
require '../../connect.php';
include("../../user.php");
 $id=$_REQUEST['id'];
$userrole=$_SESSION['userrole'];
$userid=$_SESSION['candidateid'];
$userid=$_SESSION['candidateid'];$staf=$con->query("select * from staff_master where candid_id='$userid'");
$sfetch=$staf->fetch();
$staid=$sfetch['id'];

$stmt = $con->prepare("select *,c.id as candidate_id from candidate_form_details c
INNER JOIN z_department_master d ON c.department = d.id  join designation_master dm on c.position=dm.id join candidate_round_details r on c.id=r.candid_id
where c.id='$id'
"); 
$stmt->execute(); 
$row = $stmt->fetch();

?>
<div class="container-fluid">
<div class="card mb-3">
<div class="card-header">
<i class="fa fa-table"></i> INTERVIEW FEEDBACK DETAILS EDIT
<a onclick="return back_ctc()" style="float: right;" data-toggle="modal" class="btn btn-primary"></i>Back</a>
</div>
<div class="card-body" id="printableArea">
<form method="POST" action="HRMS/interview_feedback/finalfeedback_submit.php">


<table class="table table-bordered">
<tr>
<td><center><img src="../../HRMS/image/userlog/bluebase.png" alt="quadsel" style="width:100px;height:50px;"></center></td>
<td colspan="5"><center><b>Bluebase Software services Pvt Ltd</b></center></td>
</tr>
<tr>
<td>Candidate Name:</td>

<td colspan="5">
<input type="hidden" class="form-control" id="id" name="id" value="<?php echo  $row['candidate_id'];?>"readonly>
<input type="hidden" class="form-control" id="user_id" name="user_id"  value="<?php echo  $staid;?>" readonly>
<input type="text" class="form-control" id="name" name="name" value="<?php echo  $row['first_name']." ". $row['first_name'];?>"readonly></td>

</tr>
<tr>
<td>POSITION:</td>
<td colspan="2"><input type="text" class="form-control" id="position" name="position" value="<?php echo  $row['designation_name'];?>"readonly></td>
<td>Department:</td>

<td colspan="2"><input type="text" class="form-control" id="dept_name" name="dept_name" value="<?php echo  $row['dept_name'];?>"readonly></td>
</tr>

<!--tr>
<td>Type:</td>

<td colspan="2"><input type="text" class="form-control" id="replacements" name="replacements" value="<?php echo  $row['replacement'];?>" readonly></td>
</tr>
<tr id="old_replace">
<td>Replaced Candidate Name:</td>
<td colspan="5"><input type="text" class="form-control" id="replaced_name" name="replaced_name" value="<?php echo  $row['replaced_name'];?>" readonly></td>
</tr>
<tr>
<td>Location/site:</td>
<td colspan="5"><input type="text" class="form-control" id="site" name="site" value="<?php echo  $row['site'];?>" readonly></td>
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
<tr>
<td>Current CTC</td>
<td colspan="5"><input type="text" class="form-control" id="current_ctc" name="current_ctc" value="" readonly></td>
</tr>
<tr>
<td>Expected CTC</td>
<td colspan="5"><input type="text" class="form-control" id="exp_ctc" name="exp_ctc" value="" readonly></td>
</tr>

<!--tr>
<td>Notice period</td>
<td colspan="5"><input type="number" class="form-control" id="notice_period" name="notice_period" value="<?php echo  $row['notice_period']; ?>" readonly></td>
</tr-->
<tr>
<td>Expected Date of Joining</td>
<td colspan="5"><input type="date" class="form-control" id="date_of_join" name="date_of_join" value="" readonly></td>
</tr>

<!--tr>
<td colspan="6"><center><b>Comments by Recruiter</b></center></td>
</tr-->


<!--tr id="statushide">

<td>Technical Department Assign:</td>
<td colspan="5">
<input type="text" class="form-control" id="technical_department" name="technical_department" value="<?php echo  $row['dept_name']; ?>" readonly></td>



</tr>
</table>
 <table class="table table-bordered" id="recruiter_page">
<h3><center>Interpersonal Skill</center></h3>
<tbody>

<!?php

$sql=$con->query("SELECT * FROM  technical_team_commands where candidate_id='$id'");


$cnt=1;
while($rows = $sql->fetch(PDO::FETCH_ASSOC))

{
	
		?>
<tr>
<input type="hidden" class="form-control" id="get_id" name="get_id" value="<!?php echo  $rows['candidate_id']; ?>">
<td>Question</td>
<td colspan="1"><input type="text" class="form-control" id="recruiterquestion_1" name="recruiter_question[]" value="<!?php echo  $rows['skill_question']; ?>" readonly></td>

<td>Rating:</td><td colspan="5">
<!?php if($rows['rating']== 1)
{
	?><input type="text" class="form-control"  value="<!?php echo  $rows['rating']; ?>" readonly>


<!?php } else if($rows['rating']== 2){?>
<input type="text" class="form-control"  value="<!?php echo  $rows['rating']; ?>" readonly>


<!?php
} else if($rows['rating']== 3){
?>
<input type="text" class="form-control"  value="<!?php echo  $rows['rating']; ?>" readonly>


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
<td>Response:</td><td colspan="1"><input type="text" class="form-control" id="recruiteranswer_1" name="recruiter_answer[]" value="<!?php echo  $rows['response']; ?>" readonly></td>

</tr>

<!?php 
$cnt=$cnt+1;
 }?>
 </tbody>
 
      </table-->
	  <?php

$sql=$con->query("SELECT * FROM technical_team_details where candidate_id='$id'");


$cnt=1;
$k=0;
while($rows1 = $sql->fetch(PDO::FETCH_ASSOC))
{
		?>
  <tr>
	  <input type="hidden" class="form-control" id="get_id" name="get_id" value="<?php echo  $rows1['candidate_id']; ?>">
	 
<td>Technical Person Name:</td>
<td colspan="5"><input type="text" class="form-control" id="head_name" name="head_name" value="<?php echo  $rows1['head_name']; ?>" readonly></td>
</tr>
<?php
}
?>	  
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
<td colspan="1"><input type="text" class="form-control" id="technical_question1" name="technical_question1[]" value="<?php echo  $rows2['skill']; ?>" readonly></td>


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
 	<tr>
<td>Status *:</td>
<td colspan="5">
<select class="form-control" id="status_recruiter" name="status_recruiters">
<option value="">CHOOSE TYPE</option>
<option value="13" >Select for Next Level</option>
<option value="14" >Waiting List</option>
<option value="15">Rejected</option></select></td>
</tr>			
<tr>
<td colspan="6"><center><b>Comment by HOD</b></center></td>
</tr>
<!--tr><td>Person Name</td>
<td colspan="5"><input type="text" class="form-control" id="command_technical_person" name="command_technical_person"></td>
</tr-->
<?php 
$sql=$con->query("SELECT * FROM final_technical_team_details where candidate_id='$id'");
$rows3 = $sql->fetch(PDO::FETCH_ASSOC);

?>
<table class="table table-bordered">
<tr>
<td>Overall Rating:</td>
<td colspan="5"><input type="text" class="form-control" id="rating" name="rating" value="<?php echo $rows3['rating']; ?>"></td>
</tr>
<tr>
<td>Remarks *:</td>
<td colspan="5"><input type="text" class="form-control" id="remarks" name="remarks" value="<?php echo $rows3['remarks']; ?>"></td>
</tr>	
</table>
<br>
<br>
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

<td>Question</td>
<td colspan="1"><input type="text" class="form-control" id="technical_question" name="technical_question[]" value="<?php echo  $rows2['skill']; ?>"></td>

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
	<select class="form-control" id="technicalanswer_1" name="technical_answer[]" onchange="change_replace()">
<option value="1">Bad</option>
<option value="5" >Excellent</option>
<option value="4">Good</option>
<option value="3">Average</option>
<option value="2">Ok</option>

</select>
<?php
}
elseif($res==2)
{
?>	
	<select class="form-control" id="technicalanswer_1" name="technical_answer[]" onchange="change_replace()">
<option value="2">Ok</option>
<option value="1">Bad</option>
<option value="5" >Excellent</option>
<option value="4">Good</option>
<option value="3">Average</option>
</select>
<?php
}
elseif($res==3)
{
?>	
	<select class="form-control" id="technicalanswer_1" name="technical_answer[]" onchange="change_replace()">
<option value="3">Average</option>
<option value="1">Bad</option>
<option value="2">Ok</option>
<option value="5" >Excellent</option>
<option value="4">Good</option>

</select>
<?php
}
elseif($res==4)
{
?>	
	<select class="form-control" id="technicalanswer_1" name="technical_answer[]" onchange="change_replace()">
<option value="4">Good</option>
<option value="1">Bad</option>
<option value="2">Ok</option>
<option value="3">Average</option>
<option value="5" >Excellent</option>
</select>
<?php
}
elseif($res==5)
{
?>	
	<select class="form-control" id="technicalanswer_1" name="technical_answer[]" onchange="change_replace()">
<option value="5" >Excellent</option>
<option value="1">Bad</option>
<option value="2">Ok</option>
<option value="3">Average</option>
<option value="4">Good</option>
</select>
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
<input type="button" class="btn btn-primary btn-md"  style="float:right;" name="Update" onclick="feedback_update1()" value="Update"> 
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
 function feedback_update1()
    {
    var id=$('#get_id').val();
	alert(id);
    var candidate_id=$('#get_ids').val();
   alert(get_ids);
	//alert(candidate_id);
    var data = $('form').serialize();
    $.ajax({
    type:'GET',
    data:"id="+id+"&candidate_id="+candidate_id, data,
	
    url:'HRMS/interview_feedback/final_technical_update.php',
    success:function(data)
    {
      if(data==1)
      { 
        alert('Not');
      
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