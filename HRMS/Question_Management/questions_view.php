<?php
require '../../connect.php';
$qn_name=$_REQUEST['id'];
echo "hii";
$sql=$con->query("SELECT distinct section FROM question_master a join section_master s on a.section=s.id
where qn_name='$qn_name'");
echo "SELECT distinct section,name,a.id as id FROM question_master a join section_master s on a.section=s.id
where qn_name='$qn_name'";
$cnt=1;
while($row1 = $sql->fetch(PDO::FETCH_ASSOC))
//echo "<pre>";print_r($row);exit();
{
	$secid=$row1['section'];
	
	$sec_master=$con->query("select name from section_master where id='$secid'");
	$sec_name=$sec_master->fetch(PDO::FETCH_ASSOC);
	
	$sql1=$con->query("SELECT *,a.id as id,s.name as name FROM question_master a join section_master s on a.section=s.id
where section='$secid' and qn_name='$qn_name'");
echo "SELECT * FROM question_master a join section_master s on a.section=s.id
where section='$secid' and qn_name='$qn_name'";
?>
<tr><td><h4><b><?php echo $sec_name['name'];?></b></h4>	</td>
<?php

	while($row = $sql1->fetch(PDO::FETCH_ASSOC))
	{
	
		?>
	
<tr>
<td ><?php echo $cnt;?>.</td>

<td style="font-size: 18px;">

 <?php echo $row['Questions'];?>
 <br>
 <br>
 <?php echo "A."?> &nbsp&nbsp&nbsp<?php echo $row['Option_A'];?>

<br>

<?php echo "B."?> &nbsp&nbsp&nbsp <?php echo $row['Option_B'];?>

<br>

<?php echo "C."?> &nbsp&nbsp&nbsp <?php echo $row['Option_C'];?>

<br>

<?php echo "D."?> &nbsp&nbsp&nbsp <?php echo $row['Option_D'];?>
<br>
Correct Option :
<?php echo $row['answer_key'];?>
</td>
<td><input type="button" class="btn btn-success btn-sm edit btn-flat" name="edit" id="<?php echo $row['id'];?>" value="Edit" onclick="qn_edit(this.id)" ></td>

</tr>

<?php 

$cnt=$cnt+1;

 }

?>

 </tr>
 <?php
 
}
 $total=$cnt;
?>

<script>
 function qn_edit(v)
 {
	 alert(v);
	$.ajax({
	type:"POST",
	url:"HRMS/Question_Management/question_edit.php?id="+v,
	success:function(data)
	{
		$(".content").html(data);
	}
	})
}
</script>
