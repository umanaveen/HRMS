<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

include_once '../../connect.php';
include_once './accounts_class.php';

$database = new Database();
$db = $database->getConnection();

$accounts = new account_table($db);	
$stmt = $accounts->getProfit_view();
$num = $stmt->rowCount();

if($num > 0)
{
    $accounts_asset_array = array();
    $accounts_asset_array["types"]=array();
    
    while($row = $stmt->fetch(PDO::FETCH_ASSOC))
    {
        extract($row); 	
        $accounts_asset_array_val = array("id"=>$id,"name"=>$name,"order_by"=>$order_by,"type"=>$type,"flag_id"=>$flag_id);	
        array_push($accounts_asset_array["types"], $accounts_asset_array_val);        
    }
            
    // set response code - 200 OK
    http_response_code(200);	  
    // show products data in json format
    echo json_encode($accounts_asset_array);
}
