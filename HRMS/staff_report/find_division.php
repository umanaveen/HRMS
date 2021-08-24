<?php
require '../../connect.php';
require '../../user.php';
$department_id = $_POST["department_id"];
$sql=$con->query("SELECT * FROM division_master where dep_id = $department_id");

?>
<option value="">Select Division</option>

<?php
   while($row = $sql->fetch(PDO::FETCH_ASSOC))
{
?>

<option value="<?php echo $row["id"];?>"><?php echo $row["div_name"];?></option>
<?php
}
?>