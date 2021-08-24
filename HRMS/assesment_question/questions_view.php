<?php
require '../../connect.php';
$qn_name=$_REQUEST['id'];

$sql=$con->query("SELECT distinct section,name FROM assessment_qn_master a join section_master s on a.section=s.id
where qn_name='$qn_name'");
//echo "SELECT distinct section,name FROM assessment_qn_master a join section_master s on a.section=s.id where qn_name='$qn_name'";

$cnt=1;
while($row1 = $sql->fetch(PDO::FETCH_ASSOC))
//echo "<pre>";print_r($row);exit();
{
	$secid=$row1['section'];
	$sql1=$con->query("SELECT * FROM assessment_qn_master a join section_master s on a.section=s.id
where section='$secid' and qn_name='$qn_name'");
echo "SELECT * FROM assessment_qn_master a join section_master s on a.section=s.id
where section='$secid' and qn_name='$qn_name'";
?>
<tr><td><h4><b><?php echo $row1['name'];?></b></h4>	</td>
<?php

	while($row = $sql1->fetch(PDO::FETCH_ASSOC))
	{
	
		?>
	
<tr>
<td class="center"><?php echo $cnt;?>.</td>

<td style="font-size: 18px;">

<?php echo $row['Questions'];?>
<br>
<br>
  <?php echo "A.".$row['Option_A'];?>

<br>

<?php echo "B.". $row['Option_B'];?>

<br>

<?php echo "C.". $row['Option_C'];?>

<br>

<?php echo "D.".$row['Option_D'];?> 
</td>



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

