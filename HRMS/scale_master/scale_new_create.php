<?php

require '../../connect.php';
echo "hiii".$id=$_REQUEST['id'];
$scale=$_REQUEST['scale'];
//$type=$_REQUEST['type'];
//$from_date=date('Y-m-d',strtotime($_REQUEST['from_date']));
//$amount=$_REQUEST['amount'];
//$percentage=$_REQUEST['percentage'];
//$grade_pay=$_REQUEST['grade_pay'];
//$da=$_REQUEST['da'];
//$hra=$_REQUEST['hra'];
//$cca=$_REQUEST['cca'];
//$bonus=$_REQUEST['bonus'];
//$add_allowance=$_REQUEST['add_allowance'];
//$others=$_REQUEST['others'];
//$now=date('Y-m-d');
//$status="1";
 

$statement = $con->query("INSERT INTO payroll_scale_master(name)
    VALUES ('$scale')");
	
echo "INSERT INTO payroll_scale_master(name)
    VALUES ('$scale')";
	
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