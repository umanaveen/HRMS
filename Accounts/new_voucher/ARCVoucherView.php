<?php
require('../configuration.php');
require('../user.php');
//$user_id="2";
$user_id=$_SESSION['user_group'];

$voucher_purpose_code=$_REQUEST['voucher_purpose_code'];
$voucher_code=$_REQUEST['voucher_no'];	

if($voucher_purpose_code=='PUR-001' || $voucher_purpose_code=='PUR-016')  /* if($voucher_purpose_code=='PUR-005') start here */ 
{
$arcNewMember_sql="SELECT 
  										v.code,DATE_FORMAT(date,'%d-%b-%Y') as date,
										v.voucher_category_code,vc.name as voucher_category_name,
										v.voucher_purpose_code,vp.name as voucher_purpose_name,v.reference_no as member_no,
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
								 	v.code='$voucher_code'
								ORDER BY 
								     v.id DESC";
				 
				 
									
					$arcNewMember_row=mysql_query($arcNewMember_sql);
					$arcNewMember_res=mysql_fetch_array($arcNewMember_row);
?>
<div class="right">
							<a href="#" id="1" class="excel"  onclick="tableToExcel('tblARCNewMember', 'List User')">
								<span class="fa fa-download">&nbsp;Excel</a>&nbsp;&nbsp;
							 <a href="/UCO/voucher/voucher-print.php?voucher_code=<?php echo $voucher_code; ?>" target="_blank"  style="float:right"><i class="fa fa-print"></i> Print</a>
					</div>
<table class="table table-hoever table-bordered" id="tblARCNewMember">
	<thead>
		<caption><center>Thrift & Credit Society Ltd., MSCS CR/42/94<br>
							328(Old No. 169) Thambu Chetty Street, Chennai-600 001.</center></caption>
	</thead>
	<tbody>
			<tr>
				<td>Voucher Code</td>
				<td colspan="2"><?php echo $arcNewMember_res['code'];?></td>
				<td>Date</td>
				<td colspan="2"><?php echo $arcNewMember_res['date'];?></td>
			</tr>
			
			<tr>
				<td>Category</td>
				<td colspan="2"><?php echo $arcNewMember_res['voucher_category_name'];?></td>
				<td>Purpose</td>
				<td colspan="2"><?php echo $arcNewMember_res['voucher_purpose_name'];?></td>
			</tr>
			
			<tr>
				<td>Member No</td>
				<td colspan="2"><?php echo $arcNewMember_res['member_no'];?></td>
				<td>Name</td>
				<td colspan="2"><?php echo $arcNewMember_res['name'];?></td>
			</tr>
			
			<tr>
				<td>Branch</td>
				<td colspan="2"><?php echo $arcNewMember_res['branch_code']."-".$arcNewMember_res['branch_name'];?></td>
				<td>Reference No</td>
				<td colspan="2"><?php echo $arcNewMember_res['member_no'];?></td>
			</tr>
			
			<tr>
				<td>Bank</td>
				<td colspan="2"><?php echo $arcNewMember_res['bank_name'];?></td>
	
				<td>Cheque Date</td>
				<td colspan="2"><?php echo $arcNewMember_res['cheque_date'];?></td>
			</tr>
			<tr>
				<td></td>
				<td colspan="2"></td>
	
				<td>Cheque No</td>
				<td colspan="2"><?php echo $arcNewMember_res['cheque_no'];?></td>
			</tr>
	</tbody>
	
<thead>

<tr>
	<td colspan="3">Head of Account</td>
	<td colspan="2">Amount</td>

</tr>
<tr>
	<td colspan="3"></td>
	<td>Rs.</td>
	<td>P.</td>
</tr>
</thead>
	

<tbody>
		<?php
			$vd_sql="SELECT v.voucher_code,l.name as ledger_name,v.receipt,v.payment 
							FROM voucher_detail v
						JOIN
							ledger l
						ON
							l.code=v.ledger_code
						 WHERE v.voucher_code='$voucher_code'";
						 
			$vd_row=mysql_query($vd_sql);
			while($vd_res=mysql_fetch_array($vd_row))
			{
				
				?>
				<tr>
					<td colspan="3"><?php echo $vd_res['ledger_name'];?></td>
					<td><?php $amount=round($vd_res['payment']); if($amount==0) { $amount=round($vd_res['receipt']); } echo $amount;?></td>
					<td></td>
				</tr>
				
				
				<?php
			
			}
			
		?>
		
<?php
$vd_sql1="SELECT SUM(receipt) as total_receipt,SUM(payment) as total_payment
		FROM
			voucher_detail
						 WHERE voucher_code='$voucher_code'";
						 
			$vd_row1=mysql_query($vd_sql1);
			$vd_res1=mysql_fetch_array($vd_row1);
	?>

<tfoot>
	<tr>
		<td colspan="3">Total</td>
		<td><?php echo round($vd_res1['total_payment']);?></td>
		<td></td>
	</tr>
</tfoot>

</table>



<?php 
if($user_id=='1')      // Approve voucher by ADMIN "not" USER
{
	?>
	<div align="right">
	<button class="btn btn-success"  style="margin-right:40px;" name="submit" onclick="approve_voucher(this.value)" value="<?php echo $voucher_code; ?>">Approve</button>  
	</div>
	<?php
}

} /* if($voucher_purpose_code=='PUR-001') close here */
else if($voucher_purpose_code=='PUR-003'||$voucher_purpose_code=='PUR-016')  /* if($voucher_purpose_code=='PUR-003') start here */
{
	
	
	$arcAdjCol_sql="SELECT 
  										v.code,DATE_FORMAT(date,'%d-%b-%Y') as date,
										v.voucher_category_code,vc.name as voucher_category_name,
										v.voucher_purpose_code,vp.name as voucher_purpose_name,v.reference_no,
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
								 	v.code='$voucher_code'
								ORDER BY 
								     v.id DESC";
				 
									
					$arcAdjCol_row=mysql_query($arcAdjCol_sql);
					$arcAdjCol_res=mysql_fetch_array($arcAdjCol_row);
					
			?>
					<div class="right">
							<a href="#" id="1" class="excel"  onclick="tableToExcel('tblARCAdjCol', 'List User')">
								<span class="fa fa-download">&nbsp;Excel</a>&nbsp;&nbsp;
							 <a href="/UCO/voucher/voucher-print.php?voucher_code=<?php echo $voucher_code; ?>" target="_blank"  style="float:right"><i class="fa fa-print"></i> Print</a>
					</div>
							<table class="table table-hoever table-bordered" id="tblARCAdjCol">
								<thead>
									<caption><center>Thrift & Credit Society Ltd., MSCS CR/42/94<br>
														328(Old No. 169) Thambu Chetty Street, Chennai-600 001.</center></caption>
								</thead>
								<tbody>
										<tr>
											<td>Voucher Code</td>
											<td colspan="2"><?php echo $arcAdjCol_res['code'];?></td>
											<td>Date</td>
											<td colspan="2"><?php echo $arcAdjCol_res['date'];?></td>
										</tr>
										
										<tr>
											<td>Category</td>
											<td colspan="2"><?php echo $arcAdjCol_res['voucher_category_name'];?></td>
											<td>Purpose</td>
											<td colspan="2"><?php echo $arcAdjCol_res['voucher_purpose_name'];?></td>
										</tr>
										
										<tr>
											<td>Member No</td>
											<td colspan="2"><?php echo $arcAdjCol_res['member_no'];?></td>
											<td>Name</td>
											<td colspan="2"><?php echo $arcAdjCol_res['name'];?></td>
										</tr>
										
										<tr>
											<td>Branch</td>
											<td colspan="2"><?php echo $arcAdjCol_res['branch_code']."-".$arcAdjCol_res['branch_name'];?></td>
											<td>Reference No</td>
											<td colspan="2"><?php echo $arcAdjCol_res['reference_no'];?></td>
										</tr>
										
										<tr>
											<td>Bank</td>
											<td colspan="2"><?php echo $arcAdjCol_res['bank_name'];?></td>
								
											<td>Cheque Date</td>
											<td colspan="2"><?php echo $arcAdjCol_res['cheque_date'];?></td>
										</tr>
										<tr>
				<td></td>
				<td colspan="2"></td>
	
				<td>Cheque No</td>
				<td colspan="2"><?php echo $arcAdjCol_res['cheque_no'];?></td>
			</tr>
								</tbody>
								
							<thead>
							
							<tr>
								<td colspan="3">Head of Account</td>
								<td colspan="2">Amount</td>
							
							</tr>
							<tr>
								<td colspan="3"></td>
								<td>Rs.</td>
								<td>P.</td>
							</tr>
							</thead>
							
							<tbody>
										<?php
											$vd_sql="SELECT voucher_code,name as ledger_name,receipt,payment 
															FROM voucher_detail v
														JOIN
															ledger l
														ON
															l.code=v.ledger_code
														 WHERE voucher_code='$voucher_code'";
														 
											$vd_row=mysql_query($vd_sql);
											while($vd_res=mysql_fetch_array($vd_row))
											{
												
												?>
												<tr>
													<td colspan="3"><?php echo $vd_res['ledger_name'];?></td>
													<td align="right"><?php $amount=round($vd_res['payment']); if($amount==0) { $amount=round($vd_res['receipt']); } echo $amount;?></td>
													<td></td>
												</tr>
												
												
												<?php
											
											}
											
										?>
										
								<?php
								$vd_sql1="SELECT SUM(receipt) as total_receipt,SUM(payment) as total_payment
										FROM
											voucher_detail
														 WHERE voucher_code='$voucher_code'";
														 
											$vd_row1=mysql_query($vd_sql1);
											$vd_res1=mysql_fetch_array($vd_row1);
									?>
								
								<tfoot>
									<tr>
										<td colspan="3">Total</td>
										<td align="right"><?php echo round($vd_res1['total_payment']);?></td>
										<td></td>
									</tr>
								</tfoot>
								
								</table>

<?php
}  /* if($voucher_purpose_code=='PUR-003') close here */
else if($voucher_purpose_code=='PUR-004')  /* if($voucher_purpose_code=='PUR-004') start here */ 
{
	
	
	$arcBulkCol_sql="SELECT 
  										v.code,DATE_FORMAT(date,'%d-%b-%Y') as date,
										v.voucher_category_code,vc.name as voucher_category_name,
										v.voucher_purpose_code,vp.name as voucher_purpose_name,v.reference_no,
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
								 	v.code='$voucher_code'
								ORDER BY 
								     v.id DESC";
				 
									
					$arcBulkCol_row=mysql_query($arcBulkCol_sql);
					$arcBulkCol_res=mysql_fetch_array($arcBulkCol_row);
					
			?>
					<div class="right">
							<a href="#" id="1" class="excel"  onclick="tableToExcel('tblARCBulkCol', 'List User')">
								<span class="fa fa-download">&nbsp;Excel</a>&nbsp;&nbsp;
							 <a href="/UCO/voucher/voucher-print.php?voucher_code=<?php echo $voucher_code; ?>" target="_blank"  style="float:right"><i class="fa fa-print"></i> Print</a>
					</div>
							<table class="table table-hoever table-bordered" id="tblARCBulkCol">
								<thead>
									<caption><center>Thrift & Credit Society Ltd., MSCS CR/42/94<br>
														328(Old No. 169) Thambu Chetty Street, Chennai-600 001.</center></caption>
								</thead>
								<tbody>
										<tr>
											<td>Voucher Code</td>
											<td colspan="2"><?php echo $arcBulkCol_res['code'];?></td>
											<td>Date</td>
											<td colspan="2"><?php echo $arcBulkCol_res['date'];?></td>
										</tr>
										
										<tr>
											<td>Category</td>
											<td colspan="2"><?php echo $arcBulkCol_res['voucher_category_name'];?></td>
											<td>Purpose</td>
											<td colspan="2"><?php echo $arcBulkCol_res['voucher_purpose_name'];?></td>
										</tr>
										
										<tr>
											<td>Member No</td>
											<td colspan="2"><?php echo $arcBulkCol_res['member_no'];?></td>
											<td>Name</td>
											<td colspan="2"><?php echo $arcBulkCol_res['name'];?></td>
										</tr>
										
										<tr>
											<td>Branch</td>
											<td colspan="2"><?php echo $arcBulkCol_res['branch_code']."-".$arcBulkCol_res['branch_name'];?></td>
											<td>Reference No</td>
											<td colspan="2"><?php echo $arcBulkCol_res['reference_no'];?></td>
										</tr>
										
										<tr>
											<td>Bank</td>
											<td colspan="2"><?php echo $arcBulkCol_res['bank_name'];?></td>
								
											<td>Cheque Date</td>
											<td colspan="2"><?php echo $arcBulkCol_res['cheque_date'];?></td>
										</tr>
										<tr>
				<td></td>
				<td colspan="2"></td>
	
				<td>Cheque No</td>
				<td colspan="2"><?php echo $arcBulkCol_res['cheque_no'];?></td>
			</tr>
								</tbody>
								
							<thead>
							
							<tr>
								<td colspan="3">Head of Account</td>
								<td colspan="2">Amount</td>
							
							</tr>
							<tr>
								<td colspan="3"></td>
								<td>Rs.</td>
								<td>P.</td>
							</tr>
							</thead>
							
							<tbody>
										<?php
											$vd_sql="SELECT voucher_code,name as ledger_name,receipt,payment 
															FROM voucher_detail v
														JOIN
															ledger l
														ON
															l.code=v.ledger_code
														 WHERE voucher_code='$voucher_code'";
														 
											$vd_row=mysql_query($vd_sql);
											while($vd_res=mysql_fetch_array($vd_row))
											{
												
												?>
												<tr>
													<td colspan="3"><?php echo $vd_res['ledger_name'];?></td>
													<td align="right"><?php $amount=round($vd_res['payment']); if($amount==0) { $amount=round($vd_res['receipt']); } echo $amount;?></td>
													<td></td>
												</tr>
												
												
												<?php
											
											}
											
										?>
										
								<?php
								$vd_sql1="SELECT SUM(receipt) as total_receipt,SUM(payment) as total_payment
										FROM
											voucher_detail
														 WHERE voucher_code='$voucher_code'";
														 
											$vd_row1=mysql_query($vd_sql1);
											$vd_res1=mysql_fetch_array($vd_row1);
									?>
								
								<tfoot>
									<tr>
										<td colspan="3">Total</td>
										<td align="right"><?php echo round($vd_res1['total_payment']);?></td>
										<td></td>
									</tr>
								</tfoot>
								
								</table>

<?php
}
else if($voucher_purpose_code=='PUR-007')
{
	echo "Loan closed";
	
	$arcLonCls_sql="SELECT 
  										v.code,DATE_FORMAT(date,'%d-%b-%Y') as date,
										v.voucher_category_code,vc.name as voucher_category_name,
										v.voucher_purpose_code,vp.name as voucher_purpose_name,v.reference_no,
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
								 	v.code='$voucher_code'
								ORDER BY 
								     v.id DESC";
				 
									
					$arcLonCls_row=mysql_query($arcLonCls_sql);
					$arcLonCls_res=mysql_fetch_array($arcLonCls_row);
					
			?>
					<div class="right">
							<a href="#" id="1" class="excel"  onclick="tableToExcel('tblARCLoanCls', 'List User')">
								<span class="fa fa-download">&nbsp;Excel</a>&nbsp;&nbsp;
							 <a href="/UCO/voucher/voucher-print.php?voucher_code=<?php echo $voucher_code; ?>" target="_blank"  style="float:right"><i class="fa fa-print"></i> Print</a>
					</div>
							<table class="table table-hoever table-bordered" id="tblARCLoanCls">
								<thead>
									<caption><center>Thrift & Credit Society Ltd., MSCS CR/42/94<br>
														328(Old No. 169) Thambu Chetty Street, Chennai-600 001.</center></caption>
								</thead>
								<tbody>
										<tr>
											<td>Voucher Code</td>
											<td colspan="2"><?php echo $arcLonCls_res['code'];?></td>
											<td>Date</td>
											<td colspan="2"><?php echo $arcLonCls_res['date'];?></td>
										</tr>
										
										<tr>
											<td>Category</td>
											<td colspan="2"><?php echo $arcLonCls_res['voucher_category_name'];?></td>
											<td>Purpose</td>
											<td colspan="2"><?php echo $arcLonCls_res['voucher_purpose_name'];?></td>
										</tr>
										
										<tr>
											<td>Member No</td>
											<td colspan="2"><?php echo $arcLonCls_res['member_no'];?></td>
											<td>Name</td>
											<td colspan="2"><?php echo $arcLonCls_res['name'];?></td>
										</tr>
										
										<tr>
											<td>Branch</td>
											<td colspan="2"><?php echo $arcLonCls_res['branch_code']."-".$arcLonCls_res['branch_name'];?></td>
											<td>Reference No</td>
											<td colspan="2"><?php echo $arcLonCls_res['reference_no'];?></td>
										</tr>
										
										<tr>
											<td>Bank</td>
											<td colspan="2"><?php echo $arcLonCls_res['bank_name'];?></td>
								
											<td>Cheque Date</td>
											<td colspan="2"><?php echo $arcLonCls_res['cheque_date'];?></td>
										</tr>
										<tr>
				<td></td>
				<td colspan="2"></td>
	
				<td>Cheque No</td>
				<td colspan="2"><?php echo $arcLonCls_res['cheque_no'];?></td>
			</tr>
								</tbody>
								
							
							
					<thead>
							
							<tr>
								<td colspan="3">Head of Account</td>
								<td colspan="2">Amount</td>
							
							</tr>
							<tr>
								<td colspan="3"></td>
								<td>Rs.</td>
								<td>P.</td>
							</tr>
					</thead>
						
					
					<tbody>
										<?php
											$vd_sql="SELECT voucher_code,name as ledger_name,receipt,payment 
															FROM voucher_detail v
														JOIN
															ledger l
														ON
															l.code=v.ledger_code
														 WHERE voucher_code='$voucher_code'";
														 
											$vd_row=mysql_query($vd_sql);
											while($vd_res=mysql_fetch_array($vd_row))
											{
												
												?>
												<tr>
													<td colspan="3"><?php echo $vd_res['ledger_name'];?></td>
													<td align="right"><?php $amount=round($vd_res['payment']); if($amount==0) { $amount=round($vd_res['receipt']); } echo $amount;?></td>
													<td></td>
												</tr>
												
												
												<?php
											
											}
											
										?>
										
								<?php
								$vd_sql1="SELECT SUM(receipt) as total_receipt,SUM(payment) as total_payment
										FROM
											voucher_detail
														 WHERE voucher_code='$voucher_code'";
														 
											$vd_row1=mysql_query($vd_sql1);
											$vd_res1=mysql_fetch_array($vd_row1);
									?>
								
								<tfoot>
									<tr>
										<td colspan="3">Total</td>
										<td align="right"><?php echo round($vd_res1['total_payment']);?></td>
										<td></td>
									</tr>
								</tfoot>
					
					</table>
	<?php

}
else if($voucher_purpose_code=='PUR-008')
{
	
	
	$arcScr_sql="SELECT 
  										v.code,DATE_FORMAT(date,'%d-%b-%Y') as date,
										v.voucher_category_code,vc.name as voucher_category_name,
										v.voucher_purpose_code,vp.name as voucher_purpose_name,v.reference_no,
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
								 	v.code='$voucher_code'
								ORDER BY 
								     v.id DESC";
				 
									
					$arcScr_row=mysql_query($arcScr_sql);
					$arcScr_res=mysql_fetch_array($arcScr_row);
					
			?>
					<div class="right">
							<a href="#" id="1" class="excel"  onclick="tableToExcel('tblARCLoanCls', 'List User')">
								<span class="fa fa-download">&nbsp;Excel</a>&nbsp;&nbsp;
							 <a href="/UCO/voucher/voucher-print.php?voucher_code=<?php echo $voucher_code; ?>" target="_blank"  style="float:right"><i class="fa fa-print"></i> Print</a>
					</div>
							<table class="table table-hoever table-bordered" id="tblARCLoanCls">
								<thead>
									<caption><center>Thrift & Credit Society Ltd., MSCS CR/42/94<br>
														328(Old No. 169) Thambu Chetty Street, Chennai-600 001.</center></caption>
								</thead>
								<tbody>
										<tr>
											<td>Voucher Code</td>
											<td colspan="2"><?php echo $arcScr_res['code'];?></td>
											<td>Date</td>
											<td colspan="2"><?php echo $arcScr_res['date'];?></td>
										</tr>
										
										<tr>
											<td>Category</td>
											<td colspan="2"><?php echo $arcScr_res['voucher_category_name'];?></td>
											<td>Purpose</td>
											<td colspan="2"><?php echo $arcScr_res['voucher_purpose_name'];?></td>
										</tr>
										
										<tr>
											<td>Member No</td>
											<td colspan="2"><?php echo $arcScr_res['member_no'];?></td>
											<td>Name</td>
											<td colspan="2"><?php echo $arcScr_res['name'];?></td>
										</tr>
										
										<tr>
											<td>Branch</td>
											<td colspan="2"><?php echo $arcScr_res['branch_code']."-".$arcScr_res['branch_name'];?></td>
											<td>Reference No</td>
											<td colspan="2"><?php echo $arcScr_res['reference_no'];?></td>
										</tr>
										
										<tr>
											<td>Bank</td>
											<td colspan="2"><?php echo $arcScr_res['bank_name'];?></td>
								
											<td>Cheque Date</td>
											<td colspan="2"><?php echo $arcScr_res['cheque_date'];?></td>
										</tr>
										<tr>
				<td></td>
				<td colspan="2"></td>
	
				<td>Cheque No</td>
				<td colspan="2"><?php echo $arcScr_res['cheque_no'];?></td>
			</tr>
								</tbody>
								
							
							
						<thead>
					<tr>
								<td colspan="3">Head of Account</td>
								<td colspan="2">Amount</td>
							
							</tr>
							<tr>
								<td colspan="3"></td>
								<td>Rs.</td>
								<td>P.</td>
							</tr>
					</thead>
						
					
					<tbody>
					<?php
					$vd_sql="SELECT voucher_code,name as ledger_name,receipt,payment 
												FROM voucher_detail v
											JOIN
												ledger l
											ON
												l.code=v.ledger_code
											 WHERE voucher_code='$voucher_code'";
											 
									
											 
								$vd_row=mysql_query($vd_sql);
								while($vd_res=mysql_fetch_array($vd_row))
								{
								
					?>
						<tr>
							
							<td colspan="3"><?php echo $vd_res['ledger_name'];?></td>
							<td><?php if($vd_res['receipt']<>0) { echo round($vd_res['receipt']); } else { echo round($vd_res['payment']);};?></td>
							<td></td>
						</tr>
					<?php
								}
						$vd_sql1="SELECT SUM(receipt) as total_receipt,SUM(payment) as total_payment
							FROM
								voucher_detail
											 WHERE voucher_code='$voucher_code'";
											 
								$vd_row1=mysql_query($vd_sql1);
								$vd_res1=mysql_fetch_array($vd_row1);
						?>
					
					<tfoot>
						<tr>
							<td colspan="3">Total</td>
							<td><?php echo round($vd_res1['total_receipt']);?></td>
							<td></td>
							
						</tr>
					</tfoot>
					
					</table>
	<?php
	}//vourcher purpose PUR-008 close
	
	
else if($voucher_purpose_code=='PUR-017')
{
	
	
	$arcScr_sql="SELECT 
  										v.code,DATE_FORMAT(date,'%d-%b-%Y') as date,
										v.voucher_category_code,vc.name as voucher_category_name,
										v.voucher_purpose_code,vp.name as voucher_purpose_name,v.reference_no,
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
								 	v.code='$voucher_code'
								ORDER BY 
								     v.id DESC";
				 
									
					$arcScr_row=mysql_query($arcScr_sql);
					$arcScr_res=mysql_fetch_array($arcScr_row);
					
			?>
					<div class="right">
							<a href="#" id="1" class="excel"  onclick="tableToExcel('tblARCLoanCls', 'List User')">
								<span class="fa fa-download">&nbsp;Excel</a>&nbsp;&nbsp;
							 <a href="/UCO/voucher/voucher-print.php?voucher_code=<?php echo $voucher_code; ?>" target="_blank"  style="float:right"><i class="fa fa-print"></i> Print</a>
					</div>
							<table class="table table-hoever table-bordered" id="tblARCLoanCls">
								<thead>
									<caption><center>Thrift & Credit Society Ltd., MSCS CR/42/94<br>
														328(Old No. 169) Thambu Chetty Street, Chennai-600 001.</center></caption>
								</thead>
								<tbody>
										<tr>
											<td>Voucher Code</td>
											<td colspan="2"><?php echo $arcScr_res['code'];?></td>
											<td>Date</td>
											<td colspan="2"><?php echo $arcScr_res['date'];?></td>
										</tr>
										
										<tr>
											<td>Category</td>
											<td colspan="2"><?php echo $arcScr_res['voucher_category_name'];?></td>
											<td>Purpose</td>
											<td colspan="2"><?php echo $arcScr_res['voucher_purpose_name'];?></td>
										</tr>
										
										<tr>
											<td>Member No</td>
											<td colspan="2"><?php echo $arcScr_res['member_no'];?></td>
											<td>Name</td>
											<td colspan="2"><?php echo $arcScr_res['name'];?></td>
										</tr>
										
										<tr>
											<td>Branch</td>
											<td colspan="2"><?php echo $arcScr_res['branch_code']."-".$arcScr_res['branch_name'];?></td>
											<td>Reference No</td>
											<td colspan="2"><?php echo $arcScr_res['reference_no'];?></td>
										</tr>
										
										<tr>
											<td>Bank</td>
											<td colspan="2"><?php echo $arcScr_res['bank_name'];?></td>
								
											<td>Cheque Date</td>
											<td colspan="2"><?php echo $arcScr_res['cheque_date'];?></td>
										</tr>
										<tr>
				<td></td>
				<td colspan="2"></td>
	
				<td>Cheque No</td>
				<td colspan="2"><?php echo $arcScr_res['cheque_no'];?></td>
			</tr>
								</tbody>
								
							
							
						<thead>
					<tr>
								<td colspan="3">Head of Account</td>
								<td colspan="2">Amount</td>
							
							</tr>
							<tr>
								<td colspan="3"></td>
								<td>Rs.</td>
								<td>P.</td>
							</tr>
					</thead>
						
					
					<tbody>
					<?php
					$vd_sql="SELECT voucher_code,name as ledger_name,receipt,payment 
												FROM voucher_detail v
											JOIN
												ledger l
											ON
												l.code=v.ledger_code
											 WHERE voucher_code='$voucher_code'";
											 
									
											 
								$vd_row=mysql_query($vd_sql);
								while($vd_res=mysql_fetch_array($vd_row))
								{
								
					?>
						<tr>
							
							<td colspan="3"><?php echo $vd_res['ledger_name'];?></td>
							<td><?php if($vd_res['receipt']<>0) { echo round($vd_res['receipt']); } else { echo round($vd_res['payment']);};?></td>
							<td></td>
						</tr>
					<?php
								}
						$vd_sql1="SELECT SUM(receipt) as total_receipt,SUM(payment) as total_payment
							FROM
								voucher_detail
											 WHERE voucher_code='$voucher_code'";
											 
								$vd_row1=mysql_query($vd_sql1);
								$vd_res1=mysql_fetch_array($vd_row1);
						?>
					
					<tfoot>
						<tr>
							<td colspan="3">Total</td>
							<td><?php echo round($vd_res1['total_receipt']);?></td>
							<td></td>
							
						</tr>
					</tfoot>
					
					</table>
	<?php
	}//vourcher purpose PUR-008 close
else if($voucher_purpose_code=='PUR-010' || $voucher_purpose_code=='PUR-013')
{
	
	
	$arcScr_sql="SELECT 
  										v.code,DATE_FORMAT(date,'%d-%b-%Y') as date,
										v.voucher_category_code,vc.name as voucher_category_name,
										v.voucher_purpose_code,vp.name as voucher_purpose_name,v.reference_no,
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
								 	v.code='$voucher_code'
								ORDER BY 
								     v.id DESC";
				 
									
					$arcScr_row=mysql_query($arcScr_sql);
					$arcScr_res=mysql_fetch_array($arcScr_row);
					
			?>
					<div class="right">
							<a href="#" id="1" class="excel"  onclick="tableToExcel('tblARCLoanCls', 'List User')">
								<span class="fa fa-download">&nbsp;Excel</a>&nbsp;&nbsp;
							 <a href="/UCO/voucher/voucher-print.php?voucher_code=<?php echo $voucher_code; ?>" target="_blank"  style="float:right"><i class="fa fa-print"></i> Print</a>
					</div>
							<table class="table table-hoever table-bordered" id="tblARCLoanCls">
								<thead>
									<caption><center>Thrift & Credit Society Ltd., MSCS CR/42/94<br>
														328(Old No. 169) Thambu Chetty Street, Chennai-600 001.</center></caption>
								</thead>
								<tbody>
										<tr>
											<td>Voucher Code</td>
											<td colspan="2"><?php echo $arcScr_res['code'];?></td>
											<td>Date</td>
											<td colspan="2"><?php echo $arcScr_res['date'];?></td>
										</tr>
										
										<tr>
											<td>Category</td>
											<td colspan="2"><?php echo $arcScr_res['voucher_category_name'];?></td>
											<td>Purpose</td>
											<td colspan="2"><?php echo $arcScr_res['voucher_purpose_name'];?></td>
										</tr>
										
										<tr>
											<td>Member No</td>
											<td colspan="2"><?php echo $arcScr_res['member_no'];?></td>
											<td>Name</td>
											<td colspan="2"><?php echo $arcScr_res['name'];?></td>
										</tr>
										
										<tr>
											<td>Branch</td>
											<td colspan="2"><?php echo $arcScr_res['branch_code']."-".$arcScr_res['branch_name'];?></td>
											<td>Reference No</td>
											<td colspan="2"><?php echo $arcScr_res['reference_no'];?></td>
										</tr>
										
										<tr>
											<td>Bank</td>
											<td colspan="2"><?php echo $arcScr_res['bank_name'];?></td>
								
											<td>Cheque Date</td>
											<td colspan="2"><?php echo $arcScr_res['cheque_date'];?></td>
										</tr>
										<tr>
				<td></td>
				<td colspan="2"></td>
	
				<td>Cheque No</td>
				<td colspan="2"><?php echo $arcScr_res['cheque_no'];?></td>
			</tr>
								</tbody>
								
							
							
						<thead>
					<tr>
								<td colspan="3">Head of Account</td>
								<td colspan="2">Amount</td>
							
							</tr>
							<tr>
								<td colspan="3"></td>
								<td>Rs.</td>
								<td>P.</td>
							</tr>
					</thead>
						
					
					<tbody>
					<?php
											$vd_sql="SELECT voucher_code,name as ledger_name,receipt,payment 
															FROM voucher_detail v
														JOIN
															ledger l
														ON
															l.code=v.ledger_code
														 WHERE voucher_code='$voucher_code'";
														 
											$vd_row=mysql_query($vd_sql);
											while($vd_res=mysql_fetch_array($vd_row))
											{
												
												?>
												<tr>
													<td colspan="3"><?php echo $vd_res['ledger_name'];?></td>
													<td align="right"><?php $amount=round($vd_res['payment']); if($amount==0) { $amount=round($vd_res['receipt']); } echo $amount;?></td>
													<td></td>
												</tr>
												
												
												<?php
											
											}
											
										?>
										
								<?php
								$vd_sql1="SELECT SUM(receipt) as total_receipt,SUM(payment) as total_payment
										FROM
											voucher_detail
														 WHERE voucher_code='$voucher_code'";
														 
											$vd_row1=mysql_query($vd_sql1);
											$vd_res1=mysql_fetch_array($vd_row1);
									?>
								
					
					<tfoot>
						<tr>
							<td colspan="3">Total</td>
							<td><?php echo round($vd_res1['total_receipt']);?></td>
							<td></td>
							
						</tr>
					</tfoot>
					
					</table>
	<?php
	}//vourcher purpose PUR-008 close

 ?>
 <script>
			// Approve voucher by Admin 
 function approve_voucher(a)
 {
	 var voucher_no=a;
	 $.ajax({
		 type : 'get',
		data: 'vou_no='+a,
		url : '/uco/new_voucher/approve_voucher/approve_voucher.php',
		success: function(data){
		         if(data==1)
				 {
					 alert("Voucher Will be Approved..!");
					 new_voucher();
				 }
				 else if(data==0)
				 {
					 alert('Voucher Details will not be Approved..!!!!');
					 new_voucher();
				 }
				 else
				 {
					 alert('Voucher will not be Approved');
					 new_voucher();
				 }
		}
	 });
 }
 </script>