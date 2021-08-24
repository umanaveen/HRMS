<?php
require '../../../connect.php';
require '../../../user.php';
$user_id =$_SESSION['userid'];

//$id=$_REQUEST['get_id'];
$quote_id_count = $_POST['quote_id'];
 $row_count   = count($quote_id_count);

 for($i=0;$i<$row_count;$i++)
{
  $quote = $quote_id_count[$i];
  $update_query = $con->query("update quotation_entry set status = '2',	modified_by ='$user_id',modified_on =NOW() WHERE id= '$quote '");  
  
  echo "update quotation_entry set status = '2',	modified_by ='$user_id',modified_on =NOW() WHERE id= '$quote '";
  if($update_query)
{
	//echo "<script>alert(' Aproved Successfuly');</script>";
	header("location:/HRMS/index.php");
}
}

?>






