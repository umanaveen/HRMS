<?php

require '../../../../connect.php';
require '../../../../user.php';


$staff_id=$_REQUEST['staff_id'];
$staff_salary_amount=$_REQUEST['staff_salary_amount'];
$staff_scale=$_REQUEST['staff_scale'];
$staff_id=$_REQUEST['staff_id'];

if($staff_salary_amount>21000)
{
	$esic = 0;
}
else
{
	$esic = 2;
}

$statement = $con->query("UPDATE staff_master SET scale_master_id='$staff_scale',payroll_deduction_id='$esic',salary_amount='$staff_salary_amount' WHERE candid_id='$staff_id'");

if($statement)
{
	echo 1;
}

?>