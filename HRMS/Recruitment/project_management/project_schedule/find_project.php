<?php
require '../../../../connect.php';
include("../../../../user.php");

$client_id = $_REQUEST["client_id"];

$sql=$con->query("SELECT * FROM staff_master where dep_id = $client_id");
?>
<option value="">Select staff_master Name</option>
<?php
while($row = $sql->fetch(PDO::FETCH_ASSOC))
{
?>

<option value="<?php echo $row["id"];?>"><?php echo $row["emp_name"];?></option><?php
}
?>