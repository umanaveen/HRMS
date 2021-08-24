<?php
require '../../user.php';
require '../../connect.php';

$candidate_name=$_REQUEST['candidate_name'];
$present_ctc=$_REQUEST['pctc'];
$expected_ctc=$_REQUEST['ectc']; // emp no 
$ctc_offered=$_REQUEST['ctc_offer'];
$offered_take_home=$_REQUEST['take_home'];
$offered_designation=$_REQUEST['designation'];
$dept_head_approval=$_REQUEST['head_approval'];
$dept_director_approval=$_REQUEST['director_approval'];
$CUG=$_REQUEST['CUG'];
$mail_id=$_REQUEST['mail'];
//$target=$_REQUEST['target'];
$system=$_REQUEST['system'];
$seating=$_REQUEST['seating'];
$status=1;
$userid=1;
$today = date("Y-m-d H:i:s"); 

$statement = $con->prepare("INSERT INTO ctc_approval_table(candidate_name, present_ctc, expected_ctc, ctc_offered, offered_take_home, offered_designation, dept_head_approval, dept_director_approval,CUG,mail_id,system,seating,status,created_by,created_on)VALUES (:candidate_name,:present_ctc,:expected_ctc,:ctc_offered,:offered_take_home,:offered_designation,:dept_head_approval,:dept_director_approval,:CUG,:mail_id,:system,:seating,:status,:userid,:today)");
$statement->execute(array(':candidate_name' => $candidate_name,':present_ctc'=>$present_ctc,':expected_ctc'=>$expected_ctc,':ctc_offered'=>$ctc_offered,':offered_take_home'=>$offered_take_home,':offered_designation'=>$offered_designation,':dept_head_approval'=>$dept_head_approval,':dept_director_approval'=>$dept_director_approval,':CUG'=>$CUG,':mail_id'=>$mail_id,':system'=>$system,':seating'=>$seating,':status'=>$status,':userid'=>$userid,':today'=>$today));
print_r($statement->errorInfo());
if($statement)
{
	echo 1;
}
else
{
	echo 0;
} 

/* $statement = mysqli_query($con,"INSERT INTO x_table_ctcapproval(employee_id,pctc,ectc,ctc_offer,take_home,designation,head_approval,director_approval,cug,mail,target,system,seating,status,,created_by,created_on)VALUES ('$candidate_name','$present_ctc','$expected_ctc','$offered_take_home','$offered_take_home','$offered_designation','$dept_head_approval','$dept_director_approval','$cug','$mail_id','$target','$system','$seating','$status',,'$userid',now())");

CALL ctc_approval_table_insert('jai','123','123','100','1230','100','100','100','100','100','100','123','152',1,1,'2020-09-18 14:20:20');

$statement = $con->prepare("CALL ctc_approval_table_insert(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");

$statement->bindParam(1, $candidate_name, PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 4000); 
$statement->bindParam(2, $present_ctc, PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 4000); 
$statement->bindParam(3, $expected_ctc, PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 4000); 
$statement->bindParam(4, $ctc_offered, PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 4000); 
$statement->bindParam(5, $offered_take_home, PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 4000); 
$statement->bindParam(6, $offered_designation, PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 4000); 
$statement->bindParam(7, $dept_head_approval, PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 4000); 
$statement->bindParam(8, $dept_director_approval, PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 4000); 
$statement->bindParam(9, $CUG, PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 4000); 
$statement->bindParam(10, $mail_id, PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 4000); 
$statement->bindParam(11, $target, PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 4000); 
$statement->bindParam(12, $system, PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 4000); 
$statement->bindParam(13, $seating, PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 4000);  
$statement->bindParam(14, $status, PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 4000); 
$statement->bindParam(15, $user_id, PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 4000); 
$statement->bindParam(16, $today, PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 4000);

// call the stored procedure

$statement->execute() or die(print_r($statement->errorInfo(), true)); */



/* if (!$statement->execute()) {
    print_r($statement->errorInfo());
}

if($statement)
{
	echo 0;
}
else
{
	echo 1;
}  */ 


?>