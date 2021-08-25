<?php
require('../../../connect.php');

	$memsql=$con->query("SELECT concat('VOU-',id+1) as v_code FROM voucher order by id desc limit 0,1");
	$check=mysql_num_rows($memsql);	
	if($check>0)
	{
		$mem_res=$ledger_sql->fetch(PDO::FETCH_ASSOC);
		$v_code=$mem_res['v_code'];
	}
	else
	{
		$v_code='VOU-001';
	}
	
	require('../main_process.php');
	
	$ledgers_code=$_REQUEST['ledger_code'];
	$amounts=$_REQUEST['amount'];
	
          	//cat_id=CAT-002&voucher_date=&slip_no=L002&ledger_code=A001&amount=1000
	
	$cashvouc=new voucher_process();	
	
	$cashvouc->code=$v_code;
	$cashvouc->date=date('Y-m-d',strtotime($_REQUEST['voucher_date']));
	$cashvouc->voucher_category_code=$_REQUEST['cat_id'];
	$cashvouc->voucher_purpose_code="PUR-022";
	$cashvouc->slip_no=$_REQUEST['slip_no'];
	$cashvouc->reference_no=$_REQUEST['slip_no'];
	$cashvouc->ledger_code=$ledgers_code;
	$cashvouc->amount=$amounts;
	$cashvouc->description="Adjustment Slip Against Ledger";
	$cashvouc->narration="Cash Voucher";
	$cashvouc->created_by=$user;

	
	$cashvouc->voucher_entry();
	
	$ledgers_code=array($ledgers_code);
	$ledgers_amount=array($amounts);
	$ledgers_type=array('credit');
	
	$cashvouc->voucher_details($ledgers_code,$ledgers_amount,$ledgers_type);
	


?>