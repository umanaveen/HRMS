<?php
require '../../../connect.php';
include("../../../user.php");
$id=$_REQUEST['id'];
$stmt = $con->prepare("SELECT * FROM `password_recovery`
inner join password_master on password_recovery.password_master_id=password_master.password_id
where password_recovery.id='$id'"); 

$stmt->execute(); 
$row = $stmt->fetch();
?>
<div class="card card-info">
<div class="card-header">  
<center><h3 class="card-title"><b>Password  Details </b></h3></center>
<a onclick="return back()" style="float: right;" data-toggle="modal" class="btn btn-danger"></i>Back</a>
</div>
<form method="POST" enctype="multipart/form-data">
<input type="hidden" class="form-control" id="get_id" name="get_id" value="<?php echo  $id; ?>">
<input type="hidden" class="form-control" id="password_master_id" name="password_master_id" value="<?php echo  $row['password_master_id']; ?>">
<div class="card-body">
<?php if( $row['password_master_id']==1 || $row['password_master_id']=='6'||
$row['password_master_id']=='7'||$row['password_master_id']=='8'||
$row['password_master_id']=='9'||$row['password_master_id']=='10') {
?>
<div class="form-group row">
<label for="inputname" class="col-sm-2 col-form-label">Organiztion</label>
<div class="col-sm-4">
<input type="text" class="form-control"  id="org1" name="org1" value="<?php echo  $row['organization'];?>">

</div>
</div>
<div class="form-group row">
<label for="inputname" class="col-sm-2 col-form-label">Link</label>
<div class="col-sm-4">
<input type="text" class="form-control" placeholder="Enter Link" id="Link1" name="Link1" value="<?php echo  $row['link'];?>">

</div>
</div>

<div class="form-group row">
<label for="inputname" class="col-sm-2 col-form-label">Username</label>
<div class="col-sm-4">
<input type="text" class="form-control" placeholder="Enter Username" id="Username1" name="Username1" value="<?php echo  $row['username'];?>">


</div>
</div>

<div class="form-group row">
<label for="inputname" class="col-sm-2 col-form-label">Password</label>
<div class="col-sm-4">
<input type="text" class="form-control" placeholder="Enter Username" name="password1" name="password1" value="<?php echo  $row['Password'];?>">


</div>
</div>
<div class="form-group row">
<label for="inputname" class="col-sm-2 col-form-label"> Recovery Mail_id</label>
<div class="col-sm-4">
<input type="text" class="form-control" placeholder="Enter Number" id="R_mailid" name="R_mailid" value="<?php echo  $row['recovery_mailid'];?>">



</div>
</div>
<div class="form-group row">
<label for="inputname" class="col-sm-2 col-form-label">Recovery Phone Number</label>
<div class="col-sm-4">
<input type="text" class="form-control" placeholder="Enter Number" id="Re_number" name="Re_number" value="<?php echo  $row['phone_number'];?>">
</div>
</div>
<input type="button" class="btn btn-primary" name="update" onclick="passwordrecovery_edit()" value="Update">
</form>
<?php
} else if($row['password_master_id']==2||$row['password_master_id']==3||$row['password_master_id']==4) {
?>
<form method="POST" enctype="multipart/form-data">
<input type="hidden" class="form-control" id="get_id" name="get_id" value="<?php echo  $id; ?>">
<input type="hidden" class="form-control" id="password_master_id" name="password_master_id" value="<?php echo  $row['password_master_id']; ?>">
<div class="form-group row">
<label for="inputname" class="col-sm-2 col-form-label">Organiztion</label>
<div class="col-sm-4">
<input type="text" class="form-control"  id="org1" name="org2" value="<?php echo  $row['organization'];?>">

</div>
</div>
<div class="form-group row">
<label for="inputname" class="col-sm-2 col-form-label">Link</label>
<div class="col-sm-4">
<input type="text" class="form-control" placeholder="Enter Link" id="Link1" name="Link2" value="<?php echo  $row['link'];?>">

</div>
</div>

<div class="form-group row">
<label for="inputname" class="col-sm-2 col-form-label">Username</label>
<div class="col-sm-4">
<input type="text" class="form-control" placeholder="Enter Username" id="Username1" name="Username2" value="<?php echo  $row['username'];?>">


</div>
</div>

<div class="form-group row">
<label for="inputname" class="col-sm-2 col-form-label">Password</label>
<div class="col-sm-4">
<input type="text" class="form-control" name="password2" value="<?php echo  $row['Password'];?>">


</div>
</div>
<input type="button" class="btn btn-primary" name="update" onclick="passwordrecovery_edit1()" value="Update">
</form>

<?php } else if($row['password_master_id']==11) { ?>
  <form method="POST" enctype="multipart/form-data">
  <div class="form-group row">
<label for="inputname" class="col-sm-2 col-form-label">Organiztion</label>
<div class="col-sm-4">
<input type="text" class="form-control"  id="org1" name="org3" value="<?php echo  $row['organization'];?>">

</div>
</div>
<div class="form-group row">
<label for="inputname" class="col-sm-2 col-form-label">Link</label>
<div class="col-sm-4">
<input type="text" class="form-control"  id="Link1" name="Link3" value="<?php echo  $row['link'];?>">

</div>
</div>

<div class="form-group row">
<label for="inputname" class="col-sm-2 col-form-label">Username</label>
<div class="col-sm-4">
<input type="text" class="form-control"  id="Username1" name="Username3" value="<?php echo  $row['username'];?>">


</div>
</div>

<div class="form-group row">
<label for="inputname" class="col-sm-2 col-form-label">Password</label>
<div class="col-sm-4">
<input type="text" class="form-control"  name="password4" value="<?php echo  $row['Password'];?>">


</div>
</div>
<div class="form-group row">
<label for="inputname" class="col-sm-2 col-form-label">UAN</label>
<div class="col-sm-4">
<input type="text" class="form-control"  id="UAN" name="UAN" value="<?php echo  $row['uan_number'];?>">


</div>
</div>
<input type="button" class="btn btn-primary" name="update" onclick="passwordrecovery_edit2()" value="Update">
</form>
  <?php }  else if($row['password_master_id']==12) {?>
    <form method="POST" enctype="multipart/form-data">
<input type="hidden" class="form-control" id="get_id" name="get_id" value="<?php echo  $id; ?>">
<input type="hidden" class="form-control" id="password_master_id" name="password_master_id" value="<?php echo  $row['password_master_id']; ?>">
    <div class="form-group row">
<label for="inputname" class="col-sm-2 col-form-label">Organiztion</label>
<div class="col-sm-4">
<input type="text" class="form-control"  id="org1" name="org4" value="<?php echo  $row['organization'];?>">

</div>
</div>
<div class="form-group row">
<label for="inputname" class="col-sm-2 col-form-label">Link</label>
<div class="col-sm-4">
<input type="text" class="form-control"  id="Link1" name="Link4" value="<?php echo  $row['link'];?>">

</div>
</div>

<div class="form-group row">
<label for="inputname" class="col-sm-2 col-form-label">Username</label>
<div class="col-sm-4">
<input type="text" class="form-control"  id="Username1" name="Username4" value="<?php echo  $row['username'];?>">


</div>
</div>

<div class="form-group row">
<label for="inputname" class="col-sm-2 col-form-label">Password</label>
<div class="col-sm-4">
<input type="text" class="form-control"   name="password5" value="<?php echo  $row['Password'];?>">


</div>
</div>
<div class="form-group row">
<label for="inputname" class="col-sm-2 col-form-label">EsNumber</label>
<div class="col-sm-4">
<input type="text" class="form-control"  id="esNumber" name="esNumber" value="<?php echo  $row['Esic_number'];?>">


</div>
</div>
<input type="button" class="btn btn-primary" name="update" onclick="passwordrecovery_edit3()" value="Update">
</form>

<?php } else if($row['password_master_id']==13) {?>
  <form method="POST" enctype="multipart/form-data">
<input type="hidden" class="form-control" id="get_id" name="get_id" value="<?php echo  $id; ?>">
<input type="hidden" class="form-control" id="password_master_id" name="password_master_id" value="<?php echo  $row['password_master_id']; ?>">
  <div class="form-group row">
<label for="inputname" class="col-sm-2 col-form-label">Organiztion</label>
<div class="col-sm-4">
<input type="text" class="form-control"  id="org6" name="org5" value="<?php echo  $row['organization'];?>">
</div>
</div>
<div class="form-group row">
<label for="inputname" class="col-sm-2 col-form-label"> Name Of the Bank</label>
<div class="col-sm-4">
<input type="text" class="form-control"  id="bank1" name="bank1" value="<?php echo  $row['Name_bank'];?>">
</div>
</div>
<div class="form-group row">
<label for="inputname" class="col-sm-2 col-form-label">Account Type</label>
<div class="col-sm-4">
<input type="text" class="form-control"  id="acount_type1" name="acount_type1" value="<?php echo  $row['Account_type'];?>">
</div>
</div>
<div class="form-group row">
<label for="inputname" class="col-sm-2 col-form-label">Account_number </label>
<div class="col-sm-4">
<input type="text" class="form-control"  id="acc_num1" name="acc_num1" value="<?php echo  $row['Account_number'];?>">
</div>
</div>
<div class="form-group row">
<label for="inputname" class="col-sm-2 col-form-label">Account holder Name</label>
<div class="col-sm-4">
<input type="text" class="form-control"  id="acc_hol_name1" name="acc_hol_name1" value="<?php echo  $row['Account_holder_name'];?>">
</div>
</div>
<div class="form-group row">
<label for="inputname" class="col-sm-2 col-form-label">IFSC</label>
<div class="col-sm-4">
<input type="text" class="form-control"  id="ifsc1" name="ifsc1" value="<?php echo  $row['ifsc'];?>">
</div>
</div>
<div class="form-group row">
<label for="inputname" class="col-sm-2 col-form-label">Branch</label>
<div class="col-sm-4">
<input type="text" class="form-control"  id="Branch1" name="Branch1" value="<?php echo  $row['Branch'];?>">
</div>
</div>
<div class="form-group row">
<label for="inputname" class="col-sm-2 col-form-label">Accounting opening date</label>
<div class="col-sm-4">
<input type="date" class="form-control"  id="acc_open_date1" name="acc_open_date1" value="<?php echo  $row['Account_opening_date'];?>">
</div>
</div>
<div class="form-group row">
<label for="inputname" class="col-sm-2 col-form-label"> Minimum Balance</label>
<div class="col-sm-4">
<input type="text" class="form-control"  id="minimum_balance1" name="minimum_balance1" value="<?php echo  $row['Minimum_balance'];?>">
</div>
</div>
<div class="form-group row">
<label for="inputname" class="col-sm-2 col-form-label">NET BankLink</label>
<div class="col-sm-4">
<input type="text" class="form-control"  id="net_Link" name="net_Link" value="<?php echo  $row['link'];?>">
</div>
</div>
<div class="form-group row">
<label for="inputname" class="col-sm-2 col-form-label">Net bank Username</label>
<div class="col-sm-4">
<input type="text" class="form-control"  id="NetUsername" name="NetUsername" value="<?php echo  $row['username'];?>">
</div>
</div>
<div class="form-group row">
<label for="inputname" class="col-sm-2 col-form-label"> Net bank  Password</label>
<div class="col-sm-4">
<input type="text" class="form-control"  id="netpassword" name="netpassword" value="<?php echo  $row['Password'];?>">
</div>
</div>
<div class="form-group row">
<label for="inputname" class="col-sm-2 col-form-label"> Debit  Card Number</label>
<div class="col-sm-4">
<input type="text" class="form-control"  id="debitcard_number1" name="debitcard_number1" value="<?php echo  $row['Card_number'];?>">
</div>
</div>
<div class="form-group row">
<label for="inputname" class="col-sm-2 col-form-label">Debit card_hoder_name</label>
<div class="col-sm-4">
<input type="text" class="form-control"  id="card_hoder_name1" name="card_hoder_name1" value="<?php echo  $row['Card_holder_name'];?>">
</div>
</div>
<div class="form-group row">
<label for="inputname" class="col-sm-2 col-form-label">Type of card</label>
<div class="col-sm-4">
<input type="text" class="form-control"  id="Type_card1" name="Type_card1" value="<?php echo  $row['Type_card'];?>">
</div>
</div>
<div class="form-group row">
<label for="inputname" class="col-sm-2 col-form-label">Debit card Expiry Month Year</label>
<div class="col-sm-4">
<input type="date" class="form-control"  id="month_year1" name="month_year1" value="<?php echo  $row['exp_month_year'];?>">
</div>
</div>
<input type="button" class="btn btn-primary" name="update" onclick="passwordrecovery_edit4()" value="Update">
</form>
  <?php } else if($row['password_master_id']==14) {?>
    <form method="POST" enctype="multipart/form-data">
<input type="hidden" class="form-control" id="get_id" name="get_id" value="<?php echo  $id; ?>">
<input type="hidden" class="form-control" id="password_master_id" name="password_master_id" value="<?php echo  $row['password_master_id']; ?>">
    <div class="form-group row">
<label for="inputname" class="col-sm-2 col-form-label">Organiztion</label>
<div class="col-sm-4">
<input type="text" class="form-control"  id="org6" name="org6" value="<?php echo  $row['organization'];?>">
</div>
</div>
<div class="form-group row">
<label for="inputname" class="col-sm-2 col-form-label"> Name Of the Bank</label>
<div class="col-sm-4">
<input type="text" class="form-control"  id="bank1" name="bank2" value="<?php echo  $row['Name_bank'];?>">
</div>
</div>


<div class="form-group row">
<label for="inputname" class="col-sm-2 col-form-label">Card holder Name</label>
<div class="col-sm-4">
<input type="text" class="form-control"  id="holder_name2" name="holder_name2" value="<?php echo  $row['Card_holder_name'];?>">
</div>
</div>

<div class="form-group row">
<label for="inputname" class="col-sm-2 col-form-label">Type of card</label>
<div class="col-sm-4">
<input type="text" class="form-control"  id="Type_card2" name="Type_card2" value="<?php echo  $row['Type_card'];?>">
</div>
</div>
<div class="form-group row">
<label for="inputname" class="col-sm-2 col-form-label">Expiry Month Year</label>
<div class="col-sm-4">
<input type="date" class="form-control"  id="month_year2" name="month_year2" value="<?php echo  $row['exp_month_year'];?>">
</div>
</div>
<div class="form-group row">
<label for="inputname" class="col-sm-2 col-form-label">Credit Limit</label>
<div class="col-sm-4">
<input type="text" class="form-control"  id="credit_limit2" name="credit_limit2" value="<?php echo  $row['credit_limit'];?>">
</div>
</div>
<input type="button" class="btn btn-primary" name="update" onclick="passwordrecovery_edit5()" value="Update">
</form>
    <?php } ?>
</div>
<script>

function back()
{
password_form()
}

function passwordrecovery_edit()
    {
    var id=$('#get_id').val();
	alert(id);
    var data = $('form').serialize();
    $.ajax({
    type:'GET',
    data:"id="+id, data,
  url:"HRMS/password/password_form/password_recovery_update.php",
    success:function(data)
    {
      if(data==1)
      { 
        alert('Not updated');
      
      }
      else
      {
        alert("Update Successfully");
        password_form()
      }
      
 }       
    });
    }

    function passwordrecovery_edit1()
    {
    var id=$('#get_id').val();
	alert(id);
    var data = $('form').serialize();
    $.ajax({
    type:'GET',
    data:"id="+id, data,
  url:"HRMS/password/password_form/password_recovery_update.php",
    success:function(data)
    {
      if(data==1)
      { 
        alert('Not updated');
      
      }
      else
      {
        alert("Update Successfully");
        password_form()
      }
      
 }       
    });
    }

    function passwordrecovery_edit2()
    {
    var id=$('#get_id').val();
	alert(id);
    var data = $('form').serialize();
    $.ajax({
    type:'GET',
    data:"id="+id, data,
  url:"HRMS/password/password_form/password_recovery_update.php",
    success:function(data)
    {
      if(data==1)
      { 
        alert('Not updated');
      
      }
      else
      {
        alert("Update Successfully");
        password_form()
      }
      
 }       
    });
    }
    function passwordrecovery_edit3()
    {
    var id=$('#get_id').val();
	alert(id);
    var data = $('form').serialize();
    $.ajax({
    type:'GET',
    data:"id="+id, data,
  url:"HRMS/password/password_form/password_recovery_update.php",
    success:function(data)
    {
      if(data==1)
      { 
        alert('Not updated');
      
      }
      else
      {
        alert("Update Successfully");
        password_form()
      }
      
 }       
    });
    }
    function passwordrecovery_edit4()
    {
    var id=$('#get_id').val();
	alert(id);
    var data = $('form').serialize();
    $.ajax({
    type:'GET',
    data:"id="+id, data,
  url:"HRMS/password/password_form/password_recovery_update.php",
    success:function(data)
    {
      if(data==1)
      { 
        alert('Not updated');
      
      }
      else
      {
        alert("Update Successfully");
        password_form()
      }
      
 }       
    });
    }

    function passwordrecovery_edit5()
    {
    var id=$('#get_id').val();
	alert(id);
    var data = $('form').serialize();
    $.ajax({
    type:'GET',
    data:"id="+id, data,
  url:"HRMS/password/password_form/password_recovery_update.php",
    success:function(data)
    {
      if(data==1)
      { 
        alert('Not updated');
      
      }
      else
      {
        alert("Update Successfully");
        password_form()
      }
      
 }       
    });
    }
</script>
