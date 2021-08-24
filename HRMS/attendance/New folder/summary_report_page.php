<div class="row">
<div class="col-lg-12">
<div class="panel panel-default">
<div class="panel-body">
<div class="row">	
<form role="form">
<div class="col-lg-12">
<div class="col-lg-2">
<input type="date" id="datepicker" class="add-on form-control" id="from_date" name="from_date" placeholder="From Date" value="">
</div>
<div class="col-lg-2">
<input type="date" id="datepicker1" class="add-on form-control" id="to_date" name="to_date" placeholder="To Date" value="">
</div>
<div class="col-lg-1">
OR
</div>
<div class="col-lg-3">
<input type="month" id="IconDemo1" class='add-on form-control' name="month"/>
</div>
<div class="col-lg-3">
<select id="multiple-checkboxes" name="university_name[]" class="add-on form-control" required>
<option value="All">All</option>
<?php 
$attendance_query=$con->query("select * from z_department_master WHERE status=1");
while($atten_res = $attendance_query->fetch(PDO::FETCH_ASSOC))
{
?>
<option value="<?php echo $atten_res['id']; ?>"><?php echo $atten_res['dept_name']; ?></option>
<?php
}
?>
</select>
</div>
<div class="col-lg-1"><input type="button" name="attendance_report" id="attendance_report" class="btn btn-success" value="SEARCH" onClick="attendance_report_view()"></div>
</div>
</form>
</div>
</div>
</div>
</div>
</div>