<?php
require("../../connect.php");
?>

	<div class="box box-success ">
	<div class="box-body no-padding">						
	<div class="col-sm-3">
	<div class="input-group"><div class="input-group-addon"><i class="fa fa-calendar"></i></div>
	<div id="datetimepicker" class="input-append date">
	<div class="input-group" style="width:100%;">
	<input type="date" class="add-on form-control" id="from_date" name="from_date" title=" Date" value="<?php echo date("d-m-Y"); ?>" />
	</div>
	<i data-time-icon="icon-time" data-date-icon="icon-calendar"></i>
	</div>
	</div>
	</div> <!-- col -sm-3-->
				
	<div class="col-sm-9">
	<div class="input-group input-group-sm">
	<div class="input-group"><div class="input-group-addon"><i class="fa fa-calendar"></i></div>
	<div id="datetimepicker1" class="input-append date">
	<div class="input-group" style="width:100%;">
	<input type="date" class="add-on form-control" id="to_date" name="to_date" title=" Date" value="<?php echo date("d-m-Y"); ?>" />
	</div>
	<i data-time-icon="icon-time" data-date-icon="icon-calendar"></i>
	</div>
	</div>
	<span class="input-group-btn">
	<button class="btn btn-info btn-flat" type="button" onClick="changeDaybook()">Go!</button>
	</span>
	</div><!-- /input-group -->
	</div><!--col-sm-9-->
					
	
					
	<div id="changeDaybook">
	</div><!-- changeDaybook-->
	</div> <!-- box-body-->
	</div><!-- box box-primary-->
	
	<script>
	$(document).ready(function()
	{
		$('#datetimepicker1').datetimepicker({
		format: "dd-MM-yyyy" 
		});		
		$('#datetimepicker').datetimepicker({
		format: "dd-MM-yyyy"
		});
	});
	
	function changeDaybook()
	{
		var from_date=$('#from_date').val();
		var to_date=$('#to_date').val();
		$.ajax({
		type: 'GET',
		url: 'Accounts/daybook_new/replaceDaybook.php',
		data: 'from_date='+from_date+'&to_date='+to_date,		
		success: function(data) {
			  $('#changeDaybook').html(data);
			  }
		});
	}
	</script>