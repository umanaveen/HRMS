
<?php
require("../../configuration.php");
require("../../user.php");
	
	$ledgerSql="SELECT l.code,l.name,a.type,b.name as plgroup,c.name as bsgroup
		FROM ledger l LEFT JOIN	accounts a ON a.id=l.accounts_id
						LEFT JOIN	pl_group_master b ON b.id=l.pl_group_id
							LEFT JOIN	bs_group_master c ON c.id=l.bs_group_id ORDER BY l.code ASC";
?>

<div class="box box-success" id="divAccounts">

		<div style="float:left">
							<a href="#" id="1" class="excel"  style=" padding-left:10px;" onclick="tableToExcel('tblLedger', 'List User')">
								<span class="fa fa-download">&nbsp;&nbsp;Excel</a>&nbsp;&nbsp;
					</div>
		<div style="float:right">
							 <a href="/UCO/reports/list/ledger/ledger-print.php" target="_blank" style=" padding-right:10px;"><i class="fa fa-print"></i> Print</a>
		</div>
		
		
					
	<table class="table table-striped" id="tblLedger" style="font-family:'Times New Roman', Times, serif;">
				<caption><center>Ledger Information</center></caption>
			<thead>
				 <tr>
                        <th>#</th>
                        <th>Code</th>
						<th>Name</th>
						<th>Category</th>
						<th>P&L Category</th>
						<th>BS Category</th>
                 </tr>
			</thead>
				
			<tbody>
				<?php
					$ledgerRow=mysql_query($ledgerSql);
					$i=1;
					while($ledgerRes=mysql_fetch_array($ledgerRow))
					{
				?>
						<tr>
							<td><?php echo $i++;?></td>
							<td><?php echo $ledgerRes[0];?></td>
							<td><?php echo $ledgerRes[1];?></td>
							<td><?php echo $ledgerRes[2];?></td>
							<td><?php echo $ledgerRes[3];?></td>
							<td><?php echo $ledgerRes[4];?></td>
						</tr>
				<?php
					}
				?>
			</tbody>	
				
			 <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Code</th>
						<th>Name</th>
						<th>Category</th>
						<th>P&L Category</th>
						<th>BS Category</th>
                    </tr>
             </tfoot>
	</table>
</div><!-- close divAccounts-->

  <!-- Modal form-->
                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog ">
                    <div class="modal-content">
                      
                      <div class="modal-body" id="modal-bodyku">
							
                      </div>
                      <div class="modal-footer" id="modal-footerq">
                      </div>
                    </div>
                  </div>
                </div>
                <!-- end of modal ------------------------------>
				
<script>
	 $('#tblLedger').DataTable({
	 	"paging": false 
      });
</script>

