<?php

require '../../../../connect.php';
require '../../../../user.php';
$earning_id = $_REQUEST['earning_id'];
$salary_amount = $_REQUEST['salary_amount'];

?>

<div class="card-body" id="earning_body">
<table class="table table-bordered table-hover">
<thead>
<tr><th>#</th><th>Name</th><th>Percentage</th><th>Amount</th></tr>
</thead>
<tbody>

<?php


$payroll_deduction_sql=$con->query("SELECT id, name, amount, percentage, status, created_by, created_on, modified_by, modified_on FROM payroll_structure where id in (SELECT salary_structure_id FROM payroll_scale_details where payroll_master_id='$earning_id')");
$i=1;
$grand_tot = 0;
while($payroll_deduction_res = $payroll_deduction_sql->fetch(PDO::FETCH_ASSOC))
{
	$percentage = $payroll_deduction_res['percentage'];

?>
<tr>
<td><?php echo $payroll_deduction_res['id'] ?></td>
<td><?php echo $payroll_deduction_res['name'] ?></td>
<td><?php echo $percentage; ?></td>
<td style="text-align:right">
<?php if($percentage > 0)
	{
		$values = ($percentage * $salary_amount/100) ;
		echo $values;
	}
	else
	{ 
	echo $values=0; 
	} 
	?></td>
	</tr>					
<?php

$grand_tot =$grand_tot+$values;
}
?>
<tr><td colspan="3">Total</td><td style="text-align:right"><?php echo $grand_tot; ?></td></tr>
</tbody>
</table>
</div>