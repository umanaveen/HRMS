<?php
require '../../../connect.php';
require '../../../user.php';
$user_id =$_SESSION['userid'];

 $max_quote ="SELECT * FROM quotation_entry ORDER BY id DESC";
 $query = $conn->query($max_quote);
 $number = $query->fetch_assoc();


 if (!empty($number['quote_no'])) {
	
    print_r($splite_val = explode("-",$number['quote_no'])); 	
	echo $no   =  $splite_val [0];
	echo $char =  $splite_val [1];
	
  // $result = preg_split('/[-_]/', $number);
  $find_f = substr($number['quote_no'], 0, 7);
  $find_fs = substr($number['quote_no'], 0, 4);
  // echo "<pre>";  print_r($find_f);  exit;
  if($find_f=="QUAD626"){
    $last_bill_no = substr($number['Case_Number'], -8);
    
  }
  
  
   $quote1= ++$no;
   $quote2= ++$char;
   
   $case_number=$quote1 .$quote1;
      }else{
			$d = '1001-Z';
			for ($n=0; $n<26; $n++) {
			echo ++$d . PHP_EOL;
			}

      }





/* $d = '1001-Z';
for ($n=0; $n<26; $n++) {
    echo ++$d . PHP_EOL;
} */



$specification = $_REQUEST['item'];
 $row_count   = count($specification);
$qty         = $_REQUEST['qty'];
$unit_rate   = $_REQUEST['cost'];
$total       = $_REQUEST['price'];
$gst         = $_REQUEST['gst'];

$client_id     = $_REQUEST['client_id'];

$quote_type    = $_REQUEST['quote_type'];
$business_id   = $_REQUEST['mapping_id'];
$candid_id     = $_REQUEST['candid_id'];
$vendor_id     = $_REQUEST['vendor_id'];

 for($i=0;$i<$row_count;$i++)
{
	
 $specifications = $specification[$i];
 $qtys           = $qty[$i];
 $unit_rates     = $unit_rate[$i];
 $totals         = $total[$i];

  $insert_query=$con->query("insert into quotation_entry(specification,qty,unit_rate,amount,gst_percentage,client_id,quote_type,business_id,vendor_id,candid_id,status,created_by,created_on) values('$specifications','$qtys','$unit_rates','$totals','$gst','$client_id','$quote_type','$business_id','$vendor_id','$candid_id','1','$user_id',NOW())");  
  
  
echo "insert into quotation_entry(specification,qty,unit_rate,amount,gst_percentage,client_id,quote_type,business_id,vendor_id,candid_id,status,created_by,created_on) values('$specifications','$qtys','$unit_rates','$totals','$gst','$client_id','$quote_type','$business_id','$vendor_id','$candid_id','1','$user_id',NOW())";
}





?>






