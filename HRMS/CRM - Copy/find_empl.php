<?php
require '../../connect.php';
include("../../user.php");
$client_id = $_POST["client_id"];

$sql=$con->query("SELECT * FROM project where client = $client_id");

?>
<option value="">Select Employee Name</option>

<?php
   while($row = $sql->fetch(PDO::FETCH_ASSOC))
{
?>

<option value="<?php echo $row["id"];?>"><?php echo $row["employee"];?></option>
<?php
}
?>