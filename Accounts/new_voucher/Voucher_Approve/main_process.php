<?php 

class voucher_approve
{ 
	//+++++++++++++++++++++++++++++++++++++++SRF START+++++++++++++++++++++++++++++++++++++++
	function srf_insert()
	{		
		$type=$this->srf_type;
		$srf_amount=$this->srf_amount;		
		
		$sql="SELECT srf_od_balance,srf_balance FROM member_balance WHERE 
		member_no='".$this->srf_member_no."'";
		$member_balance_row=mysql_query($sql);									
		$member_balance_res=mysql_fetch_array($member_balance_row);
		
		if($type=="credit")
		{
		$srf_balance=$member_balance_res['srf_balance'];
		$srf_od_balance=$member_balance_res['srf_od_balance'];
		$current_amount=$srf_balance+$srf_amount;
		
		//--------------------code -----------------//
			$srf_sql="SELECT code FROM srf ORDER BY id DESC";
			$srf_row=mysql_query($srf_sql);
			$srf_check=mysql_num_rows($srf_row);
			if($srf_check<1)
			{
				$srf_code='SRF-001';
			}
			else
			{
				$srf_res=mysql_fetch_array($srf_row);
				$srf_code=$srf_res['code'];
				$srf_splitValue=explode("-",$srf_code);
				$srf_num=$srf_splitValue[1];
				$srf_num=$srf_num+1;
				if($srf_num<100)
				{
					$srf_num=str_pad($srf_num,3,"0",STR_PAD_LEFT);
				}
				$srf_code=$srf_splitValue[0]."-".$srf_num;
			}
		//--------------------close	code -----------------//
			
			if($srf_od_balance<>0)
			{
				if($srf_od_balance>$srf_amount)
				{
					$srf_od_balance=$srf_od_balance-$srf_amount;
				}
				else
				{
					$srf_od_balance=0;
				}
			}

			$srf_ins_sql="INSERT INTO srf (code,reference,narration,main_entity,			main_entity_type,member_no,date,amount,previous_amount,current_amount,od_amount,created_by,created_on,remarks)VALUES ('$srf_code','".$this->voucher_code."','".$this->narration."','voucher','Adjustment Receipt','".$this->srf_member_no."','".$this->vou_date."','".$this->srf_amount."','$srf_balance','$current_amount','$srf_od_balance','1',NOW(),'".$this->narration."')";
		
			$srf1=mysql_query($srf_ins_sql);
			
			$member_balance_ups_sql="UPDATE member_balance SET srf_balance='$current_amount',srf_od_balance='$srf_od_balance',modified_by='1',modified_on=NOW() WHERE member_no='".$this->srf_member_no."'";	
			$srf2=mysql_query($member_balance_ups_sql);
			
			if($srf1)
			{
				echo "srf inserted";
			}
			if($srf2)
			{
				echo "srf member_balance inserted";
			}
			
		}		
		else
		{
			echo "not work";
		}
	
	}
//+++++++++++++++++++++++++++++++++++++++SRF CLOSE+++++++++++++++++++++++++++++++++++++++

//+++++++++++++++++++++++++++++++++++++++THRIFT START+++++++++++++++++++++++++++++++++++++++
	function thrift_insert()
	{
		
		$type=$this->thrift_type;
		$thrift_amount=$this->thrift_amount;
		
		$sql=mysql_query("select thrift_balance,thrift_od_balance from member_balance where member_no='".$this->thrift_member_no."'");
		$member_balance=mysql_fetch_array($sql);
		$thrift_balance=$member_balance['thrift_balance'];
		$thrift_od_balance=$member_balance['thrift_od_balance'];
		
		//code generate
				$thrift_deposit_sql="SELECT code FROM thrift_deposit ORDER BY id DESC";			
				$thrift_deposit_row=mysql_query($thrift_deposit_sql);
				$thrift_deposit_check=mysql_num_rows($thrift_deposit_row);
				if($thrift_deposit_check<1)
				{
					$thrift_deposit_code='TDS-001';
				}
				else
				{
					$thrift_deposit_res=mysql_fetch_array($thrift_deposit_row);
					$tds_code=$thrift_deposit_res['code'];
					$tds_splitValue=explode("-",$tds_code);
					$tds_num=$tds_splitValue[1];
					$tds_num=$tds_num+1;
				if($tds_num<100)
				{
					$tds_num=str_pad($tds_num,3,"0",STR_PAD_LEFT);
				}
					$thrift_deposit_code=$tds_splitValue[0]."-".$tds_num;
				}
		if($type=="credit")
		{
			$current_amount=$thrift_balance+$thrift_amount;
			
			if($thrift_od_balance>0)
			{
				if($thrift_od_balance>$thrift_amount)
				{
					$thrift_od_balance=$thrift_od_balance-$thrift_amount;
				}
				else
				{
				$thrift_od_balance=0;
				}
			}

			$thrift_deposit_ins_sql="INSERT INTO thrift_deposit (code,reference,narration,main_entity,main_entity_type,
			member_no,date,amount,previous_amount,current_amount,od_amount,created_by,created_on,remarks)
			VALUES('$thrift_deposit_code','".$this->voucher_code."','".$this->narration."','voucher','Adjustment Receipt',
			'".$this->thrift_member_no."','".$this->vou_date."','$thrift_amount','$thrift_balance','$current_amount','$thrift_od_balance','1',NOW(),
			'".$this->narration."')";

			$thrift1=mysql_query($thrift_deposit_ins_sql);

			$member_balance_ups_sql="UPDATE member_balance SET thrift_balance='$current_amount',
			thrift_od_balance='$thrift_od_balance',modified_by='1',modified_on=NOW() WHERE member_no='".$this->thrift_member_no."'";		

			$thrift2=mysql_query($member_balance_ups_sql);
			
			if($thrift1)
			{
				echo "thrift inserted";
			}
			if($thrift2)
			{
				echo "thrift member_balance inserted";
			}

		}	
	}	
	
//+++++++++++++++++++++++++++++++++++++++THRIFT CLOSE+++++++++++++++++++++++++++++++++++++++
//+++++++++++++++++++++++++++++++++++++++SHARE START+++++++++++++++++++++++++++++++++++++++
		
	function share_insert()
	{
		$type=$this->share_type;
		$share_amount=$this->share_amount;
		
		$sql=mysql_query("select share_capital from member_balance where member_no='".$this->share_member_no."'");
		$member_balance=mysql_fetch_array($sql);
		$share_capital=$member_balance['share_capital'];
		
		if($type=="credit")
		{
			$current_amount=$share_capital+$share_amount;
			$share_capital_sql="SELECT code FROM share_capital ORDER BY id DESC";
			$share_capital_row=mysql_query($share_capital_sql);
			$share_capital_check=mysql_num_rows($share_capital_row);

			if($share_capital_check<1)
			{
				$share_capital_code='SHR-001';
			}
			else
			{
				$share_capital_res=mysql_fetch_array($share_capital_row);
				$share_code=$share_capital_res['code'];
				$shr_splitValue=explode("-",$share_code);
				$shr_num=$shr_splitValue[1];
				$shr_num=$shr_num+1;
				if($shr_num<100)
				{
					$shr_num=str_pad($shr_num,3,"0",STR_PAD_LEFT);
				}

					$share_capital_code=$shr_splitValue[0]."-".$shr_num;
			}

			$share_capital_ins_sql="INSERT INTO 
			share_capital(code,reference,narration,main_entity,main_entity_type,
			member_no,date,amount,previous_amount,current_amount,created_by,created_on,remarks)
			VALUES
			('$share_capital_code','".$this->voucher_code."','".$this->narration."','voucher','Adjustment Receipt',
			'".$this->share_member_no."','".$this->vou_date."','$share_amount','$share_capital','$current_amount','1',NOW(),'".$this->narration."')
			";
			
			mysql_query($share_capital_ins_sql);

			$member_balance_ups_sql="UPDATE
			member_balance SET share_capital='$current_amount',modified_by='1',modified_on=NOW() WHERE member_no='".$this->share_member_no."'";
			
			mysql_query($member_balance_ups_sql);
		}				
	}
	
//+++++++++++++++++++++++++++++++++++++++SHARE CLOSE+++++++++++++++++++++++++++++++++++++++

//+++++++++++++++++++++++++++++++++++++++SURETY INT START++++++++++++++++++++++++++++++++++

	function surety_int_insert()
	{
		$type=$this->surety_int_type;
		$int_amnt=$this->surety_int_amount;
		
		$member_balance_row=mysql_query("SELECT surety_reg_balance,surety_balance,surety_od_balance,surety_od_interest 
		FROM member_balance WHERE member_no='".$this->surety_int_member_no."'");		
		$member_balance_res=mysql_fetch_array($member_balance_row);
		$surety_reg_balance=$member_balance_res['surety_reg_balance'];
		$surety_balance=$member_balance_res['surety_balance'];
		$surety_od_balance=$member_balance_res['surety_od_balance'];
		$surety_od_interest=$member_balance_res['surety_od_interest'];	
			
			$surety_loan_row=mysql_query("SELECT code FROM surety_loan ORDER BY id DESC");
			$sl_check=mysql_num_rows($surety_loan_row);
			if($sl_check<1)
			{
			$surety_loan_code='SURLON-001';
			}
			else
			{
			$surety_loan_res=mysql_fetch_array($surety_loan_row);
			$surety_loan_code=$surety_loan_res['code'];
			$sl_split_data=explode("-",$surety_loan_code);
			$sl_num=$sl_split_data[1];
			$sl_num=$sl_num+1;
				if($sl_num<100)
				{
					$sl_num=str_pad($sl_num,3,'0',STR_PAD_LEFT);
				}
					$surety_loan_code=$sl_split_data[0]."-".$sl_num;
			}
		
		if($type=="credit")////////////////////////////////////////////////////////////
		{
			
			if($surety_od_interest<>0 && $surety_od_interest>$int_amnt)
			{
			$surety_od_interest=$surety_od_interest-$int_amnt;
			}
			//rec 3000    od_int 750<>0  && 750<3000
			else if($surety_od_interest<>0 && $surety_od_interest<$int_amnt)
			{
				//2250=3000-750
				$bal_received_amount=$int_amnt-$surety_od_interest;	
			
					if($surety_od_balance<>0 && $surety_od_balance>$bal_received_amount)
					{
						$surety_od_balance=$surety_od_balance-$bal_received_amount;
					}
					
					//1500<>0 && 1500<2250
					else if($surety_od_balance<>0 && $surety_od_balance<$int_amnt)
					{
						$balance=$bal_received_amount-$surety_od_balance;
						$surety_balance=$surety_balance-$balance;
					}
				
			}
			
			$surety_loan_ins_sql="INSERT INTO surety_loan(code,reference,narration,main_entity,main_entity_type,
		member_no,date,interest,balance,od_balance,od_interest,
		created_by,created_on)VALUES('$surety_loan_code','".$this->voucher_code."','narration','voucher','adjustment receipt','".$this->surety_int_member_no."','".$this->vou_date."','$int_amnt','$surety_balance','$surety_od_balance',
		'$surety_od_interest','1',NOW())";
			$surety_int1=mysql_query($surety_loan_ins_sql);
			
			$member_balance_ups_sql="UPDATE member_balance SET surety_od_interest='$surety_od_interest' WHERE 
			member_no='".$this->surety_int_member_no."'";
			
			$surety_int2=mysql_query($member_balance_ups_sql);
			
			if($surety_int1)
			{
				echo "surety_int inserted";
			}
			if($surety_int2)
			{
				echo "surety_int member_balance inserted";
			}
		}		
		
	}
//+++++++++++++++++++++++++++++++++++++++SURETY INT close++++++++++++++++++++++++++++++++++

//+++++++++++++++++++++++++++++++++++++++SURETY PRI START++++++++++++++++++++++++++++++++++

	
	function surety_insert()
	{
		$type=$this->surety_type;
		$surety_amount=$this->surety_amount;
		
		$member_balance_row=mysql_query("SELECT surety_reg_balance,surety_balance,
		surety_od_balance,surety_od_interest FROM member_balance WHERE 
		member_no='".$this->surety_member_no."'");		
		$member_balance_res=mysql_fetch_array($member_balance_row);
		$surety_reg_balance=$member_balance_res['surety_reg_balance'];
		$surety_balance=$member_balance_res['surety_balance'];
		$surety_od_balance=$member_balance_res['surety_od_balance'];	
		$surety_od_interest=$member_balance_res['surety_od_interest'];
		
		if($surety_od_interest=='')
		{
			$surety_od_interest=0;
		}
			
			$surety_loan_row=mysql_query("SELECT code FROM surety_loan ORDER BY id DESC");
			$sl_check=mysql_num_rows($surety_loan_row);
			if($sl_check<1)
			{
			$surety_loan_code='SURLON-001';
			}
			else
			{
			$surety_loan_res=mysql_fetch_array($surety_loan_row);
			$surety_loan_code=$surety_loan_res['code'];
			$sl_split_data=explode("-",$surety_loan_code);
			$sl_num=$sl_split_data[1];
			$sl_num=$sl_num+1;
				if($sl_num<100)
				{
					$sl_num=str_pad($sl_num,3,'0',STR_PAD_LEFT);
				}
					$surety_loan_code=$sl_split_data[0]."-".$sl_num;
			}	
		
		if($type=="credit")
		{
			if($surety_od_balance<>0 && $surety_od_balance>$surety_amount)
			{
			$surety_od_balance=$surety_od_balance-$surety_amount;
			}
			else
			{
				$surety_od_balance=0;
			}
			
			$surety_reg_balance=$surety_reg_balance-$surety_amount;
			$surety_balance=$surety_balance-$surety_amount;
			
			
			
		$surety_loan_ins_sql="INSERT INTO surety_loan(code,reference,narration,main_entity,main_entity_type, member_no,date,principal,interest,debit_principal,debit_int,balance,od_balance,od_interest, created_by,created_on)VALUES('$surety_loan_code','".$this->voucher_code."','".$this->narration."',
		'voucher','adjustment receipt','".$this->surety_member_no."','".$this->vou_date."','$surety_amount','0','0','0','$surety_balance','$surety_od_balance','$surety_od_interest','1',NOW())";
		

		$surety_int1=mysql_query($surety_loan_ins_sql);
			
		$member_balance_ups_sql="UPDATE member_balance SET surety_reg_balance='$surety_reg_balance',surety_balance='$surety_balance',
		surety_od_balance='$surety_od_balance',surety_od_interest='$surety_od_interest' 
		WHERE member_no='".$this->surety_member_no."'";
			
		$surety_int2=mysql_query($member_balance_ups_sql);
		
			if($surety_int1)
			{
				echo "surety_pri inserted";
			}
			if($surety_int2)
			{
				echo "surety_pri member_balance inserted";
			}
		}		
	}

//+++++++++++++++++++++++++++++++++++++++SURETY PRI close++++++++++++++++++++++++++++++++++

//+++++++++++++++++++++++++++++++++++++++FESTIVAL INT START++++++++++++++++++++++++++++++++	
	
	function fest_int_insert()
	{
		$type=$this->fest_int_type;
		$int_amnt=$this->fest_int_amount;
		
		$member_balance_row=mysql_query("SELECT  festival_reg_balance,festival_balance,festival_od_balance,festival_od_interest
		FROM member_balance WHERE member_no='".$this->fest_int_member_no."'");		
		
		$member_balance_res=mysql_fetch_array($member_balance_row);
		
		$festival_reg_balance=$member_balance_res['festival_reg_balance'];
		$festival_balance=$member_balance_res['festival_balance'];
		$festival_od_balance=$member_balance_res['festival_od_balance'];
		$festival_od_interest=$member_balance_res['festival_od_interest'];
			
		$festival_loan_row=mysql_query("SELECT code FROM festival_loan ORDER BY id DESC");
		$fesl_check=mysql_num_rows($festival_loan_row);
		if($fesl_check<1)
		{
		$festival_loan_code='FESLON-001';
		}
		else
		{
		$festival_loan_res=mysql_fetch_array($festival_loan_row);

		$festival_loan_code=$festival_loan_res['code'];
		$fesl_split_data=explode("-",$festival_loan_code);
		$fesl_num=$fesl_split_data[1];
		$fesl_num=$fesl_num+1;
		if($fesl_num<100)
		{
		$fesl_num=str_pad($fesl_num,3,'0',STR_PAD_LEFT);
		}
		$festival_loan_code=$fesl_split_data[0]."-".$fesl_num;
		}
		
		if($type=="credit")////////////////////////////////////////////////////////////
		{
			if($festival_od_interest<>0 && $festival_od_interest>$int_amnt)
			{
			$festival_od_interest=$festival_od_interest-$int_amnt;
			}
			else
			{
				$festival_od_interest=0;
			}
			$festival_loan_ins_sql=("update festival_loan set interest='$int_amnt',modified_on=now() where member_no='".$this->fest_int_member_no."' and reference='".$this->voucher_code."'");
			
	//$festival_loan_ins_sql="INSERT INTO festival_loan(code,reference,narration,main_entity,main_entity_type,member_no,date,interest,balance,od_balance,od_interest)VALUES('$festival_loan_code','".$this->voucher_code."','".$this->narration."','voucher','adjustment receipt','".$this->fest_int_member_no."','".$this->narration."','".$this->vou_date."','$int_amnt','$festival_balance','$festival_od_balance','$festival_od_interest')";		
	
			mysql_query($festival_loan_ins_sql);
			
			
			$member_balance_ups_sql="UPDATE member_balance SET festival_interest='$int_amnt',$festival_od_interest='$festival_od_interest' WHERE member_no='".$this->fest_int_member_no."'";	
			
			mysql_query($member_balance_ups_sql);
			
			if($surety_int1)
			{
				echo "surety_int inserted";
			}
			if($surety_int2)
			{
				echo "surety_int member_balance inserted";
			}
		}		
	}
//+++++++++++++++++++++++++++++++++++++++FESTIVAL INT close++++++++++++++++++++++++++++++++++

//+++++++++++++++++++++++++++++++++++++++FESTIVAL PRI START++++++++++++++++++++++++++++++++++

	
	function fest_pri_insert()
	{
		
		$type=$this->fest_type;
		$fest_amount=$this->fest_amount;
		
		$member_balance_row=mysql_query("SELECT  festival_reg_balance,festival_balance,festival_od_interest
		festival_od_balance FROM member_balance WHERE member_no='".$this->fest_member_no."'");		
		
		$member_balance_res=mysql_fetch_array($member_balance_row);
		
		$festival_reg_balance=$member_balance_res['festival_reg_balance'];
		$festival_balance=$member_balance_res['festival_balance'];
		$festival_od_balance=$member_balance_res['festival_od_balance'];
		$festival_od_interest=$member_balance_res['festival_od_interest'];
			
			$festival_loan_row=mysql_query("SELECT code FROM festival_loan ORDER BY id DESC");
			$fesl_check=mysql_num_rows($festival_loan_row);
			if($fesl_check<1)
			{
			$festival_loan_code='FESLON-001';
			}
			else
			{
			$festival_loan_res=mysql_fetch_array($festival_loan_row);

			$festival_loan_code=$festival_loan_res['code'];
			$fesl_split_data=explode("-",$festival_loan_code);
			$fesl_num=$fesl_split_data[1];
			$fesl_num=$fesl_num+1;
			if($fesl_num<100)
			{
			$fesl_num=str_pad($fesl_num,3,'0',STR_PAD_LEFT);
			}
			$festival_loan_code=$fesl_split_data[0]."-".$fesl_num;
			}
		
		if($type=="credit")
		{
			if($festival_od_balance<>0 && $festival_od_balance>$fest_amount)
			{
				$festival_od_balance=$festival_od_balance-$fest_amount;
			}
			else
			{
				$festival_od_balance=0;
			}
			
			$festival_reg_balance=$festival_reg_balance-$fest_amount;
			
			$festival_balance=$festival_balance-$fest_amount;
			
			
			
			$festival_loan_ins_sql="INSERT INTO festival_loan(code,reference,narration,main_entity,main_entity_type,member_no,date,principal,balance,od_balance,od_interest)VALUES('$festival_loan_code','".$this->voucher_code."','".$this->narration."','voucher','adjustment receipt',	'".$this->fest_member_no."','".$this->vou_date."','$fest_amount','$festival_balance','$festival_od_balance','$festival_od_interest')";	
		
			
			mysql_query($festival_loan_ins_sql);
			
			$member_balance_ups_sql="UPDATE member_balance SET festival_balance='$festival_balance',festival_reg_balance='$festival_reg_balance',festival_od_interest='$festival_od_interest' WHERE member_no='".$this->fest_member_no."'";	
			
			mysql_query($member_balance_ups_sql);
		}		
	}
	
	function scr()
	{
		
		$type=$this->scr_type;
		$scr_amount=$this->scr_amount;
		$narration=$this->narration;
		$ref=$this->scr_member_no;
		$check_branch=mysql_query("SELECT branch_code FROM voucher where branch_code='$ref' ORDER BY id DESC");
		$check=mysql_num_rows($check_branch);
		if($check>0)
		{
			$bran=mysql_fetch_array($check_branch);
			echo $branc_name=$bran['branch_code'];
		}
		else
		{
			$reference=$ref;
		}
		
		
		$scr_sql="SELECT code FROM sundry_creditors ORDER BY id DESC";
		$scr_row=mysql_query($scr_sql);
		$scr_check=mysql_num_rows($scr_row);

		if($scr_check<1)
		{
		$scr_code='SCR-001';
		}
		else
		{
		$scr_res=mysql_fetch_array($scr_row);
		$scr_code=$scr_res['code'];
		$scr_splitValue=explode("-",$scr_code);
		$scr_num=$scr_splitValue[1];
		$scr_num=$scr_num+1;
		if($scr_num<100)
		{
		$scr_num=str_pad($scr_num,3,"0",STR_PAD_LEFT);
		}

		$scr_code=$scr_splitValue[0]."-".$scr_num;
		}
	$scr_ins_sql="INSERT INTO sundry_creditors(code,reference,narration,main_entity,main_entity_type,member_no,branch_code,date,amount,created_by,created_on,remarks)VALUES('$scr_code','".$this->voucher_code."','$narration','VOUCHER','ADJUSTMENT RECEIPT','$reference','$branc_name','".$this->vou_date."','$scr_amount','1',NOW(),'".$this->narration."')";
		
		
		mysql_query($scr_ins_sql);
	}
	
	function sdr()
	{
		$reference_voucher=$this->reference_voucher;
		$voucher_code=$this->voucher_code;
		$description='SUNDRY DEBITOR';
		$narration='OPN BAL';
		
		$sdr_ins_sql="update sundry_debtors set paid_voucher_code='$voucher_code',description='$description',main_entity='VOUCHER',main_entity_type='ADJUSTMENT SLIP',branch_code='".$this->branch_code."',date=now(),flag_id=20,modified_on=now() where reference='$reference_voucher'";
					
		mysql_query($sdr_ins_sql);
	}
	
	function after_demand($member_no,$demand_month_no)
	{
		echo "CALL Bulk_Col_after_demand('$demand_month_no','$member_no')";
		$check=mysql_query("CALL Bulk_Col_after_demand('$demand_month_no','$member_no')");
		if($check)
		{
			echo "Affected";
		}
		
	}
	
}


?>