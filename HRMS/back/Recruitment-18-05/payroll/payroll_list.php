<?php
require '../../connect.php';
?>
<?php
	 $payroll_master=$con->query("select * from payroll_master where flag=2");
	
	 $res = $payroll_master->fetch();
	if($res['month'] = "1"){
	  $month = "January";
	}elseif($res['month']= "2"){
	   $month ="February";
	}elseif($res['month']= "3"){
	  $month = "March";
	}elseif($res['month']= "4"){
	  $month ="April";
	}elseif($res['month']= "5"){
	   $month = "May";
	}elseif($res['month']= "6"){
	   $month = "June";	
	}elseif($res['month']= "7"){
	   $month = "July";
	}elseif($res['month']= "8"){
	   $month = "August";
	}elseif($res['month']= "9"){
	   $month = "September";
	}elseif($res['month']= "10"){
	   $month = "October";
	}elseif($res['month']= "11"){
	   $month ="November";
	}elseif($res['month']= "12"){
	   $month ="December";
	}
	?>	
<div class="content-wrapper" style="padding-left: 50px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h2>Payroll Generate For The Month Of <?php echo $month; ?> -  <?php echo $res['year']; ?></h2>
          </div>
          <div class="col-sm-6">
		  <input class="btn btn-primary btn-sm btn-flat" style="float: right;"  type="button" name="pay_generate" id="pay_generate" onclick="pay_generate(<?php echo $res['id']; ?>)" value="Payroll Generate">

		  <!--<a onclick="return add_employee()" style="float: right;" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus"></i> Payroll Generate</a>-->
          </div>
		  <div class="col-sm-6">
		  <button class="btn btn-primary" onclick="printDiv('tblARCNewMember')"><span class="print-icon"></span>PRINT</button>
          <button type="submit" class="btn btn-success" name="myButtonControlID" id="myButtonControlID" target="_blank" value="">EXCEL</button>	
        </div>
		</div>
      </div><!-- /.container-fluid -->
	</section>
    <!-- Main content -->
	<?php
		//echo $cont_master_sql=$con->query( "select id,month,year,date,flag from payroll_master where flag=2");
		
		//$contractor_row = mysql_query( $con, $cont_master_sql );			
		//$payroll_row=mysql_fetch_array($contractor_row, MYSQL_FETCH_ASSOC);
		
	?>	
	<div id="tblARCNewMember">
<div id="divTableDataHolder">
    <section class="content">
    <div class="container-fluid">
    <div class="row">
    <div class="col-md-12">
    <!-- Profile Image -->
    <div class="card card-primary card-outline">
    <div class="card-body box-profile">
	<h2 class="box-title">Attendance List</h2>
	<div class="box-body no-padding" id="pay_generate_view">
	<table cellpadding="0" cellspacing="0" border="0" class="sortable table table-bordered table-hover" id="sorter" style="font-size:11px;">  
	<thead>				
	<tr style="color:#0033FF">		
	<th> # </th>
	<th rowspan="1">CODE</th>
	<th rowspan="1">CNAME</th>
	<th rowspan="1">Department</th>
	<th rowspan="1">Division</th>
	<th rowspan="1">Section</th>
	
	<th rowspan="1">NO.OF DAYS</th>
	</tr>
	</thead>
	<tbody>
	<?php
		$attendance_sql=$con->query("select a.shift_date,a.emp_id,COUNT(a.emp_id) as work_Days,b.* 
		from employee_attendance a join employee_master b on (a.emp_id = b.code)
		where a.shift_date >='2021-01-01'");
	$cnt=1;
	 while($row=$attendance_sql->fetch(PDO::FETCH_ASSOC))
			  {?>
		<tr>
		<td><?php echo htmlentities($cnt);?></td>
		<td><?php echo htmlentities($row['code']);?></td>
		<td><?php echo htmlentities($row['name']);?></td>
		<td><?php echo htmlentities($row['department']);?></td>
		<td><?php echo htmlentities($row['division']);?></td>
		<td><?php echo htmlentities($row['section']);?></td>
		<td><?php echo htmlentities($row['work_Days']);?></td>
		</tr>
		<?php
		$cnt++;
	}
	?>	
	</div>
	</table>
    
<!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div><!-- /.container-fluid -->
</section>
</div>
</div>
<!-- /.content -->
</div>


<script>
function pay_generate(v){
alert(v)
//$('#pay_generate_view').html('<br><div style="text-align: center;"><img src="/CLMS/images/images/pageLoader.gif"></div>');
$.ajax({
type: 'get',
url: '/Recruitment/Recruitment/payroll/payroll_generate.php',
data: 'payroll_master_id='+v,
success: function(data)
{
$('#pay_generate_view').html(data);
}
});
}
</script>
<script>
function printDiv(tblARCNewMember) {
alert('w');
let printContents, popupWin;
printContents = document.getElementById('tblARCNewMember').innerHTML;
popupWin = window.open('', '_blank', 'top=0,left=0,height=100%,width=auto');
popupWin.document.open();
popupWin.document.write(`
<html>
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<style>
.row {
margin-bottom: 30px;
margin: 0px;
}
tr {
font-size: 14px;
height: 15px;
}
td {
padding: 0px 15px !important;
}
.h-10 {
height: 10px;
}
.t-align {
text-align: center;
}
.f-w-b {
font-weight: bold;
}
.f-s-14 {
font-size: 14px;
}
.t-decoration {
text-decoration: underline;
}
.t-align-end {
text-align: end;
}
.user-images {
width: 100px;
height: 100px;
}
.user-image {
padding: 5px 0px 3px 10px;
}
.w-10rem {
width: 30%;
}
.mr-b-n-15 {
margin-bottom: -15px;
}
</style>
<body onload="window.print();window.close()">${printContents}</body>
</html>`
);
popupWin.document.close();

}
</script>
<script>
$("[id$=myButtonControlID]").click(function(e) {
window.open('data:application/vnd.ms-excel,' + encodeURIComponent( $('div[id$=tblARCNewMember]').html()));
e.preventDefault();
});
</script>