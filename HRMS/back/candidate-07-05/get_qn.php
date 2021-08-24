<?php
require '../../connect.php';
$roundid=$_REQUEST['id'];
$sql=$con->query("select * from interview_rounds where id='$roundid'");
$fet=$sql->fetch();
$roundname=$fet['name'];
if($roundname=="Assessment")
{
	?>

		<select class="form-control" id="qn_name" name="qn_name" onchange="get_qn(this.value)" >
		<!--?php 
		
		$qns=$con->query("SELECT * FROM question_name_master ");
		$qndis = $qns->fetch(PDO::FETCH_ASSOC)
		?-->
		<option value="">Select Question</option>
		<?php $stmt22 = $con->query("SELECT * FROM question_name_master where status=1");
		while ($row22 = $stmt22->fetch()) 
		{
		?>
		<option value="<?php echo $row22['id'];?>"> <?php echo $row22['name'];?></option>
		<?php 
		}
		?>
		</select>
	

<?php	
}

else
{
	?>
		<select class="form-control" id="allocate_person" name="allocate_person" onchange="get_qn(this.value)" >
		<!--?php 
		
		$qns=$con->query("SELECT * FROM question_name_master ");
		$qndis = $qns->fetch(PDO::FETCH_ASSOC)
		?-->
		<option value="">Select round</option>
		<?php $stmt22 = $con->query("SELECT * FROM interview_rounds_mapping i join staff_master s on i.person_name=s.id  where i.status=1 and i.round_id='$roundid'");
		while ($row22 = $stmt22->fetch()) 
		{
		?>
		<option value="<?php echo $row22['id'];?>"> <?php echo $row22['emp_name'];?></option>
		<?php 
		}
		?>
		</select>
<?php
}
?>