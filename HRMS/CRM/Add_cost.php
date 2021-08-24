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

<!-- /.card-header -->
<!-- form start -->
<form role="form" name="" action="" method="post" enctype="multipart/type">

<div class="card-body">
<input type="hidden" class="form-control" id="get_id" name="get_id" value="<?php echo  $row['enquiry_id']; ?>">
<input type="hidden" class="form-control" id="get_emp_id" name="get_emp_id" value="<?php echo  $row['employee']; ?>">
<?php if($row['flag']==2){
?>
<?php 
$stmt1 = $con->prepare("SELECT * FROM `quotation`
where quotation.Enquire_id='$id'"); 

$stmt1->execute(); 
$row_stmt1 = $stmt1->fetch();
?>
<table class="table table-bordered">

<tr>
<td>Proposal For</td>
<td colspan="2"><input type="text" class="form-control" placeholder="Proposal For" id="proposal_for" name="proposal" id="Client"  value="<?php echo  $row_stmt1['proposal']; ?>" readonly></td>
<td>Client</td>
<td colspan="2"><input type="text" class="form-control" placeholder="Client" id="Client" name="Client" id="Client" value="<?php echo  $row['Company_name'];?>" readonly></td>
</tr>

<tr>
<td>Proposal Date</td>
<td colspan="2"><input type="text" class="form-control" placeholder="Proposal Date" id="date" name="date" value="<?php echo  $row_stmt1['Date'];?>" readonly></td>
<td>Version</td>
<td colspan="2"><input type="text" class="form-control" placeholder="Version" id="Version" name="Version" id="Version" value="<?php echo  $row_stmt1['Version'];?>" readonly></td>
</tr>


<tr>
<td>Employee Name</td>
<td colspan="2">

<input type="text" class="form-control" name="first_name" id="first_name" value="<?php echo  $row['first_name'];?>"readonly>
</td>
<td>Emp Email_ID</td>
<td colspan="2"><input type="text" id="email_id" name="email_id" class="form-control" style ="border:none;" value="<?php echo  $row_stmt1['email_id'];?>"readonly></td>
</tr>


<tr>
<td>Emp Tele_no</td>
<td colspan="2">
<input type="hidden" id="id" name="id" class="form-control" value="<?php echo $id;?>">
<input type="text" id="tel_no" name="tel_no" class="form-control" style ="border:none;" value="<?php echo  $row_stmt1['tel_no'];?>"readonly></td>
</tr>


<tr>
<td>Scope Statement</td>
<td colspan="2">
<input type="text"  class="form-control" style ="border:none;width:710px;height:100px" value="<?php echo  $row_stmt1['scope'];?>"readonly></td>

</tr>

<tr>
<td>Proposal - Bluebase Software Services Private Limited </td>
<td colspan="5">
<input type="text"  class="form-control" style ="border:none;width:710px;height:100px" value="<?php echo  $row_stmt1['Proposal_statement'];?>"readonly>
</td>
</tr>




<tr>
<td>Terms & Conditions </td>
<td colspan="5">
<input type="text"  class="form-control" style ="border:none;width:710px;height:100px" value="<?php echo  $row_stmt1['Conditions'];?>"readonly>

</td>
</tr>
<br>
<br>

</table>
<?php }
?>

<?php if($row['flag']==1){
?>
<table class="table table-bordered">

<tr>
<td>Proposal For</td>
<td colspan="5"><input type="text" class="form-control" placeholder="Proposal For" id="proposal_for" name="proposal" id="Client"></td>
</tr>
<tr>
<td>Client</td>
<td colspan="5"><input type="text" class="form-control" placeholder="Client" id="Client" name="Client" id="Client" value="<?php echo  $row['Company_name'];?>" readonly></td>
</tr>
<tr>
<td>Proposal Date</td>
<td colspan="5"><input type="date" class="form-control" placeholder="Proposal Date" id="date" name="date"></td>
</tr>
<tr>
<td>Version</td>
<td colspan="5"><input type="text" class="form-control" placeholder="Version" id="Version" name="Version" id="Version"></td>
</tr>

<tr>
<td>Employee Name</td>
<td colspan="5"> <select id="emp_id" name="emp_id" class="form-control">
<option> --- Select Employee Name ---</option>
<?php $query = $con->query("SELECT * FROM staff_master");
while ($row_fetch = $query->fetch()) {?>
<option value="<?php echo $row_fetch['id']; ?>"><?php echo $row_fetch['emp_name']; ?> </option>
<?php } ?>
</select></td>
</tr>
<tr>
<td>Emp Email_ID</td>
<td colspan="5"><input type="text" id="email_id" name="email_id" class="form-control" style ="border:none;" readonly></td>
</tr>

<tr>
<td>Emp Tele_no</td>
<td colspan="5">
<input type="hidden" id="id" name="id" class="form-control" value="<?php echo $id;?>">
<input type="text" id="tel_no" name="tel_no" class="form-control" style ="border:none;" readonly></td>
</tr>


<tr>
<td>Scope Statement</td>
<td colspan="5">

<textarea id="scope" name="scope" class="form-control" style="height:600px">
</textarea></td>
</tr>
<tr>
<td>Proposal - Bluebase Software Services Private Limited </td>
<td colspan="5">

<textarea id="Proposal" name="Proposal_statement" class="form-control" style="height:300px">

</textarea></td>
</tr>




<tr>
<td>Terms & Conditions</td>
<td colspan="5">

<textarea id="Conditions" name="Conditions" class="form-control" style="height:300px">

</textarea></td>
</tr>
<br>
<br>

</table>
<?php }
?>
<?php
$candidateid=$_SESSION['candidateid'];
$userrole=$_SESSION['userrole'];
if($userrole=='R002' || $userrole=='R001' || $userrole=='R016'){

?>

<br>
<br>
<?php
$ph1=$con->query("SELECT * FROM `cost_sheet_entry` INNER JOIN cost_totl ON cost_sheet_entry.enquiry_id = cost_totl.enquiries_id WHERE cost_sheet_entry.enquiry_id='$id' AND cost_sheet_entry.Phases='1' AND cost_totl.Phases='1'");
$ph1->execute(); 
$row_ph1 = $ph1->fetch();
?>
<?php if( $row_ph1['Phases']==1){
?>
<table class="table table-bordered">


<center><h2><b>Cost sheet Entry Details </b></h2></center>

<td><b>Phases</b></td>
<td>Specification</b></td>
<td><b>Man/hours/days<b></td>
<td><b>Amount<b></td>

<tbody>

<?php


$sql_1=$con->query("SELECT * FROM `cost_sheet_entry` INNER JOIN cost_totl ON cost_sheet_entry.enquiry_id = cost_totl.enquiries_id WHERE cost_sheet_entry.enquiry_id='$id' AND cost_sheet_entry.Phases='1' AND cost_totl.Phases='1'");


$cnt=1;
while($rows_1 = $sql_1->fetch(PDO::FETCH_ASSOC))

{
?>
<?php if( $rows_1['Phases']==1){
?>
<tr>
<input type="hidden" class="form-control" id="get_id" name="get_id" value="<?php echo  $rows_1['enquiry_id']; ?>">

<td><input type="text" class="form-control" id="phase" name="phase" value="<?php echo  $rows_1['Phases']; ?>" readonly></td>
<td colspan="1"><input type="text" class="form-control" id="Task" name="Task" value="<?php echo  $rows_1['Specification']; ?>" readonly></td>
<td colspan="1"><input type="text" class="form-control" id="unit" name="unit" value="<?php echo  $rows_1['day']; ?>" readonly></td>
<td colspan="1"><input type="text" class="form-control" id="amt" name="amt" value="<?php echo  $rows_1['Amount']; ?>" readonly></td>
</tr>
<?php } ?>
<?php 
$cnt=$cnt+1;
}?>
<?php 
$sqlquery_1=$con->query("SELECT * FROM `cost_sheet_entry` INNER JOIN cost_totl ON cost_sheet_entry.enquiry_id = cost_totl.enquiries_id WHERE cost_sheet_entry.enquiry_id='$id' AND cost_sheet_entry.Phases='1' AND cost_totl.Phases='1'");

$sqlquery_1->execute(); 
$sqlquery_1row = $sqlquery_1->fetch();
?>
<?php if( $sqlquery_1row['Phases']==1){
?>
<tr>


<td colspan="3"><center>Total</center></td><td colspan="1"><input type="text" class="form-control" id="total" name="total" value="<?php echo  $sqlquery_1row['total']; ?>" readonly></td>
</tr>
<tr>

<td colspan="3"><center>GST</center></td><td colspan="1"><input type="text" class="form-control" id="GST" name="GST" value="18%" readonly></td>
</tr>
<?php 
$gst=$sqlquery_1row['total']*18/100;
$grant_total=$gst+$sqlquery_1row['total'];
?>
<tr>

<td colspan="3"><center>Grand Total</center></td><td colspan="1"><input type="text" class="form-control" id="total" name="total" value="<?php echo  $grant_total; ?>" readonly></td>
</tr>
<?php } ?>
</tbody>
</table>
<?php } 
?>
<br>
<br>
<?php
$ph1=$con->query("SELECT * FROM `cost_sheet_entry` INNER JOIN cost_totl ON cost_sheet_entry.enquiry_id = cost_totl.enquiries_id WHERE cost_sheet_entry.enquiry_id='$id' AND cost_sheet_entry.Phases='2' AND cost_totl.Phases='2'");
$ph1->execute(); 
$row_ph1 = $ph1->fetch();
?>
<?php if( $row_ph1['Phases']==2){
?>

<table class="table table-bordered">


<td><b>Phases</b></td>
<td>Specification</b></td>
<td><b>Man/hours/days<b></td>
<td><b>Amount<b></td>


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

<td><input type="text" class="form-control" id="phase" name="phase" value="<?php echo  $rows_1['Phases']; ?>" readonly></td>
<td colspan="1"><input type="text" class="form-control" id="Task" name="Task" value="<?php echo  $rows_1['Specification']; ?>" readonly></td>
<td colspan="1"><input type="text" class="form-control" id="unit" name="unit" value="<?php echo  $rows_1['day']; ?>" readonly></td>
<td colspan="1"><input type="text" class="form-control" id="amt" name="amt" value="<?php echo  $rows_1['Amount']; ?>" readonly></td>
</tr>
<?php } ?>
<?php 
$cnt=$cnt+1;
}?>
<?php 
$sqlquery_1=$con->query("SELECT * FROM `cost_sheet_entry` INNER JOIN cost_totl ON cost_sheet_entry.enquiry_id = cost_totl.enquiries_id WHERE cost_sheet_entry.enquiry_id='$id' AND cost_sheet_entry.Phases='2' AND cost_totl.Phases='2'");

$sqlquery_1->execute(); 
$sqlquery_1row = $sqlquery_1->fetch();
?>
<?php if( $sqlquery_1row['Phases']==2){
?>
<tr>

<td colspan="3"><center>Total</center></td><td colspan="1"><input type="text" class="form-control" id="total" name="total" value="<?php echo  $sqlquery_1row['total']; ?>" readonly></td>
</tr>
<tr>

<td colspan="3"><center>GST</center></td><td colspan="1"><input type="text" class="form-control" id="GST" name="GST" value="18%" readonly></td>
</tr>
<?php 
$gst=$sqlquery_1row['total']*18/100;
$grant_total=$gst+$sqlquery_1row['total'];
?>
<tr>

<td colspan="3"><center>Grand Total</center></td><td colspan="8"><input type="text" class="form-control" id="total" name="total" value="<?php echo  $grant_total; ?>" readonly></td>
</tr>
<?php } ?>
</tbody>

</table>
<?php } ?>
<br>
<br>
<?php
$ph1=$con->query("SELECT * FROM `cost_sheet_entry` INNER JOIN cost_totl ON cost_sheet_entry.enquiry_id = cost_totl.enquiries_id WHERE cost_sheet_entry.enquiry_id='$id' AND cost_sheet_entry.Phases='3' AND cost_totl.Phases='3'");
$ph1->execute(); 
$row_ph1 = $ph1->fetch();
?>
<?php if( $row_ph1['Phases']==3){
?>
<table class="table table-bordered">


<td><b>Phases</b></td>
<td>Specification</b></td>
<td><b>Man/hours/days<b></td>
<td><b>Amount<b></td>

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

<td><input type="text" class="form-control" id="phase" name="phase" value="<?php echo  $rows_1['Phases']; ?>" readonly></td>
<td colspan="1"><input type="text" class="form-control" id="Task" name="Task" value="<?php echo  $rows_1['Specification']; ?>" readonly></td>
<td colspan="1"><input type="text" class="form-control" id="unit" name="unit" value="<?php echo  $rows_1['day']; ?>" readonly></td>
<td colspan="1"><input type="text" class="form-control" id="amt" name="amt" value="<?php echo  $rows_1['Amount']; ?>" readonly></td>
</tr>
<?php } ?>
<?php 
$cnt=$cnt+1;
}?>
<?php 
$sqlquery_1=$con->query("SELECT * FROM `cost_sheet_entry` INNER JOIN cost_totl ON cost_sheet_entry.enquiry_id = cost_totl.enquiries_id WHERE cost_sheet_entry.enquiry_id='$id' AND cost_sheet_entry.Phases='3' AND cost_totl.Phases='3'");

$sqlquery_1->execute(); 
$sqlquery_1row = $sqlquery_1->fetch();
?>
<?php if( $sqlquery_1row['Phases']==3){
?>
<tr>

<td colspan="3"><center>Total</center></td><td colspan="1"><input type="text" class="form-control" id="total" name="total" value="<?php echo  $sqlquery_1row['total']; ?>" readonly></td>
</tr>
<tr>

<td colspan="3"><center>GST</center></td><td colspan="1"><input type="text" class="form-control" id="GST" name="GST" value="18%" readonly></td>
</tr>
<?php 
$gst=$sqlquery_1row['total']*18/100;
$grant_total=$gst+$sqlquery_1row['total'];
?>
<tr>

<td colspan="3"><center>Grand Total</center></td><td colspan="1"><input type="text" class="form-control" id="total" name="total" value="<?php echo  $grant_total; ?>" readonly></td>
</tr>
<?php } ?>
</tbody>

</table>
<br>
<br>
<?php } ?>

<?php
$ph1=$con->query("SELECT * FROM `cost_sheet_entry` INNER JOIN cost_totl ON cost_sheet_entry.enquiry_id = cost_totl.enquiries_id WHERE cost_sheet_entry.enquiry_id='$id' AND cost_sheet_entry.Phases='4' AND cost_totl.Phases='4'");
$ph1->execute(); 
$row_ph1 = $ph1->fetch();
?>
<?php if( $row_ph1['Phases']==4){
?>
<table class="table table-bordered">

<td><b>Phases</b></td>
<td>Specification</b></td>
<td><b>Man/hours/days<b></td>
<td><b>Amount<b></td>

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

<td><input type="text" class="form-control" id="phase" name="phase" value="<?php echo  $rows_1['Phases']; ?>" readonly></td>
<td colspan="1"><input type="text" class="form-control" id="Task" name="Task" value="<?php echo  $rows_1['Specification']; ?>" readonly></td>
<td colspan="1"><input type="text" class="form-control" id="unit" name="unit" value="<?php echo  $rows_1['day']; ?>" readonly></td>
<td colspan="1"><input type="text" class="form-control" id="amt" name="amt" value="<?php echo  $rows_1['Amount']; ?>" readonly></td>
</tr>
<?php } ?>
<?php 
$cnt=$cnt+1;
}?>
<?php 
$sqlquery_1=$con->query("SELECT * FROM `cost_sheet_entry` INNER JOIN cost_totl ON cost_sheet_entry.enquiry_id = cost_totl.enquiries_id WHERE cost_sheet_entry.enquiry_id='$id' AND cost_sheet_entry.Phases='4' AND cost_totl.Phases='4'");

$sqlquery_1->execute(); 
$sqlquery_1row = $sqlquery_1->fetch();
?>
<?php if( $sqlquery_1row['Phases']==4){
?>
<tr>
<td colspan="3"><center>Total</center></td><td colspan="1"><input type="text" class="form-control" id="total" name="total" value="<?php echo  $sqlquery_1row['total']; ?>" readonly></td>
</tr>
<tr>
<td colspan="3"><center>GST</center></td><td colspan="1"><input type="text" class="form-control" id="GST" name="GST" value="18%" readonly></td>
</tr>
<?php 
$gst=$sqlquery_1row['total']*18/100;
$grant_total=$gst+$sqlquery_1row['total'];
?>
<td colspan="3"><center>Total</center></td><td colspan="1"><input type="text" class="form-control" id="total" name="total" value="<?php echo  $grant_total; ?>" readonly></td>
</tr>
<?php } ?>
</tbody>

</table>
<br>
<br>
<?php } ?>
<?php
$ph1=$con->query("SELECT * FROM `cost_sheet_entry` INNER JOIN cost_totl ON cost_sheet_entry.enquiry_id = cost_totl.enquiries_id WHERE cost_sheet_entry.enquiry_id='$id' AND cost_sheet_entry.Phases='5' AND cost_totl.Phases='5'");
$ph1->execute(); 
$row_ph1 = $ph1->fetch();
?>
<?php if( $row_ph1['Phases']==5){
?>
<table class="table table-bordered">

<td><b>Phases</b></td>
<td>Specification</b></td>
<td><b>Man/hours/days<b></td>
<td><b>Amount<b></td>

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

<td><input type="text" class="form-control" id="phase" name="phase" value="<?php echo  $rows_1['Phases']; ?>" readonly></td>
<td colspan="1"><input type="text" class="form-control" id="Task" name="Task" value="<?php echo  $rows_1['Specification']; ?>" readonly></td>
<td colspan="1"><input type="text" class="form-control" id="unit" name="unit" value="<?php echo  $rows_1['day']; ?>" readonly></td>
<td colspan="1"><input type="text" class="form-control" id="amt" name="amt" value="<?php echo  $rows_1['Amount']; ?>" readonly></td>
</tr>
<?php } ?>
<?php 
$cnt=$cnt+1;
}?>
<?php 
$sqlquery_1=$con->query("SELECT * FROM `cost_sheet_entry` INNER JOIN cost_totl ON cost_sheet_entry.enquiry_id = cost_totl.enquiries_id WHERE cost_sheet_entry.enquiry_id='$id' AND cost_sheet_entry.Phases='5' AND cost_totl.Phases='5'");

$sqlquery_1->execute(); 
$sqlquery_1row = $sqlquery_1->fetch();
?>
<?php if( $sqlquery_1row['Phases']==5){
?>
<tr>
<td colspan="3"><center>Total</center></td><td colspan="1"><input type="text" class="form-control" id="total" name="total" value="<?php echo  $sqlquery_1row['total']; ?>" readonly></td>
</tr>
<tr>
<td colspan="3"><center>GST</center></td><td colspan="1"><input type="text" class="form-control" id="GST" name="GST" value="18%" readonly></td>
</tr>
<?php 
$gst=$sqlquery_1row['total']*18/100;
$grant_total=$gst+$sqlquery_1row['total'];
?>
<td colspan="3"><center>Total</center></td><td colspan="1"><input type="text" class="form-control" id="total" name="total" value="<?php echo  $grant_total; ?>" readonly></td>
</tr>
<?php } ?>
</tbody>

</table>
<br>
<br>
<?php } ?>
<?php 
}
?>
<br>
<br>
<?php if($row['flag']==1){
?>
<input type="button" class="btn btn-success" id="gopinath" name="gopinath" onclick="add_cost()" value="Add">
<div id="add_cost">
<TABLE id="new_tab1" width="350px" border="1" style="border-collapse:collapse;" class="table table-bordered table1">
<TR><h3>Phase 1</h3>


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

<h4><b>Total</b></h4>

<input type="text" class="form-control" name="priceTotal[]" id="priceTotal1" >




</td>
</TR>
</TABLE>	 
</div>
<?php }
?>
<br>
<br>

</div>
<?php if($row['enquiry_status']==3 && $row['flag']==1){

?>
<input type="button" class="btn btn-success" id="save" name="save" onclick="cost_update()" value="Save">
<br>
<br>
<?php
}
?>

<?php if($row['enquiry_status']==3 && $row['flag']==2){

?> 
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
<?php if($row['enquiry_status']==5 && $userrole=='R016' || $userrole=='R002'){

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
function add_cost(){
var len = $('#add_cost tr').length;

newTabLen += 1;

$('#add_cost').append('<TABLE id="new_tab' + newTabLen + '" width="350px" border="1" style="border-collapse:collapse;" class="table table-bordered ' + "table" + newTabLen + '" ><tr><h3>Phase' + newTabLen + '</h3><th><INPUT type="checkbox" name="select-all" id="select-all" onclick="toggle(this);"></th><th>Phases</th> <th>Specification</th><th>Man Hours/Days</th><th>Amount</th> <th>ACTION</th></tr><tr class="row_'+len+'"><td><input type="checkbox" class="chk" name="chk[]" id="chk_'+len+'" value="'+len+'"</td><td><select class="form-control" id="phase_'+len+'" name="phase[]"><option value="0">Select Phase</option><option value="1">Phase 1</option><option value="2">Phase 2</option><option value="3">Phase 3</option>	<option value="4">Phase 4</option><option value="5">Phase 5</option>	</Select></td><td><input type="text" class="form-control" id="item_'+len+'" name="item[]"></td><td><input type="text" class="form-control" id="cost_'+len+'" name="cost[]"></td><td><input type="text" class="form-control price" id="price_1" name="price[]" onchange="total_amount(' + newTabLen + ')"></td><td><input type="button" class="btn btn-success" id="new_row" name="new_row" onclick="check(' + newTabLen + ')" value="Add"><input type="button" class="btn btn-danger" id="enquiry_row_remove"  value="Remove"><h4><b>Total</b></h4><input type="text" class="form-control" name="priceTotal[]" id="priceTotal'+newTabLen+'" ></td></tr></TABLE>'); 

len = len + 1;
}

$(function () {
//Add text editor
$('#scope').summernote()
})
$(function () {
//Add text editor
$('#Proposal').summernote()
})
$(function () {
//Add text editor
$('#Conditions').summernote()
})

$(document).ready(function() {
$('#emp_id').on('change', function() {

var emp_id = this.value;
//alert(emp_id);
$.ajax({
url: "HRMS/BusinessProcess/quotation/getemp_details.php",
type: "get",
data: {
emp_id: emp_id
},
cache: false,
success: function(data){
		//alert(data);
var split=data.split("=");
//alert(split[0]);
$('#email_id').val(split[0]);
$('#tel_no').val(split[1]);
//alert(split[1]);
}
});
});
});

</script>
