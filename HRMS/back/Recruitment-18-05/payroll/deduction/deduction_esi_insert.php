<!--?php 
require '../../connect.php';
$fdate=$_REQUEST['from_date'];
$percentage=$_REQUEST['percentage'];
$now=date('Y-m-d');
$statement = $con->prepare("insert into esi_master(from_date,percentage,status) values(?,?,?)");
$statement ->execute([$fdate,$percentage,0]);
?-->

<!--?php

require '../../../connect.php';
echo "hiii".$id=$_REQUEST['id'];
$name=$_REQUEST['name'];
$from_date=date('Y-m-d',strtotime($_REQUEST['from_date']));
$percentage=$_REQUEST['percentage'];
$min_amount=$_REQUEST['min_amount'];
$max_amount=$_REQUEST['max_amount'];
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
 

$statement = $con->query("INSERT INTO deduction_master(name,from_date,percentage,min_amount,max_amount,status,created_by,created_on,modified_by,modified_on)
    VALUES ('$name','$from_date','$percentage','$min_amount','$max_amount','$status','$created_by','$created_on','$modified_by','$modified_on')");
	
echo "INSERT INTO deduction_master(name,from_date,percentage,min_amount,max_amount,status,created_by,created_on,modified_by,modified_on)
    VALUES ('$name','$from_date','$percentage','$min_amount','$max_amount','$status','$created_by','$created_on','$modified_by','$modified_on')";
	
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

?-->



<?php

require '../../../connect.php';
$name=$_REQUEST['name'];
$from_date=date('Y-m-d',strtotime($_REQUEST['from_date']));
$amount=$_REQUEST['amount'];
$percentage=$_REQUEST['percentage'];
echo "111".$min_amount=$_REQUEST['min_amount'];
$max_amount=$_REQUEST['max_amount'];
$now=date('Y-m-d');
$status="1";
 

$statement = $con->query("INSERT INTO payroll_deduction_master(name,from_date,amount,percentage,min_amount,max_amount,status,created_by,created_on,modified_by,modified_on)
    VALUES ('$name','$from_date','$amount','$percentage','$min_amount','$max_amount','$status','1','$now','1','$now')");	
	
	echo "INSERT INTO payroll_deduction_master(name,from_date,amount,percentage,min_amount,max_amount,status,created_by,created_on,modified_by,modified_on)
    VALUES ('$name','$from_date','$amount','$percentage','$min_amount','$max_amount','$status','1','$now','1','$now')";



?>