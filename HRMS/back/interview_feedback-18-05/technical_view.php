<?php
require '../../connect.php';
 $id=$_REQUEST['id'];

$stmt = $con->prepare("SELECT *,t.rating as overall_rating FROM candidate_form_details c left join `technical_team_details` t on c.id=t.candidate_id left join technical_team_commands m on t.id=m.technical_id left join z_department_master d on c.department=d.id join designation_master dm on c.position=dm.id
WHERE c.id='$id'"); 
$stmt->execute(); 
$row = $stmt->fetch();

?>

<div class="container-fluid">
<div class="card mb-3">
<div class="card-header">
<i class="fa fa-table"></i> INTERVIEW FEEDBACK DETAILS VIEW
<a onclick="return back_ctc()" style="float: right;" data-toggle="modal" class="btn btn-primary"></i>Back</a>
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
<td colspan="5"><input type="text" class="form-control" id="name" name="name" value="<?php echo  $row['first_name'];?>"readonly></td>

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
<td>Reference Name</td>
<td colspan="5"><input type="text" class="form-control" id="reference" name="reference" value="<?php echo  $row['reference']; ?>" readonly></td>
</tr>

<tr>
<td>Total Years of Experience</td>
<td colspan="5"><input type="text" class="form-control" id="tot_year_exp" name="tot_year_exp" value="<?php echo  $row['tot_year_exp']; ?>" readonly></td>
</tr-->

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
</tr>

<tr>
<td>Recruiter Name:</td>
<td colspan="5"><input type="text" class="form-control" id="recruiter_name" name="recruiter_name" value="" readonly></td>
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
<!?php
if($row['status_recruiter'] == 0){
	?>
	
<option value="">Select for Next Level</option>
<!?php
}
else if($row['status_recruiter'] == 1){
	?>
	<option value="">Waiting List</option>
	<!?php
} else {
?>
<option value="">Rejected</option>
<!?php
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
<td colspan="1"><input type="text" class="form-control" id="recruiterquestion_1" name="recruiter_question[]" value="<!?php echo  $rows['skill_question']; ?>" readonly></td>

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
 </tbody>
 
      </table-->

	 <!--?php

$sql=$con->query("SELECT * FROM technical_team_details where candidate_id='$id'");


$cnt=1;
$k=0;
$rows1 = $sql->fetch(PDO::FETCH_ASSOC)
	
		?-->
 <!--tr>
<input type="hidden" class="form-control" id="get_id" name="get_id<?php echo $k;?>" value="<?php echo  $rows1['candidate_id']; ?>">
<td>Technical Person Name:
<td colspan="3"><input type="text" class="form-control" id="head_name" name="head_name" value="<?php echo  $rows1['head_name']; ?>" readonly></td>
</tr-->

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

 </tbody>
 
      </table>
	  
	  <table class="table table-bordered">
<tr>
<td>Overall Rating:</td>
<td colspan="5"><input type="text" class="form-control" id="ratings" name="ratings" value="<?php echo  $row['overall_rating']; ?>" readonly></td>
</tr>
<tr>
<td>Remarks *:</td>
<td colspan="5"><input type="text" class="form-control" id="remarks" name="remarks" value="<?php echo  $row['remarks']; ?>" readonly></td>
</tr>

</table>
	  
	  
	  
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