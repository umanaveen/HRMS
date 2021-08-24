<?php
require '../../../../connect.php';
include("../../../../user.php");

$project_id = $_REQUEST['project_id'];
$sql=$con->query("SELECT * FROM project_department where project_id='$project_id'");

echo "SELECT * FROM project_department where project_id = '$project_id'";
?>
<option value="">Select Employee</option>
<?php

while($row = $sql->fetch(PDO::FETCH_ASSOC))
{
?>

<option value="<?php echo $row["id"];?>"><?php echo $row["employee"];?></option><?php
}
?>