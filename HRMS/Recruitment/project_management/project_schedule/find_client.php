<?php
require '../../../../connect.php';
include("../../../../user.php");

$client_id = $_REQUEST["client_id"];

$sql=$con->query("SELECT * FROM project_management where Client = $client_id");
echo "SELECT * FROM project_management where Client = $client_id";
?>
<option value="">Select Project Name</option>
<?php
while($row = $sql->fetch(PDO::FETCH_ASSOC))
{
?>

<option value="<?php echo $row["project_id"];?>"><?php echo $row["Project_Name"];?></option><?php
}
?>