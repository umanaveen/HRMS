<?php
require('../../../connect.php');


$client_id = $_REQUEST['customer_id'];

$worder_sql = $con->query("SELECT Po_id,CONCAT(prefix_code,workorder_number) as workorder FROM po_upload where client_id='$client_id'");
while($worder_res=$worder_sql->fetch(PDO::FETCH_ASSOC))
{
	?>
	<option value="<?php echo $worder_res['Po_id'];?>"><?php echo $worder_res['workorder'];?></option>
	<?php
}	
?>