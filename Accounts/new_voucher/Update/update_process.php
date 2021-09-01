<?php

class voucher_update
{
	public $code;
	public $date;
	public $voucher_category_code;
	public $voucher_purpose_code;
	public $slip_no;
	public $reference_voucher;
	public $member_no;
	public $name;
	public $branch_code;
	public $reference_no;
	public $ledger_code;
	public $amount;
	public $bank_code;
	public $cheque_no;
	public $cheque_date;
	public $description;
	public $narration;
	public $status;
	public $created_by;
	public $modified_by;
	
	public function voucher_table()
	{		
		$voucher=mysql_query("update voucher set 
		date='".$this->date."',
		slip_no='".$this->slip_no."',
		reference_voucher='".$this->reference_voucher."', 
		member_no='".$this->member_no."',
		name='".$this->name."',
		branch_code='".$this->branch_code."',
		reference_no='".$this->reference_no."',
		ledger_code='".$this->ledger_code."',
		amount='".$this->amount."',
		bank_code='".$this->bank_code."',
		cheque_no=''".$this->cheque_no."'',
		cheque_date='".$this->cheque_date."',
		description='".$this->description."' where code='".$this->code."'");			
	}
	
	public function voucher_details($ledgers_code,$ledgers_amount,$ledgers_type)
	{
		$code=$this->code;
		$member_no=$this->member_no;
		$narration=$this->narration;
		$length=count($ledgers_code);
		for($i=0;$i<$length;$i++)	
		{
			$voucher_detail=mysql_query("INSERT INTO voucher_detail(voucher_code,sequence,ledger_code, reference,amount,type, narration, status, created_by, created_on) VALUES('$code','$i','$ledgers_code[$i]','$member_no','$ledgers_amount[$i]','$ledgers_type[$i]','$narration','1','$created_by',NOW())");
		}			 
	}	 
}