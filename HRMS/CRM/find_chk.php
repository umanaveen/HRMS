<?php
require '../../connect.php';
include("../../user.php");
$checking = $_POST["checking"];

$sql=$con->query("SELECT * FROM client_master where org_name LIKE '%".$checking."%' ");
$output = '<ul class="list-unstyled">';
?>


<?php
   while($row = $sql->fetch(PDO::FETCH_ASSOC))
{
	$output.='<li>'.<?php echo $row["org_name"];?>.'</li>';
?>
<?php
}
?>