<?php
require('../../configuration.php');
require('../../user.php');
$user_id=$_SESSION['user'];

$voucher_code=$_REQUEST['voucher_code'];




$voucher_detail=mysql_fetch_array(mysql_query("select * from voucher where code='$voucher_code'"));
$date=$voucher_detail['date'];
$member_no=$voucher_detail['member_no'];	
$name=$voucher_detail['name'];	
$branch_code=$voucher_detail['branch_code'];	
$category_code=$voucher_detail['voucher_category_code'];
$purpose_code=$voucher_detail['voucher_purpose_code'];
$total_amount=$voucher_detail['amount'];
$loan_no=$voucher_detail['reference_no'];
$reference_voucher=$voucher_detail['reference_voucher'];

	$vd_sql=mysql_query("select * FROM voucher_detail WHERE voucher_code='$voucher_code'");
	
	while($vd_res=mysql_fetch_array($vd_sql))
	{
		$ledger_code[]=$vd_res['ledger_code'];
		$amount[]=$vd_res['amount'];
		$type[]=$vd_res['type'];
		$reference[]=$vd_res['reference'];
		$narration[]=$vd_res['narration'];
		
	}
$length=count($ledger_code);	
for($i=0;$i<$length;$i++)
{
		$account_sql="SELECT code FROM account_entry ORDER BY id DESC LIMIT 1";
		$account_row=mysql_query($account_sql);
		$account_res=mysql_fetch_array($account_row);
		$account_code=$account_res['code'];
		$acc_splitValue=explode("-",$account_code);
		$acc_num=$acc_splitValue[1];
		$acc_num=$acc_num+1;
		if($acc_num<100)
		{
		$acc_num=str_pad($acc_num,3,"0",STR_PAD_LEFT);
		}
		
		

		$account_entry_code=$acc_splitValue[0]."-".$acc_num;
		
		if($ledger_code[$i]=='L003' || $ledger_code[$i]=='L002')
		{
			$type='debit';
		}
		else
		{
			$type='credit';
		}
	$account_entry_ins_sql1=mysql_query("INSERT INTO account_entry(code,sequence,main_entity,main_entity_type,reference,		search_no,date,ledger_code,amount,type,created_by,created_on)VALUES('$account_entry_code','$i','VOUCHER','ADJUSTMENT RECEIPT','$voucher_code','$member_no','$date','$ledger_code[$i]','$amount[$i]','$type','$user_id',NOW())");
			
}	
		
$fdr_sql="SELECT * FROM fd_loan_details WHERE loan_no='$loan_no' and member_no='$member_no' and flag_id='2'";	
	$fdr_row=mysql_query($fdr_sql);
	$fdr_res=mysql_fetch_array($fdr_row);
	
	$fd_loan_amount=$fdr_res['amount'];
	
	$fd_loan_amount=round($fd_loan_amount);
	
$principal_query=mysql_fetch_array(mysql_query("select * FROM voucher_detail WHERE voucher_code='$voucher_code' and ledger_code='G003'"));
	$principal_amount=$principal_query['amount'];
	
$interest_query=mysql_fetch_array(mysql_query("select * FROM voucher_detail WHERE voucher_code='$voucher_code' and ledger_code='F007'"));
	$interest_amount=$interest_query['amount'];						
	
	if($principal_amount!=0 && $fd_loan_amount>$principal_amount)
	{	
		
		$int_cal=mysql_fetch_array(mysql_query("SELECT date,interest_rate,amount FROM `fd_loan_details` WHERE `loan_no`='$loan_no' and `flag_id`=2"));
		$int_cal_date=$int_cal['date'];
		$int_interest_rate=$int_cal['interest_rate'];
		$int_amount=$int_cal['amount'];
		
		$diff = abs(strtotime($date) - strtotime($int_cal_date))/86400;	
		
		$fd_loan_interest=(($int_amount*$int_interest_rate/100/365)*$diff);		
		
		echo $fd_loan_interest_amount=round($fd_loan_interest);
		
		$fdloandetail_update_query=mysql_query("UPDATE fd_loan_details set flag_id=3,interest_amount='$fd_loan_interest_amount', closed_date='$date',modified_by='$user_id',modified_on=NOW() where member_no='$member_no' and loan_no='$loan_no' and flag_id=2");
		
		
		//==================================fd collection=======================//
										
	$fdCol_sql="SELECT code FROM fd_collection ORDER BY id DESC";
	$fdCol_row=mysql_query($fdCol_sql);
	$fdCol_check=mysql_num_rows($fdCol_row);

	if($fdCol_check<1)
	{
		$fd_collection_code='FDCOL-001';
	}
	else
	{
		$fdCol_res=mysql_fetch_array($fdCol_row);
		$fdCol_code=$fdCol_res['code'];
		$fdCol_splitValue=explode("-",$fdCol_code);
		$fdCol_num=$fdCol_splitValue[1];
		$fdCol_num=$fdCol_num+1;
		if($fdCol_num<100)
		{
			$fdCol_num=str_pad($fdCol_num,3,"0",STR_PAD_LEFT);
		}
		
		$fd_collection_code=$fdCol_splitValue[0]."-".$fdCol_num;
	}
	
	$fdCol_ins_sql=mysql_query("INSERT INTO fd_collection(code,reference,member_no,name,branch_code,	loan_no,date,amount,loan_principal,loan_interest,narration,created_by,created_on)	VALUES('$fd_collection_code','$voucher_code','$member_no','$name','$branch_code',	'$loan_no','$date','$total_amount','$principal_amount','$interest_amount','ADJUSTMENT RECEIPT FOR FD LOAN',	'$user_id',NOW())");
		
		//================================fd collection close===================//
	
	
//-------------fd_loan_detail update end-----------

	$fdLoanDetail_sql="SELECT code FROM fd_loan_details ORDER BY id DESC LIMIT 1";
	$fdLoanDetail_row=mysql_query($fdLoanDetail_sql);
	$fdLoanDetail_res=mysql_fetch_array($fdLoanDetail_row);
	$fdLoanDetail_code=$fdLoanDetail_res['code'];
	$fdLoanDetail_splitValue=explode("-",$fdLoanDetail_code);
	$fdLoanDetail_num=$fdLoanDetail_splitValue[1];
	$fdLoanDetail_num=$fdLoanDetail_num+1;
	if($fdLoanDetail_num<100)
	{
	$fdLoanDetail_num=str_pad($fdLoanDetail_num,3,"0",STR_PAD_LEFT);
	}

	$fd_loanDetail_code=$fdLoanDetail_splitValue[0]."-".$fdLoanDetail_num;
					
	$bal_loan_amount=$fd_loan_amount-$principal_amount;
	
	$fdCol_ins_sql=mysql_query("INSERT INTO fd_loan_details(reference,code,date,member_no,loan_no,elligible_amount,	principal,interest,amount,interest_rate,bank_code,cheque_no,cheque_date,flag_id,created_by,created_on)VALUES	('$voucher_code','$fd_loanDetail_code','$date','$member_no','$loan_no','','$principal_amount','$interest_amount','$bal_loan_amount','$int_interest_rate','$bank_code','$cheque_no','$cheque_date','2','$user',NOW())");
	
		
	if($fdCol_ins_sql)
	{
		$update_voucher=mysql_query("UPDATE voucher SET status=2 WHERE code='$voucher_code'");
		$update_voucher_detail=mysql_query("UPDATE voucher_detail SET status=2 WHERE voucher_code='$voucher_code'");
	}		
		
	}
		
	if($fd_loan_amount==$principal_amount)
	{	
												
	$fdCol_sql="SELECT code FROM fd_collection ORDER BY id DESC";
	$fdCol_row=mysql_query($fdCol_sql);
	$fdCol_check=mysql_num_rows($fdCol_row);

	if($fdCol_check<1)
	{
		$fd_collection_code='FDCOL-001';
	}
	else
	{
		$fdCol_res=mysql_fetch_array($fdCol_row);
		$fdCol_code=$fdCol_res['code'];
		$fdCol_splitValue=explode("-",$fdCol_code);
		$fdCol_num=$fdCol_splitValue[1];
		$fdCol_num=$fdCol_num+1;
		if($fdCol_num<100)
		{
			$fdCol_num=str_pad($fdCol_num,3,"0",STR_PAD_LEFT);
		}
		
		$fd_collection_code=$fdCol_splitValue[0]."-".$fdCol_num;
	}
	
	$fdCol_ins_sql=mysql_query("INSERT INTO fd_collection(code,reference,member_no,name,branch_code,	loan_no,date,amount,loan_principal,loan_interest,narration,created_by,created_on)	VALUES('$fd_collection_code','$voucher_code','$member_no','$name','$branch_code',	'$loan_no','$date','$total_amount','$principal_amount','$interest_amount','ADJUSTMENT RECEIPT FOR FD LOAN',	'$user_id',NOW())");
	
								
		//================================fd collection close===================//
	
	
//-------------fd_loan_detail update end-----------

	$fdLoanDetail_sql="SELECT code FROM fd_loan_details ORDER BY id DESC LIMIT 1";
	$fdLoanDetail_row=mysql_query($fdLoanDetail_sql);
	$fdLoanDetail_res=mysql_fetch_array($fdLoanDetail_row);
	$fdLoanDetail_code=$fdLoanDetail_res['code'];
	$fdLoanDetail_splitValue=explode("-",$fdLoanDetail_code);
	$fdLoanDetail_num=$fdLoanDetail_splitValue[1];
	$fdLoanDetail_num=$fdLoanDetail_num+1;
	if($fdLoanDetail_num<100)
	{
	$fdLoanDetail_num=str_pad($fdLoanDetail_num,3,"0",STR_PAD_LEFT);
	}

	$fd_loanDetail_code=$fdLoanDetail_splitValue[0]."-".$fdLoanDetail_num;
					
	$bal_loan_amount=$fd_loan_amount-$principal_amount;
	
		$fdCol_ins_sql=mysql_query("INSERT INTO fd_loan_details(reference,code,date,member_no,loan_no,elligible_amount,	principal,interest,amount,interest_rate,bank_code,cheque_no,cheque_date,flag_id,created_by,created_on)VALUES	('$voucher_code','$fd_loanDetail_code','$date','$member_no','$loan_no','','$principal_amount','$interest_amount','$bal_loan_amount','$int_interest_rate','$bank_code','$cheque_no','$cheque_date','2','$user',NOW())");
	
		mysql_query("UPDATE fd_loan_details set flag_id=3 where member_no='$member_no' and loan_no='$loan_no' and flag_id=2");
		
		$sql=mysql_query("UPDATE fd_loan_header set flag_id=3 where member_no='$member_no' and loan_no='$loan_no' and flag_id=2");
	
	
	if($sql)
	{
		$update_voucher=mysql_query("UPDATE voucher SET status=2 WHERE code='$voucher_code'");
		$update_voucher_detail=mysql_query("UPDATE voucher_detail SET status=2 WHERE voucher_code='$voucher_code'");
	}
	
	}
?>