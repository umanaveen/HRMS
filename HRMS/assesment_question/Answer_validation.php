<?php
//echo "<pre>";print_r($_GET);exit();

require '../../connect.php';
echo "count".$count=$_REQUEST['count'];
for($i=1;$i<$count;$i++)
{
	    $session_id=$_GET['candidateid'];
	    $qn_id=$_GET['qn_id'];
		$answer=$_GET['answer_value_'.$i];
		$question=$_GET['question_value_'.$i];
		
		$date=date('Y-m-d');
		

$sql=$con->query("insert into employee_assessment_result(emp_id,qn_name_id,question,answer,status,created_on) values('$session_id','$qn_id','$question','$answer','0','$date')");

$upd=$con->query("update emp_assessment_login_detail set status=2 where staff_id='$session_id' ");

//echo "<pre>";print_r($sql);
//echo "insert into employee_assessment_result(emp_id,question,answer) values('$session_id','$question','$answer')";
}
exit();
?>