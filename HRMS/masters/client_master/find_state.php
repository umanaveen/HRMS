<?php
require '../../../connect.php';
include("../../../user.php");
$country = $_REQUEST["country"];

$sql=$con->query("SELECT * FROM state where country_map_id = $country");

?>
<option value="">Select State</option>

<?php
   while($row = $sql->fetch(PDO::FETCH_ASSOC))
{
?>

<option value="<?php echo $row["state_id"];?>"><?php echo $row["state_name"];?></option>
<?php
}
?>