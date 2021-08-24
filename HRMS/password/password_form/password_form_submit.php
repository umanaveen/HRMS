<?php
require '../../../connect.php';
include("../../../user.php");
$candidateid=$_SESSION['candidateid'];

$password_master=$_REQUEST['password_master'];
if($password_master==1 || $password_master=='6'||$password_master=='7'||$password_master=='8'||$password_master=='9'||$password_master=='10')
{
   
$org=$_REQUEST['org1'];
$Link=$_REQUEST['Link1'];
$Username=$_REQUEST['Username1'];
$password=$_REQUEST['password1'];
$R_mailid=$_REQUEST['R_mailid'];
$Re_number=$_REQUEST['Re_number'];

$sql11=$con->query("INSERT INTO `password_recovery`(`password_master_id`, `organization`, `link`, `username`, `Password`, 
`recovery_mailid`,`phone_number`,`created_on`)values
 ('$password_master','$org','$Link','$Username','$password','$R_mailid','$Re_number','$candidateid')");
 echo "INSERT INTO `password_recovery`(`password_master_id`, `organization`, `link`, `username`, `Password`, 
 `recovery_mailid`,`phone_number`,`created_on`)values
  ('$password_master','$org','$Link','$Username','$password','$R_mailid','$Re_number','$candidateid')";
 
 $last_id = $con->lastInsertId();
 $department_1=$_REQUEST['department'];
 //print_r($department_1);
 $project_name_1=$_REQUEST['project_name'];
$department_count=count($department_1);
for($i=0;$i<$department_count;$i++)
{
$departments= $department_1[$i];
 $project_names= $project_name_1[$i];
$sql2=$con->query("INSERT INTO `password_recovery_emp`( `password_master_id`, `recovery_id`, `department`, `employee`) 
 VALUES('$password_master','$last_id','$departments','$project_names')");  
echo "INSERT INTO `password_recovery_emp`( `password_master_id`, `recovery_id`, `department`, `employee`) 
VALUES('$password_master','$last_id','$departments','$project_names')";   
}

} 
else if($password_master==2||$password_master==3||$password_master==4)
{
   
$org=$_REQUEST['org2'];
$Link=$_REQUEST['Link2'];
$Username=$_REQUEST['Username2'];
$password=$_REQUEST['password2'];

$sql11=$con->query("INSERT INTO `password_recovery`(`password_master_id`, `organization`, `link`, `username`, `Password`,`created_on`)
 values
 ('$password_master','$org','$Link','$Username','$password','$candidateid')");
echo "INSERT INTO `password_recovery`(`password_master_id`, `organization`, `link`, `username`, `Password`)
 values
 ('$password_master','$org','$Link','$Username','$password')";
 $last_id = $con->lastInsertId();
 $department_1=$_REQUEST['department'];
 print_r($department_1);
 $project_name_1=$_REQUEST['project_name'];
$department_count=count($department_1);
for($i=0;$i<$department_count;$i++)
{
$departments= $department_1[$i];
 $project_names= $project_name_1[$i];
$sql2=$con->query("INSERT INTO `password_recovery_emp`( `password_master_id`, `recovery_id`, `department`, `employee`) 
 VALUES('$password_master','$last_id','$departments','$project_names')");  
echo "INSERT INTO `password_recovery_emp`( `password_master_id`, `recovery_id`, `department`, `employee`) 
VALUES('$password_master','$last_id','$departments','$project_names')";   
}
}
else if($password_master==11)
{
   
$org=$_REQUEST['org3'];
$Link=$_REQUEST['Link3'];
$Username=$_REQUEST['Username3'];
$password=$_REQUEST['password3'];
$UAN=$_REQUEST['UAN'];
$sql11=$con->query("INSERT INTO `password_recovery`(`password_master_id`, `organization`, `link`, `username`, `Password`, `uan_number`,`created_on`)
 values
 ('$password_master','$org','$Link','$Username','$password','$UAN','$candidateid')");
echo "INSERT INTO `password_recovery`(`password_master_id`, `organization`, `link`, `username`, `Password`)
 values
 ('$password_master','$org','$Link','$Username','$password')";
 $last_id = $con->lastInsertId();
 $department_1=$_REQUEST['department'];
 
 $project_name_1=$_REQUEST['project_name'];
$department_count=count($department_1);
for($i=0;$i<$department_count;$i++)
{
 echo $departments= $department_1[$i];
 echo $project_names= $project_name_1[$i];
$sql2=$con->query("INSERT INTO `password_recovery_emp`( `password_master_id`, `recovery_id`, `department`, `employee`) 
 VALUES('$password_master','$last_id','$departments','$project_names')");  
echo "INSERT INTO `password_recovery_emp`( `password_master_id`, `recovery_id`, `department`, `employee`) 
VALUES('$password_master','$last_id','$departments','$project_names')";   
}
}
 else if($password_master==12)
{
   
$org=$_REQUEST['org4'];
$Link=$_REQUEST['Link4'];
$Username=$_REQUEST['Username4'];
$password=$_REQUEST['password4'];
$esNumber=$_REQUEST['esNumber'];

$sql11=$con->query("INSERT INTO `password_recovery`(`password_master_id`, `organization`, `link`, `username`, `Password`, 
`Esic_number`,`created_on`)values
 ('$password_master','$org','$Link','$Username','$password','$esNumber','$candidateid')");
 echo "INSERT INTO `password_recovery`(`password_master_id`, `organization`, `link`, `username`, `Password`, 
 `Esic_number`)
  values
  ('$password_master','$org','$Link','$Username','$password','$esNumber')";
 
 $last_id = $con->lastInsertId();
 $department_1=$_REQUEST['department'];
 print_r($department_1);
 $project_name_1=$_REQUEST['project_name'];
$department_count=count($department_1);
for($i=0;$i<$department_count;$i++)
{
$departments= $department_1[$i];
 $project_names= $project_name_1[$i];
$sql2=$con->query("INSERT INTO `password_recovery_emp`( `password_master_id`, `recovery_id`, `department`, `employee`,`created_on`) 
 VALUES('$password_master','$last_id','$departments','$project_names','$candidateid')");  
echo "INSERT INTO `password_recovery_emp`( `password_master_id`, `recovery_id`, `department`, `employee`) 
VALUES('$password_master','$last_id','$departments','$project_names','$candidateid')";   
}

} 
else if($password_master==13)
{
   
$org=$_REQUEST['org5'];
$bank=$_REQUEST['bank1'];
$acount_type=$_REQUEST['acount_type1'];
$acc_num=$_REQUEST['acc_num1'];
$acc_hol_name=$_REQUEST['acc_hol_name1'];
$ifsc=$_REQUEST['ifsc1'];
$Branch=$_REQUEST['Branch1'];
$acc_open_date=$_REQUEST['acc_open_date1'];
$minimum_balance=$_REQUEST['minimum_balance1'];
$net_Link=$_REQUEST['net_Link'];
$NetUsername=$_REQUEST['NetUsername'];
$netpassword=$_REQUEST['netpassword'];
$debitcard_number=$_REQUEST['debitcard_number1'];
$card_hoder_name=$_REQUEST['card_hoder_name1'];
$Type_card=$_REQUEST['Type_card1'];
  $month_year=$_REQUEST['month_year1'];


$sql11=$con->query("INSERT INTO `password_recovery`(`password_master_id`, `organization`, `link`, `username`, `Password`, 
`Name_bank`, `Account_type`, `Account_number`, `Account_holder_name`, `ifsc`, `Branch`, `Account_opening_date`, `Minimum_balance`,
`Card_number`, `Card_holder_name`, `Type_card`, `exp_month_year`,`created_on`)
values
 ('$password_master','$org','$net_Link','$NetUsername','$netpassword','$bank','$acount_type','$acc_num',
 '$acc_hol_name','$ifsc','$Branch','$acc_open_date','$minimum_balance','$debitcard_number','$card_hoder_name','$Type_card','$month_year','$candidateid')"); 

 echo "INSERT INTO `password_recovery`(`password_master_id`, `organization`, `link`, `username`, `Password`, 
 `Name_bank`, `Account_type`, `Account_number`, `Account_holder_name`, `ifsc`, `Branch`, `Account_opening_date`, `Minimum_balance`,
 `Card_number`, `Card_holder_name`, `Type_card`, `exp_month_year`,`created_on`)
 values
  ('$password_master','$org','$net_Link','$NetUsername','$netpassword','$bank','$acount_type','$acc_num',
  '$acc_hol_name','$ifsc','$Branch','$acc_open_date','$minimum_balance','$debitcard_number','$card_hoder_name','$Type_card','$month_year','$candidateid')";
 
 echo $last_id = $con->lastInsertId();
 $department_1=$_REQUEST['department'];
 //print_r($department_1);
 $project_name_1=$_REQUEST['project_name'];
$department_count=count($department_1);
for($i=0;$i<$department_count;$i++)
{
$departments= $department_1[$i];
 $project_names= $project_name_1[$i];
$sql2=$con->query("INSERT INTO `password_recovery_emp`( `password_master_id`, `recovery_id`, `department`, `employee`) 
 VALUES('$password_master','$last_id','$departments','$project_names')");  
echo "INSERT INTO `password_recovery_emp`( `password_master_id`, `recovery_id`, `department`, `employee`) 
VALUES('$password_master','$last_id','$departments','$project_names')";   
}
}
else if($password_master==14)
{
   
$org=$_REQUEST['org6'];
$bank=$_REQUEST['bank2'];

$card_hoder_name=$_REQUEST['holder_name2'];
$Type_card=$_REQUEST['Type_card2'];
$month_year=$_REQUEST['month_year2'];
$credit_limit=$_REQUEST['credit_limit2'];

$sql11=$con->query("INSERT INTO `password_recovery`(`password_master_id`, `organization`,  
`Name_bank`,`Card_holder_name`, `Type_card`, `exp_month_year`, `credit_limit`,`created_on`)values
 ('$password_master','$org','$bank','$card_hoder_name','$Type_card','$month_year','$credit_limit','$candidateid')");

 echo "INSERT INTO `password_recovery`(`password_master_id`, `organization`,  
 `Name_bank`,`Card_holder_name`, `Type_card`, `exp_month_year`, `credit_limit`)values
  ('$password_master','$org','$bank','$acount_type','$card_hoder_name',
  '$Type_card','$month_year','$credit_limit')";
 
 $last_id = $con->lastInsertId();
 $department_1=$_REQUEST['department'];
 print_r($department_1);
 $project_name_1=$_REQUEST['project_name'];
$department_count=count($department_1);
for($i=0;$i<$department_count;$i++)
{
$departments= $department_1[$i];
 $project_names= $project_name_1[$i];
$sql2=$con->query("INSERT INTO `password_recovery_emp`( `password_master_id`, `recovery_id`, `department`, `employee`) 
 VALUES('$password_master','$last_id','$departments','$project_names')");  
echo "INSERT INTO `password_recovery_emp`( `password_master_id`, `recovery_id`, `department`, `employee`) 
VALUES('$password_master','$last_id','$departments','$project_names')";   
}
} 
?>
