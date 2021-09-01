delimiter //
CREATE PROCEDURE VOUCHER_REPORT(in vcode VARCHAR(255))
BEGIN
SET @ta1=concat("SELECT voucher_code, sequence, ledger_code, description, receipt, payment, narration, status, created_by, created_on, modified_by, modified_on FROM voucher_detail WHERE voucher_code='",vcode,"'");
PREPARE stmt1 from @ta1;
EXECUTE stmt1;
DEALLOCATE PREPARE stmt1;
end //
delimiter //

call VOUCHER_REPORT('VOU-004');