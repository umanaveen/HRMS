<?php
require '../../../connect.php';
include("../../../user.php");
$state = $_REQUEST["state"];

$sql=$con->query("SELECT * FROM  city where state_map_id =$state");

?>
<option value="">Select State</option>

<?php
   while($row = $sql->fetch(PDO::FETCH_ASSOC))
{
?>

<option value="<?php echo $row["city_id"];?>"><?php echo $row["city_name"];?></option>
<?php
}
?>