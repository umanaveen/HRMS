<?php 
	require("../../connect.php");

	//get data from daybook master//
	$main_entity[]="";
	$main_entity_type[]="";
	$ledger_code[]="";
	
	
	$master_sql=$con->query("SELECT main_entity,main_entity_type,ledger_code FROM accounts_daybook_master where flag=1");
	while($master_res=$master_sql->fetch(PDO::FETCH_ASSOC))
	{
		$main_entity[]=$master_res['main_entity'];
		$main_entity_type[]=$master_res['main_entity_type'];
		$ledger_code[]=$master_res['ledger_code'];
	}
	
	
	$total_row=count($main_entity);
	 
	//daybook deletion
	$delete_query="Delete FROM daybook_new where date>'2021-03-31'";
	
	$del = $con->prepare($delete_query);
		
		if($del->execute())
		{
				//daybook Insert
			$insert_query="INSERT INTO daybook_new(main_entity, main_entity_type, reference, search_no, date, ledger_code, name, narration, cash_receipt, adjustment_receipt,receipt_total, cash_payment, adjustment_payment, payment_total)
			select t1.main_entity,t1.main_entity_type,t1.reference,t1.search_no,t1.date,t1.ledger_code,t1.name,t1.narration,
			t1.rec_cash,t1.REC_ADJ,t1.receipt_total,t1.pay_cash,t1.PAY_ADJ,t1.payment_total 
			from 
			(SELECT main_entity,main_entity_type,reference,search_no,date,
			(case when type='credit' then ledger_code end) as ledger_code,l.name,'CASH' as narration,
			(case when type='credit' then sum(amount) else 0 end) as rec_cash,
			NULL as REC_ADJ,NULL as receipt_total,
			NULL as pay_cash,NULL as PAY_ADJ,NULL as payment_total
			FROM account_entry a join accounts_ledger l on a.ledger_code=l.code  
			WHERE  	main_entity='cash Voucher' and 
			main_entity_type in ('cash Receipt') and ledger_code not in ('Z001') group by ledger_code,date
			union
			SELECT main_entity,main_entity_type,reference,search_no,date,
			(case when type='debit' then ledger_code end) as ledger_code,l.name,'CASH' as narration,
			NULL as rec_cash,NULL as REC_ADJ,NULL as receipt_total,
			(case when type='debit' then sum(amount) else 0 end) as pay_cash,NULL as PAY_ADJ,NULL as payment_total
			FROM account_entry a join accounts_ledger l on a.ledger_code=l.code  
			WHERE main_entity='cash Voucher' and 
			main_entity_type in ('Cash Payment') group by ledger_code,date 
			)
			t1 ORDER BY ledger_code,date,reference,search_no"; 
			
			$sth = $con->prepare($insert_query);
			
			if($sth->execute())
			{
				echo 0;
			}
			else
			{
				print_r($sth->errorInfo());
			}
		}
		else
		{
			print_r($sth->errorInfo());
		}
	

		
	
?>


