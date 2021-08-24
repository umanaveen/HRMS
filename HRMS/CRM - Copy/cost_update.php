<?php
require '../../connect.php';
require '../../user.php';

$id=$_REQUEST['get_id'];
$candidateid=$_REQUEST['get_emp_id'];
$phase=$_REQUEST['phase'];
$phase_count=count($phase);
$item=$_REQUEST['item'];
$cost=$_REQUEST['cost'];
$price=$_REQUEST['price'];


$priceTotal=$_REQUEST['priceTotal'];

 for($i=0;$i<$phase_count;$i++)
{

$phases= $phase[$i];
$items= $item[$i];
 $costs= $cost[$i];
 $prices= $price[$i];


  $sql1=$con->query("insert into `cost_sheet_entry`(`enquiry_id`, `Phases`, `Specification`, `Hours/Days`, `Amount`,`total`,`created_by`)  
values('$id','$phases','$items','$costs','$prices','$priceTotal','$candidateid')");  


  




echo "insert into `cost_sheet_entry`(`enquiry_id`, `Phases`, `Specification`, `Hours/Days`, `Amount`,`total`,`created_by`)  
values('$id','$phases','$items','$costs','$prices','$priceTotal','$candidateid')";  

}





?>






