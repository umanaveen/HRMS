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
<div class="wrapper">
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
	<section class="content">

	<!-- Default box -->
	<div class="card">
	<div class="card-header">
	<h5 class="card-title">Payroll Generation</h5>
	</div>
	<div class="card-body">
	
	<table class="table table-striped" id="branchwisecollection2" style="height:1000px;color: black;" style="width: 1000;">
	<form method="post" action="" style="height:100px;">
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
	
		$payroll=mysql_query("select month,year,id from staff_payroll where month='$month1' and year='$year1' and flag='2'");
		$count=mysql_num_rows($payroll);
		$payroll_id=mysql_fetch_array($payroll);
		if($count<>0)
		{
		?>
		<caption>
		<center style="width: 1100;">	<B>PAYROLL APPROVE</B>
		</center>
		</caption>
		<thead>
		<tr>
		<th>Month</th>
		<input type="hidden" name="month1" id="month1"  value="<?php echo $month1 ?>">
		<input type="hidden" name="year1" id="year1" value="<?php echo $year1 ?>" >
		<th>
		<input type="hidden" name="payroll" id="payroll" value="">
		<input type="hidden" name="payroll_id1" id="payroll_id1" value="<?PHP echo $payroll_id['id'];?>">
		<?php $m2=$month1;
										$mon1=date('Y-'.$m2.'-d');
										echo date('F',strtotime($mon1))." - ".$year1; ?>
		</th>
		<th>
		<div class="col-sm-3">
		<div class="input-group">
		<div class="input-group-addon"><i class="fa fa-calendar"></i></div>
		<div id="datepicker" class="input-append date">
		<div class="input-group" style="width:500%;">
		<input type="text" class="add-on form-control" id="date123" name="date123" title="Date" value="" />
		</div>
		<i data-time-icon="icon-time" data-date-icon="icon-calendar"></i>
		</div>
		</div>
		</div>
		</th>

		<th><input type="button" name="approve" id="approve" onclick="approve()" value="Approved"/></th> 
		<?php 
		}
		else
		{
		?><center><h2>You Don't Have Salary Approve Provesion</h2></center>
		<?PHP
		}
	}
?>
</tr>
</form>
</thead>
</table>


<div id="loading">
Please Wait it will Loading...
</div>


<div id="salary_view"  style="font-family:'Times New Roman', Times, serif;float:left;width:100%;height:100%">
<!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header" style="color : black">
                <h3 class="card-title">Salary View</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped" style="color : black">
                  <thead class="t-head">
                  <tr>
                    <th>#</th>
                    <th>Dep</th>
                    <th>Division</th>
                    <th>E CODE</th>
                    <th>E Name</th>
                    <th>Earnings</th>
                    <th>Deduction</th>
                    <th>Gross Salary</th>
                    <th>Net Salary</th>
                  </tr>
                  </thead>
                  <tbody>
                  <tr>
                    <td>Trident</td>
                    <td>Internet
                      Explorer 4.0
                    </td>
                    <td>Win 95+</td>
                    <td> 4</td>
                    <td>X</td>
                  </tr>
                  <tr>
                    <td>Trident</td>
                    <td>Internet
                      Explorer 5.0
                    </td>
                    <td>Win 95+</td>
                    <td>5</td>
                    <td>C</td>
                  </tr>
                  <tr>
                    <td>Misc</td>
                    <td>PSP browser</td>
                    <td>PSP</td>
                    <td>-</td>
                    <td>C</td>
                  </tr>
                  <tr>
                    <td>Other browsers</td>
                    <td>All others</td>
                    <td>-</td>
                    <td>-</td>
                    <td>U</td>
                  </tr>
                  </tbody>
                  <tfoot>
				<tr>
				<th>#</th>
				<th>Dep</th>
				<th>Division</th>
				<th>E CODE</th>
				<th>E Name</th>
				<th>Earnings</th>
				<th>Deduction</th>
				<th>Gross Salary</th>
				<th>Net Salary</th>
				</tr>
                </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->

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
		
	 $.ajax({
			type: "GET",
			url: "Recruitment/payroll/payroll_process/payroll_insert.php",
			data:  "month=" + month +"&year=" + year, 
			success: function(data){
			if(data==1)
			{
					alert("Staff Salary Generated Successfully"); 
					$('#loading').hide();
					$("#salary_view").show();	
			}
			else
			{
				alert("Generated ");
				$('#loading').hide();
				$("#salary_view").show();	
			}
			}  						
										
	});	
}
function approve()
{
	var month=$('#month1').val();
	var year=$('#year1').val();
	var date=$('#date123').val();
	var payroll_id=$('#payroll_id1').val();
	if(date=="")
	{
		alert("Please Select the Date");
	}
	else
	{
		$("#approve").hide();
		$('#loading').show();
		$.ajax({ 
			type: "GET",
			url: "/UCO/payroll/pay_approve.php",
			data:  "month=" + month +"&year=" + year +"&date=" + date+"&payroll_id="+payroll_id, 
			success: function(data)
			{
				if(data==1)
				{
					alert("Salary Approved Successfully");
					$("#salary_view").html(data);
					window.location="index.php";
					$('#loading').hide();
				}
				else
				{
					
					alert("Not Successfully Approved");
					$("#salary_view").html(data);
					$('#loading').hide();
				}
				
			}  						

		});
	}
}
</script>
	
	</div>
	<!-- /.card-body -->
	<div class="card-footer">
	</div>
	<!-- /.card-footer-->
	</div>
	<!-- /.card -->

	</section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  </div>
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
