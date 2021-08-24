 <?php
require '../../connect.php';
$type=$_REQUEST['type'];
?>
 <td>Asset Name</td>
        <td colspan="5"><select class="form-control" id="get_asset_name" name="get_asset_name" onchange="get_asset_no(this.value)">
		<option value="">Choose Assets</option>
		<?php $stmt1 = $con->query("SELECT * FROM assets_master where type='$type'");
		while ($row1 = $stmt1->fetch()) {?>
		<option value="<?php echo $row1['id']; ?>"> <?php echo $row1['name']; ?> </option>
		<?php } ?>
		</select></td>