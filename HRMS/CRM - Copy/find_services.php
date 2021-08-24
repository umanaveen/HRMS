<?php
require '../../connect.php';
include("../../user.php");
$Product = $_POST["Product"];

$sql=$con->query("SELECT * FROM `product/services` where mapping_id='$Product'");

?>

<option value="">Select Product/Services</option>

<?php
   while($row = $sql->fetch(PDO::FETCH_ASSOC))
{
?>

<option value="<?php echo $row["id"];?>"><?php echo $row["name"];?></option>
<?php
} 
?>