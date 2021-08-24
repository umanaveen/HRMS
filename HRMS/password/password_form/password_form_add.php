<?php
require '../../../connect.php';
include("../../../user.php");
$userrole=$_SESSION['userrole'];

?>
<div class="card card-info">
<div class="card-header">

<center><h3 class="card-title"><b>Password Name</b></h3></center>
<a onclick="return back()" style="float: right;" data-toggle="modal" class="btn btn-danger"></i>Back</a>
</div>


<form method="POST" enctype="multipart/form-data">
<!-- Post -->
<table class="table table-bordered">
<tr>
<td><center><img src="/HRMS/HRMS/Recruitment/image/userlog/bluebase.png"  style="width:300px;height:150px;"></center></td>
<td colspan="5"><center><h1><b>Bluebase Software services Pvt Ltd</b></h1></center></td>
</tr>


<table class="table table-bordered">
<tr>
<td>Form Master</td>
<td colspan="5">
<select class="form-control" id="password_master" name="password_master" onchange="get_form(this.value)">
<option value="">Choose Type</option>
<?php $stmt = $con->query("SELECT * FROM password_master");
while ($row = $stmt->fetch()) {?>
<option value="<?php echo $row['password_id']; ?>"> <?php echo $row['name']; ?> </option>
<?php } ?>
</select></td>
</tr>
</table>


<table class="table table-bordered" id="email" style="visibility:collapse !important;">
<tr>

<td> Organiztion/Personel</td>

<td colspan="5"><input type="text" class="form-control" placeholder="Enter org" id="org1" name="org1"></td>
</tr>
<tr>

<td> Link</td>

<td colspan="5"><input type="text" class="form-control" placeholder="Enter Link" id="Link1" name="Link1"></td>
</tr>

<tr>
<td> Username</td>
<td colspan="5"><input type="text" class="form-control" placeholder="Enter Username" id="Username1" name="Username1"></td>
</tr>
<tr>

<td> Password</td>
<td colspan="5"> <input id="password-field" type="password" class="form-control" name="password1" value="">
<span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span></td>
</tr>
<tr>
<td> Recovery Mail_id</td>
<td colspan="5"><input type="text" class="form-control" placeholder="Enter Recovery Mail_id" id="R_mailid" name="R_mailid"></td>
</tr>
<tr>
<td> Recovery Phone Number</td>
<td colspan="5"><input type="text" class="form-control" placeholder="Enter Number" id="Re_number" name="Re_number"></td>
</tr>

<TR>
<TH>
<INPUT type="checkbox" name="select-all" id="select-all" onclick="toggle(this);">
</TH> 

<th>Department</th>
<th>Employee</th>
<th>Action</th>
</TR>
<TR>
<TD>
<INPUT type="checkbox" name="chk[]">
</TD>
<TD>
<select id="department_1" name="department[]" onchange="getProject_data(1,this.value)" class="form-control" >
<option value="">Select Department</option>
<?php
$dep_sql=$con->query("SELECT * FROM z_department_master");
while($dep_sql_res=$dep_sql->fetch(PDO::FETCH_ASSOC))
{
?>
<option value="<?php echo $dep_sql_res['id']; ?>"><?php echo $dep_sql_res['dept_name']; ?></option>
<?php
}
?>
</select>
</TD>

<TD>
<select id="project_name_1" name="project_name[]"  class="form-control">
</select>	
</TD>
<td>
<input type="button" class="btn btn-success" id="new_row" name="new_row" onclick="append()" value="Add">
<input type="button" class="btn btn-danger" id="enquiry_row_remove"  value="Remove">
</td>
</tr>
</TR>
<td colspan="6"><input type="button" class="btn btn-success" name="save" onclick="insert_pass()" value="save"></td>
</table>


<!-- /.post -->
</form>

<form role="form" name="" action="" method="post" enctype="multipart/type">
<table id="Erp" class="table table-bordered" style="visibility:collapse !important;">
<tr>

<td> Organiztion/Personel</td>

<td colspan="5"><input type="text" class="form-control" placeholder="Enter org" id="org" name="org2"></td>
</tr>
<tr>
<td> Link</td>
<td colspan="5"><input type="text" class="form-control" placeholder="Enter Link" id="Link" name="Link2"></td>
</tr>

<tr>
<td> Username</td>
<td colspan="5"><input type="text" class="form-control" placeholder="Enter Username" id="Username" name="Username2"></td>
</tr>
<tr>

<td> Password</td>
<td colspan="5"> <input id="erppassword-field" type="password" class="form-control" name="password2" value="">
<span toggle="#erppassword-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
</td>
</tr>
<TR>
<TH>
<INPUT type="checkbox" name="select-all" id="select-all" onclick="toggle(this);">
</TH> 

<th>Department</th>
<th>Employee</th>




<th>Action</th>
</TR>

<TR>
<TD>
<INPUT type="checkbox" name="chk[]">
</TD>

<TD>

<select id="department_1" name="department[]" onchange="getProject_data(1,this.value)" class="form-control" >
<option value="">Select Department</option>
<?php
$dep_sql=$con->query("SELECT * FROM z_department_master");
while($dep_sql_res=$dep_sql->fetch(PDO::FETCH_ASSOC))
{
?>
<option value="<?php echo $dep_sql_res['id']; ?>"><?php echo $dep_sql_res['dept_name']; ?></option>
<?php
}
?>
</select>
</TD>

<TD>
<select id="project_name_1" name="project_name[]"  class="form-control">
</select>	
</TD>
<td>
<input type="button" class="btn btn-success" id="new_row" name="new_row" onclick="append1()" value="Add">
<input type="button" class="btn btn-danger" id="enquiry_row_remove1"  value="Remove">
</td>
</tr>
</TR>
<td colspan="6"><input type="button" class="btn btn-success" name="save" onclick="insert_pass1()" value="save"></td>
</table>

</form>
<form role="form" name="" action="" method="post" enctype="multipart/type">
<table id="EPF" class="table table-bordered" style="visibility:collapse !important;">
<tr>

<td> Organiztion/Personel</td>

<td colspan="5"><input type="text" class="form-control" placeholder="Enter org" id="org3" name="org3"></td>
</tr>
<tr>
<td> Link</td>
<td colspan="5"><input type="text" class="form-control" placeholder="Enter Link" id="Link" name="Link3"></td>
</tr>

<tr>
<td> Username</td>
<td colspan="5"><input type="text" class="form-control" placeholder="Enter Username" id="Username" name="Username3"></td>
</tr>
<tr>

<td> Password</td>
<td colspan="5"> <input id="epfpassword-field" type="password" class="form-control" name="password3" value="">
<span toggle="#epfpassword-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
</td>
</tr>
<tr>
<td> UAN</td>
<td colspan="5"><input type="text" class="form-control" placeholder="Enter UAN" id="UAN" name="UAN"></td>
</tr>
<TR>
<TH>
<INPUT type="checkbox" name="select-all" id="select-all" onclick="toggle(this);">
</TH> 

<th>Department</th>
<th>Employee</th>




<th>Action</th>
</TR>

<TR>
<TD>
<INPUT type="checkbox" name="chk[]">
</TD>

<TD>

<select id="department_1" name="department[]" onchange="getProject_data(1,this.value)" class="form-control" >
<option value="">Select Department</option>
<?php
$dep_sql=$con->query("SELECT * FROM z_department_master");
while($dep_sql_res=$dep_sql->fetch(PDO::FETCH_ASSOC))
{
?>
<option value="<?php echo $dep_sql_res['id']; ?>"><?php echo $dep_sql_res['dept_name']; ?></option>
<?php
}
?>
</select>
</TD>

<TD>
<select id="project_name_1" name="project_name[]"  class="form-control">
</select>	
</TD>








<td>
<input type="button" class="btn btn-success" id="new_row" name="new_row" onclick="append3()" value="Add">
<input type="button" class="btn btn-danger" id="enquiry_row_remove3"  value="Remove">
</td>
</tr>
</TR>
<td colspan="6"><input type="button" class="btn btn-success" name="save" onclick="insert_pass2()" value="save"></td>
</table>


</form>
<form role="form" name="" action="" method="post" enctype="multipart/type">
<table id="ESIC" class="table table-bordered" style="visibility:collapse !important;">
<tr>

<td> Organiztion/Personel</td>

<td colspan="5"><input type="text" class="form-control" placeholder="Enter org" id="org" name="org4"></td>
</tr>
<tr>
<td> Link</td>
<td colspan="5"><input type="text" class="form-control" placeholder="Enter Link" id="Link" name="Link4"></td>
</tr>

<tr>
<td> Username</td>
<td colspan="5"><input type="text" class="form-control" placeholder="Enter Username" id="Username" name="Username4"></td>
</tr>
<tr>

<td> Password</td>
<td colspan="5"> <input id="esicpassword-field" type="password" class="form-control" name="password4" value="">
<span toggle="#esicpassword-field" class="fa fa-fw fa-eye field-icon toggle-password"></span></td>
</tr>
<tr>
<td> Number</td>
<td colspan="5"><input type="text" class="form-control" placeholder="Enter esNumber" id="esNumber" name="esNumber"></td>
</tr>
<TR>
<TH>
<INPUT type="checkbox" name="select-all" id="select-all" onclick="toggle(this);">
</TH> 

<th>Department</th>
<th>Employee</th>




<th>Action</th>
</TR>

<TR>
<TD>
<INPUT type="checkbox" name="chk[]">
</TD>

<TD>

<select id="department_1" name="department[]" onchange="getProject_data(1,this.value)" class="form-control" >
<option value="">Select Department</option>
<?php
$dep_sql=$con->query("SELECT * FROM z_department_master");
while($dep_sql_res=$dep_sql->fetch(PDO::FETCH_ASSOC))
{
?>
<option value="<?php echo $dep_sql_res['id']; ?>"><?php echo $dep_sql_res['dept_name']; ?></option>
<?php
}
?>
</select>
</TD>

<TD>
<select id="project_name_1" name="project_name[]"  class="form-control">
</select>	
</TD>








<td>
<input type="button" class="btn btn-success" id="new_row" name="new_row" onclick="append2()" value="Add">
<input type="button" class="btn btn-danger" id="enquiry_row_remove2"  value="Remove">
</td>
</tr>
</TR>
<td colspan="6"><input type="button" class="btn btn-success" name="save" onclick="insert_pass2()" value="save"></td>
</table>

</form>
<form>
<table class="table table-bordered" id="bank" style="visibility:collapse !important;">
<tr>

<td> Organiztion/Personel</td>

<td colspan="5"><input type="text" class="form-control" placeholder="Enter org" id="org" name="org5">
</td>
</tr>
<tr>

<td> Name Of the Bank</td>

<td colspan="5"><input type="text" class="form-control" placeholder="Enter bank name" id="bank" name="bank1"></td>
</tr>

<tr>
<td> Account Type</td>
<td colspan="5"><input type="text" class="form-control" placeholder="Enter account type" id="acount_type" name="acount_type1"></td>
</tr>
<tr>
<td> Account Number</td>
<td colspan="5"><input type="text" class="form-control" placeholder="Enter acc_num" id="acc_num" name="acc_num1"></td>
</tr>
<tr>
<td> Account holder Name</td>
<td colspan="5"><input type="text" class="form-control" placeholder="Enter acc_hol_name" id="acc_hol_name" name="acc_hol_name1"></td>
</tr>
<tr>
<td> IFSC</td>
<td colspan="5"><input type="text" class="form-control" placeholder="Enter ifsc" id="ifsc" name="ifsc1"></td>
</tr>
<tr>
<td> Branch</td>
<td colspan="5"><input type="text" class="form-control" placeholder="Enter Branch" id="Branch" name="Branch1"></td>
</tr>
<tr>
<td> Accounting opening date</td>
<td colspan="5"><input type="date" class="form-control" placeholder="Enter acc_open_date" id="acc_open_date" name="acc_open_date1"></td>
</tr>
<tr>
<td> Minimum Balance </td>
<td colspan="5"><input type="text" class="form-control" placeholder="Enter minimum_balance" id="minimum_balance" name="minimum_balance1"></td>
</tr>

<tr>
<td> NET BankLink</td>
<td colspan="5"><input type="text" class="form-control" placeholder="Enter Link" id="net_Link" name="net_Link"></td>
</tr>

<tr>
<td> Net bank Username</td>
<td colspan="5"><input type="text" class="form-control" placeholder="Enter Username" id="NetUsername" name="NetUsername"></td>
</tr>
<tr>

<td> Net bank  Password</td>
<td colspan="5"> <input id="bankpassword-field" type="netpassword" class="form-control" name="netpassword" value="">
<span toggle="#bankpassword-field" class="fa fa-fw fa-eye field-icon toggle-password"></span></td>
</tr>

<tr>
<td>Debit  Card Number</td>
<td colspan="5"><input type="text" class="form-control" placeholder="Enter card_number" id="debitcard_number" name="debitcard_number1"></td>
</tr>

<tr>
<td> Debit card_hoder_name</td>
<td colspan="5"><input type="text" class="form-control" placeholder="Enter card_hoder_name" id="card_hoder_name" name="card_hoder_name1"></td>
</tr>
<tr>
<td> Type of card</td>
<td colspan="5"><input type="text" class="form-control" placeholder="Enter Type of card" id="Type_card" name="Type_card1"></td>
</tr>
<tr>
<td> Debit card Expiry Month Year</td>
<td colspan="5"><input type="date" class="form-control" placeholder="Enter Month Year" id="month_year" name="month_year1"></td>
</tr>


<TR>
<TH>
<INPUT type="checkbox" name="select-all" id="select-all" onclick="toggle(this);">
</TH> 

<th>Department</th>
<th>Employee</th>




<th>Action</th>
</TR>

<TR>
<TD>
<INPUT type="checkbox" name="chk[]">
</TD>

<TD>

<select id="department_1" name="department[]" onchange="getProject_data(1,this.value)" class="form-control" >
<option value="">Select Department</option>
<?php
$dep_sql=$con->query("SELECT * FROM z_department_master");
while($dep_sql_res=$dep_sql->fetch(PDO::FETCH_ASSOC))
{
?>
<option value="<?php echo $dep_sql_res['id']; ?>"><?php echo $dep_sql_res['dept_name']; ?></option>
<?php
}
?>
</select>
</TD>

<TD>
<select id="project_name_1" name="project_name[]"  class="form-control">
</select>	
</TD>








<td>
<input type="button" class="btn btn-success" id="new_row" name="new_row" onclick="append4()" value="Add">
<input type="button" class="btn btn-danger" id="enquiry_row_remove4"  value="Remove">
</td>
</tr>
</TR>
<td colspan="6"><input type="button" class="btn btn-success" name="save" onclick="insert_pass3()" value="save"></td>
</table>
</form>
<form>
<table class="table table-bordered" id="credit" style="visibility:collapse !important;">
<tr>

<td> Organiztion/Personel</td>

<td colspan="5"><input type="text" class="form-control" placeholder="Enter org" id="org" name="org6"></td>
</tr>
<tr>

<td> Name Of the Bank</td>

<td colspan="5"><input type="text" class="form-control" placeholder="Enter bank name" id="bank" name="bank2"></td>
</tr>

<tr>
<td> Card Holder Name</td>
<td colspan="5"><input type="text" class="form-control" placeholder="Enter  holder Name" id="holder_name" name="holder_name2"></td>
</tr>
<tr>
<td> Type of card</td>
<td colspan="5"><input type="text" class="form-control" placeholder="Enter Type of card" id="Type_card" name="Type_card2"></td>
</tr>
<tr>
<td> Expiry Month Year</td>
<td colspan="5"><input type="date" class="form-control" placeholder="Enter Month Year" id="month_year" name="month_year2"></td>
</tr>


<tr>
<td> Credit Limit</td>
<td colspan="5"><input type="text" class="form-control" placeholder="Enter credit limit" id="credit_limit" name="credit_limit2"></td>
</tr>

<TR>
<TH>
<INPUT type="checkbox" name="select-all" id="select-all" onclick="toggle(this);">
</TH> 

<th>Department</th>
<th>Employee</th>




<th>Action</th>
</TR>

<TR>
<TD>
<INPUT type="checkbox" name="chk[]">
</TD>

<TD>

<select id="department_1" name="department[]" onchange="getProject_data(1,this.value)" class="form-control" >
<option value="">Select Department</option>
<?php
$dep_sql=$con->query("SELECT * FROM z_department_master");
while($dep_sql_res=$dep_sql->fetch(PDO::FETCH_ASSOC))
{
?>
<option value="<?php echo $dep_sql_res['id']; ?>"><?php echo $dep_sql_res['dept_name']; ?></option>
<?php
}
?>
</select>
</TD>

<TD>
<select id="project_name_1" name="project_name[]"  class="form-control">
</select>	
</TD><td>
<input type="button" class="btn btn-success" id="new_row" name="new_row" onclick="append5()" value="Add">
<input type="button" class="btn btn-danger" id="enquiry_row_remove5"  value="Remove">
</td>
</tr>
</TR>
<td colspan="6"><input type="button" class="btn btn-success" name="save" onclick="insert_pass4()" value="save"></td>
</table>


</form>



</div>

<script>
function insert_pass()
{
var id=0;
//alert(id);
var data = $('form').serialize();
//alert(data);
$.ajax({
type:'Get',
data:"id="+id, data,
url:"HRMS/password/password_form/password_form_submit.php",

success:function(data)
{      
alert("Entry Successfully");
password_form()

}       
});
}
function back()

{
password_form()

}


function get_form(value)
{

if(value=='1'||value=='6'||value=='7'||value=='8'||value=='9'||value=='10')
{

document.getElementById('email').style.visibility = "visible";
document.getElementById('Erp').style.visibility = "collapse";
document.getElementById('EPF').style.visibility = "collapse";
document.getElementById('ESIC').style.visibility = "collapse";
document.getElementById('bank').style.visibility = "collapse";
document.getElementById('credit').style.visibility = "collapse";
document.getElementById('debit').style.visibility = "collapse";


} 
else if(value=='2'||value=='3'||value=='4')
{
document.getElementById('Erp').style.visibility = "visible";
document.getElementById('email').style.visibility = "collapse";
document.getElementById('EPF').style.visibility = "collapse";
document.getElementById('ESIC').style.visibility = "collapse";
document.getElementById('bank').style.visibility = "collapse";
document.getElementById('credit').style.visibility = "collapse";
document.getElementById('debit').style.visibility = "collapse";
}
else if(value=='11')
{
document.getElementById('Erp').style.visibility = "collapse";
document.getElementById('email').style.visibility = "collapse";
document.getElementById('EPF').style.visibility = "visible";
document.getElementById('ESIC').style.visibility = "collapse";
document.getElementById('bank').style.visibility = "collapse";
document.getElementById('credit').style.visibility = "collapse";
document.getElementById('debit').style.visibility = "collapse";
}
else if(value=='12')
{
document.getElementById('Erp').style.visibility = "collapse";
document.getElementById('email').style.visibility = "collapse";
document.getElementById('EPF').style.visibility = "collapse";
document.getElementById('ESIC').style.visibility = "visible";
document.getElementById('bank').style.visibility = "collapse";
document.getElementById('credit').style.visibility = "collapse";
document.getElementById('debit').style.visibility = "collapse";
}
else if(value=='13')
{
document.getElementById('Erp').style.visibility = "collapse";
document.getElementById('email').style.visibility = "collapse";
document.getElementById('EPF').style.visibility = "collapse";
document.getElementById('ESIC').style.visibility = "collapse";
document.getElementById('bank').style.visibility = "visible";
document.getElementById('credit').style.visibility = "collapse";
document.getElementById('debit').style.visibility = "collapse";
}

else if(value=='14')
{
document.getElementById('Erp').style.visibility = "collapse";
document.getElementById('email').style.visibility = "collapse";
document.getElementById('EPF').style.visibility = "collapse";
document.getElementById('ESIC').style.visibility = "collapse";
document.getElementById('bank').style.visibility = "collapse";
document.getElementById('credit').style.visibility = "visible";
document.getElementById('debit').style.visibility = "collapse";
}
else if(value=='15')
{
document.getElementById('Erp').style.visibility = "collapse";
document.getElementById('email').style.visibility = "collapse";
document.getElementById('EPF').style.visibility = "collapse";
document.getElementById('ESIC').style.visibility = "collapse";
document.getElementById('bank').style.visibility = "collapse";
document.getElementById('credit').style.visibility = "collapse";
document.getElementById('debit').style.visibility = "visible";
}
}

$(".toggle-password").click(function() {

$(this).toggleClass("fa-eye fa-eye-slash");
var input = $($(this).attr("toggle"));
if (input.attr("type") == "password") {
input.attr("type", "text");
} else {
input.attr("type", "password");
}
});
function append() 
{
var len=$('#email tr').length;	
len=len+1; 
$('#email').append('<tr class="row_'+len+'"><td><input type="checkbox" class="chk" name="chk[]" id="chk_'+len+'" value="'+len+'"</td><td><select id="department'+len+'" name="department[]" onchange="getProject_data('+len+',this.value)" class="form-control" ><option value="">Select Department</option><?php $dep_sql=$con->query("SELECT * FROM z_department_master"); while($dep_sql_res=$dep_sql->fetch(PDO::FETCH_ASSOC)){ ?><option value="<?php echo $dep_sql_res['id']; ?>"><?php echo $dep_sql_res['dept_name']; ?></option><?php } ?></select></td><td><select id="project_name_'+len+'" name="project_name[]"  class="form-control"></select></td></tr>'); 
}
$('#enquiry_row_remove').click(function(){
$('input:checkbox:checked.chk').map(function(){
var id=$(this).val();
var le=$('#email tr').length;

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

function append1() 
{
var len=$('#Erp tr').length;	
len=len+1; 
$('#Erp').append('<tr class="row_'+len+'"><td><input type="checkbox" class="chk" name="chk[]" id="chk_'+len+'" value="'+len+'"</td><td><select id="department'+len+'" name="department[]" onchange="getProject_data('+len+',this.value)" class="form-control" ><option value="">Select Department</option><?php $dep_sql=$con->query("SELECT * FROM z_department_master"); while($dep_sql_res=$dep_sql->fetch(PDO::FETCH_ASSOC)){ ?><option value="<?php echo $dep_sql_res['id']; ?>"><?php echo $dep_sql_res['dept_name']; ?></option><?php } ?></select></td><td><select id="project_name_'+len+'" name="project_name[]"  class="form-control"></select>	</td></tr>'); 
}
$('#enquiry_row_remove1').click(function(){
$('input:checkbox:checked.chk').map(function(){
var id=$(this).val();
var le=$('#Erp tr').length;

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
function append2() 
{
var len=$('#ESIC tr').length;	
len=len+1; 
$('#ESIC').append('<tr class="row_'+len+'"><td><input type="checkbox" class="chk" name="chk[]" id="chk_'+len+'" value="'+len+'"</td><td><select id="department'+len+'" name="department[]" onchange="getProject_data('+len+',this.value)" class="form-control" ><option value="">Select Department</option><?php $dep_sql=$con->query("SELECT * FROM z_department_master"); while($dep_sql_res=$dep_sql->fetch(PDO::FETCH_ASSOC)){ ?><option value="<?php echo $dep_sql_res['id']; ?>"><?php echo $dep_sql_res['dept_name']; ?></option><?php } ?></select></td><td><select id="project_name_'+len+'" name="project_name[]"  class="form-control"></select>	</td></tr>'); 
}
$('#enquiry_row_remove2').click(function(){
$('input:checkbox:checked.chk').map(function(){
var id=$(this).val();
var le=$('#ESIC tr').length;

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

function append3() 
{
var len=$('#EPF tr').length;	
len=len+1; 
$('#EPF').append('<tr class="row_'+len+'"><td><input type="checkbox" class="chk" name="chk[]" id="chk_'+len+'" value="'+len+'"</td><td><select id="department'+len+'" name="department[]" onchange="getProject_data('+len+',this.value)" class="form-control" ><option value="">Select Department</option><?php $dep_sql=$con->query("SELECT * FROM z_department_master"); while($dep_sql_res=$dep_sql->fetch(PDO::FETCH_ASSOC)){ ?><option value="<?php echo $dep_sql_res['id']; ?>"><?php echo $dep_sql_res['dept_name']; ?></option><?php } ?></select></td><td><select id="project_name_'+len+'" name="project_name[]"  class="form-control"></select>	</td></tr>'); 
}
$('#enquiry_row_remove3').click(function(){
$('input:checkbox:checked.chk').map(function(){
var id=$(this).val();
var le=$('#EPF tr').length;

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

function append4() 
{
var len=$('#bank tr').length;	
len=len+1; 
$('#bank').append('<tr class="row_'+len+'"><td><input type="checkbox" class="chk" name="chk[]" id="chk_'+len+'" value="'+len+'"</td><td><select id="department'+len+'" name="department[]" onchange="getProject_data('+len+',this.value)" class="form-control" ><option value="">Select Department</option><?php $dep_sql=$con->query("SELECT * FROM z_department_master"); while($dep_sql_res=$dep_sql->fetch(PDO::FETCH_ASSOC)){ ?><option value="<?php echo $dep_sql_res['id']; ?>"><?php echo $dep_sql_res['dept_name']; ?></option><?php } ?></select></td><td><select id="project_name_'+len+'" name="project_name[]"  class="form-control"></select>	</td></tr>'); 
}
$('#enquiry_row_remove4').click(function(){
$('input:checkbox:checked.chk').map(function(){
var id=$(this).val();
var le=$('#bank tr').length;

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

function append5() 
{
var len=$('#credit tr').length;	
len=len+1; 
$('#credit').append('<tr class="row_'+len+'"><td><input type="checkbox" class="chk" name="chk[]" id="chk_'+len+'" value="'+len+'"</td><td><select id="department'+len+'" name="department[]" onchange="getProject_data('+len+',this.value)" class="form-control" ><option value="">Select Department</option><?php $dep_sql=$con->query("SELECT * FROM z_department_master"); while($dep_sql_res=$dep_sql->fetch(PDO::FETCH_ASSOC)){ ?><option value="<?php echo $dep_sql_res['id']; ?>"><?php echo $dep_sql_res['dept_name']; ?></option><?php } ?></select></td><td><select id="project_name_'+len+'" name="project_name[]"  class="form-control"></select>	</td></tr>'); 
}
$('#enquiry_row_remove6').click(function(){
$('input:checkbox:checked.chk').map(function(){
var id=$(this).val();
var le=$('#credit tr').length;

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

function append6() 
{
var len=$('#debit tr').length;	
len=len+1; 
$('#debit').append('<tr class="row_'+len+'"><td><input type="checkbox" class="chk" name="chk[]" id="chk_'+len+'" value="'+len+'"</td><td><select id="department'+len+'" name="department[]" onchange="getProject_data('+len+',this.value)" class="form-control" ><option value="">Select Department</option><?php $dep_sql=$con->query("SELECT * FROM z_department_master"); while($dep_sql_res=$dep_sql->fetch(PDO::FETCH_ASSOC)){ ?><option value="<?php echo $dep_sql_res['id']; ?>"><?php echo $dep_sql_res['dept_name']; ?></option><?php } ?></select></td><td><select id="project_name_'+len+'" name="project_name[]"  class="form-control"></select>	</td></tr>'); 
}
$('#enquiry_row_remove5').click(function(){
$('input:checkbox:checked.chk').map(function(){
var id=$(this).val();
var le=$('#debit tr').length;

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

function getProject_data(v,c){
//alert(v);
//var client_id=document.getElementById('client_'+v).value;
//document.getElementById("demo").innerHTML = "You selected: " + client_id;

$.ajax({
type: "GET",
url: "/HRMS/HRMS/Recruitment/project_management/project_schedule/find_project.php?client_id="+c,
success: function(data){
$("#project_name_"+v).html(data);
}
});

}

function insert_pass1()
{
var id=0;
//alert(id);
var data = $('form').serialize();
//alert(data);
$.ajax({
type:'Get',
data:"id="+id, data,
url:"HRMS/password/password_form/password_form_submit.php",

success:function(data)
{      
alert("Entry Successfully");
password_form()

}       
});
}

function insert_pass2()
{
var id=0;
//alert(id);
var data = $('form').serialize();
//alert(data);
$.ajax({
type:'Get',
data:"id="+id, data,
url:"HRMS/password/password_form/password_form_submit.php",

success:function(data)
{      
alert("Entry Successfully");
password_form()

}       
});
}
function insert_pass3()
{
var id=0;
//alert(id);
var data = $('form').serialize();
//alert(data);
$.ajax({
type:'Get',
data:"id="+id, data,
url:"HRMS/password/password_form/password_form_submit.php",

success:function(data)
{      
alert("Entry Successfully");
password_form()

}       
});
}

function insert_pass4()
{
var id=0;
//alert(id);
var data = $('form').serialize();
//alert(data);
$.ajax({
type:'Get',
data:"id="+id, data,
url:"HRMS/password/password_form/password_form_submit.php",

success:function(data)
{      
alert("Entry Successfully");
password_form()

}       
});
}
</script>

