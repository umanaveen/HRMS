<?php
require("../../connect.php");

$from_date=$_REQUEST['from_date'];
$to_date=$_REQUEST['to_date'];
?>

	<div class="right">
	<a href="#" id="1" class="excel"  onclick="tableToExcel('tblDayBook', 'List User')">
	<span class="fa fa-download"></span>&nbsp;Excel</a>&nbsp;&nbsp;
	<a href="/UCO/daybook-print.php?from_date=<?php echo $from_date;?>&to_date=<?php echo $to_date;?>" target="_blank"  style="float:right; padding-right:20px;">
	<i class="fa fa-print"></i> Print
	</a>
	</div>
	<br/>
	
<style>
@media print {
	 .pagebreak {page-break-after: always;}	
	 thead
        {
            display: table-header-group;
        }
	 
	tr.b_f{
		text-align:center;
		page-break-before: always;
	}
	tr.c_f{
		text-align:center;
		page-break-after: always;
	}
	
	@page {
  @bottom-right {
    content: counter(page) " of " counter(pages);
  }
}
body{
	font-size:12px;
}
}
.table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th{
	    vertical-align: bottom;
		font-size:15px;
		padding:2.5px;
}
.txt_right{
	text-align:right;
}
caption {
    padding-top: 8px;
    padding-bottom: 8px;
    color: #f39c12;
    text-align: left;
}
.table-bordered>tbody>tr>td, .table-bordered>tbody>tr>th, .table-bordered>tfoot>tr>td, .table-bordered>tfoot>tr>th, .table-bordered>thead>tr>td, .table-bordered>thead>tr>th
{
	border:1px solid #eeeeee;
}
</style>
<?php 

	$from=date("Y-m-d",strtotime($from_date));
	$dateclose=date("Y-m-d",strtotime($from_date));

	$to=date("Y-m-d",strtotime($to_date));
	$start = strtotime("$from");
	$end = strtotime("$to");
	$days_between = ceil(abs($end - $start) / 86400);
	$current_date=date("Y-m-d",strtotime($from_date));
	
	for($r=0;$r<=$days_between;$r++)  //this is used to check coll in date between used for loop
	{
		$a=0;
		$result = array();
		
		$check = $con->query("select count(id) from daybook_new")->fetchColumn();	
		
		$query = $con->query("SELECT main_entity, main_entity_type,
				(case when main_entity in ('FD','VOUCHER') then reference else '' end) as reference,
				(case when main_entity in ('FD','VOUCHER') then search_no else '' end) as search_no,
						date, ledger_code,narration,name,cash_receipt,
						(case when ledger_code<>'A001' then sum(adjustment_receipt) else adjustment_receipt end) as adjustment_receipt,receipt_total,cash_payment, 
					 (case when ledger_code<>'A001' then sum(adjustment_payment) else adjustment_payment end) as adjustment_payment,payment_total
						 FROM daybook_new  where date='$current_date' group by search_no,ledger_code ORDER BY ledger_code desc");
		
		
		if($check>0)
		{
			
						 
						 
			while($res_query=$query->fetch(PDO::FETCH_ASSOC))
			{				
				$result[$a]=$res_query;
				$a++;
			}	
		
		$count=count($result);
		$c=$count; //$count=32;
		$d_count=24; //Display Count
		$n=round($count/$d_count); //$n=2
		$s=0;
		//ini_set('display_errors', 0);
		//ini_set('display_startup_errors', 0);
		//error_reporting(E_ALL);
		
		
		for($o=$s;$o<=$n;$o++)
		{
			if($count>=$d_count)
			{

?>
	
		<caption>
		<center>
		Quadsel<br>
		CHENNAI 600 001 , PHONE : 044-25331230 <br>
		<center>DAYBOOK - <?php echo date("d-m-Y",strtotime($current_date));?></center>

		</center>
		</caption>
		<table class="table table-bordered table-striped table-hover " class="tblDayBook" style="float:clear;font-family:'Times New Roman', Times, serif" style="page-break-before: always; page-break-after: always;">	
			<thead>
	
			
			</thead>
			<tr>
			<th></th>
			<th colspan="4" style="color: #00a65a;"><center>RECEIPTS</center></th>
			<th colspan="4" style="color: #de210d;"><center>PAYMENTS</center></th>
			</tr>
			<tr>
			<th style="text-align: left;color: #3c8dbc;">VOU. NO</th>
			<th style="text-align: left;color: #3c8dbc;">NAME AND PARTICULARS</th>
			<th style="text-align: left;color: #3c8dbc;">CASH</th>
			<th style="text-align: right;color: #3c8dbc;">ADJUSTMENT</th>
			<th style="text-align: right;color: #3c8dbc;">TOTAL</th>
			<th style="width:7%;text-align: right;color: #3c8dbc;"></th>
			<th style="text-align: right;color: #3c8dbc;">CASH</th>
			<th style="text-align: right;color: #3c8dbc;">ADJUSTMENT</th>
			<th style="text-align: right;color: #3c8dbc;">TOTAL</th>
			</tr>
			

		<?php 
		if($o!=0)
		{
			?>				
			<tr class="b_f" style="page-break-inside: avoid;">
			<td class="txt_right"><b>B/F</b></td>
			<td></td>
			<td class="txt_right"><?php $ptot_cash_recpt[]=array_sum($tot_cash_recpt); echo array_sum($tot_cash_recpt); ?></td>
			<td class="txt_right"><?php $ptot_adj_recpt[]=array_sum($tot_adj_recpt);  echo  array_sum($tot_adj_recpt); ?></td>
			<td class="txt_right"><?php echo array_sum($tot_cash_recpt)+  array_sum($tot_adj_recpt); ?></td>
			<td></td>
			<td class="txt_right"><?php $ptot_cash_pay[]=array_sum($tot_cash_pay); echo array_sum($tot_cash_pay); ?></td>
			<td class="txt_right"><?php $ptot_adj_pay[]=array_sum($tot_adj_pay); echo array_sum($tot_adj_pay); ?></td>
			<td class="txt_right"><?php echo array_sum($tot_cash_pay)+ array_sum($tot_adj_pay);  ?></td>
			</tr>		
			<?php 
		}
		 
		for($p=0;$p<$d_count;$p++)
		{
		$s=$c-($p+1); ?>
		<tr>
		<td>
		<?php if($result[$s]['reference']!='')
		{	
		echo $result[$s]['reference']; 
		}
		else
		{ 
		echo '-'.$result[$s]['reference'];
		}
		?>
		</td>
		<td>
		<?php 
	if($p==0)
	{	
	echo '<b>'.$result[$s]['ledger_code'].' - '.strtoupper($result[$s]['name']).' </b> <br/> '.$result[$s]['search_no'].' - '.strtoupper($result[$s]['name']);
	$j=$s+1;
	}
	else if(trim($result[$s]['ledger_code'])==trim($result[$j]['ledger_code']))
	{
	if(isset($result[$s]['narration'])){
	if(isset($result[$s]['member_no'])){
	echo $result[$s]['search_no'].' - <b>'.$result[$s]['member_no'].' / '.strtoupper($result[$s]['member_name']).'</b>';
	}else{
	echo $result[$s]['search_no'].' - '.strtoupper($result[$s]['narration']);
	}
	}else{
	echo $result[$s]['search_no'].' - '.strtoupper($result[$s]['name']);
	}

	}else{
	echo '<b>'.$result[$s]['ledger_code'].' - '.strtoupper($result[$s]['name']).' </b> <br/> '.$result[$s]['search_no'].' - '.strtoupper($result[$s]['narration']);
	}		
	?>
	</td>
	<td class="txt_right"><?php $tot_cash_recpt[$s]=$result[$s]['cash_receipt'];
	if($result[$s]['cash_receipt']!=0)
	{ 
	echo $result[$s]['cash_receipt'];} ?>
	</td>
	<td class="txt_right"><?php $tot_adj_recpt[$s]=$result[$s]['adjustment_receipt']; 
	if($result[$s]['adjustment_receipt']!=0){  echo $result[$s]['adjustment_receipt']; } ?>
	</td>
	<td class="txt_right"><?php 
	if($p==0){
	if($result[$s]['receipt_total']!=0){
	echo $result[$s]['receipt_total'];
	}
	$j=$s+1;
	}else if(trim($result[$s]['ledger_code'])==trim($result[$j]['ledger_code'])){
	echo '';


	}else{
	if($result[$s]['receipt_total']!=0){
	echo $result[$s]['receipt_total'];
	}
	} ?>
	</td>
	<td></td>
	<td class="txt_right">
	<?php $tot_cash_pay[$s]=$result[$s]['cash_payment']; 
	if($result[$s]['cash_payment']!=0){ echo $result[$s]['cash_payment']; } ?></td>
	<td class="txt_right">
	<?php $tot_adj_pay[$s]=$result[$s]['adjustment_payment']; if($result[$s]['adjustment_payment']!=0){ echo $result[$s]['adjustment_payment'];} ?>
	</td>
	<td class="txt_right"><?php 
	if($p==0){
	if($result[$s]['payment_total']!=0){
	echo $result[$s]['payment_total'];
	}
	$j=$s+1;
	}else if(trim($result[$s]['ledger_code'])==trim($result[$j]['ledger_code'])){
	echo '';	

	}else{
	if($result[$s]['payment_total']!=0){
	echo $result[$s]['payment_total'];
	}
	} 
	?>
	</td>
	</tr>


	<?php $j--; 


	} 

		$count=$count-$d_count;
		$c=$count;
		if($c>1) { ?> 
		
		
	<tr class="c_f" >
	<td style='text-align:center;'><b>C/O</b></td>
	<td></td>
	<td class="txt_right"><?php $ptot_cash_recpt[]=array_sum($tot_cash_recpt); echo array_sum($tot_cash_recpt); ?></td>
	<td class="txt_right"><?php $ptot_adj_recpt[]=array_sum($tot_adj_recpt);  echo  array_sum($tot_adj_recpt); ?></td>
	<td class="txt_right"><?php echo array_sum($tot_cash_recpt)+array_sum($tot_adj_recpt); ?></td>
	<td></td>
	<td class="txt_right"><?php $ptot_cash_pay[]=array_sum($tot_cash_pay); echo array_sum($tot_cash_pay); ?></td>
	<td class="txt_right"><?php $ptot_adj_pay[]=array_sum($tot_adj_pay); echo array_sum($tot_adj_pay); ?></td>
	<td class="txt_right"><?php echo array_sum($tot_cash_pay)+array_sum($tot_adj_pay);  ?></td>
	</tr>
		
		<?php }
		
		?>
		</tbody>
		</table>
		<div class='pagebreak'></div>
		<?php
		
		//echo '<tr></tr><tr></tr>';
		
	}
	else if($count!=0)
	{		?>

	<caption>
	<center>
	QUADSEL<br>
	CHENNAI 600 001 , PHONE : 044-25331230 <br>
	<center>DAYBOOK - <?php echo date("d-m-Y",strtotime($current_date));?></center>
	</center>
	</caption>
	<table class="table table-bordered table-striped table-hover " id="tblDayBook" style="font-family:'Times New Roman', Times, serif" style="page-break-before: always; page-break-after: always;">
	<thead>	
	<tr>
	<th></th>
	<th colspan="4" style="color: #00a65a;"><center>RECEIPTS</center></th>
	<th colspan="4" style="color: #de210d;"><center>PAYMENTS</center></th>
	</tr>
	<tr>
	<th style="text-align: left;color: #3c8dbc;">VOU. NO</th>
	<th style="text-align: left;color: #3c8dbc;">NAME AND PARTICULARS</th>
	<th style="text-align: left;color: #3c8dbc;">CASH</th>
	<th style="text-align: right;color: #3c8dbc;">ADJUSTMENT</th>
	<th style="text-align: right;color: #3c8dbc;">TOTAL</th>
	<th style="width:7%;text-align: right;color: #3c8dbc;"></th>
	<th style="text-align: right;color: #3c8dbc;">CASH</th>
	<th style="text-align: right;color: #3c8dbc;">ADJUSTMENT</th>
	<th style="text-align: right;color: #3c8dbc;">TOTAL</th>
	</tr>
		</thead>

<?php 
		if($o!=0){
			?> 
		
		<tr class="b_f " style="page-break-inside: avoid;">
		<td colspan=2 style='text-align:center;'><b> B/F</b></td>
		<td></td>
		<td class="txt_right"><?php $ptot_cash_recpt[]=array_sum($tot_cash_recpt); echo array_sum($tot_cash_recpt); ?></td>
		<td class="txt_right"><?php $ptot_adj_recpt[]=array_sum($tot_adj_recpt);  echo  array_sum($tot_adj_recpt); ?></td>
		<td class="txt_right"><?php echo array_sum($tot_cash_recpt)+  array_sum($tot_adj_recpt); ?></td>
		<td></td>
		<td class="txt_right"><?php $ptot_cash_pay[]=array_sum($tot_cash_pay); echo array_sum($tot_cash_pay); ?></td>
		<td class="txt_right"><?php $ptot_adj_pay[]=array_sum($tot_adj_pay); echo array_sum($tot_adj_pay); ?></td>
		<td class="txt_right"><?php echo array_sum($tot_cash_pay)+ array_sum($tot_adj_pay);  ?></td>
		</tr>
		
		<?php 
		}
		 
		
		for($q=0;$q<$count;$q++){
			$s=$c-($q+1);
			?>
		
		
		
			<tr>
				<td><?php  if($result[$s]['reference']!=''){echo $result[$s]['reference'];}else{ echo '-';} ?></td>
				<td><?php 
				if($q==0){
					echo '<b>'.$result[$s]['ledger_code'].' - '.strtoupper($result[$s]['name']).' </b> <br/> '.$result[$s]['search_no'].' - '.strtoupper($result[$s]['narration']);
					echo $j=$s+1;
				}else if(trim($result[$s]['ledger_code'])==trim($result[$j]['ledger_code'])){
					
					if(isset($result[$s]['narration'])){
						if(isset($result[$s]['member_no'])){
							echo $result[$s]['search_no'].' - <b>'.$result[$s]['member_no'].' / '.strtoupper($result[$s]['member_name']).'</b>';
						}else{
						echo $result[$s]['search_no'].' - '.strtoupper($result[$s]['narration']);
						}
					}else{
						echo $result[$s]['search_no'].' - '.strtoupper($result[$s]['name']);
					}
					
				}else{
					
					echo '<b>'.$result[$s]['ledger_code'].' - '.strtoupper($result[$s]['name']).' </b> <br/> '.$result[$s]['search_no'].' - '.strtoupper($result[$s]['narration']);
				}			
				
				 ?>
				 </td>
				<td class="txt_right"><?php $tot_cash_recpt[$s]=$result[$s]['cash_receipt']; if($result[$s]['cash_receipt']!=0){
					echo $result[$s]['cash_receipt']; 
				} ?>
				</td>
				<td class="txt_right"><?php $tot_adj_recpt[$s]=$result[$s]['adjustment_receipt']; if($result[$s]['adjustment_receipt']!=0){ echo $result[$s]['adjustment_receipt']; }?></td>
				<td class="txt_right"><?php  if($q==0){
					echo $result[$s]['receipt_total'];
					$j=$s+1;
				}else if(trim($result[$s]['ledger_code'])==trim($result[$j]['ledger_code'])){
					echo '';
					
					
				}else{
					echo $result[$s]['receipt_total'];
				} 
				?></td>
				<td></td>
				<td class="txt_right"><?php  $tot_cash_pay[$s]=$result[$s]['cash_payment']; if($result[$s]['cash_payment']!=0){ echo $result[$s]['cash_payment'];}?></td>
				<td class="txt_right"><?php $tot_adj_pay[$s]=$result[$s]['adjustment_payment'];if($result[$s]['adjustment_payment']!=0){  echo $result[$s]['adjustment_payment'];} ?></td>
				<td class="txt_right"><?php 
				if($q==0){
					 if($result[$s]['payment_total']!=0){
						echo $result[$s]['payment_total']; 
					 }
					
					
					$j=$s+1;
				}else if(trim($result[$s]['ledger_code'])==trim($result[$j]['ledger_code'])){
					echo '';
					
					
				}else{
					 if($result[$s]['payment_total']!=0){
					echo $result[$s]['payment_total'];
					 }
				}?></td>
			</tr>
		
		
		<?php $j--; 
				
			
		}  
		
		if($q==$count){
			$count=0;
		}else{
			$count=$q;
		}
		$c=$count;
		
		
		if($c>1) { ?> 
		
		<tr class="c_f" >
				
				<td colspan=3 style='text-align:center;'><b>C/O</b></td>
				<td></td>
				<td class="txt_right"><?php $ptot_cash_recpt[]=array_sum($tot_cash_recpt); echo array_sum($tot_cash_recpt); ?></td>
				<td class="txt_right"><?php $ptot_adj_recpt[]=array_sum($tot_adj_recpt);  echo  array_sum($tot_adj_recpt); ?></td>
				<td class="txt_right"><?php echo array_sum($tot_cash_recpt)+  array_sum($tot_adj_recpt); ?></td>
				<td></td>
				<td class="txt_right"><?php $ptot_cash_pay[]=array_sum($tot_cash_pay); echo array_sum($tot_cash_pay); ?></td>
				<td class="txt_right"><?php $ptot_adj_pay[]=array_sum($tot_adj_pay); echo array_sum($tot_adj_pay); ?></td>
				<td class="txt_right"><?php echo array_sum($tot_cash_pay)+  array_sum($tot_adj_pay);  ?></td>
			</tr>
		
		<?php 
		
		}
		
		?>
		
		<?php
	}
	?>
</table>	

	<?php 
	
	
} 

if($o==0){
  ?>

	<div class='pagebreak'></div>
	
<table class="table table-bordered table-striped table-hover " class="tblDayBook" style="float:left;margin-left:220px;font-family:'Times New Roman', Times, serif" style="page-break-before: always; page-break-after: always;">
	<thead>
	
		<caption>
		<center>
		QUADSEL<br>
		CHENNAI 600 001 , PHONE : 044-25331230 <br>
		<center>DAYBOOK - <?php echo date("d-m-Y",strtotime($current_date));?></center>			
		</center>
		</caption>
		<tr>
		<th></th>
		<th colspan="4" style="color: #00a65a;"><center>RECEIPTS</center></th>
		<th colspan="4" style="color: #de210d;"><center>PAYMENTS</center></th>
		</tr>
		<tr>
		<th style="text-align: left;color: #3c8dbc;">VOU. NO</th>
		<th style="text-align: left;color: #3c8dbc;">NAME AND PARTICULARS</th>
		<th style="text-align: left;color: #3c8dbc;">CASH</th>
		<th style="text-align: right;color: #3c8dbc;">ADJUSTMENT</th>
		<th style="text-align: right;color: #3c8dbc;">TOTAL</th>
		<th style="width:7%;text-align: right;color: #3c8dbc;"></th>
		<th style="text-align: right;color: #3c8dbc;">CASH</th>
		<th style="text-align: right;color: #3c8dbc;">ADJUSTMENT</th>
		<th style="text-align: right;color: #3c8dbc;">TOTAL</th>
		</tr>
		</thead>
		</table>

<?php }
else
{
	?>
<table class="table table-bordered table-striped table-hover " style="float:left;margin-left:0px;font-family:'Times New Roman', Times, serif" style="page-break-before: always; page-break-after: always;" >
		<tfoot>		
		<tr class="t_f" >
		<th style="width:5.8%;text-align: left;"></th>
		<th style="width:24%;text-align: left;color: #3c8dbc;"><b>Total</b></th>
		<th style="width:4%;text-align: right;"><b><?php echo array_sum($tot_cash_recpt); ?></b></th>
		<th style="width:8.5%;text-align: right;"><b><?php echo array_sum($tot_adj_recpt); ?></b></th>
		<th style="width:3%;text-align: right;"><b><?php  echo array_sum($tot_cash_recpt)+array_sum($tot_adj_recpt); ?></b></th>
		<th style="width:.1%;text-align: right;"><b></b></th>
		<th style="width:3.7%;text-align: right;"><b><?php echo array_sum($tot_cash_pay);  ?></b></th>
		<th style="width:8.6%;text-align: right;"><b><?php echo array_sum($tot_adj_pay);  ?></b></th>
		<th style="width:2.7%;text-align: right;"><b><?php echo array_sum($tot_cash_pay)+array_sum($tot_adj_pay);  ?></b></th>
		</tr>
			
			<!-- /* Opening Balance and Closeing Balance */-->
			<?php
			 $cur_date=date('d',strtotime($current_date));
			 $cur_month=date('m',strtotime($current_date));
			 if($cur_month==01 || $cur_month==02 || $cur_month ==03){
				 $cur_year=date('Y',strtotime($current_date. ' -1 year'));				
			 }else{
				 $cur_year=date('Y',strtotime($current_date));
			 }
			 
			  $cur_fin_date=$cur_year.'-04-01';
			  $prev_day=date('Y-m-d', strtotime($current_date . ' -1 day'));
			if(($cur_date=='01')&&($cur_month=='04')){
				$opn_query=mysql_fetch_array(mysql_query("select * from accounts_ledger_opening_balance where 
			year='$cur_year' and ledger_code ='Z001'"));
			$opn_bal=$opn_query['balance'];
			
			}
			else
			{
				
				$opn_query_sql=$con->query("select * from accounts_ledger_opening_balance where year='$cur_year' and ledger_code ='Z001'");
				$opn_query=$opn_query_sql->fetch(PDO::FETCH_ASSOC);
				
				
				//$opn_bal_query_sql=$con->query("select sum(cash_receipt) as cash_rec,sum(cash_payment) as cash_pay from daybook where date between '$cur_fin_date' and '$prev_day' ");

				//$opn_bal_query=$opn_bal_query_sql->fetch(PDO::FETCH_ASSOC);
			
				
					$opn_bal=$opn_query['balance'];//+($opn_bal_query['cash_rec']-$opn_bal_query['cash_pay']);
				
					
			}
			?>
		<tr class="t_f" >
		<th style="text-align: left;"></th>
		<th style="text-align: left;color: #3c8dbc;"><b> OPN.Bal</b></th>
		<th style="text-align: right;"><b><?php $opn_tot=$opn_bal;echo $opn_tot; ?></b></th>
		<th style="text-align: right;"></th>
		<th style="text-align: right;"><b><?php  echo $opn_tot; ?></b></th>
		<th style="text-align: right;width:0%;color: #3c8dbc;"><b>CLS.Bal</b></th>
		<th style="text-align: right;"><b><?php $cls_tot=$opn_tot- array_sum($tot_cash_pay);  echo $cls_tot+array_sum($tot_cash_recpt);  ?></b></th>
		<th style="text-align: right;"></th>
		<th style="text-align: right;"><b><?php echo $number = $cls_tot+array_sum($tot_cash_recpt);  ?></b></th>
		</tr>			
		<!-- /* End of Opening Balance and Closeing Balance */-->
		
		<tr class="t_f" >
			<td></td>
			<td style="text-align: left;color: #3c8dbc;"><b><?php echo 'Total'; ?></b></td>				
			<td style="text-align: right;color: #00a65a;"><b><?php echo $opn_tot+array_sum($tot_cash_recpt); ?></b></td>
			<td style="text-align: right;color: #00a65a;"><b><?php echo array_sum($tot_adj_recpt); ?></b></td>
			<td style="text-align: right;color: #00a65a;"><b><?php  echo $opn_tot+array_sum($tot_adj_recpt); ?></b></td>
			<td style="text-align: right;"></td>
			<td style="text-align: right;color: #de210d;"><b><?php echo $opn_tot+array_sum($tot_cash_recpt);  ?></b></td>
			<td style="text-align: right;color: #de210d;"><b><?php echo array_sum($tot_adj_pay);  ?></b></td>
			<td style="text-align: right;color: #de210d;"	><b><?php echo $opn_tot+array_sum($tot_adj_pay);  ?></b></td>
		</tr>
			<?php /* number to string conversion Starts */

		$numr=$number;
   $no = round($number);
   $point = round($number - $no, 2) * 100;
   $hundred = null;
   $digits_1 = strlen($no);
   $i = 0;
   $str = array();
   $words = array('0' => '', '1' => 'one', '2' => 'two',
    '3' => 'three', '4' => 'four', '5' => 'five', '6' => 'six',
    '7' => 'seven', '8' => 'eight', '9' => 'nine',
    '10' => 'ten', '11' => 'eleven', '12' => 'twelve',
    '13' => 'thirteen', '14' => 'fourteen',
    '15' => 'fifteen', '16' => 'sixteen', '17' => 'seventeen',
    '18' => 'eighteen', '19' =>'nineteen', '20' => 'twenty',
    '30' => 'thirty', '40' => 'forty', '50' => 'fifty',
    '60' => 'sixty', '70' => 'seventy',
    '80' => 'eighty', '90' => 'ninety');
   $digits = array('', 'hundred', 'thousand', 'lakh', 'crore');
   while ($i < $digits_1) {
     $divider = ($i == 2) ? 10 : 100;
     $number = floor($no % $divider);
     $no = floor($no / $divider);
     $i += ($divider == 10) ? 1 : 2;
     if ($number) {
        $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
        $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
        $str [] = ($number < 21) ? $words[$number] .
            " " . $digits[$counter] . $plural . " " . $hundred
            :
            $words[floor($number / 10) * 10]
            . " " . $words[$number % 10] . " "
            . $digits[$counter] . $plural . " " . $hundred;
     } else $str[] = null;
  }
  $str = array_reverse($str);
  $result = implode('', $str);
  $points = ($point) ?
    "." . $words[$point / 10] . " " . 
          $words[$point = $point % 10] : '';
		  $string_amount='';
   $string_amount=$result . "Rupees  " . $points . " Paise only";
   
		/* number to string conversion Ends*/
		
		?>
		
		
		<tr ><td colspan=8 style="border:none;"><?php echo "<b>CASH ON HAND Rs.".$numr.' ( '.strtoupper($string_amount)."</b> )";?></td></tr>
		
		<tr>
		<td colspan=5 style="border:none;"></td>
		<td colspan=3 style="border:none;color: #a93a4d;">QUADSEL,</td>
		</tr>
		<tr>
		<td colspan=5 style="border:none;"></td>
		<td colspan=1 style="border:none;color:#1c0cf5e0;">SECRETARY</td> 
		<td colspan=2 style="border:none;color:#1c0cf5e0;">PRESIDENT</td>
		</tr>
		
		</tfoot>
		
		<?php unset($tot_adj_recpt);unset($tot_adj_pay);unset($tot_cash_pay);unset($tot_cash_recpt);?>
		
		</table>
		<div class='pagebreak'></div>
	
	<?php
}

}
$current_date = date('Y-m-d', strtotime($current_date . ' +1 day'));
$dateclose = date('Y-m-d', strtotime($dateclose . ' +1 day'));
}
?>
