<?php
require '../../../connect.php';
require '../../../user.php';

$id=$_REQUEST['get_id'];


$status=2;
$workorder=$con->query("select * from po_upload where prefix_code='BBWO' order by workorder_number desc limit 1");
$count = $workorder->rowCount();
$number=$workorder->fetch();
$workorder_number=$number['workorder_number'];
$num=$workorder_number+1; // add 1;

    $len = strlen($num);
	if($len <3)
	{
		echo $num ="00".$num ;
	}
	
    else
   {
	   echo $num;
   } 

 if($count==1)
{
$sql2= $con->query("Update po_upload set po_status='$status',prefix_code='BBWO',workorder_number='$num' where Po_id='$id'");
	echo "Update po_upload set po_status='$status' where Po_id='$id'";


}

else
{
	
	$sql2= $con->query("Update po_upload set po_status='$status',prefix_code='BBWO',workorder_number='001' where Po_id='$id'");
	echo "Update po_upload set po_status='$status' where Po_id='$id'";
	
}



?>






