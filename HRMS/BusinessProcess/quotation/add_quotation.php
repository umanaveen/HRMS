<?php
require '../../../connect.php';
require '../../../user.php';
$candidateid=$_SESSION['candidateid'];
$userrole=$_SESSION['userrole'];
$id=$_REQUEST['id'];
$stmt = $con->prepare("SELECT enquiry.id as enquirys_id,enquiry.status as enquiry_status,enquiry.mail as enquiry_mailid,enquiry.*,calls_master.*,z_department_master.*,candidate_form_details.*,quotation.* FROM `enquiry` 
INNER JOIN calls_master ON enquiry.Call_type=calls_master.id 
INNER join z_department_master ON enquiry.Department=z_department_master.id 
INNER JOIN candidate_form_details ON enquiry.employee=candidate_form_details.id
 INNER join quotation ON enquiry.id=quotation.Enquire_id
  

where enquiry.id='$id'"); 

$stmt->execute(); 
$row = $stmt->fetch();
?>
<style>


.bb {
    border-bottom: 3px solid var(--darkWhite);
}

/* Top Section */
.top-content {
    padding-bottom: 15px;
}

.logo img {
    height: 60px;
    margin-left: 320px;
    margin-top: 30px;
}

.top-left p {
    margin: 0;
}

.top-left .graphic-path {
    height: 40px;
    position: relative;
}

.top-left .graphic-path::before {
    content: "";
    height: 20px;
    background-color: var(--dark);
    position: absolute;
    left: 15px;
    right: 0;
    top: -15px;
    z-index: 2;
}

.top-left .graphic-path::after {
    content: "";
    height: 22px;
    width: 17px;
    background: var(--black);
    position: absolute;
    top: -13px;
    left: 6px;
    transform: rotate(45deg);
}

.top-left .graphic-path p {
    color: var(--white);
    height: 40px;
    left: 0;
    right: -100px;
    text-transform: uppercase;
    background-color: var(--themeColor);
    font: 26px;
    z-index: 3;
    position: absolute;
    padding-left: 10px;
}

/* User Store Section */
.store-user {
    padding-bottom: 25px;
    margin-top: 130px !important;
}

.store-user p {
    margin: 0;
    font-weight: 600;
}

.store-user .address {
    font-weight: 400;
}

.store-user h2 {
    color: var(--themeColor);
    font-family: 'Rajdhani', sans-serif;
}

.extra-info p span {
    font-weight: 400;
}

/* Product Section */
thead {
    color: var(--white);
    background: var(--themeColor);
}
#table1, td, th {
    border: 2px solid black;
    font-weight: normal;
    padding: 10px;
  }

/* .table td,
.table th {
    text-align: center;
    vertical-align: middle;
} */

#table1 {
    width: 80%;
    margin-left: 70px;
    margin-top: 80px;
    border-collapse: collapse;
  }
  #table2 {
    width: 80%;
    margin-left: 70px;
    border-collapse: collapse;
  }
  #table2, td, th {
    border: 1px solid black;
  }
  #table2, th {
   font-weight: bold;
  }
tr th:first-child,
tr td:first-child {
    text-align: left;
}

.media img {
    height: 60px;
    width: 60px;
}

.media p {
    font-weight: 400;
    margin: 0;
}

.media p.title {
    font-weight: 600;
}

/* Balance Info Section */
.balance-info .table td,
.balance-info .table th {
    padding: 0;
    border: 0;
}

.balance-info tr td:first-child {
    font-weight: 600;
}

tfoot {
    border-top: 2px solid var(--darkWhite);
}

tfoot td {
    font-weight: 600;
}

/* Cart BG */
.cart-bg {
    height: 250px;
    bottom: 32px;
    left: -40px;
    opacity: 0.3;
    position: absolute;
}

/* Footer Section */
/* footer {
    text-align: center;
    position: absolute;
    bottom: 30px;
    left: 535px;
}

footer hr {
    margin-bottom: -22px;
    border-top: 3px solid var(--darkWhite);
}

footer a {
    color: var(--themeColor);
}

footer p {
    padding: 6px;
    border: 3px solid var(--darkWhite);
    background-color: var(--white);
    display: inline-block;
} */



.h4{
    font-family: initial;
    font-weight: bold;
    margin-top: 45px;
}
</style>
<div  class="card card-primary">
<div class="card-header">
<h3 class="card-title"><font size="5"><center><b>Quotation</b></center></font></h3>
<a onclick="return back_ctc()" style="float: right;" data-toggle="modal" class="btn btn-danger"></i>Back</a>
</div>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <!-- Custom Style -->
    <link rel="stylesheet" href="style.css">

    <title>Invoice..!</title>
</head>
<form>
<body>
    <div class="my-5 page" size="A4">
        <div class="p-5">
            <section class="store-user mt-5">
                <div align="center">
                    <h4 class="h4"> Proposal for </h4>
                    <h4 class="h4"><?php echo  $row['proposal'];?></h4>
                    <h4 class="h4">by</h4>
                </div>
                <div class="logo">
                <img src="/HRMS/HRMS/Recruitment/image/userlog/bluebase.png"  style="width:300px;height:150px;">
                </div>
            </section>

            <section class="product-area mt-4">
			<p style="font-weight: bold;font-family: initial;font-size: 20px;">proposal</p>
                <table id="table1">
                    <tr>
					<input type="hidden" class="form-control" id="get_id" name="get_id" value="<?php echo $id; ?>">
                        <th>Document Type</th>
                        <th>Proposal for<b> <?php echo  $row['proposal'];?></b></th>
                    </tr>
                    <tr>
                        <td>Customer</td>
                        <td><?php echo  $row['Company_name'];?></td>
                    </tr>
                    <tr>
                        <td>Document Owner</td>
                        <td>BLUEBASE SOFTWARE SERVICES PRIVATE LIMITED,
                            Chennai, India</td>
                    </tr>
                    <tr>
                        <td>Document Date & Version</td>
                        <td><?php echo  $row['Date'];?>&nbsp;&nbsp;||&nbsp;&nbsp;<?php echo  $row['Version'];?>
                        </td>
                    </tr>
                    <tr>
                        <td> Contact Person</td>
                        <td><?php echo  $row['Client'];?>&nbsp;&nbsp;||&nbsp;&nbsp;<?php echo  $row['Mobile'];?></td>
                    </tr>
                </table>
            </section>
        </div>
    </div>

    <div class="my-5 page" size="A4">
        <div class="p-5">
            <section style="margin-top: 50px;">
                <p style="font-weight: bold;font-family: initial;font-size: 20px;">Table of Contents</p>
                <h6 style="font-family: initial;">Introduction</br>
                    Scope Statement</br>
                    Proposal</br>
                    Commercials</br>
                    Terms & Conditions
                </h6>
            </section>
            <div style="font-weight: bold;font-family: initial;font-size: 20px;background-color: #f7f3f3;">
                INTRODUCTION</div>
            </br>
            <div style="font-weight: bold;font-family: initial;font-size: 20px;background-color: #f7f3f3;">About
                Bluebase Software Services Private Limited
            </div>
            </br>
            <p style="font-family: initial;">Bluebase Software Services Private Limited is the software services group
                of Quadsel Systems
                Private Limited.</p>

            <p style="font-family: initial;">Bluebase Software Services Private Limited is a Chennai based IT Software
                Services Company
                with capabilities on business intelligence and data analytics solutions using Open Source
                technologies. Bluebase Software Services Private Limited also builds and develops Website,
                Mobile Applications on Android, iOS platforms and does SEO / SMO.
            </p>
            <p style="font-family: initial;">Bluebase Software Services Private Limited operates with a vision to create
                products and
                services that add value to Business and improve Process Efficiency.
            </p>

            <div style="font-weight: bold;font-family: initial;font-size: 20px;background-color: #f7f3f3;">
                About Bluebase Software services Pvt Ltd
            </div>
            </br>
            <p style="font-family: initial;">Bluebase Software services Pvt Ltd (ISO 9001:2008 & ISO 27001:2013 Certified
                Company) is a
                recognized leader in designing and implementing comprehensive IT infrastructure solutions
                with cutting edge technologies over twenty (20) years for customers across multiple verticals in
                India.</p>
            <p style="font-family: initial;">Bluebase Software services Pvt Ltd is a</p>

            <ul style="font-family: initial;">
                <li>Hewlett Packard (HP) Gold Partner
                </li>
                <li>Hewlett Packard (HP) Service One Partner
                </li>
                <li>Microsoft Gold Partner
                </li>
                <li>VMware Enterprise Partner
                </li>
                <li>Dell Enterprise Partner
                </li>
            </ul>
            <p style="font-family: initial;">The software arm, Bluebase, was started to meet the needs of Quadsel’s
                esteemed customers for
                cost effective, open source based software and customized software. Our Clients include, MRF,
                UCO Bank, Zoho, Sundaram Clayton, Petrofac, DP World, Toshiba etc. </p>
            <!-- <footer>
                <div class="social pt-3">
                    <h5
                        style="font-size: 0.9rem;font-weight: normal;color: #cecaca;font-family: initial;font-style: italic;">
                        BLUEBASE
                        SOFTWARE SERVICES PRIVATE LIMITED
                    </h5>
                    <h6
                        style="font-weight: normal;font-size: 0.8rem;color: #cecaca;font-family: initial;font-style: italic;">
                        No 118,
                        Annasalai, Manikkam, Guindy, Chennai -
                        600032
                    </h6>
                    <h6
                        style="font-weight: normal;font-size: 0.8rem;color: #cecaca;font-family: initial;font-style: italic;">
                        Phone: +91 44
                        22502277<a href="https://www.bluebase.in">&nbsp;&nbsp;&nbsp;www.bluebase.in</a></h6>
                </div>
            </footer> -->
        </div>
    </div>

    <div class="my-5 page" size="A4">
        <div class="p-5">
            <section style="margin-top: 50px;">
                <div style="font-weight: bold;font-family: initial;font-size: 20px;background-color: #f7f3f3;">
                    Scope Statement
                </div>
            </section>
            </br>
            <p style="font-weight: bold;font-family: initial;font-size: 18px;">To achieve the following objectives:</p>
            <ul style="font-family: initial;">
                <li>  <?php echo  $row['scope'];?></li>
                
            </ul>
           
           
            <div style="font-weight: bold;font-family: initial;font-size: 20px;background-color: #f7f3f3;">
                Proposal - Bluebase Software Services Private Limited
            </div>
            <p style="font-family: initial;">  <li>  <?php echo  $row['Proposal_statement'];?></li>
            </p>
            
         
			
            <!-- <footer>
                <div class="social pt-3">
                    <h5
                        style="font-size: 0.9rem;font-weight: normal;color: #cecaca;font-family: initial;font-style: italic;">
                        BLUEBASE
                        SOFTWARE SERVICES PRIVATE LIMITED
                    </h5>
                    <h6
                        style="font-weight: normal;font-size: 0.8rem;color: #cecaca;font-family: initial;font-style: italic;">
                        No 118,
                        Annasalai, Manikkam, Guindy, Chennai -
                        600032
                    </h6>
                    <h6
                        style="font-weight: normal;font-size: 0.8rem;color: #cecaca;font-family: initial;font-style: italic;">
                        Phone: +91 44
                        22502277<a href="https://www.bluebase.in">&nbsp;&nbsp;&nbsp;www.bluebase.in</a></h6>
                </div>
            </footer> -->
        </div>
    </div>

    <div class="my-5 page" size="A4">
        <div class="p-5">
           
            <div style="font-weight: bold;font-family: initial;font-size: 20px;background-color: #f7f3f3;">
                Commercials
            </div>
            <section class="product-area mt-4">
			<?php
$ph1=$con->query("SELECT * FROM `cost_sheet_entry` INNER JOIN cost_totl ON cost_sheet_entry.enquiry_id = cost_totl.enquiries_id WHERE cost_sheet_entry.enquiry_id='$id' AND cost_sheet_entry.Phases='1' AND cost_totl.Phases='1'");
$ph1->execute(); 
$row_ph1 = $ph1->fetch();
?>
<?php if( $row_ph1['Phases']==1){
?>
<table class="table table-bordered">




<td><b>Phases</b></td>
<td><b>Specification</b></td>
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
<td><b>Specification</b></td>
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
<td><b>Specification</b></td>
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
<td><b>Specification</b></td>
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
<td><b>Specification</b></td>
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
<td>Phases</td>
<td><input type="text" class="form-control" id="phase" name="phase" value="<?php echo  $rows_1['Phases']; ?>" readonly></td>
<td>Specification</td><td colspan="1"><input type="text" class="form-control" id="Task" name="Task" value="<?php echo  $rows_1['Specification']; ?>" readonly></td>
<td>Man/hours</td><td colspan="1"><input type="text" class="form-control" id="unit" name="unit" value="<?php echo  $rows_1['day']; ?>" readonly></td>
<td>Amount</td><td colspan="1"><input type="text" class="form-control" id="amt" name="amt" value="<?php echo  $rows_1['Amount']; ?>" readonly></td>
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
<?php } ?>

<br>
<br>

<br>
<br>
              
            </section>
            <div style="font-weight: bold;font-family: initial;font-size: 20px;background-color: #f7f3f3;">
                Terms & Conditions
            </div>
            <ol style="font-family: initial;">
                <li><?php echo  $row['Conditions'];?>
                </li>
               
            </ol>
            
        </div>
    </div>
</body>
<td>	
<center>			
<button style="margin-left:400px;" class="btn btn-danger" data-id="<?php echo $row['enquirys_id']; ?>" onclick="send_mail(<?php echo $row['enquirys_id']; ?>)"></i>SEND MAIL</button>
				
</center>
	</td>
</form>
</html>



</div>

<script>



	
  function send_mail(v){
	  alert(v);
	$.ajax({
	type:"POST",
	url:"HRMS/BusinessProcess/quotation/sendmail.php?id="+v,
	success:function(data)
	{
		$("#main_content").html(data);
	}
	})
} 
 /* function send_mail()
    {
    var id=$('#get_id').val();
	alert(id);
    var data = $('form').serialize();
    $.ajax({
    type:'GET',
    data:"id="+id, data,
    url:"HRMS/BusinessProcess/quotation/sendmail.php?get_id="+id,
    success:function(data)
    {
      /* if(data==1)
      { 
        alert('Not updated');
      
      }
      else
      {
        alert("Update Successfully");
		user_role()
      } 
      
    }       
    });
    } */
  
</script>


