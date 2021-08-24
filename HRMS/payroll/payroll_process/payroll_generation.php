<?php

require '../../../connect.php';

$staff_payroll_sql=$con->query("select month,year,flag from payroll_master where flag in(1,2)");
$staff_payroll_res=$staff_payroll_sql->fetch(PDO::FETCH_ASSOC);

$month=$staff_payroll_res['month']; 
$year=$staff_payroll_res['year']; 
$flag=$staff_payroll_res['flag'];
$month1=$month;
$year1=$year;

?>
<head>
<!-- Font Awesome -->
<link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
<!-- Ionicons -->
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
<!-- DataTables -->
<link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<!-- Theme style -->
<link rel="stylesheet" href="dist/css/adminlte.min.css">
<!-- Google Font: Source Sans Pro -->
<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<style>
.p_g_btn {
	background-color: #17a2b8e8;
    border-color: #198ae3;
    height: 2.5rem;
    border-radius: 5px;
    line-height: 1;
    color: #ffffff;
    border: none;
    outline: none;
}
.t-head {
	background: #17a2b8e8;
    color: black;
    border-top-left-radius: 48px;
}
</style>


	<!-- Default box -->
	<div class="card">
	<div class="card-header">
	<h5 class="card-title" style="font-size: 19px !important;font-weight: 900 !important;">Payroll Generation</h5>
	</div>
	<div class="card-body">
	
	<table class="table table-striped" id="branchwisecollection2">
	<form method="post" action="" >
	<?php
	if($flag==1)
	{ 
		?>
		<thead>
		<tr>
		<th>Month</th>
		<input type="hidden" name="month" id="month"  value="<?php echo $month ?>">
		<input type="hidden" name="year" id="year" value="<?php echo $year ?>" >
		<th>
		<input type="hidden" name="payroll" id="payroll" value="<?php echo $year ?>" >
		<?php 
		$m1=$month;
		$mon=date('Y-'.$m1.'-d');
		echo date('F',strtotime($mon))." - ".$year; ?>
		</th>
		<th>
		<input type="button" name="payrollsubmit" class="p_g_btn" id="Gen_staff_salary" onclick="Gen_staff_salary()" value="Generate Payroll" />
		</th>
		<?php 
	}
	
	if($flag==2)
	{
	
		
		
			$sql = "select COUNT(*),id from payroll_master where month='$month1' and year='$year1' and flag='2'";
			$res = $con->query($sql);
			$count = $res->fetchColumn();
			
			
			
		if($count<>0)
		{
			
			$sth = $con->prepare("SELECT id, month, year, date, flag FROM payroll_master where month='$month1' and year='$year1' and flag='2'");
			$result = $sth->fetch(PDO::FETCH_ASSOC);
			print_r($result);
			?>
			<thead>
			<tr>
			<th>Month</th>
			<input type="hidden" name="month1" id="month1"  value="<?php echo $month1 ?>">
			<input type="hidden" name="year1" id="year1" value="<?php echo $year1 ?>" >
			<th>
			<input type="hidden" name="payroll" id="payroll" value="">
			<input type="hidden" name="payroll_id1" id="payroll_id1" value="<?PHP echo $result['id'];?>">
			<?php $m2=$month1;
											$mon1=date('Y-'.$m2.'-d');
											echo date('F',strtotime($mon1))." - ".$year1; ?>
			</th>
			<th><input type="button" name="delete_payroll" id="delete_payroll" onclick="payroll_delete()" value="Delete"/></th> 
			<?php 
		}
		else
		{
			?>
			<center><h2>You Don't Have Salary Approve Provesion</h2></center>
			<?PHP
		}
	}
?>

</form>
</thead>
</table>


<div id="salary_view"  style="font-family:'Times New Roman', Times, serif;float:left;width:100%;height:100%">
</div>
<script>

$(document).ready(function(){
	$("#loading").hide();
	$("#Gen_staff_salary").click(function(){
		$("#Gen_staff_salary").hide();
		$('#loading').show();
	});
});

function Gen_staff_salary()
{
	var month=$('#month').val();
	var year=$('#year').val();
	
	$("#salary_view").html('<br><div style="text-align: center;"><img src="/CLMSW/images/loader/loader.gif"></div>');

	 $.ajax({
			type: "GET",
			url: "/HRMS/HRMS/payroll/payroll_process/payroll_insert.php",
			data:  "month=" + month +"&year=" + year, 
			success: function(data)
			{
				if(data==1)
				{
						alert("Staff Salary Generated Successfully"); 
						$('#salary_view').hide();
				}
			}  						
										
	});	
}

function payroll_delete()
{
	var id = 1;
	var month=$('#month1').val();
	var year=$('#year1').val();
	
	$('#delete_payroll').hide();
	$("#salary_view").html('<br><div style="text-align: center;"><img src="/CLMSW/images/loader/loader.gif"></div>');
	
	$.ajax({
			type: "GET",
			url: "/HRMS/HRMS/payroll/payroll_process/payroll_approve.php",
			data:  "month=" + month +"&year=" + year +"&id=" + id, 
			success: function(data)
			{
				if(data==1)
				{
					alert("Payroll truncated Successfully"); 
					
					$('#salary_view').hide();
				}
			}  						
										
	});	
}


</script>
	
	</div>
	</div>
	<!-- /.card -->

	
<!-- ./wrapper -->
<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>

<!-- page script -->
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
