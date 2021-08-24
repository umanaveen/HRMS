<?php
require '../../../../connect.php';
include("../../../../user.php");

echo $employees_id = $_REQUEST["project_id"];

$sql=$con->query("SELECT * FROM project_modules where Employee= $employees_id");
echo "SELECT * FROM project_modules where Employee= $employees_id";
?>
<option value="">Select No Of Working Hours</option>
<?php
while($row = $sql->fetch(PDO::FETCH_ASSOC))
{
?>

<option value="<?php echo $row["no_of_working_hours1"];?>"><?php echo $row["no_of_working_hours1"];?></option><?php
}
?>