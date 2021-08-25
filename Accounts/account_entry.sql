
	--account_entry procedure

	DELIMITER $$
	CREATE PROCEDURE account_entry_procedure(IN id INT, IN code  VARCHAR(155), IN sequence INT, IN main_entity VARCHAR(155), IN main_entity_type VARCHAR(155), IN reference VARCHAR(155), IN search_no VARCHAR(155), IN date DATE, IN ledger_code VARCHAR(155), IN amount VARCHAR(155), IN type VARCHAR(155), IN bank_code VARCHAR(155),IN cheque_no VARCHAR(155),IN cheque_date DATE,IN narration VARCHAR(155), IN created_by INT)
	begin
	if id=1 then		
	SET @t98=concat("insert into account_entry(INSERT INTO account_entry(code, sequence, main_entity, main_entity_type, reference, search_no, date, ledger_code, amount, type ,bank_code, cheque_no, cheque_date, narration, created_by, created_on) values('",code,"','",sequence,"','",main_entity,"','",main_entity_type,"','",reference,"','",search_no,"','",date,"','",ledger_code,"','",amount,"','",type,"','",bank_code,"','",cheque_no,"','",cheque_date,"','",narration,"','",created_by,"',NOW())");	
	PREPARE stmt98 from @t98;
	EXECUTE stmt98;
	DEALLOCATE PREPARE stmt98;
	end if;
	end
	
	--voucher stored procedure
	
	
	SELECT id, code, date, voucher_category_code, voucher_purpose_code, slip_no, reference_voucher, member_no, name, branch_code, reference_no, ledger_code, amount, bank_code, cheque_no, cheque_date, description, narration, status, created_by, created_on
	
	
	DELIMITER $$
	CREATE PROCEDURE accounts_voucher_procedure(IN id INT, IN code  VARCHAR(155),IN date DATE, IN voucher_category_code VARCHAR(155), IN voucher_purpose_code VARCHAR(155), IN slip_no VARCHAR(155), IN reference_voucher VARCHAR(155), IN member_no VARCHAR(155),  IN name VARCHAR(155), IN branch_code VARCHAR(155), IN type VARCHAR(155), IN bank_code VARCHAR(155),IN cheque_no VARCHAR(155),IN cheque_date DATE,IN narration VARCHAR(155), IN created_by INT)
	begin
	if id=1 then		
	SET @t98=concat("insert into account_entry(INSERT INTO account_entry(code, sequence, main_entity, main_entity_type, reference, search_no, date, ledger_code, amount, type ,bank_code, cheque_no, cheque_date, narration, created_by, created_on) values('",code,"','",sequence,"','",main_entity,"','",main_entity_type,"','",reference,"','",search_no,"','",date,"','",ledger_code,"','",amount,"','",type,"','",bank_code,"','",cheque_no,"','",cheque_date,"','",narration,"','",created_by,"',NOW())");	
	PREPARE stmt98 from @t98;
	EXECUTE stmt98;
	DEALLOCATE PREPARE stmt98;
	end if;
	end