<?php

require('../configuration.php');
require('../user.php');

$member_no=$_REQUEST['member_no'];
$voucher_no=$_REQUEST['voucher_no'];
$status_id=$_REQUEST['status_id'];

$vouch_query=mysql_fetch_array(mysql_query("SELECT * FROM `voucher` where member_no='$member_no' and code='$voucher_no'"));
	
	//echo "SELECT * FROM `voucher` where member_no='$member_no' and code='$voucher_no'";
	
$status_ids=$vouch_query['status'];

if($status_ids=='1')
{

$aslFdClosed_sql="SELECT 
						v.code,DATE_FORMAT(date,'%d-%b-%Y') as date,
						v.voucher_category_code,vc.name as voucher_category_name,
						v.voucher_purpose_code,vp.name as voucher_purpose_name,v.reference_no as fdr_no,
						v.slip_no,v.member_no,v.name,b.code as branch_code,b.name as branch_name,
						bn.name as bank_name,v.cheque_no,DATE_FORMAT(cheque_date,'%d-%b-%Y') as cheque_date,
						v.ledger_code,l.name as ledger_name,
						v.amount
				FROM 
					voucher v
				JOIN
					voucher_category vc
				ON
					vc.code=v.voucher_category_code
				LEFT JOIN
					voucher_purpose vp
				ON
					vp.code=v.voucher_purpose_code
				LEFT JOIN
					bank bn
				ON
					bn.code=v.bank_code
					
				LEFT JOIN
					 ledger l
				ON
				   l.code=v.ledger_code
				 LEFT JOIN
					branch b
				ON
					b.code=v.branch_code
				 WHERE
					v.code='$voucher_no'
				ORDER BY 
					 v.id DESC";
				 
									
					$aslFdClosed_row=mysql_query($aslFdClosed_sql);
					$aslFdClosed_res=mysql_fetch_array($aslFdClosed_row);
?>
<div class="right">
	<a href="/UCO/voucher/voucher-print.php?voucher_code=<?php echo $voucher_no; ?>" target="_blank"  style="float:right"><i class="fa fa-print"></i> Print</a>
</div>
<table class="table table-hoever table-bordered" id="aslFDClosed">
	<thead>
		<caption><center>Thrift & Credit Society Ltd., MSCS CR/42/94<br>
							328(Old No. 169) Thambu Chetty Street, Chennai-600 001.</center></caption>
	</thead>
	<tbody>
			<tr>
				<td>Voucher Code</td>
				<td colspan="2"><?php echo $aslFdClosed_res['code'];?></td>
				<td>Date</td>
				<td colspan="2"><?php echo $aslFdClosed_res['date'];?></td>
			</tr>
			
			<tr>
				<td>Category</td>
				<td colspan="2"><?php echo $aslFdClosed_res['voucher_category_name'];?></td>
				<td>Purpose</td>
				<td colspan="2"><?php echo $aslFdClosed_res['voucher_purpose_name'];?></td>
			</tr>
			
			<tr>
				<td>Member No</td>
				<td colspan="2"><?php echo $aslFdClosed_res['member_no'];?></td>
				<td>Name</td>
				<td colspan="2"><?php echo $aslFdClosed_res['name'];?></td>
			</tr>
			
			<tr>
				<td>Branch</td>
				<td colspan="2"><?php echo $aslFdClosed_res['branch_code']."-".$aslFdClosed_res['branch_name'];?></td>
				<td>Fdr No</td>
				<td colspan="2"><?php echo $aslFdClosed_res['fdr_no'];?></td>
			</tr>
			
			<tr>
				<td>Bank</td>
				<td colspan="2"><?php echo $aslFdClosed_res['bank_name'];?></td>
	
				<td>Cheque Date</td>
				<td colspan="2"><?php echo $aslFdClosed_res['cheque_date'];?></td>
			</tr>
			<tr>
									<td>Amount</td>
									<td colspan="2"><?php echo $aslFdClosed_res['amount'];?></td>
						
									<td>Cheque No</td>
									<td colspan="2"><?php echo $aslFdClosed_res['cheque_no'];?></td>
								</tr>
	</tbody>
<?php echo $name=$aslFdClosed_res['voucher_purpose_name'];
if($name=='New Member') { 
} 
else
{	?>
<thead>
<tr>
	<td colspan="3"><center>RECEIPTS</center></td>
	<td colspan="3"><center>PAYMENTS</center></td>
</tr>
<tr>
	<td>Head of Account</td>
	<td colspan="2">Amount</td>
	<td>Head of Account</td>
	<td colspan="2">Amount</td>
</tr>
<tr>
	<td></td>
	<td>Rs.</td>
	<td>P.</td>
	<td></td>
	<td>Rs.</td>
	<td>P.</td>
</tr>
</thead>
	

<tbody> 
		<?php
			$vd_sql="SELECT sum(a.amount) as total,a.reference,a.ledger_code,a.type,l.name,a.search_no FROM `account_entry` a join ledger l on l.code=a.ledger_code
where a.type='credit' and a.reference='$voucher_no' group by a.ledger_code,a.search_no";
			$vd_sql1="SELECT sum(a.amount) as total,a.reference,a.ledger_code,a.type,l.name,a.search_no FROM `account_entry` a join ledger l on l.code=a.ledger_code
where a.type='debit' and a.reference='$voucher_no' group by a.ledger_code,a.search_no";

											
								$vd_row=mysql_query($vd_sql);
								$vd_row1=mysql_query($vd_sql1);
			
			$i=0;
			$j=0;
			$tot_receipt=0;
			$tot_payment=0;
			while($vd_res=mysql_fetch_array($vd_row))
			{
				$receipt=$vd_res['total'];
				//$tot_receipt=round($tot_receipt+$receipt);
				
				//$payment=round($vd_res['payment']);
				//$tot_payment=round($tot_payment+$payment);
								
									if($receipt<>0)
									{
										
										$r[$i]=$receipt;
										
										if($vd_res['name']=='FIXED DEPOSIT')
										{
										$rl[$i]=$vd_res['search_no']."-".$vd_res['name'];
										}
										else
										{
										$rl[$i]=$vd_res['name'];
										}
										$i++;
										
									}
			}
			$i=0;
			$j=0;
									while($vd_res1=mysql_fetch_array($vd_row1))
										{
											$payment=$vd_res1['total'];
									if($payment<>0)
									{
										$p[$j]=$payment;
										
										if($vd_res1['name']=='FIXED DEPOSIT')
										{
										$pl[$i]=$vd_res1['search_no']."-".$vd_res1['name'];
										}
										else
										{
										$pl[$j]=$vd_res1['name'];
										}
										
										
										$j++;
									}
										}
								
								$rSize=sizeof($r);
								$ramount=array_sum($r);
								$pSize=sizeof($p);
								$pamount=array_sum($p);
								
								
									if($rSize<$pSize)
									{
										for($k=0;$k<$pSize;$k++)
										{
											?>
											<tr>
												<td><?php if($k<$rSize)
														{
															echo $rl[$k];
														}
														?></td>
												<td><?php if($k<$rSize)
														{
															echo $r[$k];
														}
														?></td>
												<td></td>												
												<td><?php if($k<$pSize)
														{
															echo $pl[$k];
														}
														?></td>
												<td><?php if($k<$pSize)
														{
															echo $p[$k];
														}
														?></td>
												<td></td>
											</tr>
											<?php
										}
									}
									else
									{
										for($k=0;$k<$rSize;$k++)
										{
											?>
											<tr>
												<td><?php if($k<$rSize)
														{
															echo $rl[$k];
														}
														?></td>
												<td><?php if($k<$rSize)
														{
															echo $r[$k];
														}
														?></td>
												<td></td>												
												<td><?php if($k<$pSize)
														{
															echo $pl[$k];
														}
														?></td>
												<td><?php if($k<$pSize)
														{
															echo $p[$k];
														}
														?></td>
												<td></td>
											</tr>
											<?php
										}	
									}
	?>

<tfoot>
	<tr>
		<td>Total</td>
		<td><?php echo $ramount;?></td>
		<td></td>
		<td>Total</td>
		<td><?php echo $pamount;?></td>
		<td></td>
	</tr>
</tfoot>
<?php } ?>
</table>
<?php	
}
?>
	
	
