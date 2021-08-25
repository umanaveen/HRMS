<?php
	require('../../connect.php');
	//require('../../user.php');
	$user_id=1;//$_SESSION['user'];

	$voucher_code=$_REQUEST['vocuher_no'];	
	$pur_chech_id=$_REQUEST['pur_id'];

	$pur_det=$con->query("SELECT voucher_purpose_code,status FROM accounts_voucher where code='$voucher_code'");	
	$vouc_Pur_code=$pur_det->fetch(PDO::FETCH_ASSOC);
	
	$voucher_purpose_code=$vouc_Pur_code['voucher_purpose_code'];
	$status=$vouc_Pur_code['status'];
	

if($voucher_purpose_code=='PUR-001' || $voucher_purpose_code=='PUR-016')  /* if($voucher_purpose_code=='PUR-005') start here */ 
{
	
	$arcNewMember_sql="SELECT 
  										v.code,DATE_FORMAT(date,'%d-%b-%Y') as date,
										v.voucher_category_code,vc.name as voucher_category_name,
										v.voucher_purpose_code,vp.name as voucher_purpose_name,v.reference_no as member_no,
										v.slip_no,v.member_no,v.name,
										bn.name as bank_name,v.cheque_no,DATE_FORMAT(cheque_date,'%d-%b-%Y') as cheque_date,
										v.ledger_code,l.name as ledger_name,
										v.amount
								FROM 
									accounts_voucher v
								JOIN
									accounts_voucher_category vc
								ON
									vc.code=v.voucher_category_code  
								LEFT JOIN
									accounts_voucher_purpose vp
								ON
									vp.code=v.voucher_purpose_code
								LEFT JOIN
									accounts_bank bn
								ON
									bn.code=v.bank_code
									
								LEFT JOIN
								     accounts_ledger l
							    ON
								   l.code=v.ledger_code
								 WHERE
								 	v.code='$voucher_code'
								ORDER BY 
								     v.id DESC";
				 
				 
					//echo $arcNewMember_sql;
					
					$arcNewMember_row=$con->query($arcNewMember_sql);
					$arcNewMember_res=$arcNewMember_row->fetch(PDO::FETCH_ASSOC);
?>
<table>
<tr><td colspan="10"><a href="#" id="1" class="excel"  onclick="tableToExcel('tblARCNewMember')">
<span class="fa fa-download">&nbsp;Excel</a>&nbsp;&nbsp;</td></tr>
<a href="#" onclick="printtab()" target="_blank"  style="float:right;"><i class="fa fa-print"></i> Print</a>
</table>
<script>
function printtab()
{
	var print_table= document.getElementById('tblARCNewMember');
	newWin = window.open("");
      newWin.document.write(print_table.outerHTML);
      newWin.print();
      newWin.close();
}
</script>
<div id="tblARCNewMember">
<table class="table table-hover table-bordered">
	<?php
if($status=='4')
{
	?>
	<h4><center>REJECTED VOUCHER</center></h4>
	<?php
}
else
{
	
}
?>

	
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
				<td colspan="2"><?php //echo $arcNewMember_res['branch_code']."-".$arcNewMember_res['branch_name'];?></td>
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
	
	$vd_sql="select reference,name as ledger_name,amount,type from account_entry ae JOIN accounts_ledger l ON l.code=ae.ledger_code	WHERE ae.reference='$voucher_code'";

	$vd_row=$con->query($vd_sql);
	while($vd_res=$vd_row->fetch(PDO::FETCH_ASSOC))
	{
		?>
		<tr>
		<td colspan="3"><?php echo $vd_res['ledger_name'];?></td>
		<td align="right"><?php $amount=round($vd_res['amount']); if($amount==0) { $amount=round($vd_res['amount']); } echo $amount;?></td>
		<td></td>
		</tr>
		<?php
	}

	$vd_sql1="SELECT SUM(amount) as total_payment FROM account_entry WHERE reference='$voucher_code' and type='debit'";

	$vd_row1=$con->query($vd_sql1);
	$vd_res1=$vd_row1->fetch(PDO::FETCH_ASSOC)
	?>

	<tfoot>
	<tr>
	<td colspan="3">Total</td>
	<td align="right"><?php echo round($vd_res1['total_payment']);?></td>
	<td></td>
	</tr>
	</tfoot>

	</table>
	</div>


<?php

} /* if($voucher_purpose_code=='PUR-001') close here */
else if($voucher_purpose_code=='PUR-003'|| $voucher_purpose_code=='PUR-016')  /* if($voucher_purpose_code=='PUR-003') start here */
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
					
					<table>
<tr><td colspan="10"><a href="#" id="1" class="excel"  onclick="tableToExcel('tblARCAdjCol')">
<span class="fa fa-download">&nbsp;Excel</a>&nbsp;&nbsp;</td></tr>
	<a href="#" onclick="printtab()" target="_blank"  style="float:right;"><i class="fa fa-print"></i> Print</a>
</table>
<script>
function printtab()
{
	var print_table= document.getElementById('tblARCAdjCol');
	newWin = window.open("");
      newWin.document.write(print_table.outerHTML);
      newWin.print();
      newWin.close();
}
</script>
							
<div  id="tblARCAdjCol">
<?php
if($status=='4')
{
	?>
	<h4><center>REJECTED VOUCHER</center></h4>
	<?php
}
else
{
	
}
?>
				<table class="table table-hoever table-bordered" id="">
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
					//$vd_sql="SELECT voucher_code,name as ledger_name,amount,type FROM voucher_detail v JOIN	ledger l ON l.code=v.ledger_code	WHERE voucher_code='$voucher_code'"; 
					
					$vd_sql="select reference,name as ledger_name,amount,type from account_entry ae JOIN ledger l ON l.code=ae.ledger_code	WHERE ae.reference='$voucher_code'";

					$vd_row=mysql_query($vd_sql);
					while($vd_res=mysql_fetch_array($vd_row))
					{

					?>
					<tr>
					<td colspan="3"><?php echo $vd_res['ledger_name'];?></td>
					<td align="right"><?php $amount=round($vd_res['amount']); if($amount==0) { $amount=round($vd_res['amount']); } echo $amount;?></td>
					<td></td>
					</tr>


					<?php

					}

					?>

					<?php
					//$vd_sql1="SELECT SUM(amount) as total_payment FROM voucher_detail WHERE voucher_code='$voucher_code' and type='debit'";
					
					$vd_sql1="SELECT SUM(amount) as total_payment FROM account_entry WHERE reference='$voucher_code' and type='debit'";
							 
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
								</div>

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
				<table>
<tr><td colspan="10"><a href="#" id="1" class="excel"  onclick="tableToExcel('tblARCBulkCol')">
<span class="fa fa-download">&nbsp;Excel</a>&nbsp;&nbsp;</td></tr>
	<a href="#" onclick="printtab()" target="_blank"  style="float:right;"><i class="fa fa-print"></i> Print</a>
</table>
<script>
function printtab()
{
	var print_table= document.getElementById('tblARCBulkCol');
	newWin = window.open("");
      newWin.document.write(print_table.outerHTML);
      newWin.print();
      newWin.close();
}
</script>
		
<div  id="tblARCBulkCol">
<?php
if($status=='4')
{
	?>
	<h4><center>REJECTED VOUCHER</center></h4>
	<?php
}
else
{
	
}
?>
							<table class="table table-hoever table-bordered" id="">
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
					//$vd_sql="SELECT voucher_code,name as ledger_name,amount,type FROM voucher_detail v JOIN	ledger l ON	l.code=v.ledger_code WHERE voucher_code='$voucher_code'";

					$vd_sql="select reference,name as ledger_name,amount,type from account_entry ae JOIN ledger l ON l.code=ae.ledger_code	WHERE ae.reference='$voucher_code'";

					
					$vd_row=mysql_query($vd_sql);
					while($vd_res=mysql_fetch_array($vd_row))
					{

					?>
					<tr>
					<td colspan="3"><?php echo $vd_res['ledger_name'];?></td>
					<td align="right"><?php $amount=round($vd_res['amount']); if($amount==0) { $amount=round($vd_res['amount']); } echo $amount;?></td>
					<td></td>
					</tr>


					<?php

					}

					?>

					<?php
					//$vd_sql1="SELECT SUM(amount) as total_payment FROM voucher_detail WHERE voucher_code='$voucher_code' and type='debit'";
					
					$vd_sql1="SELECT SUM(amount) as total_payment FROM account_entry WHERE reference='$voucher_code' and type='debit'";
							 
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
</div>
<?php
}
else if($voucher_purpose_code=='PUR-007')
{
	//echo "Loan closed";
	
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
				<table>
<tr><td colspan="10"><a href="#" id="1" class="excel"  onclick="tableToExcel('tblARCLoanCls')">
<span class="fa fa-download">&nbsp;Excel</a>&nbsp;&nbsp;</td></tr>
	<a href="#" onclick="printtab()" target="_blank"  style="float:right;"><i class="fa fa-print"></i> Print</a>
</table>
<script>
function printtab()
{
	var print_table= document.getElementById('tblARCLoanCls');
	newWin = window.open("");
      newWin.document.write(print_table.outerHTML);
      newWin.print();
      newWin.close();
}
</script>
<div  id="tblARCLoanCls">
<?php
if($status=='4')
{
	?>
	<h4><center>REJECTED VOUCHER</center></h4>
	<?php
}
else
{
	
}
?>
							<table class="table table-hoever table-bordered" id="">
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
					//$vd_sql="SELECT voucher_code,name as ledger_name,amount,type FROM voucher_detail v JOIN	ledger l ON	l.code=v.ledger_code WHERE voucher_code='$voucher_code'";

					$vd_sql="select reference,name as ledger_name,amount,type from account_entry ae JOIN ledger l ON l.code=ae.ledger_code	WHERE ae.reference='$voucher_code'";

					$vd_row=mysql_query($vd_sql);
					while($vd_res=mysql_fetch_array($vd_row))
					{

					?>
					<tr>
					<td colspan="3"><?php echo $vd_res['ledger_name'];?></td>
					<td align="right"><?php $amount=round($vd_res['amount']); if($amount==0) { $amount=round($vd_res['amount']); } echo $amount;?></td>
					<td></td>
					</tr>


					<?php

					}

					?>

					<?php
					//$vd_sql1="SELECT SUM(amount) as total_payment FROM voucher_detail WHERE voucher_code='$voucher_code' and type='debit'";
					
					$vd_sql1="SELECT SUM(amount) as total_payment FROM account_entry WHERE reference='$voucher_code' and type='debit'";
							 
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
					</div>
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
					<table>
<tr><td colspan="10"><a href="#" id="1" class="excel"  onclick="tableToExcel('tblARCLoanCls')">
<span class="fa fa-download">&nbsp;Excel</a>&nbsp;&nbsp;</td></tr>
	<a href="#" onclick="printtab()" target="_blank"  style="float:right;"><i class="fa fa-print"></i> Print</a>
</table>
<script>
function printtab()
{
	var print_table= document.getElementById('tblARCLoanCls');
	newWin = window.open("");
      newWin.document.write(print_table.outerHTML);
      newWin.print();
      newWin.close();
}
</script>

<div  id="tblARCLoanCls">
<?php
if($status=='4')
{
	?>
	<h4><center>REJECTED VOUCHER</center></h4>
	<?php
}
else
{
	
}
?>
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
					//$vd_sql="SELECT voucher_code,name as ledger_name,amount,type FROM voucher_detail v JOIN ledger l ON l.code=v.ledger_code WHERE voucher_code='$voucher_code'"; OLD CODE
					
					$vd_sql="select reference,name as ledger_name,amount,type from account_entry ae JOIN ledger l ON l.code=ae.ledger_code	WHERE ae.reference='$voucher_code'";

					$vd_row=mysql_query($vd_sql);
					while($vd_res=mysql_fetch_array($vd_row))
					{

					?>
					<tr>
					<td colspan="3"><?php echo $vd_res['ledger_name'];?></td>
					<td align="right"><?php $amount=round($vd_res['amount']); if($amount==0) { $amount=round($vd_res['amount']); } echo $amount;?></td>
					<td></td>
					</tr>


					<?php

					}

					?>

					<?php
					//$vd_sql1="SELECT SUM(amount) as total_payment FROM voucher_detail WHERE voucher_code='$voucher_code' and type='debit'";  OLD CODE 
										
					$vd_sql1="SELECT SUM(amount) as total_payment FROM account_entry WHERE reference='$voucher_code' and type='debit'";
							 
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
					</div>
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
					<table>
<tr><td colspan="10"><a href="#" id="1" class="excel"  onclick="tableToExcel('tblARCLoanCls')">
<span class="fa fa-download">&nbsp;Excel</a>&nbsp;&nbsp;</td></tr>
	<a href="#" onclick="printtab()" target="_blank"  style="float:right;"><i class="fa fa-print"></i> Print</a>
</table>
<script>
function printtab()
{
	var print_table= document.getElementById('tblARCLoanCls');
	newWin = window.open("");
      newWin.document.write(print_table.outerHTML);
      newWin.print();
      newWin.close();
}
</script>
<div  id="tblARCLoanCls">
<?php
if($status=='4')
{
	?>
	<h4><center>REJECTED VOUCHER</center></h4>
	<?php
}
else
{
	
}
?>
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
					$vd_sql="SELECT voucher_code,name as ledger_name,amount,type FROM voucher_detail v JOIN	ledger l ON
					l.code=v.ledger_code WHERE voucher_code='$voucher_code'";

					$vd_sql="select reference,name as ledger_name,amount,type from account_entry ae JOIN ledger l ON l.code=ae.ledger_code	WHERE ae.reference='$voucher_code'";
					
					$vd_row=mysql_query($vd_sql);
					while($vd_res=mysql_fetch_array($vd_row))
					{

					?>
					<tr>
					<td colspan="3"><?php echo $vd_res['ledger_name'];?></td>
					<td align="right"><?php $amount=round($vd_res['amount']); if($amount==0) { $amount=round($vd_res['amount']); } echo $amount;?></td>
					<td></td>
					</tr>


					<?php

					}

					?>

					<?php
					//$vd_sql1="SELECT SUM(amount) as total_payment FROM voucher_detail WHERE voucher_code='$voucher_code' and type='debit'";
					
					$vd_sql1="SELECT SUM(amount) as total_payment FROM account_entry WHERE reference='$voucher_code' and type='debit'";
							 
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
					</div>
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
					<table>
<tr><td colspan="10"><a href="#" id="1" class="excel"  onclick="tableToExcel('tblARCLoanCls')">
<span class="fa fa-download">&nbsp;Excel</a>&nbsp;&nbsp;</td></tr>
	<a href="#" onclick="printtab()" target="_blank"  style="float:right;"><i class="fa fa-print"></i> Print</a>
</table>
<script>
function printtab()
{
	var print_table= document.getElementById('tblARCLoanCls');
	newWin = window.open("");
      newWin.document.write(print_table.outerHTML);
      newWin.print();
      newWin.close();
}
</script>
<div  id="tblARCLoanCls">
<?php
if($status=='4')
{
	?>
	<h4><center>REJECTED VOUCHER</center></h4>
	<?php
}
else
{
	
}
?>
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
					//$vd_sql="SELECT voucher_code,name as ledger_name,amount,type FROM voucher_detail v JOIN ledger l		ON l.code=v.ledger_code	WHERE voucher_code='$voucher_code'";

					$vd_sql="select reference,name as ledger_name,amount,type from account_entry ae JOIN ledger l ON l.code=ae.ledger_code	WHERE ae.reference='$voucher_code'";
					
					$vd_row=mysql_query($vd_sql);
					while($vd_res=mysql_fetch_array($vd_row))
					{

					?>
					<tr>
					<td colspan="3"><?php echo $vd_res['ledger_name'];?></td>
					<td align="right"><?php $amount=round($vd_res['amount']); if($amount==0) { $amount=round($vd_res['amount']); } echo $amount;?></td>
					<td></td>
					</tr>


					<?php

					}

					?>

					<?php
					//$vd_sql1="SELECT SUM(amount) as total_payment FROM	voucher_detail WHERE voucher_code='$voucher_code' and type='debit'";
					
					$vd_sql1="SELECT SUM(amount) as total_payment FROM account_entry WHERE reference='$voucher_code' and type='debit'";
							 
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
					</div>
	<?php
	}//vourcher purpose PUR-008 close
	
if($voucher_purpose_code=='PUR-021')  /* if($voucher_purpose_code=='PUR-021') start here */ 
{
	
	$arcNewMember_sql="SELECT 
  										v.code,DATE_FORMAT(date,'%d-%b-%Y') as date,
										v.voucher_category_code,vc.name as voucher_category_name,
										v.voucher_purpose_code,vp.name as voucher_purpose_name,v.reference_no as member_nos,
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
					<table>
<tr><td colspan="10"><a href="#" id="1" class="excel"  onclick="tableToExcel('tblARCNewMember')">
<span class="fa fa-download">&nbsp;Excel</a>&nbsp;&nbsp;</td></tr>
	<a href="#" onclick="printtab()" target="_blank"  style="float:right;"><i class="fa fa-print"></i> Print</a>
</table>
<script>
function printtab()
{
	var print_table= document.getElementById('tblARCNewMember');
	newWin = window.open("");
      newWin.document.write(print_table.outerHTML);
      newWin.print();
      newWin.close();
}
</script>
<div  id="tblARCNewMember">
<table class="table table-hover table-bordered">
	<?php
if($status=='4')
{
	?>
	<h4><center>REJECTED VOUCHER</center></h4>
	<?php
}
else
{
	
}
?>

<thead>
		<caption><b><center>UCO BANK <br>Thrift & Credit Society Ltd., MSCS CR/42/94<br>
							328(Old No. 169) Thambu Chetty Street, Chennai-600 001.</center></b>></caption>
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
				<td>Reference No</td>
				<td colspan="2"><?php echo $arcNewMember_res['member_nos'];?></td>
				<td colspan="3"></td>
			</tr>
			
			
	</tbody>
	
<thead>

<tr>
	<td colspan="3"><b>Head of Account</b></td>
	<td colspan="2"><b>Amount</b></td>
</tr>
<tr>
	<td colspan="3"></td>
	<td><b>Rs.</b></td>
	<td><b>P.</b></td>
</tr>
</thead>
	

<tbody>
					<?php
					//$vd_sql="SELECT voucher_code,name as ledger_name,amount,type FROM voucher_detail v JOIN ledger l ON	l.code=v.ledger_code WHERE voucher_code='$voucher_code'";

					$vd_sql="select reference,name as ledger_name,amount,type from account_entry ae JOIN ledger l ON l.code=ae.ledger_code	WHERE ae.reference='$voucher_code'";
					
					$vd_row=mysql_query($vd_sql);
					while($vd_res=mysql_fetch_array($vd_row))
					{

					?>
					<tr>
					<td colspan="3"><?php echo $vd_res['ledger_name'];?></td>
					<td align="right"><?php $amount=round($vd_res['amount']); if($amount==0) { $amount=round($vd_res['amount']); } echo $amount;?></td>
					<td></td>
					</tr>


					<?php

					}

					?>

					<?php
					
					//$vd_sql1="SELECT SUM(amount) as total_payment FROM voucher_detail WHERE voucher_code='$voucher_code' and type='credit'";
					
					$vd_sql1="SELECT SUM(amount) as total_payment FROM account_entry WHERE reference='$voucher_code' and type='debit'";
							 
					$vd_row1=mysql_query($vd_sql1);
					$vd_res1=mysql_fetch_array($vd_row1);
					?>
								
								<tfoot>
									<tr>
										<td colspan="3"><b>Total</b></td>
										<td align="right"><?php echo round($vd_res1['total_payment']);?></td>
										<td></td>
									</tr>
			
			<tr>
			</tr>
			<tr>
			<td colspan="3" style="text-align:center;">Secretary</td>
			<td colspan="2" style="text-align:center;">Signature</td>
			</tr>
			<tr>
			<td colspan="3"></td>
			<td colspan="2"></td>
			</tr>
			
	</tfoot>

</table>
</div>


<?php

} /* if($voucher_purpose_code=='PUR-021') close here */

if($voucher_purpose_code=='PUR-022')  /* if($voucher_purpose_code=='PUR-021') start here */ 
{
	
	$arcNewMember_sql="SELECT 
  										v.code,DATE_FORMAT(date,'%d-%b-%Y') as date,
										v.voucher_category_code,vc.name as voucher_category_name,
										v.voucher_purpose_code,vp.name as voucher_purpose_name,v.reference_no as member_nos,
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
					<table>
<tr><td colspan="10"><a href="#" id="1" class="excel"  onclick="tableToExcel('tblARCNewMember')">
<span class="fa fa-download">&nbsp;Excel</a>&nbsp;&nbsp;</td></tr>
	<a href="#" onclick="printtab()" target="_blank"  style="float:right;"><i class="fa fa-print"></i> Print</a>
</table>
<script>
function printtab()
{
	var print_table= document.getElementById('tblARCNewMember');
	newWin = window.open("");
      newWin.document.write(print_table.outerHTML);
      newWin.print();
      newWin.close();
}
</script>
<div  id="tblARCNewMember">
<table class="table table-hover table-bordered">
	<?php
if($status=='4')
{
	?>
	<h4><center>REJECTED VOUCHER</center></h4>
	<?php
}
else
{
	
}
?>

<thead>
		<caption><b><center>UCO BANK <br>Thrift & Credit Society Ltd., MSCS CR/42/94<br>
							328(Old No. 169) Thambu Chetty Street, Chennai-600 001.</center></b>></caption>
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
				<td>Reference No</td>
				<td colspan="2"><?php echo $arcNewMember_res['member_nos'];?></td>
				<td colspan="3"></td>
			</tr>
			
			
	</tbody>
	
<thead>

<tr>
	<td colspan="3"><b>Head of Account</b></td>
	<td colspan="2"><b>Amount</b></td>
</tr>
<tr>
	<td colspan="3"></td>
	<td><b>Rs.</b></td>
	<td><b>P.</b></td>
</tr>
</thead>
	

<tbody>
					<?php
					//$vd_sql="SELECT voucher_code,name as ledger_name,amount,type FROM voucher_detail v JOIN ledger l ON	l.code=v.ledger_code WHERE voucher_code='$voucher_code'";

					$vd_sql="select reference,name as ledger_name,amount,type from account_entry ae JOIN ledger l ON l.code=ae.ledger_code	WHERE ae.reference='$voucher_code'";
					
					$vd_row=mysql_query($vd_sql);
					while($vd_res=mysql_fetch_array($vd_row))
					{

					?>
					<tr>
					<td colspan="3"><?php echo $vd_res['ledger_name'];?></td>
					<td align="right"><?php $amount=round($vd_res['amount']); if($amount==0) { $amount=round($vd_res['amount']); } echo $amount;?></td>
					<td></td>
					</tr>


					<?php

					}

					?>

					<?php
					
					//$vd_sql1="SELECT SUM(amount) as total_payment FROM voucher_detail WHERE voucher_code='$voucher_code' and type='credit'";
					
					$vd_sql1="SELECT SUM(amount) as total_payment FROM account_entry WHERE reference='$voucher_code' and type='credit'";
							 
					$vd_row1=mysql_query($vd_sql1);
					$vd_res1=mysql_fetch_array($vd_row1);
					?>
								
								<tfoot>
									<tr>
										<td colspan="3"><b>Total</b></td>
										<td align="right"><?php echo round($vd_res1['total_payment']);?></td>
										<td></td>
									</tr>
								</tfoot>

</table>
</div>


<?php

} /* if($voucher_purpose_code=='PUR-022') close here */
 ?>