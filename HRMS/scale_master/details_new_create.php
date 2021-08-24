<?php

require '../../connect.php';
$scale_name=$_REQUEST['scale_name'];
$from_date=date('Y-m-d',strtotime($_REQUEST['from_date']));
$basic_pay=$_REQUEST['basic_pay'];
$spl_pay=$_REQUEST['spl_pay'];
$grade_pay=$_REQUEST['grade_pay'];
$da=$_REQUEST['da'];
$hra=$_REQUEST['hra'];
$cca=$_REQUEST['cca'];
$bonus=$_REQUEST['bonus'];
$addition_allowance=$_REQUEST['addition_allowance'];
$others=$_REQUEST['others'];
$now=date('Y-m-d');
$status="1";
 

$statement = $con->query("INSERT INTO master_scale_master(scale_name, from_date, basic_pay, spl_pay, grade_pay, da, hra, cca, bonus, addition_allowance, others, status, created_on, modified_on)
    VALUES ('$scale_name', '$from_date', '$basic_pay', '$spl_pay', '$grade_pay', '$da', '$hra', '$cca', '$bonus', '$addition_allowance', '$others', '$status', '$now', '$now')");
	
echo "INSERT INTO master_scale_master(scale_name, from_date, basic_pay, spl_pay, grade_pay, da, hra, cca, bonus, add_allowance, others, status, created_on, modified_on)
    VALUES ('$scale_name', '$from_date', '$basic_pay', '$spl_pay', '$grade_pay', '$da', '$hra', '$cca', '$bonus', '$addition_allowance', '$others', '$status','$now', '$now')";
	
//$statement->execute([
    ///'scale' => $scale,
//'from_date' => $from_date,
    //'basic_pay' => $basic_pay,
    //'spl_pay' => $spl_pay,
    //'grade_pay' => $grade_pay,
    //'da' => $da,
    //'hra' => $hra,
    //'cca' => $cca,
    //'bonus' => $bonus,
    //'addition_allowance' => $add_allowance,
   // 'others' => $others,
   // 'status' => $status,
    //'created_on' => $now
//]);


if($statement)
{
	0;
}
else
{
	1;
}

?>