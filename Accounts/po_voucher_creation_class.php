<?php

class voucher_process
{	

	public $code;
	public $date;
	public $voucher_category_code;
	public $voucher_purpose_code;
	public $slip_no;
	public $reference_voucher;
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
	
	public function __construct($db)
	{
		$this->conn = $db;
	}
	
	public function voucher_entry()
	{	
		$qry = "INSERT INTO accounts_voucher(code,date,voucher_category_code,voucher_purpose_code, slip_no, reference_voucher, reference_no, ledger_code, amount, bank_code, cheque_no, cheque_date, description, narration, status,created_by,created_on) VALUES ('".$this->code."','".$this->date."','".$this->voucher_category_code."','".$this->voucher_purpose_code."','".$this->slip_no."','".$this->reference_voucher."','".$this->reference_no."','".$this->ledger_code."','".$this->amount."','".$this->bank_code."','".$this->cheque_no."',NULL,'".$this->description."','".$this->narration."','1','".$this->created_by."',NOW())";
				
		$sth = $this->conn->prepare($qry);
		$sth->execute();
		//print_r($sth->errorInfo());
	}
	
	public function voucher_details($ledgers_code,$ledgers_amount,$ledgers_type)
	{
		$category_code=$this->voucher_category_code;
		$purpose_code=$this->voucher_purpose_code;
		
		$code=$this->code;
		$status=$this->status;
		$created_by=$this->created_by;
		$narration=$this->narration;
		$reference=$this->reference_no;
		
		$length=count($ledgers_code);	
		
		$vp_query = $this->conn->query("SELECT narration FROM accounts_voucher_purpose WHERE code='$purpose_code' and voucher_category_code='$category_code'");		
    	$AEnarsql=$vp_query->fetch(PDO::FETCH_ASSOC);
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

		if($category_code=='CAT-001')
		{
			$reference=$this->reference_no;	
		
			for($k=0;$k<$length;$k++)		
			{
				$voucher_detail="INSERT INTO accounts_voucher_detail(voucher_code,sequence,ledger_code, reference,amount,type,narration, status, created_by, created_on) VALUES('$code','1','$ledgers_code[$k]','$reference','$ledgers_amount[$k]','$ledgers_type[$k]','$AEnar','1','$created_by',NOW())";
				
				$sth = $this->conn->prepare($voucher_detail);
				$sth->execute();
				//print_r($sth->errorInfo());
			}
		}
		else if($credit_total==$debit_total)
		{
			for($k=0;$k<$length;$k++)		
			{
				if($ledgers_amount[$k]<>0 && $ledgers_amount[$k]!='')
				{
					$voucher_detail="INSERT INTO accounts_voucher_detail(voucher_code,sequence,ledger_code, reference,amount,type,narration, status, created_by, created_on) VALUES('$code','$k','$ledgers_code[$k]','$reference','$ledgers_amount[$k]','$ledgers_type[$k]','$AEnar','1','$created_by',NOW())";
					
					$sth = $this->conn->prepare($voucher_detail);
					$sth->execute();
					//print_r($sth->errorInfo());
				}
				else
				{
					echo "credit and debit totals are not equal";
				}
			}
		}
	}
	
	public function account_entry_insert($v_code)
	{
		echo $voucher_code = $v_code;	
		
		echo "select * from accounts_voucher where code='$voucher_code'";

		$voucher_sql  = $this->conn->query("select * from accounts_voucher where code='$voucher_code'");		
		$voucher_detail = $voucher_sql->fetch(PDO::FETCH_ASSOC);
		echo $date=$voucher_detail['date'];
		$category_code=$voucher_detail['voucher_category_code'];
		$purpose_code=$voucher_detail['voucher_purpose_code'];
		$total_amount=$voucher_detail['amount'];
		$reference_no=$voucher_detail['reference_no'];
		echo $reference_voucher=$voucher_detail['reference_voucher'];
		
		
	}
}