<?php
require '../../../connect.php';
include("../../../user.php");


$product_name=$_REQUEST['product_name'];

$array=array("9789957518","9994996010","9841416638","7449011719","9360987353");

foreach ($array as $key=>$vale){
send_whatapp_api($product_name,$vale);
}
function send_whatapp_api($product_name,$vale)
{
	$url = "https://api.chat-api.com/instance321449/sendMessage?token=h4ynr26b5d73kpo1";
$curl = curl_init($url);
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$headers = array(
   "Accept: application/json",
   "Content-Type: application/json",
);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

$data = <<<DATA
{
  "phone": "91$vale",
  "body": "Product_name='$product_name'"
  
}
DATA;

curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

//for debug only!
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

$resp = curl_exec($curl);
curl_close($curl);
var_dump($resp);
 






//$sql11=$con->query("insert into products_master(`Product_name`) values('$product_name')"); 
}
$sql11=$con->query("insert into products_master(`Product_name`) values ('$product_name')"); 
//echo "insert into products_master(`Product_name`) values('$product_name')";
?>
