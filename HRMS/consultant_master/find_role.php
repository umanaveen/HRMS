<?php
require '../../connect.php';
include("../../user.php");
$code = $_REQUEST["code"];

$sql=$con->query("SELECT * FROM  z_role_master  where id='$code'");
//echo "SELECT area,address1,client_name,designation,mobile_no1,email_id1 FROM client_master where org_name='$Company_name'";

  $row = $sql->fetch(PDO::FETCH_ASSOC);

 $role_code=$row['code'];

echo $role_code;
?>