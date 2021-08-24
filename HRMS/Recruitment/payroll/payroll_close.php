<?php
require '../../connect.php';
?>
<?php
	 $payroll_master=$con->query("select * from payroll_master where flag=2");
	 //echo "select * from payroll_master where flag=2";
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
<div class="content-wrapper" id='wage_content' style="padding-left: 50px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h2>Payroll Close For The Month Of  <?php echo $month; ?> -  <?php echo $res['year']; ?></h2>
          </div>
          <div class="col-sm-6">
		  <input class="btn btn-primary btn-sm btn-flat" style="float: center;"  type="button" name="payroll_close" id="payroll_close" onclick="payroll_close_page(<?php echo $res['id']; ?>)" value="Payroll Close">
		  <!--<a onclick="return add_employee()" style="float: right;" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus"></i> Payroll Generate</a>-->
          </div>
		 
		</div>
      </div><!-- /.container-fluid -->
	</section>
	
    <!-- Main content -->

<!-- /.content -->
</div>

<script>
	function payroll_close_page(v){	
			$.ajax({
			type: 'get',
			url: '/Recruitment/Recruitment/payroll/payroll_close_update.php',
			data: 'payroll_master_id='+v,
			success: function(data)
				{
					 alert(data)
					//$('#wage_content').html(data);
					 if(data==0)
					{
						alert("Payroll Closed Successfuly");
						payroll_close_page();
					}
					else
					{
						alert("Payroll Not Closed");
						payroll_close_page();
					} 	
						
			
			});
	}
	</script>