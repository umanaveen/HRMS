<?php
require('../../../connect.php');
$po_id = $_REQUEST['cost_sheet_entry_id'];


$worder_sql = $con->query("SELECT id,Phases,Amount FROM cost_sheet_entry where enquiry_id in (SELECT enquiry_id FROM po_upload WHERE Po_id='$po_id')");
?>
<option value="">Select Customer first</option>
<?php
while($worder_res=$worder_sql->fetch(PDO::FETCH_ASSOC))
{
	?>
	<option value="<?php echo $worder_res['id'];?>"><?php echo $worder_res['Phases'].'-'.$worder_res['Amount'];?></option>
	<?php
}
?>
