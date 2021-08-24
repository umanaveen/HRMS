<?php
require '../../connect.php';
require '../../user.php';
$dep_id = $_POST["dep_id"];
$sql=$con->query("SELECT * FROM staff_master where dep_id = $dep_id");

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

