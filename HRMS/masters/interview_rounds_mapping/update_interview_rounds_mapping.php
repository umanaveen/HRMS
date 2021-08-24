<?php
require '../../../connect.php';
?>
<?php
if(isset($_REQUEST['submit']))
{
	$id=$_REQUEST['intid'];
	$round_id=$_REQUEST['round_id'];
	echo "222". $person_name=$_REQUEST['person_name'];
	$status=$_REQUEST['status'];
	$sql=$con->query("update interview_rounds_mapping set round_id='$round_id',person_name='$person_name',status='$status' where id='$id'");
	echo "update interview_rounds_mapping set round_id='$round_id',person_name='$person_name',status='$status' where id='$id'";
	if($sql)
{
	echo "<script>alert(' Updated Updated');</script>";
	header("location:/HRMS/index.php");
}
}?>
