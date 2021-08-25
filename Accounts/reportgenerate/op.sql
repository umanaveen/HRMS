SELECT main_entity, main_entity_type,
		(case when main_entity='FD' then reference else '' end) as reference,
		(case when main_entity='FD' then search_no else '' end) as search_no, 
                date, ledger_code, name, cash_receipt,
                (case when ledger_code<>'A001' then sum(adjustment_receipt) else adjustment_receipt end) as adjustment_receipt,
                cash_payment, 
               (case when ledger_code<>'A001' then sum(adjustment_payment) else adjustment_payment end) as adjustment_payment FROM daybook_new group by search_no,ledger_code
ORDER BY `daybook_new`.`ledger_code` ASC