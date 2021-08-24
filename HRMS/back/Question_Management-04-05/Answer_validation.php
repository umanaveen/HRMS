<?php
//echo "<pre>";print_r($_GET);exit();

require '../../connect.php';
for($i=1;$i<=24;$i++)
{
	
	    $qn_id=$_GET['qnid'];
	    $session_id=$_GET['candidateid'];
		$question=$_GET['question_value_'.$i];
		$answer=$_GET['answer_value_'.$i];
		$status='20';

$sql=$con->query("insert into candicate_results(qn_name_id,ueser_id,question,answer) values('$qn_id','$session_id','$question','$answer')");
echo "insert into candicate_results(qn_name_id,ueser_id,question,answer) values('$qn_id','$session_id','$question','$answer')";
$upd=$con->query("update candidate_form_details set status='$status' where id='$session_id'");
}
exit();
?>