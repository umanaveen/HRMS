<?php 

class credit_voucher
{	
	public $code;
	public $vou_date;
	public $voucher_category_code;
	public $slip_no;
	public $ledger_code;
	public $amount;
	public $user;
	
	function voucher_entry()
	{		
		mysql_query("INSERT INTO voucher(code,date,voucher_category_code,slip_no,ledger_code,amount,created_by,created_on)
		VALUES('".$this->code."','".$this->vou_date."','".$this->voucher_category_code."','".$this->slip_no."',
		'".$this->ledger_code."','".$this->amount."','".$this->user."',NOW())");
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