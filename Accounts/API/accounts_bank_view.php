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
$stmt = $accounts->getBank_view();
$num = $stmt->rowCount();

if($num > 0)
{
    $accounts_bank_array = array();
    $accounts_bank_array["types"]=array();    
    while($row = $stmt->fetch(PDO::FETCH_ASSOC))
    {
        extract($row);			
        $accounts_array_val = array("id"=>$id,"code"=>$code,"ledger_code"=>$ledger_code,"name"=>$name,"description"=>$description);	
        array_push($accounts_bank_array["types"], $accounts_array_val);        
    }
            
    // set response code - 200 OK
    http_response_code(200);	  
    // show products data in json format
    echo json_encode($accounts_bank_array);
}
