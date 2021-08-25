select 	t1.main_entity,t1.main_entity_type,
		t1.reference,t1.search_no,
		t1.date,
		t1.ledger_code,t1.name,t1.rec_cash,t1.REC_ADJ,t1.pay_cash,t1.PAY_ADJ 
		from 
		(SELECT main_entity,main_entity_type,reference,search_no,date,
		(case when type='credit' then ledger_code when type='debit' then ledger_code  end) as ledger_code,'' as name,
		'' as rec_cash,(case when type='credit' then amount  end) as REC_ADJ,
		'' as pay_cash,(case when type='debit' then amount end) as PAY_ADJ
		FROM `account_entry` WHERE main_entity='FD')t1 
		where t1.date between '2017-04-01' and '2017-04-30' group by search_no ORDER BY date,reference,search_no
		
SELECT main_entity,main_entity_type,reference,search_no,date,
		(case when type='credit' then ledger_code when type='debit' then ledger_code  end) as ledger_code,'' as name,
		'' as rec_cash,(case when type='credit' then amount  end) as REC_ADJ,
		'' as pay_cash,(case when type='debit' then amount end) as PAY_ADJ
		FROM `account_entry` WHERE main_entity='FD' and date='2017-04-29' group by search_no ORDER BY date,reference,search_no
	
select 	t1.main_entity,t1.main_entity_type,
		t1.reference,t1.search_no,
		t1.date,
		t1.ledger_code,t1.name,t1.rec_cash,t1.REC_ADJ,t1.pay_cash,t1.PAY_ADJ 
		from 
		(SELECT main_entity,main_entity_type,reference,search_no,date,(case when type='credit' then ledger_code when type='debit' then ledger_code  end) as ledger_code,l.name,'AS PER LDR' as narration,
'' as rec_cash,(case when type='credit' then sum(amount) else 0 end) as REC_ADJ,
'' as pay_cash,(case when type='debit' then sum(amount) else 0 end) as PAY_ADJ
		FROM `account_entry`  a join ledger l on a.ledger_code=l.code  
WHERE main_entity='loan' and main_entity_type='surety loan' group by ledger_code,date)t1 where t1.date='2017-04-03'