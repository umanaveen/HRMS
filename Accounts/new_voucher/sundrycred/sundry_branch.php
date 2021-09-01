<?Php
require('../../configuration.php');
require('../../user.php');
?>
<table class="table table-striped">
	<thead>
	<tr>
	<th colspan="2"></th>
	</tr>
	</thead>
	<tbody>
<?php
	$member_no=$_REQUEST['member_no'];
	if($member_no=='' || $member_no==null)
	{
?>
<tr>
	<td>Branch</td>
	<td> <select class="form-control select2" style="width: 100%;" name="branch" id="branch">
	<option value="">Select Branch</option>
	<?php
	$branch_sql="SELECT code,name FROM branch";
	$branch_row=mysql_query($branch_sql);
	while($branch_res=mysql_fetch_array($branch_row))
	{
	?>
	<option value="<?php echo $branch_res['code'];?>"><?php echo $branch_res['code']."-".	$branch_res['name'];?></option>
	<?php
	}
	?>
	</select>	
	</td>
</tr>
<?php
}
?>
</tbody>
	<tfoot>
		<tr>
			<th colspan="2"></th>
		</tr>
	</tfoot>
</table>				
<script>
	$(function(){
		$(".select2").select2();
	});
</script>

