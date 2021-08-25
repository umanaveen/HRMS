<?php 
class debit_voucher
{	
	public $code;
	public $vou_date;
	public $voucher_category_code;	
	public $slip_no;
	public $member_no;
	public $name;
	public $branch_code;	
	public $bank_code;
	public $cheque_no;
	public $cheque_date;	
	public $ledger_code;
	public $reference_no;
	public $amount;
	public $user;
	
	function voucher_entry()
	{
		echo "INSERT INTO voucher
	(code,date,voucher_category_code,slip_no,member_no,name,branch_code,reference_no,ledger_code,amount,				bank_code,cheque_no,cheque_date,narration,created_by,created_on)VALUES('".$this->code."','".$this->vou_date."','".$this->voucher_category_code."','".$this->slip_no."','".$this->member_no."','".$this->name."','".$this->branch_code."','".$this->reference_no."','".$this->ledger_code."','".$this->amount."','".$this->bank_code."','".$this->cheque_no."','".$this->cheque_date."',	'Interest paid on thrift deposit','".$this->user."',NOW())";
	
	$voucher_detail_sql="INSERT INTO voucher_detail
									(voucher_code,sequence,ledger_code,description,receipt,payment,created_by,created_on)
									VALUES
									('".$this->code."','1','$ledger_code','Fd Interest Paid transaction','','$amount','$user',NOW())
						";
						
	$voucher_detail_sql2="INSERT INTO voucher_detail
									(code,voucher_code,sequence,ledger_code,description,receipt,payment,created_by,created_on)
									VALUES
									('$voucher_detail_code','$voucher_code','2','$ledger_code1','Fd Closed transaction','$fd_maturity_amount','','$user',NOW())
						";
	
		/* mysql_query("INSERT INTO voucher
	(code,date,voucher_category_code,slip_no,member_no,name,branch_code,reference_no,ledger_code,amount,				bank_code,cheque_no,cheque_date,narration,created_by,created_on)VALUES('".$this->code."','".$this->vou_date."','".$this->voucher_category_code."','".$this->slip_no."','".$this->member_no."','".$this->name."','".$this->branch_code."','".$this->reference_no."','".$this->ledger_code."','".$this->amount."','".$this->bank_code."','".$this->cheque_no."','".$this->cheque_date."',	'Interest paid on thrift deposit','".$this->user."',NOW())"); */
	
	}
	function voucher_update()
	{
	}
	function voucher_delete()
	{
	}
	function voucher_display()
	{
		$sql="select * from voucher where ";
	}
}