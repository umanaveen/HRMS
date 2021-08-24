<?php
require '../../../connect.php';
include("../../../user.php");
$code = $_REQUEST["code"];

$sql=$con->query("SELECT * FROM  consultant_master  where consultant_id='$code'");
//echo "SELECT * FROM  consultant_master  where consultant_id='$code'";

  $row = $sql->fetch(PDO::FETCH_ASSOC);

 $consultant_name=$row['consultant_name'];

echo $consultant_name;
?>