<?php
require("../../configuration.php");
require("../../user.php");
$user=$_SESSION['user'];

$code=$_REQUEST['id'];
$cus=mysql_fetch_array(mysql_query("SELECT 
			l.id,l.code,l.name,
			a.type,
			b.name as plgroup,
			c.name as bsgroup 
				FROM ledger l LEFT JOIN	accounts a 
				ON a.id=l.accounts_id 
				LEFT JOIN 
				pl_group_master b ON b.id=l.pl_group_id
				LEFT JOIN
				bs_group_master c ON c.id=l.bs_group_id 
				where l.code='$code'"));
				
			$l_id=$cus['id'];
			$l_code=$cus['code'];
			$l_name=$cus['name'];
			$l_type=$cus['type'];
			$l_plgroup=$cus['plgroup'];
			$l_bsgroup=$cus['bsgroup'];
			
			echo $l_id."=".$l_code."=".$l_name."=".$l_type."=".$l_plgroup."=".$l_bsgroup;
						
						
		
?>