<?php
require '../../../connect.php';
require '../../../user.php';
require 'PHPMailer/PHPMailerAutoload.php';
require 'class/class.phpmailer.php';
include ('pdf.php');
echo $id=$_REQUEST['id'];
$stmt = $con->prepare("SELECT enquiry.id as enquirys_id,enquiry.status as enquiry_status,enquiry.mail as enquiry_mailid,enquiry.*,calls_master.*,z_department_master.*,candidate_form_details.*,quotation.* FROM `enquiry` 
INNER JOIN calls_master ON enquiry.Call_type=calls_master.id 
INNER join z_department_master ON enquiry.Department=z_department_master.id 
INNER JOIN candidate_form_details ON enquiry.employee=candidate_form_details.id
 INNER join quotation ON enquiry.id=quotation.Enquire_id 

where enquiry.id='$id'"); 

$stmt->execute(); 
$row = $stmt->fetch();
?>

<!-- <style>
.row1{
	 border:1px solid black;
}
.row2{
   height: 6px;
}
.table>tbody>tr>th{
	 width:700px;
}
.table-bordered>tbody>tr>td, .table-bordered>tbody>tr>th, .table-bordered>tfoot>tr>td, .table-bordered>tfoot>tr>th, .table-bordered>thead>tr>td, .table-bordered>thead>tr>th {
     padding: 4px;
    border: none;
}

.border>tbody>tr>td, .border>tbody>tr>th, .border>tfoot>tr>td, .border>tfoot>tr>th, .border>thead>tr>td, .border>thead>tr>th {
    
   border :1px  solid  black;
}
.m_b_0px {
	margin-bottom: 0px !important;
}
.container{
	width:500px;
    margin: 0 auto;
    text-align: center;
}
table, th, td {
  border: 1px solid black;
}
</style> -->
<?php 
$pros=$row['proposal'];	
$comp_name=$row['Company_name'];
$Date=$row['Date'];
$Version=$row['Version'];
$first_name=$row['first_name'];
$phone=$row['phone'];
$scope=$row['scope'];
$Proposal_statement=$row['Proposal_statement'];
$Conditions=$row['Conditions'];


 $output= '
 <style>
 .row1{
    border:1px solid black;
}
.row2{
  height: 6px;
}
.table>tbody>tr>th{
    width:700px;
}

.m_b_0px {
   margin-bottom: 0px !important;
}
.container{
   width:500px;
   margin: 0 auto;
   text-align: center;
}
.balance-info .table td,
.balance-info .table th {
    padding: 0;
    border: 0;
}
tr th:first-child,
tr td:first-child {
    text-align: left;
}
table, th, td {
 border: 1px solid black;
}
.bb {
    border-bottom: 3px solid var(--darkWhite);
}


.logo img {
    height: 60px;
    margin-left: 270px;
    margin-top: 30px;
}

thead {
    color: var(--white);
    background: var(--themeColor);
}
#table1, td, th {
    border: 2px solid black;
    font-weight: normal;
    padding: 10px;
  }


#table1 {
    width: 80%;
    margin-left: 70px;
    margin-top: 80px;
    border-collapse: collapse;
  }
  #table2 {
    margin-left:40px
    width: 5%;
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


.h4{
    font-family: initial;
    font-weight: bold;
    margin-top: 45px;
}

/* Footer Section */
footer {
    text-align: center;
    position: absolute;
    bottom: 3px;
    left: 35px;
}

// footer hr {
//     margin-bottom: -22px;
//     border-top: 3px solid var(--darkWhite);
// }

// footer a {
//     color: var(--themeColor);
// }

// footer p {
//     padding: 6px;
//     border: 3px solid var(--darkWhite);
//     background-color: var(--white);
//     display: inline-block;
// }
</style>
 
 <div class="my-5 page" size="A4">
        <div class="p-5">
            <section class="store-user mt-5">
                <div align="center">
                    <h4 class="h4" style="font-size:30px;"> Proposal for </h4>
                    <h4 class="h4" style="font-size:30px;">'.$pros.'</h4>
                    <h4 class="h4" style="font-size:30px;">by</h4>
                </div>
                <div class="logo">
               <img src="../../Recruitment/image/userlog/bluebase1.png" alt="quadsel" style="margin-left: 270px;"><br/></br>
                </div>
            </section>

            <section class="product-area mt-4">
                <table id="table1">
                    <tr>
					
                        <th>Document Type</th>
						
                        <th>Proposal for<b> '.$pros.'</b></th>
                    </tr>
                    <tr>
                        <td>Customer</td>
                        <td>'.$comp_name.'</td>
                    </tr>
                    <tr>
                        <td>Document Owner</td>
                        <td>BLUEBASE SOFTWARE SERVICES PRIVATE LIMITED,
                            Chennai, India</td>
                    </tr>
                    <tr>
                        <td>Document Date & Version</td>
                        <td>'.$Date.'&nbsp;&nbsp;|&nbsp;&nbsp;'.$Version.'
                        </td>
                    </tr>
                    <tr>
                        <td> Contact Person</td>
                         <td>'.$first_name.'&nbsp;&nbsp;|&nbsp;&nbsp;'.$phone.'
                        </td>
                    </tr>
                </table>
            </section>
          <!--  <footer>
                   <div class="social pt-3">
                        <h5
                            style="font-size: 0.9rem;font-weight: normal;color: #cecaca;font-family: initial;font-style: italic;">
                            BLUEBASE
                            SOFTWARE SERVICES PRIVATE LIMITED
                            <br/>
                            No 118,
                            Annasalai, Manikkam, Guindy, Chennai -
                            600032
                            <br/>
                            Phone: +91 44
                            22502277<a href="https://www.bluebase.in">&nbsp;&nbsp;&nbsp;www.bluebase.in</a>
                        </h5>
                    </div>
                </footer>-->
        </div>
    </div>';

    $output.='<div class="my-5 page" size="A4">
        <div class="p-5">
            <section style="margin-top: 250px;">
                <p style="font-weight: bold;font-family: initial;font-size: 20px;">Table of Contents</p>
               
				<ul style="font-family: initial;">
                <li>Introduction
                </li>
                <li>Scope Statement
                </li>
                <li>Proposal
                </li>
                <li>Commercials
                </li>
                <li>Terms & Conditions
                </li>
            </ul>
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
                <!--<footer>
                <div class="social pt-3">
                     <h5
                         style="font-size: 0.9rem;font-weight: normal;color: #cecaca;font-family: initial;font-style: italic;">
                         BLUEBASE
                         SOFTWARE SERVICES PRIVATE LIMITED
                         <br/>
                         No 118,
                         Annasalai, Manikkam, Guindy, Chennai -
                         600032
                         <br/>
                         Phone: +91 44
                         22502277<a href="https://www.bluebase.in">&nbsp;&nbsp;&nbsp;www.bluebase.in</a>
                     </h5>
                 </div>
             </footer>-->
        </div>
    </div>';

	 $output.='<div class="my-5 page" size="A4"">
        <div class="p-5">
            <section>
                <div style="font-weight: bold;font-family: initial;font-size: 20px;background-color: #f7f3f3;">
                    Scope Statement
                </div>
            </section>
            </br>
            
            <ul style="font-family: initial;">
                '.$scope.'
                
            </ul>
            
           
           <!-- <footer>
            <div class="social pt-3">
                 <h5
                     style="font-size: 0.9rem;font-weight: normal;color: #cecaca;font-family: initial;font-style: italic;">
                     BLUEBASE
                     SOFTWARE SERVICES PRIVATE LIMITED
                     <br/>
                     No 118,
                     Annasalai, Manikkam, Guindy, Chennai -
                     600032
                     <br/>
                     Phone: +91 44
                     22502277<a href="https://www.bluebase.in">&nbsp;&nbsp;&nbsp;www.bluebase.in</a>
                 </h5>
             </div>
         </footer>-->
        </div>
    </div>';
	
	 $output.='<div class="my-5 page" size="A4"">
        <div class="p-5">
        <section>
        <div style="font-weight: bold;font-family: initial;font-size: 20px;background-color: #f7f3f3;">
        Proposal - Bluebase Software Services Private Limited
		
    </div>
 
      </section>
		 <p style="font-family: initial;">'.$Proposal_statement.'
    </p>
            <p style="font-family: initial;">
            </p>
       
            <section class="product-area mt-4">
            <div style="font-weight: bold;font-family: initial;font-size: 20px;background-color: #f7f3f3;margin-bottom: 30px;">
            Commercials
        </div>
            ';
            
			$ph=$con->query("SELECT * FROM `cost_sheet_entry` INNER JOIN cost_totl ON cost_sheet_entry.enquiry_id = cost_totl.enquiries_id WHERE cost_sheet_entry.enquiry_id='$id' AND cost_sheet_entry.Phases='1' AND cost_totl.Phases='1'");
			
$ph->execute(); 
$row_ph = $ph->fetch();
if($row_ph['Phases']==1){

			$output.='<h3>Phase 1</h3>
			<table id="table2">
<tr>
<th><b>S.NO</b></th>
<th><b>Specification</b></th>

<th><b>Net Amount in INR<b></th>
</tr>

<tbody>';



$sql_1=$con->query("SELECT * FROM `cost_sheet_entry` INNER JOIN cost_totl ON cost_sheet_entry.enquiry_id = cost_totl.enquiries_id WHERE cost_sheet_entry.enquiry_id='$id' AND cost_sheet_entry.Phases='1' AND cost_totl.Phases='1'");


$cnt=1;
while($rows_1 = $sql_1->fetch(PDO::FETCH_ASSOC))

{

if( $rows_1['Phases']==1){
echo "hai";
$enq_id=$rows_1['enquiry_id'];

$Specification=$rows_1['Specification'];
$Hours=$rows_1['Hours/Days'];
$Amount=$rows_1['Amount'];
$output.='<tr>
<input type="hidden" class="form-control" id="get_id" name="get_id" value="'.$enq_id.'">

<td>'.$cnt.'</td>
<td style="width:300px !important;">'.$Specification.'</td>

<td align="right">'.$Amount.'</td>
</tr>';
}

$cnt=$cnt+1;
}
 
$sqlquery_1=$con->query("SELECT * FROM `cost_sheet_entry` INNER JOIN cost_totl ON cost_sheet_entry.enquiry_id = cost_totl.enquiries_id WHERE cost_sheet_entry.enquiry_id='$id' AND cost_sheet_entry.Phases='1' AND cost_totl.Phases='1'");

$sqlquery_1->execute(); 
$sqlquery_1row = $sqlquery_1->fetch();

 if( $sqlquery_1row['Phases']==1){
$total=$sqlquery_1row['total'];
$output.='<tr>


<td colspan="2"><center><b>Total</b></center></td><td align="right" colspan="1">'.$total.'</td>
</tr>
<tr>

<td colspan="2"><center><b>GST</b></center></td><td align="right" colspan="1">18%</td>
</tr>';

$gst=$sqlquery_1row['total']*18/100;
$grant_total=$gst+$sqlquery_1row['total'];

$output.='<tr>

<td colspan="2"><center><b>Grand Total</b></center></td><td align="right" colspan="1">'.$grant_total.'</td>
</tr>';
 }
$output.='</tbody>
</table><br/>';
}

$ph=$con->query("SELECT * FROM `cost_sheet_entry` INNER JOIN cost_totl ON cost_sheet_entry.enquiry_id = cost_totl.enquiries_id WHERE cost_sheet_entry.enquiry_id='$id' AND cost_sheet_entry.Phases='2' AND cost_totl.Phases='2'");
			
$ph->execute(); 
$row_ph = $ph->fetch();
if($row_ph['Phases']==2){

			$output.='<h3>Phase 2</h3>
			<table id="table2">
<tr>
<th><b>S.NO</b></th>
<th><b>Specification</b></th>

<th><b>Net Amount in INR<b></th>
</tr>

<tbody>';



$sql_1=$con->query("SELECT * FROM `cost_sheet_entry` INNER JOIN cost_totl ON cost_sheet_entry.enquiry_id = cost_totl.enquiries_id WHERE cost_sheet_entry.enquiry_id='$id' AND cost_sheet_entry.Phases='2' AND cost_totl.Phases='2'");


$cnt=1;
while($rows_1 = $sql_1->fetch(PDO::FETCH_ASSOC))

{

if( $rows_1['Phases']==2){
echo "hai";
$enq_id=$rows_1['enquiry_id'];

$Specification=$rows_1['Specification'];
$Hours=$rows_1['Hours/Days'];
$Amount=$rows_1['Amount'];
$output.='<tr>
<input type="hidden" class="form-control" id="get_id" name="get_id" value="'.$enq_id.'">

<td>'.$cnt.'</td>
<td style="width:300px !important;">'.$Specification.'</td>

<td align="right">'.$Amount.'</td>
</tr>';
}

$cnt=$cnt+1;
}
 
$sqlquery_1=$con->query("SELECT * FROM `cost_sheet_entry` INNER JOIN cost_totl ON cost_sheet_entry.enquiry_id = cost_totl.enquiries_id WHERE cost_sheet_entry.enquiry_id='$id' AND cost_sheet_entry.Phases='2' AND cost_totl.Phases='2'");

$sqlquery_1->execute(); 
$sqlquery_1row = $sqlquery_1->fetch();

 if( $sqlquery_1row['Phases']==2){
$total=$sqlquery_1row['total'];
$output.='<tr>


<td colspan="2"><center><b>Total</b></center></td><td align="right" colspan="1">'.$total.'</td>
</tr>
<tr>

<td colspan="2"><center><b>GST</b></center></td><td align="right" colspan="1">18%</td>
</tr>';

$gst=$sqlquery_1row['total']*18/100;
$grant_total=$gst+$sqlquery_1row['total'];

$output.='<tr>

<td colspan="2"><center><b>Grand Total</b></center></td><td align="right" colspan="1">'.$grant_total.'</td>
</tr>';
 }
$output.='</tbody>
</table><br/>';
}
$ph=$con->query("SELECT * FROM `cost_sheet_entry` INNER JOIN cost_totl ON cost_sheet_entry.enquiry_id = cost_totl.enquiries_id WHERE cost_sheet_entry.enquiry_id='$id' AND cost_sheet_entry.Phases='3' AND cost_totl.Phases='3'");
			
$ph->execute(); 
$row_ph = $ph->fetch();
if($row_ph['Phases']==3){

			$output.='<h3>Phase 3</h3>
			<table id="table2">
<tr>
<th><b>S.No</b></th>
<th><b>Specification</b></th>

<th><b>Net Amount in INR<b></th>
</tr>

<tbody>';



$sql_1=$con->query("SELECT * FROM `cost_sheet_entry` INNER JOIN cost_totl ON cost_sheet_entry.enquiry_id = cost_totl.enquiries_id WHERE cost_sheet_entry.enquiry_id='$id' AND cost_sheet_entry.Phases='3' AND cost_totl.Phases='3'");


$cnt=1;
while($rows_1 = $sql_1->fetch(PDO::FETCH_ASSOC))

{

if( $rows_1['Phases']==3){
echo "hai";
$enq_id=$rows_1['enquiry_id'];

$Specification=$rows_1['Specification'];
$Hours=$rows_1['Hours/Days'];
$Amount=$rows_1['Amount'];
$output.='<tr>
<input type="hidden" class="form-control" id="get_id" name="get_id" value="'.$enq_id.'">

<td>'.$cnt.'</td>
<td style="width:300px !important;">'.$Specification.'</td>

<td align="right">'.$Amount.'</td>
</tr>';
}

$cnt=$cnt+1;
}
 
$sqlquery_1=$con->query("SELECT * FROM `cost_sheet_entry` INNER JOIN cost_totl ON cost_sheet_entry.enquiry_id = cost_totl.enquiries_id WHERE cost_sheet_entry.enquiry_id='$id' AND cost_sheet_entry.Phases='3' AND cost_totl.Phases='3'");

$sqlquery_1->execute(); 
$sqlquery_1row = $sqlquery_1->fetch();

 if( $sqlquery_1row['Phases']==3){
$total=$sqlquery_1row['total'];
$output.='<tr>


<td colspan="2"><center><b>Total</b></center></td><td align="right" colspan="1">'.$total.'</td>
</tr>
<tr>

<td colspan="2"><center><b>GST</b></center></td><td align="right" colspan="1">18%</td>
</tr>';

$gst=$sqlquery_1row['total']*18/100;
$grant_total=$gst+$sqlquery_1row['total'];

$output.='<tr>

<td colspan="2"><center><b>Grand Total</b></center></td><td align="right" colspan="1">'.$grant_total.'</td>
</tr>';
 }
$output.='</tbody>
</table><br/>';
}
       $ph=$con->query("SELECT * FROM `cost_sheet_entry` INNER JOIN cost_totl ON cost_sheet_entry.enquiry_id = cost_totl.enquiries_id WHERE cost_sheet_entry.enquiry_id='$id' AND cost_sheet_entry.Phases='4' AND cost_totl.Phases='4'");
			
$ph->execute(); 
$row_ph = $ph->fetch();
if($row_ph['Phases']==4){

			$output.='<h3>Phase 4</h3>
			<table id="table2">
<tr>

<th><b>S.No</b></th>
<th><b>Specification</b></th>

<th><b>Net Amount in INR<b></th>
</tr>

<tbody>';



$sql_1=$con->query("SELECT * FROM `cost_sheet_entry` INNER JOIN cost_totl ON cost_sheet_entry.enquiry_id = cost_totl.enquiries_id WHERE cost_sheet_entry.enquiry_id='$id' AND cost_sheet_entry.Phases='4' AND cost_totl.Phases='4'");


$cnt=1;
while($rows_1 = $sql_1->fetch(PDO::FETCH_ASSOC))

{

if( $rows_1['Phases']==4){
echo "hai";
$enq_id=$rows_1['enquiry_id'];

$Specification=$rows_1['Specification'];
$Hours=$rows_1['Hours/Days'];
$Amount=$rows_1['Amount'];
$output.='<tr>
<input type="hidden" class="form-control" id="get_id" name="get_id" value="'.$enq_id.'">

<td>'.$cnt.'</td>
<td style="width:300px !important;">'.$Specification.'</td>

<td align="right">'.$Amount.'</td>
</tr>';
}

$cnt=$cnt+1;
}
 
$sqlquery_1=$con->query("SELECT * FROM `cost_sheet_entry` INNER JOIN cost_totl ON cost_sheet_entry.enquiry_id = cost_totl.enquiries_id WHERE cost_sheet_entry.enquiry_id='$id' AND cost_sheet_entry.Phases='4' AND cost_totl.Phases='4'");

$sqlquery_1->execute(); 
$sqlquery_1row = $sqlquery_1->fetch();

 if( $sqlquery_1row['Phases']==4){
$total=$sqlquery_1row['total'];
$output.='<tr>


<td colspan="2"><center><b>Total</b></center></td><td align="right" colspan="1">'.$total.'</td>
</tr>
<tr>

<td colspan="2"><center><b>GST</b></center></td><td align="right" colspan="1">18%</td>
</tr>';

$gst=$sqlquery_1row['total']*18/100;
$grant_total=$gst+$sqlquery_1row['total'];

$output.='<tr>

<td colspan="2"><center><b>Grand Total</b></center></td><td align="right" colspan="1">'.$grant_total.'</td>
</tr>';
 }
$output.='</tbody>
</table><br/>';
}    

$ph=$con->query("SELECT * FROM `cost_sheet_entry` INNER JOIN cost_totl ON cost_sheet_entry.enquiry_id = cost_totl.enquiries_id WHERE cost_sheet_entry.enquiry_id='$id' AND cost_sheet_entry.Phases='5' AND cost_totl.Phases='5'");
			
$ph->execute(); 
$row_ph = $ph->fetch();
if($row_ph['Phases']==5){

			$output.='<h3>Phase 4</h3>
			<table id="table2">
<tr>
<th><b>S.no</b></th>
<th><b>Specification</b></th>

<th><b>Net Amount in INR<b></th>
</tr>

<tbody>';



$sql_1=$con->query("SELECT * FROM `cost_sheet_entry` INNER JOIN cost_totl ON cost_sheet_entry.enquiry_id = cost_totl.enquiries_id WHERE cost_sheet_entry.enquiry_id='$id' AND cost_sheet_entry.Phases='5' AND cost_totl.Phases='5'");


$cnt=1;
while($rows_1 = $sql_1->fetch(PDO::FETCH_ASSOC))

{

if( $rows_1['Phases']==5){
echo "hai";
$enq_id=$rows_1['enquiry_id'];

$Specification=$rows_1['Specification'];
$Hours=$rows_1['Hours/Days'];
$Amount=$rows_1['Amount'];
$output.='<tr>
<input type="hidden" class="form-control" id="get_id" name="get_id" value="'.$enq_id.'">

<td>'.$cnt.'</td>
<td style="width:300px !important;">'.$Specification.'</td>

<td align="right">'.$Amount.'</td>
</tr>';
}

$cnt=$cnt+1;
}
 
$sqlquery_1=$con->query("SELECT * FROM `cost_sheet_entry` INNER JOIN cost_totl ON cost_sheet_entry.enquiry_id = cost_totl.enquiries_id WHERE cost_sheet_entry.enquiry_id='$id' AND cost_sheet_entry.Phases='5' AND cost_totl.Phases='5'");

$sqlquery_1->execute(); 
$sqlquery_1row = $sqlquery_1->fetch();

 if( $sqlquery_1row['Phases']==5){
$total=$sqlquery_1row['total'];
$output.='<tr>


<td colspan="2"><center><b>Total</b></center></td><td align="right" colspan="1">'.$total.'</td>
</tr>
<tr>

<td colspan="2"><center><b>GST</b></center></td><td align="right" colspan="1">18%</td>
</tr>';

$gst=$sqlquery_1row['total']*18/100;
$grant_total=$gst+$sqlquery_1row['total'];

$output.='<tr>

<td colspan="2"><center><b>Grand Total</b></center></td><td align="right" colspan="1">'.$grant_total.'</td>
</tr>';
 }
$output.='</tbody>
</table><br/>';
}   
          $output.='</section>
            <div style="font-weight: bold;font-family: initial;font-size: 20px;background-color: #f7f3f3;">
                Terms & Conditions
            </div>
            <ol style="font-family: initial;">
                
                '.$Conditions.'
               
                
            </ol>
          <!--<footer>
               <div class="social pt-3">
                 <h5
                     style="font-size: 0.9rem;font-weight: normal;color: #cecaca;font-family: initial;font-style: italic;">
                     BLUEBASE
                     SOFTWARE SERVICES PRIVATE LIMITED
                     <br/>
                     No 118,
                     Annasalai, Manikkam, Guindy, Chennai -
                     600032
                     <br/>
                     Phone: +91 44
                     22502277<a href="https://www.bluebase.in">&nbsp;&nbsp;&nbsp;www.bluebase.in</a>
                 </h5>
             </div>
            </footer>-->
        </div>
    </div>';
	  

   




	 
	$file_name = md5(rand()) . '.pdf';
	$html_code = '<link rel="stylesheet" href="bootstrap.min.css">';
	
	
	

	$pdf = new Pdf();
	$pdf->setPaper('A4', 'portrait');
	$pdf->load_html($output);
	$pdf->render();
	$file = $pdf->output();
	
	file_put_contents($file_name, $file);
	
	//require 'class/class.phpmailer.php';
	

	$mail = new PHPMailer;	
	$mail->SMTPDebug = 3; 
	$mail->IsSMTP(true);								//Sets Mailer to send message using SMTP
	$mail->Host = 'smtp.zoho.com';		//Sets the SMTP hosts of your Email hosting, this for Godaddy
	$mail->Port = '465';								//Sets the default SMTP server port
	$mail->SMTPAuth = true;							//Sets SMTP authentication. Utilizes the Username and Password variables
	$mail->Username = 'preethi@bluebase.in';
	$mail->Password = 'Aathi@2427';					//Sets SMTP password
	$mail->SMTPSecure = 'ssl';							//Sets connection prefix. Options are "", "ssl" or "tls"
	$mail->From = 'preethi@bluebase.in';			//Sets the From email address for the message
	 $mail->FromName = 'Test';			//Sets the From name of the message
	 $mail->AddAddress('gobinath.p@bluebase.in');		//Adds a "To" address
		
	$mail->WordWrap = 50;							//Sets word wrapping on the body of the message to a given number of characters
	$mail->IsHTML(true);							//Sets message type to HTML				
	$mail->AddAttachment($file_name);     				//Adds an attachment from a path on the filesystem
    $mail->Subject = 'Quote / Proposal ';			//Sets the Subject of the message
	$mail->Body = 'Please Find Quote / Proposal Report in attach PDF File.';				//An HTML or plain text message body
	
	
	if(!$mail->send()) {
       echo 'Message could not be sent.';
       echo 'Mailer Error: ' . $mail->ErrorInfo;
	   echo "0";
   } 
    else {
         $message = '<label class="text-success">Quote Details has been send Successfully...</label>';
	   
	
	}
	unlink($file_name);


     $mail->clearAttachments(); 
?>