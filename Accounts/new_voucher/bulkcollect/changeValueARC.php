<?php
require("../../configuration.php");
require("../../user.php");

$member_no=$_REQUEST['member_no'];
$id=$_REQUEST['id'];
$amount=$_REQUEST['amount'];
$vou_entry_date=$_REQUEST['vou_entry_date'];
$day=date('d',strtotime($vou_entry_date));

	if($id==1) //surety loan
	{
		$member_balance_sql="SELECT surety_reg_balance,surety_od_balance,surety_od_interest 
								FROM
									member_balance
								WHERE
									member_no='$member_no'";
		$member_balance_row=mysql_query($member_balance_sql);
		$member_balance_res=mysql_fetch_array($member_balance_row);
		
		$loan_od_interest=$member_balance_res['surety_od_interest'];
		$loan_od_balance=$member_balance_res['surety_od_balance'];
		$loan_reg_balance=$member_balance_res['surety_reg_balance'];
	}
	else if($id==2) //festival loan
	{
		$member_balance_sql="SELECT festival_reg_balance,festival_od_balance,festival_od_interest
								FROM
									member_balance
								WHERE
									member_no='$member_no'";
		$member_balance_row=mysql_query($member_balance_sql);
		$member_balance_res=mysql_fetch_array($member_balance_row);
		
		$loan_od_interest=$member_balance_res['festival_od_interest'];
		$loan_od_balance=$member_balance_res['festival_od_balance'];
		$loan_reg_balance=$member_balance_res['festival_reg_balance'];
	}
/* else if($id==3) //flood loan
{
	$member_balance_sql="SELECT flood_reg_balance,flood_od_balance,flood_od_interest
							FROM
								member_balance
							WHERE
								member_no='$member_no'";
	$member_balance_row=mysql_query($member_balance_sql);
	$member_balance_res=mysql_fetch_array($member_balance_row);
	
	$loan_od_interest=$member_balance_res['flood_od_interest'];
	$loan_od_balance=$member_balance_res['flood_od_balance'];
	$loan_reg_balance=$member_balance_res['flood_reg_balance'];
	
} */	

if($loan_od_interest<>0 && $loan_od_balance<>0)
{
	
	if($amount>$loan_od_interest)
	{
		$amount=$amount-$loan_od_interest;
		if($amount>$loan_od_balance)
		{
			$amount=$amount-$loan_od_balance;
			
			if($amount>$loan_reg_balance)
			{
				if($day<=15)
				{
				$interest=round(((($loan_reg_balance*10)/100)/12)/2);
				$scr=$amount-($loan_reg_balance+$interest);				
				}
				else
				{
				$interest=round((($loan_reg_balance*10)/100)/12);
				$scr=$amount-($loan_reg_balance+$interest);
				
				}
				
			}
			else
			{	
				$interest=round((($loan_reg_balance*10)/100)/12);		
				$loan_reg_balance=$amount-$interest;
			}
		}
		else
		{
			$loan_od_balance=$amount;
			$loan_reg_balance=0;
		}
	}
	else
	{
		$loan_od_interest=$amount;
		$loan_od_balance=0;
		$loan_reg_balance=0;
		$scr=0;
	}
}
if($loan_od_interest==0 && $loan_od_balance<>0)
{
	if($amount>$loan_od_balance)
		{
			$amount=$amount-$loan_od_balance;
			
			if($amount>$loan_reg_balance)
			{
				if($day<=15)
				{
				$interest=round(((($loan_reg_balance*10)/100)/12)/2);
				$scr=$amount-($loan_reg_balance+$interest);
				
				}
				else
				{
				$interest=round((($loan_reg_balance*10)/100)/12);
				$scr=$amount-($loan_reg_balance+$interest);
				
				}
			}
			else
			{			
				$interest=round((($loan_reg_balance*10)/100)/12);		
				$loan_reg_balance=$amount-$interest;
			}
		}
		else
		{
			$loan_od_balance=$amount;
			$loan_reg_balance=0;
			$scr=0;
		}
}
if($loan_od_interest==0 && $loan_od_balance==0 && $loan_reg_balance<>0)
{
	if($amount>$loan_reg_balance)
	{
				if($day<=15)
				{
					$interest=round(((($loan_reg_balance*10)/100)/12)/2);
					$scr=$amount-($loan_reg_balance+$interest);
					
				}
				else
				{
				$interest=round((($loan_reg_balance*10)/100)/12);
				$scr=$amount-($loan_reg_balance+$interest);
				}
	}
	else
	{
	$interest=round((($loan_reg_balance*10)/100)/12);		
	$loan_reg_balance=$amount-$interest;
	$scr=0;
	}
}
$sql=mysql_query("SELECT * FROM demand WHERE member_no='$member_no' and flag_id=8");
$check=mysql_num_rows($sql);
if($check==0 && $day>15)
{
	$loan_reg_balance=$loan_reg_balance+$interest;
	$interest=0;
	
}
else if($check==0 && $day<15)
{
	$loan_reg_balance;
	$interest;
}
else
{
	$interest;
}

echo $loan_od_interest."=".$loan_od_balance."=".$loan_reg_balance."=".$interest."=".$scr;