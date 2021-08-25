<?php
require('../../configuration.php');
require('../../user.php');

class voucher_process
{
	public $code;
	public $date;
	public $voucher_category_code;
	public $voucher_purpose_code;
	public $slip_no;
	public $reference;
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
	
	public function voucher_entry()
	{  
	$voucher=mysql_query("INSERT INTO voucher(code,date,voucher_category_code,voucher_purpose_code, slip_no, reference_voucher, member_no, name, branch_code, reference_no, ledger_code, amount, bank_code, cheque_no, cheque_date, description, narration, status,created_by,created_on) VALUES ('".$this->code."','".$this->date."','".$this->voucher_category_code."','".$this->voucher_purpose_code."','".$this->slip_no."','".$this->reference_voucher."','".$this->member_no."','".$this->name."','".$this->branch_code."','".$this->reference_no."','".$this->ledger_code."','".$this->amount."','".$this->bank_code."','".$this->cheque_no."','".$this->cheque_date."','".$this->description."','".$this->narration."','1','".$this->created_by."',NOW())");	
	
	}
	
	public function voucher_details($ledgers_code,$ledgers_amount,$ledgers_type)
	{
		$category_code=$this->voucher_category_code;
		$purpose_code=$this->voucher_purpose_code;
		$code=$this->code;
		$status=$this->status;
		$created_by=$this->created_by;	
		$narration=$this->narration;	
		$reference=$this->reference;	
		
		$length=count($ledgers_code);
		 $AEnarsql=mysql_fetch_array(mysql_query("SELECT narration FROM voucher_purpose WHERE code='$purpose_code' and voucher_category_code='$category_code'"));
		$AEnar=$AEnarsql['narration'];
		
		
		$credit_total=0;
		$debit_total=0;
		for($i=0;$i<$length;$i++)		
		{
			if($ledgers_type[$i]=='credit')
			{
				$credit_total=$credit_total+$ledgers_amount[$i];
			}
			if($ledgers_type[$i]=='debit')
			{
				$debit_total=$debit_total+$ledgers_amount[$i];
			}			
		}
		
		if($credit_total==$debit_total)
		{ 
			for($k=0;$k<$length;$k++)		
			{
				if($ledgers_amount[$k]<>0 && $ledgers_amount[$k]!='')
				{
					$voucher_detail=mysql_query("INSERT INTO voucher_detail(voucher_code,sequence,ledger_code, reference,amount,type,narration, status, created_by, created_on) VALUES('$code','$k','$ledgers_code[$k]','$reference','$ledgers_amount[$k]','$ledgers_type[$k]','$AEnar','1','$created_by',NOW())");
				}
			}
		}
		else
		{
			echo "credit and debit totals are not equal";
		}
	}
}