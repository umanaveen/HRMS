<?php 
require("../../configuration.php");
require("../../user.php");
$user=$_SESSION['user'];
//get data from daybook master//
	$main_entity[]="";
	$main_entity_type[]="";
	$ledger_code[]="";
	$master_sql=mysql_query("SELECT main_entity,main_entity_type,ledger_code FROM daybook_master where flag=1");
	while($master_res=mysql_fetch_array($master_sql))
	{
		$main_entity[]=$master_res['main_entity'];
		$main_entity_type[]=$master_res['main_entity_type'];
		$ledger_code[]=$master_res['ledger_code'];		
	}
	/*
	echo print_r($main_entity).'<br>';
	echo print_r($main_entity_type).'<br>';
	echo print_r($ledger_code).'<br>';
	*/
	
	 $total_row=count($main_entity);
//daybook deletion
		$delete_query=mysql_query("Delete FROM daybook_new");

//daybook Insert
		$insert_query=mysql_query("INSERT INTO daybook_new(main_entity, main_entity_type, reference, search_no, date, ledger_code, name, narration, cash_receipt, adjustment_receipt,receipt_total, cash_payment, adjustment_payment, payment_total)
		select t1.main_entity,t1.main_entity_type,t1.reference,t1.search_no,t1.date,t1.ledger_code,t1.name,t1.narration,
		t1.rec_cash,t1.REC_ADJ,t1.receipt_total,t1.pay_cash,t1.PAY_ADJ,t1.debit_total 
		from 
		(select 
		a.main_entity,a.main_entity_type,a.reference,a.search_no,a.date,a.ledger_code,a.name, a.narration,a.rec_cash,a.REC_ADJ,b.receipt_total,a.pay_cash,a.PAY_ADJ,b.debit_total 
		from 
		(SELECT a.main_entity,a.main_entity_type,a.reference,a.search_no,a.date,(case when a.type='credit' then a.ledger_code when a.type='debit' then a.ledger_code end) as ledger_code,l.name,fb.name as narration,'' as rec_cash,(case when a.type='credit' then a.amount end) as REC_ADJ,'' as receipt_total,'' as pay_cash,(case when a.type='debit' then a.amount end) as PAY_ADJ,'' as payment_total FROM account_entry a join ledger l on a.ledger_code=l.code join fd_balance fb on a.search_no=fb.fdr_no WHERE main_entity='$main_entity[1]' group by search_no)a 
		left join 
		(SELECT date,ledger_code, sum(case when type='credit' then amount else 0 end) as receipt_total, sum(case when type='debit' then amount else 0 end) as debit_total FROM account_entry WHERE main_entity='$main_entity[1]' and ledger_code='$ledger_code[1]' group by date)b on 
		a.ledger_code=b.ledger_code and a.date=b.date
		union
		SELECT 
		main_entity,main_entity_type,reference,search_no,date,
		(case when type='credit' then ledger_code when type='debit' then ledger_code  end) as ledger_code,
		l.name,'AS PER LDR' as narration,
		'' as rec_cash,(case when type='credit' then sum(amount) else 0 end) as REC_ADJ,
		(case when type='credit' then sum(amount) else 0 end) as receipt_total,'' as pay_cash,
		(case when type='debit' then sum(amount) else 0 end) as PAY_ADJ,
		(case when type='debit' then sum(amount) else 0 end) as payment_total
		FROM account_entry  a join ledger l on a.ledger_code=l.code  
		WHERE  main_entity='loan' and main_entity_type='surety loan' group by ledger_code,date
		union
		SELECT main_entity,main_entity_type,reference,search_no,date,(case when type='credit' then ledger_code when type='debit' then ledger_code  end) as ledger_code,l.name,'AS PER LDR' as narration,
		'' as rec_cash,
		(case when type='credit' then sum(amount) else 0 end) as REC_ADJ,
		(case when type='credit' then sum(amount) else 0 end) as receipt_total,'' as pay_cash,
		(case when type='debit' then sum(amount) else 0 end) as PAY_ADJ,
		(case when type='debit' then sum(amount) else 0 end) as payment_total
		FROM account_entry  a join ledger l on a.ledger_code=l.code  
		WHERE  main_entity='loan' and main_entity_type='festival loan' group by ledger_code,date

		union
		SELECT main_entity,main_entity_type,reference,search_no,date,(case when type='credit' then ledger_code when type='debit' then ledger_code  end) as ledger_code,l.name,'AS PER FD LOAN' as narration,
		'' as rec_cash,
		(case when type='credit' then sum(amount) else 0 end) as REC_ADJ,
		(case when type='credit' then sum(amount) else 0 end) as receipt_total,'' as pay_cash,
		(case when type='debit' then sum(amount) else 0 end) as PAY_ADJ,
		(case when type='debit' then sum(amount) else 0 end) as payment_total
		FROM account_entry  a join ledger l on a.ledger_code=l.code  
		WHERE  main_entity='loan' and main_entity_type='FD LOAN' group by ledger_code,date

		union
		SELECT main_entity,main_entity_type,reference,search_no,date,(case when type='credit' then ledger_code when type='debit' then ledger_code  end) as ledger_code,l.name,'AS PER STAFF LOAN' as narration,
		'' as rec_cash,
		(case when type='credit' then sum(amount) else 0 end) as REC_ADJ,
		(case when type='credit' then sum(amount) else 0 end) as receipt_total,'' as pay_cash,
		(case when type='debit' then sum(amount) else 0 end) as PAY_ADJ,
		(case when type='debit' then sum(amount) else 0 end) as payment_total
		FROM account_entry  a join ledger l on a.ledger_code=l.code  
		WHERE  main_entity='loan' and main_entity_type='staff loan' group by ledger_code,date

		union
		SELECT main_entity,main_entity_type,reference,search_no,date,(case when type='credit' then ledger_code when type='debit' then ledger_code  end) as ledger_code,l.name,'AS PER COLLECTION' as narration,'' as rec_cash,
		(case when type='credit' then sum(amount) else 0 end) as REC_ADJ,
		(case when type='credit' then sum(amount) else 0 end) as receipt_total,
		'' as pay_cash,
		(case when type='debit' then sum(amount) else 0 end) as PAY_ADJ,
		(case when type='debit' then sum(amount) else 0 end) as payment_total
		FROM account_entry a join ledger l on a.ledger_code=l.code  
		WHERE main_entity in ('DEMAND COLLECTION','VOUCHER') and 
		main_entity_type in ('EXCESS COLLECTION','FULL COLLECTION','LESS COLLECTION','ADJUSTMENT RECEIPT','SUNDRY CREDITOR AMT') 
		group by ledger_code,date

		union
		select 
		a.main_entity,a.main_entity_type,a.reference,a.search_no,a.date,a.ledger_code,a.name,a.narration,a.rec_cash,
		a.REC_ADJ,b.receipt_total,a.pay_cash,a.PAY_ADJ,b.debit_total as payment_total
		from 
		(SELECT main_entity,main_entity_type,reference,search_no,date,
		(case when type='credit' then ledger_code when type='debit' then ledger_code  end) as ledger_code,
		l.name,main_entity_type as narration,'' as rec_cash,
		(case when type='credit' then amount else 0 end) as REC_ADJ,                
		'' as pay_cash,
		(case when type='debit' then amount else 0 end) as PAY_ADJ
		FROM account_entry  a join ledger l on a.ledger_code=l.code  
		WHERE  	main_entity='VOUCHER' and 
		main_entity_type in ('ADJUSTMENT SLIP','ADJUSTMENT SLIP FOR FD LOAN') group by reference,ledger_code,date)a 
		join 
		(SELECT date,ledger_code,(case when type='credit' then sum(amount) else 0 end) as receipt_total,(case when type='debit' then sum(amount) else 0 end) as debit_total FROM account_entry where main_entity='VOUCHER' and 
		main_entity_type in ('ADJUSTMENT SLIP','ADJUSTMENT SLIP FOR FD LOAN') group by date,ledger_code)b on a.ledger_code=b.ledger_code and a.date=b.date		
		union
		SELECT main_entity,main_entity_type,reference,search_no,date,
		(case when type='credit' then ledger_code end) as ledger_code,l.name,'CASH' as narration,
		(case when type='credit' then sum(amount) else 0 end) as rec_cash,
		'' as REC_ADJ,'' as receipt_total,
		'' as pay_cash,'' as PAY_ADJ,'' as payment_total
		FROM account_entry a join ledger l on a.ledger_code=l.code  
		WHERE  	main_entity='cash Voucher' and 
		main_entity_type in ('cash Receipt') and ledger_code not in ('Z001') group by ledger_code,date
		union
		SELECT main_entity,main_entity_type,reference,search_no,date,
		(case when type='debit' then ledger_code end) as ledger_code,l.name,'CASH' as narration,
		'' as rec_cash,'' as REC_ADJ,'' as receipt_total,
		(case when type='debit' then sum(amount) else 0 end) as pay_cash,'' as PAY_ADJ,'' as payment_total
		FROM account_entry a join ledger l on a.ledger_code=l.code  
		WHERE main_entity='cash Voucher' and 
		main_entity_type in ('Cash Payment') group by ledger_code,date 
		union
		SELECT main_entity,main_entity_type,reference,search_no,date,(case when type='credit' then ledger_code when type='debit' then ledger_code  end) as ledger_code,l.name,main_entity_type as narration,
		'' as rec_cash,
		(case when type='credit' then sum(amount) else 0 end) as REC_ADJ,
		(case when type='credit' then sum(amount) else 0 end) as receipt_total,
		'' as pay_cash,
		(case when type='debit' then sum(amount) else 0 end) as PAY_ADJ,	
		(case when type='debit' then sum(amount) else 0 end) as payment_total	
		FROM account_entry a join ledger l on a.ledger_code=l.code  
		WHERE main_entity='STAFF SALARY' group by ledger_code,date
		union
		SELECT main_entity,main_entity_type,reference,search_no,date,(case when type='credit' then ledger_code when type='debit' then ledger_code  end) as ledger_code,l.name,main_entity_type as narration,
		'' as rec_cash,
		(case when type='credit' then sum(amount) else 0 end) as REC_ADJ,
		(case when type='credit' then sum(amount) else 0 end) as receipt_total,
		'' as pay_cash,
		(case when type='debit' then sum(amount) else 0 end) as PAY_ADJ,
		(case when type='debit' then sum(amount) else 0 end) as payment_total
		FROM account_entry  a join ledger l on a.ledger_code=l.code  
		WHERE main_entity='STAFF LOAN' group by ledger_code,date)t1 ORDER BY ledger_code,date,reference,search_no"); 
if($insert_query)
{
echo 0;
}
else
{
echo 1;
}
?>


