<?php
require '../../connect.php';
 $id=$_REQUEST['id'];

$stmt = $con->prepare("SELECT c.status as candidate_status,t.rating as overall_rating,m.*,c.*,t.*,d.*,dm.* FROM candidate_form_details c 
left join `technical_team_details` t on c.id=t.candidate_id 
left join technical_team_commands m on t.id=m.technical_id 
left join z_department_master d on c.department=d.id 
join designation_master dm on c.position=dm.id
WHERE c.id='$id'"); 
$stmt->execute(); 
$row = $stmt->fetch();

?>
<div class="card card-info">
              <div class="card-header">
                
				              <center><h3 class="card-title"><b>INTERVIEW FEEDBACK DETAILS VIEW</b></h3></center>
		<a onclick="return back_ctc()" style="float: right;" data-toggle="modal" class="btn btn-danger"></i>Back</a>
              </div>
			  

<form role="form" name="" action="" method="post" enctype="multipart/type">

<table class="table table-bordered">
 <tr>
        <td><center><img src="/HRMS/HRMS/Recruitment/image/userlog/bluebase.png"  style="width:300px;height:150px;"></center></td>
        <td colspan="5"><center><h1><b>Bluebase Software services Pvt Ltd</b></h1></center></td>
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
<h3><center>Technical Skill</center></h3>
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

    </script>