<?php
require '../../connect.php';
include("../../user.php");
$candidateid=$_SESSION['candidateid'];
$userrole=$_SESSION['userrole'];
$id=$_REQUEST['id'];
$stmt = $con->prepare("SELECT enquiry.id as enquiry_id,enquiry.status as enquiry_status,enquiry.mail as enquiry_mailid,enquiry.*,calls_master.*,z_department_master.*,candidate_form_details.*  FROM `enquiry`
INNER JOIN calls_master ON enquiry.Call_type=calls_master.id
INNER join z_department_master ON enquiry.Department=z_department_master.id
INNER JOIN candidate_form_details ON enquiry.employee=candidate_form_details.id
where enquiry.id='$id'"); 

$stmt->execute(); 
$row = $stmt->fetch();
?>
<div class="card card-info">
<div class="card-header">  
<center><h3 class="card-title"><b>Enquiry Details </b></h3></center>
<a onclick="return back_ctc()" style="float: right;" data-toggle="modal" class="btn btn-danger"></i>Back</a>
</div>
<br>
<br>
<br>
<!-- /.card-header -->
<!-- form start -->
<form role="form" name="" action="" method="post" enctype="multipart/type">

<div class="card-body">
<div class="form-group row">
<label for="inputname" class="col-sm-2 col-form-label">Call Type</label>
<div class="col-sm-4">
<input type="hidden" class="form-control" id="get_id" name="get_id" value="<?php echo  $row['enquiry_id']; ?>">
<input type="hidden" class="form-control" id="get_emp_id" name="get_emp_id" value="<?php echo  $row['employee']; ?>">
<input type="text" class="form-control" name="name" id="name" value="<?php echo  $row['name'];?>"readonly>
</div>
</div>

<div class="form-group row">
<label for="inputdob" class="col-sm-2 col-form-label">Date</label>
<div class="col-sm-4">
<input type="text" class="form-control" name="date" id="date" value="<?php echo  $row['date'];?>"readonly>
</div>
</div>
<div class="form-group row">
<label for="inputEmail3" class="col-sm-2 col-form-label">Client Type</label>
<div class="col-sm-4">
<?php if($row['Client_type']==1){
?>
<input type="text" class="form-control" name="Client_Type" id="Client_type" value="Existing"readonly>
<?php } else {
?>
<input type="text" class="form-control" name="Client_Type" id="Client_type" value="New" readonly>
<?php
}
?>

</div>
</div>
<div class="form-group row">
<label for="inputnumber" class="col-sm-2 col-form-label">Company Name</label>
<div class="col-sm-4">
<input type="text" class="form-control" name="Company_Name" id="Company_Name" value="<?php echo  $row['Company_name'];?>"readonly>
</div>
</div>


<div class="form-group row">
<label for="inputnumber" class="col-sm-2 col-form-label">Location</label>
<div class="col-sm-4">
<input type="text" class="form-control" name="Location" id="Location" value="<?php echo  $row['Location'];?>"readonly>
</div>
</div>

<div class="form-group row">
<label for="inputnumber" class="col-sm-2 col-form-label">Address</label>
<div class="col-sm-4">
<input type="text" class="form-control" name="Address" id="Address" value="<?php echo  $row['Address'];?>"readonly>
</div>
</div>


<div class="form-group row">
<label for="inputnumber" class="col-sm-2 col-form-label">Client name</label>
<div class="col-sm-4">
<input type="text" class="form-control" name="Client_name" id="Client_name" value="<?php echo  $row['Client'];?>"readonly>
</div>
</div>

<div class="form-group row">
<label for="inputnumber" class="col-sm-2 col-form-label">Contact Number</label>
<div class="col-sm-4">
<input type="text" class="form-control" name="Contact_Number" id="Contact_Number" value="<?php echo  $row['Mobile'];?>"readonly>
</div>
</div>

<div class="form-group row">
<label for="inputnumber" class="col-sm-2 col-form-label">Designation</label>
<div class="col-sm-4">
<input type="text" class="form-control" name="Designation" id="Designation" value="<?php echo  $row['Designation'];?>"readonly>
</div>
</div>
<div class="form-group row">
<label for="inputnumber" class="col-sm-2 col-form-label">Mail_id</label>
<div class="col-sm-4">
<input type="text" class="form-control" name="Mail_id" id="Mail_id" value="<?php echo  $row['enquiry_mailid'];?>"readonly>
</div>
</div>
<div class="form-group row">
<label for="inputnumber" class="col-sm-2 col-form-label">Product/Service</label>
<div class="col-sm-4">
<input type="text" class="form-control" name="Product_Service" id="Product_Service" value="<?php echo  $row['Product'];?>"readonly>
</div>
</div>

<div class="form-group row">
<label for="inputnumber" class="col-sm-2 col-form-label">Feedback</label>
<div class="col-sm-4">
<input type="text" class="form-control" name="Feedback" id="Feedback" value="<?php echo  $row['Feedback'];?>"readonly>
</div>
</div>
<div class="form-group row">
<label for="inputnumber" class="col-sm-2 col-form-label">Followup Date</label>
<div class="col-sm-4">
<input type="text" class="form-control" name="Follup" id="Follup" value="<?php echo  $row['Follup'];?>"readonly>
</div>
</div>

<div class="form-group row">
<label for="inputnumber" class="col-sm-2 col-form-label">Assign To Company</label>
<div class="col-sm-4">


<input type="text" class="form-control" name="companys" id="companys" value="Bluebase Software services Pvt Ltd"  readonly>


</div>
</div>

<div class="form-group row">
<label for="inputnumber" class="col-sm-2 col-form-label">Department</label>
<div class="col-sm-4">
<input type="text" class="form-control" name="Department" id="Department" value="<?php echo  $row['dept_name'];?>"readonly>
</div>
</div>

<div class="form-group row">
<label for="inputnumber" class="col-sm-2 col-form-label">Employee Name</label>
<div class="col-sm-4">
<input type="text" class="form-control" name="first_name" id="first_name" value="<?php echo  $row['first_name'];?>"readonly>
</div>
</div>
<br>
<br>
<table class="table table-bordered">
<h3><center>Feedback Entry Details</center></h3>
<tbody>

<?php

$sql=$con->query("SELECT * FROM  feedback_enquiry_crm where enquiry_id='$id'");
$cnt=1;
while($rows = $sql->fetch(PDO::FETCH_ASSOC))
{
?>
<tr>
<input type="hidden" class="form-control" id="get_id" name="get_id" value="<?php echo  $rows['enquiry_id']; ?>">
<td>Feedback</td>
<td><input type="text" class="form-control" id="feedback_1" name="feedbacks[]" value="<?php echo  $rows['Feedback']; ?>" readonly></td>
<td>Feedback Date:</td><td colspan="1"><input type="text" class="form-control" id="date_1" name="dates[]" value="<?php echo  $rows['feedback_date']; ?>" readonly></td>
</tr>
<?php 
$cnt=$cnt+1;
}?>
</tbody>
</table>
<?php
$candidateid=$_SESSION['candidateid'];
$userrole=$_SESSION['userrole'];
if($userrole=='R002' || $userrole=='R001' || $userrole=='R016'){

?>
<table class="table table-bordered">


<center><h2 class="card-title"><b>Cost sheet Entry Details </b></h2></center>

<tbody>

<?php

$sql_1=$con->query("SELECT * FROM  cost_sheet_entry where enquiry_id='$id'");


$cnt=1;
while($rows_1 = $sql_1->fetch(PDO::FETCH_ASSOC))

{
?>
<?php if( $rows_1['Phases']==1){
?>
<tr>
<input type="hidden" class="form-control" id="get_id" name="get_id" value="<?php echo  $rows_1['enquiry_id']; ?>">
<td>Phases</td>
<td><input type="text" class="form-control" id="phase" name="phase" value="<?php echo  $rows_1['Phases']; ?>" readonly></td>
<td>Task</td><td colspan="1"><input type="text" class="form-control" id="Task" name="Task" value="<?php echo  $rows_1['Specification']; ?>" readonly></td>
<td>unit</td><td colspan="1"><input type="text" class="form-control" id="unit" name="unit" value="<?php echo  $rows_1['Hours/Days']; ?>" readonly></td>
<td>Amount</td><td colspan="1"><input type="text" class="form-control" id="amt" name="amt" value="<?php echo  $rows_1['Amount']; ?>" readonly></td>

</tr>
<?php } ?>
<?php 
$cnt=$cnt+1;
}?>
</tbody>
</table>
<!--<label for="inputnumber" class="col-sm-8 col-form-label"></label>
<div class="col-sm-4">
<h4>Total</h4>
<input type="text" class="form-control" name="priceTotal" id="priceTotal1">
</div>-->
<br>
<br>
<table class="table table-bordered">



<tbody>

<?php

$sql_1=$con->query("SELECT * FROM  cost_sheet_entry where enquiry_id='$id'");


$cnt=1;
while($rows_1 = $sql_1->fetch(PDO::FETCH_ASSOC))

{
?>
<?php if( $rows_1['Phases']==2){
?>
<tr>
<input type="hidden" class="form-control" id="get_id" name="get_id" value="<?php echo  $rows_1['enquiry_id']; ?>">
<td>Phases</td>
<td><input type="text" class="form-control" id="phase" name="phase" value="<?php echo  $rows_1['Phases']; ?>" readonly></td>
<td>Task</td><td colspan="1"><input type="text" class="form-control" id="Task" name="Task" value="<?php echo  $rows_1['Specification']; ?>" readonly></td>
<td>unit</td><td colspan="1"><input type="text" class="form-control" id="unit" name="unit" value="<?php echo  $rows_1['Hours/Days']; ?>" readonly></td>
<td>Amount</td><td colspan="1"><input type="text" class="form-control" id="amt" name="amt" value="<?php echo  $rows_1['Amount']; ?>" readonly></td>
</tr>
<?php } ?>
<?php 
$cnt=$cnt+1;
}?>
</tbody>

</table>
<table class="table table-bordered">



<tbody>

<?php

$sql_1=$con->query("SELECT * FROM  cost_sheet_entry where enquiry_id='$id'");


$cnt=1;
while($rows_1 = $sql_1->fetch(PDO::FETCH_ASSOC))

{
?>
<?php if( $rows_1['Phases']==3){
?>
<tr>
<input type="hidden" class="form-control" id="get_id" name="get_id" value="<?php echo  $rows_1['enquiry_id']; ?>">
<td>Phases</td>
<td><input type="text" class="form-control" id="phase" name="phase" value="<?php echo  $rows_1['Phases']; ?>" readonly></td>
<td>Task</td><td colspan="1"><input type="text" class="form-control" id="Task" name="Task" value="<?php echo  $rows_1['Specification']; ?>" readonly></td>
<td>unit</td><td colspan="1"><input type="text" class="form-control" id="unit" name="unit" value="<?php echo  $rows_1['Hours/Days']; ?>" readonly></td>
<td>Amount</td><td colspan="1"><input type="text" class="form-control" id="amt" name="amt" value="<?php echo  $rows_1['Amount']; ?>" readonly></td>
</tr>
<?php } ?>
<?php 
$cnt=$cnt+1;
}?>
</tbody>

</table>
<table class="table table-bordered">



<tbody>

<?php

$sql_1=$con->query("SELECT * FROM  cost_sheet_entry where enquiry_id='$id'");


$cnt=1;
while($rows_1 = $sql_1->fetch(PDO::FETCH_ASSOC))

{
?>
<?php if( $rows_1['Phases']==4){
?>
<tr>
<input type="hidden" class="form-control" id="get_id" name="get_id" value="<?php echo  $rows_1['enquiry_id']; ?>">
<td>Phases</td>
<td><input type="text" class="form-control" id="phase" name="phase" value="<?php echo  $rows_1['Phases']; ?>" readonly></td>
<td>Task</td><td colspan="1"><input type="text" class="form-control" id="Task" name="Task" value="<?php echo  $rows_1['Specification']; ?>" readonly></td>
<td>unit</td><td colspan="1"><input type="text" class="form-control" id="unit" name="unit" value="<?php echo  $rows_1['Hours/Days']; ?>" readonly></td>
<td>Amount</td><td colspan="1"><input type="text" class="form-control" id="amt" name="amt" value="<?php echo  $rows_1['Amount']; ?>" readonly></td>
</tr>
<?php } ?>
<?php 
$cnt=$cnt+1;
}?>
</tbody>

</table>
<table class="table table-bordered">



<tbody>

<?php

$sql_1=$con->query("SELECT * FROM  cost_sheet_entry where enquiry_id='$id'");


$cnt=1;
while($rows_1 = $sql_1->fetch(PDO::FETCH_ASSOC))

{
?>
<?php if( $rows_1['Phases']==5){
?>
<tr>
<input type="hidden" class="form-control" id="get_id" name="get_id" value="<?php echo  $rows_1['enquiry_id']; ?>">
<td>Phases</td>
<td><input type="text" class="form-control" id="phase" name="phase" value="<?php echo  $rows_1['Phases']; ?>" readonly></td>
<td>Task</td><td colspan="1"><input type="text" class="form-control" id="Task" name="Task" value="<?php echo  $rows_1['Specification']; ?>" readonly></td>
<td>unit</td><td colspan="1"><input type="text" class="form-control" id="unit" name="unit" value="<?php echo  $rows_1['Hours/Days']; ?>" readonly></td>
<td>Amount</td><td colspan="1"><input type="text" class="form-control" id="amt" name="amt" value="<?php echo  $rows_1['Amount']; ?>" readonly></td>
</tr>
<?php } ?>
<?php 
$cnt=$cnt+1;
}?>
</tbody>

</table>
<?php 
}
?>

<?php if($row['enquiry_status']==3){
?>
<input type="button" class="btn btn-success" id="gopinath" name="gopinath" onclick="gopi()" value="Add">
<div id="gopi">
<TABLE id="new_tab1" width="350px" border="1" style="border-collapse:collapse;" class="table table-bordered table1">
<TR><h3>Commercials</h3>


<TH>
<INPUT type="checkbox" name="select-all" id="select-all" onclick="toggle(this);">
</TH> 
<th>Phases</th>
<th>Specification</th>


<th>Man Hours/Days</th>
<TH>Amount</TH>

<TH>ACTION</TH>
</TR>
<TR>
<TD>
<INPUT type="checkbox" name="chk[]">
</TD>
<TD>
<select id="phase1" name="phase[]" class="form-control">
<option value="0">Select Phase</option>
<option value="1">Phase 1</option>
<option value="2">Phase 2</option>
<option value="3">Phase 3</option>
<option value="4">Phase 4</option>
<option value="5">Phase 5</option>
</Select>
</TD>
<TD>
<INPUT type="text" id="item_1" name="item[]" class="form-control"> </TD>



<TD>
<INPUT type="text" id="cost_1" name="cost[]"  class="form-control"> </TD>
<TD>
<INPUT type="text" id="price_1" name="price[]" onchange="total_amount(1)" class="form-control price"> </TD>

<td><input type="button" class="btn btn-success" id="new_row" name="new_row" onclick="check(1)" value="Add">
<input type="button" class="btn btn-danger" id="enquiry_row_remove"  value="Remove">

<label for="inputnumber" class="col-sm-2 col-form-label"><h4><b>Total</b></h4></label>
<div class="col-sm-2">
<input type="text" class="form-control" name="priceTotal" id="priceTotal1" >


</div>

</td>
</TR>
</TABLE>	 
</div>
<?php }
?>
<br>
<br>

</div>
<?php if($row['enquiry_status']==3){

?>
<input type="button" class="btn btn-success" id="save" name="save" onclick="cost_update()" value="Save">
<br>
<br>

<input type="button" class="btn btn-primary" id="save" name="save" onclick="cost_approval()" value="Generate For Cost Approval">
<?php
}
?>

<?php if($row['enquiry_status']==4 && $userrole=='R001' || $userrole=='R002'){

?>
<center>
<?php if($row['enquiry_status']==4){

?>
<input type="button" class="btn btn-success btn-lg"" id="save" name="save" onclick="approved()" value="Approve">

<input type="button" class="btn btn-danger btn-lg"" id="save" name="save" onclick="rejected()" value="Rejected">
<?php
}?>
</center>
<br>
<br>
<?php
}
?>
<?php if($row['enquiry_status']==5){

?>

<center>
<input type="button" class="btn btn-primary" id="save" name="save" onclick="generate_quotation()" value="Generate For Quotation">
</center>
<?php
}
?>
<br>
<br>
</form>



</div>

<script>




function cost_update()
{
var id=$('#get_id').val();
//alert(id);
var data = $('form').serialize();

$.ajax({
type:'GET',
data:"id="+id, data,

url:'HRMS/CRM/cost_update.php',
success:function(data)
{
if(data==1)
{ 
alert('Not');
}
else
{
alert("Update Successfully");
cost()
}
}           
});
}
function generate_quotation()
{
var id=$('#get_id').val();
alert(id);
var data = $('form').serialize();
$.ajax({
type:'GET',
data:"id="+id,data,

url:'HRMS/CRM/generate_quotation.php',
success:function(data)
{
if(data==1)
{ 
alert('Not');
}
else
{
alert("Update Successfully");
Quotation()
}
}           
});
}
function cost_approval()
{
var id=$('#get_id').val();
alert(id);
var data = $('form').serialize();
$.ajax({
type:'GET',
data:"id="+id,data,

url:'HRMS/CRM/generate_approval.php',
success:function(data)
{
if(data==1)
{ 
alert('Not');
}
else
{
alert("Update Successfully");
cost()
}
}           
});
}
function approved()
{
var id=$('#get_id').val();
alert(id);
var data = $('form').serialize();
$.ajax({
type:'GET',
data:"id="+id,data,

url:'HRMS/CRM/approval.php',
success:function(data)
{
if(data==1)
{ 
alert('Not');
}
else
{
alert("Approved Successfully");
cost()
}
}           
});
}
function rejected()
{
var id=$('#get_id').val();
alert(id);
var data = $('form').serialize();
$.ajax({
type:'GET',
data:"id="+id,data,

url:'HRMS/CRM/rejected.php',
success:function(data)
{
if(data==1)
{ 
alert('Not');
}
else
{
alert("Approved Successfully");
cost()
}
}           
});
}
function check(newTabName) // education
{
var len = $('#new_tab' + newTabName + ' tr ').length;	

$('#new_tab'+ newTabName).append('<tr class="row_'+len+'"><td><input type="checkbox" class="chk" name="chk[]" id="chk_'+len+'" value="'+len+'"</td><td><select class="form-control" id="phase_'+len+'" name="phase[]"><option value="0">Select Phase</option><option value="1">Phase 1</option><option value="2">Phase 2</option><option value="3">Phase 3</option>	<option value="4">Phase 4</option><option value="5">Phase 5</option>	</Select></td><td><input type="text" class="form-control" id="item_'+len+'" name="item[]"></td><td><input type="text" class="form-control" id="cost_'+len+'" name="cost[]"></td><td><input type="text" class="form-control price" id="price_'+len+'" name="price[]" onchange="total_amount('+newTabName+')"></td></tr>'); 
len=len+1;  
}

$('#enquiry_row_remove').click(function(){
$('input:checkbox:checked.chk').map(function(){
var id=$(this).val();
var le=$('#new_tab tr').length;

if(le==1)
{
alert("You Can't Delete All the Rows");
}
else
{
$('.row_'+id).remove();
}

});
});


function total_amount(newTabName){
var len = $("#new_tab" + newTabName + " .price").length;
//console.log(len);
var amount = 0;
for(i = 1; i <= len; i++){	
amount += Number($("#new_tab" + newTabName + " #price_" + i).val());
//console.log("Number : " + $("#new_tab" + newTabName + " #price_" + i).val());
}

document.getElementById("priceTotal" + newTabName).value = amount;
}

var newTabLen = 1;
function gopi(){
var len = $('#gopi tr').length;

newTabLen += 1;

$('#gopi').append('<TABLE id="new_tab' + newTabLen + '" width="350px" border="1" style="border-collapse:collapse;" class="table table-bordered ' + "table" + newTabLen + '" ><tr><h3>Commercials</h3><th><INPUT type="checkbox" name="select-all" id="select-all" onclick="toggle(this);"></th><th>Phases</th> <th>Specification</th><th>Man Hours/Days</th><th>Amount</th> <th>ACTION</th></tr><tr class="row_'+len+'"><td><input type="checkbox" class="chk" name="chk[]" id="chk_'+len+'" value="'+len+'"</td><td><select class="form-control" id="phase_'+len+'" name="phase[]"><option value="0">Select Phase</option><option value="1">Phase 1</option><option value="2">Phase 2</option><option value="3">Phase 3</option>	<option value="4">Phase 4</option><option value="5">Phase 5</option>	</Select></td><td><input type="text" class="form-control" id="item_'+len+'" name="item[]"></td><td><input type="text" class="form-control" id="cost_'+len+'" name="cost[]"></td><td><input type="text" class="form-control price" id="price_1" name="price[]" onchange="total_amount(' + newTabLen + ')"></td><td><input type="button" class="btn btn-success" id="new_row" name="new_row" onclick="check(' + newTabLen + ')" value="Add"><input type="button" class="btn btn-danger" id="enquiry_row_remove"  value="Remove"> <label for="inputnumber" class="col-sm-2 col-form-label"><h4><b>Total</b></h4></label> <div class="col-sm-2"> <input type="text" class="form-control" name="priceTotal' + newTabLen + '" id="priceTotal' + newTabLen + '" ></div></td></tr></TABLE>'); 

len = len + 1;
}
</script>
