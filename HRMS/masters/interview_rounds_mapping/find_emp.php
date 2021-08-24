<?php
require '../../connect.php';
include("../../user.php");
$department_id = $_POST["department_id"];

$sql=$con->query("SELECT * FROM staff_master where dep_id = $department_id");

?>
<option value="">Select Employee</option>

<?php
   while($row = $sql->fetch(PDO::FETCH_ASSOC))
{
?>

<option value="<?php echo $row["id"];?>"><?php echo $row["emp_name"];?></option>
<?php
}
?>