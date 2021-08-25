SELECT main_entity,main_entity_type,reference,search_no,date,(case when type='credit' then ledger_code when type='debit' then ledger_code  end) as ledger_code,l.name,main_entity_type as narration,
		'' as rec_cash,(case when type='credit' then amount  end) as REC_ADJ,
		'' as pay_cash,(case when type='debit' then amount end) as PAY_ADJ
		FROM `account_entry` a join ledger l on a.ledger_code=l.code   WHERE date='2017-04-29' and main_entity='FD' group by search_no
		
union
SELECT main_entity,main_entity_type,reference,search_no,date,(case when type='credit' then ledger_code when type='debit' then ledger_code  end) as ledger_code,l.name,'AS PER LDR' as narration,
'' as rec_cash,(case when type='credit' then sum(amount) else 0 end) as REC_ADJ,
'' as pay_cash,(case when type='debit' then sum(amount) else 0 end) as PAY_ADJ
		FROM `account_entry`  a join ledger l on a.ledger_code=l.code  
WHERE 
date='2017-04-29' and main_entity='loan' and main_entity_type='surety loan' group by ledger_code

union
SELECT main_entity,main_entity_type,reference,search_no,date,(case when type='credit' then ledger_code when type='debit' then ledger_code  end) as ledger_code,l.name,'AS PER LDR' as narration,
'' as rec_cash,(case when type='credit' then sum(amount) else 0 end) as REC_ADJ,
'' as pay_cash,(case when type='debit' then sum(amount) else 0 end) as PAY_ADJ
		FROM `account_entry`  a join ledger l on a.ledger_code=l.code  
WHERE 
date='2017-04-29' and main_entity='loan' and main_entity_type='festival loan' group by ledger_code

union
SELECT main_entity,main_entity_type,reference,search_no,date,(case when type='credit' then ledger_code when type='debit' then ledger_code  end) as ledger_code,l.name,'AS PER FD LOAN' as narration,
'' as rec_cash,(case when type='credit' then sum(amount) else 0 end) as REC_ADJ,
'' as pay_cash,(case when type='debit' then sum(amount) else 0 end) as PAY_ADJ
		FROM `account_entry`  a join ledger l on a.ledger_code=l.code  
WHERE 
date='2017-04-29' and main_entity='loan' and main_entity_type='FD LOAN' group by ledger_code

union
SELECT main_entity,main_entity_type,reference,search_no,date,(case when type='credit' then ledger_code when type='debit' then ledger_code  end) as ledger_code,l.name,'AS PER STAFF LOAN' as narration,
'' as rec_cash,(case when type='credit' then sum(amount) else 0 end) as REC_ADJ,
'' as pay_cash,(case when type='debit' then sum(amount) else 0 end) as PAY_ADJ
		FROM `account_entry`  a join ledger l on a.ledger_code=l.code  
WHERE 
date='2017-04-29' and main_entity='loan' and main_entity_type='staff loan' group by ledger_code

union
SELECT main_entity,main_entity_type,reference,search_no,date,(case when type='credit' then ledger_code when type='debit' then ledger_code  end) as ledger_code,l.name,'AS PER COLLECTION' as narration,'' as rec_cash,
		(case when type='credit' then sum(amount) else 0 end) as REC_ADJ,
		'' as pay_cash,
		(case when type='debit' then sum(amount) else 0 end) as PAY_ADJ
		FROM `account_entry` a join ledger l on a.ledger_code=l.code  
WHERE date='2017-04-29' and 
		main_entity in ('DEMAND COLLECTION','VOUCHER') and 
		main_entity_type in ('EXCESS COLLECTION','FULL COLLECTION','LESS COLLECTION','ADJUSTMENT RECEIPT','SUNDRY CREDITOR AMT') 
		group by ledger_code
		
union
SELECT main_entity,main_entity_type,reference,search_no,date,
		(case when type='credit' then ledger_code when type='debit' then ledger_code  end) as ledger_code,
		l.name,main_entity_type as narration,'' as rec_cash,
		(case when type='credit' then sum(amount) else 0 end) as REC_ADJ,
		'' as pay_cash,
		(case when type='debit' then sum(amount) else 0 end) as PAY_ADJ
		FROM `account_entry`  a join ledger l on a.ledger_code=l.code  
WHERE date='2017-04-29' and 
		main_entity='VOUCHER' and 
		main_entity_type in ('ADJUSTMENT SLIP','ADJUSTMENT SLIP FOR FD LOAN') group by ledger_code
		
union
SELECT main_entity,main_entity_type,reference,search_no,date,
		(case when type='credit' then ledger_code end) as ledger_code,l.name,'CASH' as narration,
		(case when type='credit' then sum(amount) else 0 end) as rec_cash,'' as REC_ADJ,
		'' as pay_cash,'' as PAY_ADJ
		FROM `account_entry` a join ledger l on a.ledger_code=l.code  
WHERE date='2017-04-29' and 
		main_entity='cash Voucher' and 
		main_entity_type in ('cash Receipt') and ledger_code not in ('Z001') group by ledger_code
union
SELECT main_entity,main_entity_type,reference,search_no,date,
		(case when type='debit' then ledger_code end) as ledger_code,l.name,'CASH' as narration,
		'' as rec_cash,'' as REC_ADJ,
		(case when type='debit' then sum(amount) else 0 end) as pay_cash,'' as PAY_ADJ
		FROM `account_entry` a join ledger l on a.ledger_code=l.code  
WHERE date='2017-04-29' and 
		main_entity='cash Voucher' and 
		main_entity_type in ('Cash Payment') group by ledger_code 
union
SELECT main_entity,main_entity_type,reference,search_no,date,(case when type='credit' then ledger_code when type='debit' then ledger_code  end) as ledger_code,l.name,main_entity_type as narration,
'' as rec_cash,(case when type='credit' then sum(amount) else 0 end) as REC_ADJ,
'' as pay_cash,(case when type='debit' then sum(amount) else 0 end) as PAY_ADJ	FROM `account_entry` a join ledger l on a.ledger_code=l.code  
WHERE 
date='2017-04-29' and main_entity='STAFF SALARY' group by ledger_code
union
SELECT main_entity,main_entity_type,reference,search_no,date,(case when type='credit' then ledger_code when type='debit' then ledger_code  end) as ledger_code,l.name,main_entity_type as narration,
'' as rec_cash,(case when type='credit' then sum(amount) else 0 end) as REC_ADJ,
'' as pay_cash,(case when type='debit' then sum(amount) else 0 end) as PAY_ADJ FROM `account_entry`  a join ledger l on a.ledger_code=l.code  
WHERE 
date='2017-04-29' and main_entity='STAFF LOAN' group by ledger_code


		