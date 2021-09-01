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
		FROM `account_entry`  a join ledger l on a.ledger_code=l.code  
		WHERE  	main_entity='VOUCHER' and 
		main_entity_type in ('ADJUSTMENT SLIP','ADJUSTMENT SLIP FOR FD LOAN') group by reference,ledger_code,date)a 
		join 
		(SELECT date,`ledger_code`,(case when type='credit' then sum(amount) else 0 end) as receipt_total,(case when type='debit' then sum(amount) else 0 end) as debit_total FROM `account_entry` where main_entity='VOUCHER' and 
		main_entity_type in ('ADJUSTMENT SLIP','ADJUSTMENT SLIP FOR FD LOAN') group by date,ledger_code)b on a.ledger_code=b.ledger_code and a.date=b.date