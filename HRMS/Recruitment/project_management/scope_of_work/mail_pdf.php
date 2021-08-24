<?php
require '../../../connect.php';
require '../../../user.php';
require 'PHPMailer/PHPMailerAutoload.php';
require 'class/class.phpmailer.php';
include ('pdf.php');

//$file_name = md5(rand()) . '.pdf';
$costsheet_id = $_REQUEST['id'];

$count = sizeof($costsheet_id);


// Create a function for converting the amount in words
function AmountInWords($amount)
{
   $amount_after_decimal = round($amount - ($num = floor($amount)), 2) * 100;
   // Check if there is any number after decimal
   $amt_hundred = null;
   $count_length = strlen($num);
   $x = 0;
   $string = array();
   $change_words = array(0 => '', 1 => 'One', 2 => 'Two',
     3 => 'Three', 4 => 'Four', 5 => 'Five', 6 => 'Six',
     7 => 'Seven', 8 => 'Eight', 9 => 'Nine',
     10 => 'Ten', 11 => 'Eleven', 12 => 'Twelve',
     13 => 'Thirteen', 14 => 'Fourteen', 15 => 'Fifteen',
     16 => 'Sixteen', 17 => 'Seventeen', 18 => 'Eighteen',
     19 => 'Nineteen', 20 => 'Twenty', 30 => 'Thirty',
     40 => 'Forty', 50 => 'Fifty', 60 => 'Sixty',
     70 => 'Seventy', 80 => 'Eighty', 90 => 'Ninety');
    $here_digits = array('', 'Hundred','Thousand','Lakh', 'Crore');
    while( $x < $count_length ) {
      $get_divider = ($x == 2) ? 10 : 100;
      $amount = floor($num % $get_divider);
      $num = floor($num / $get_divider);
      $x += $get_divider == 10 ? 1 : 2;
      if ($amount) {
       $add_plural = (($counter = count($string)) && $amount > 9) ? 's' : null;
       $amt_hundred = ($counter == 1 && $string[0]) ? ' and ' : null;
       $string [] = ($amount < 21) ? $change_words[$amount].' '. $here_digits[$counter]. $add_plural.' 
       '.$amt_hundred:$change_words[floor($amount / 10) * 10].' '.$change_words[$amount % 10]. ' 
       '.$here_digits[$counter].$add_plural.' '.$amt_hundred;
        }
   else $string[] = null;
   }
   $implode_to_Rupees = implode('', array_reverse($string));
   $get_paise = ($amount_after_decimal > 0) ? "And " . ($change_words[$amount_after_decimal / 10] . " 
   " . $change_words[$amount_after_decimal % 10]) . ' Paise' : '';
   return ($implode_to_Rupees ? $implode_to_Rupees . 'Rupees ' : '') . $get_paise;
}
?>

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
.table-bordered>tbody>tr>td, .table-bordered>tbody>tr>th, .table-bordered>tfoot>tr>td, .table-bordered>tfoot>tr>th, .table-bordered>thead>tr>td, .table-bordered>thead>tr>th {
    padding: 4px;
    /* border: none; */
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
</style>

<?php 
 class fetch_data{
 public $costsheet_id;
	function fetch_quote_data($con,$costsheet_id,$client_name,$QuoteNo){ 
	
$stmt= $con->query("SELECT a.id as costsheet_id,a.*,b.*,e.*,f.*,g.*,h.* from cost_sheet_entry a 
		 inner join client_master b on(b.id=a.client_id) 
		 inner join product_services f on (f.id = a.business_id)
		INNER JOIN staff_master e ON e.candid_id=a.candid_id 
		inner join z_user_master g ON (g.candidate_id = e.id)
		inner join quote_generate h on(h.cost_sheet_no=a.cost_sheet_no)
		where a.id='$costsheet_id'  and a.status ='3' ");
	
		$stmt->execute(); 
		$row        = $stmt->fetch();
		$company_id = $row['company_id'];
		$cost_sheet_no = $row['cost_sheet_no'];
		
		$quote_date = date('d-m-Y', strtotime($row['quote_date']));
		if($row['quote_type']==1){  
		   $currency = "INDIAN RUPEES"; 
		}else{ 
		   $currency = "DOLLAR RUPEES"; 
		}
		$QuoteNo    = $row['quote_no'];
		$quote_type = $row['quote_type'];
	    $design_id  = $row['design_id'];
 $output = '<div style="font-size:15px;font-weight:normal;">
 <table width="710px" style="text-align:left; border: none;">
	<tr><td colspan="5"><img src="../../Recruitment/image/userlog/bluebase.png" alt="quadsel" width=200px; height=100px;><br/></br>
	<div class="container1"> 
	<h4 align="center"><b>QUOTATION</b></h4> </div></td>
	</tr>
	</table>
<TABLE width="710px" style="border: 1px solid black;">
 <tr style="border:1px solid black;"> 
		  <td colspan="3"> <div style="font-weight:bold;font-size:17px;">Bluebase Software services Pvt Ltd</div>
		  <div style="margin-top:5px;font-size:13px;">New No:118,Anna Salai,Manikkam Lane,</div>
		  <div style="font-size:13px;">Guindy,Chennai,Tamil-Nadu 600032</div><br/></td>
		</tr>
		<tr style="border :1px  solid  black;font-size:13px;border-bottom-style: groove ! important;border-bottom: 1px solid black;"> 
		<td height="30px"><div style="float: left;"><div style="float: left;font-weight:bold;">E-Mail : <div style="font-weight:bold;font-size:13px;">Phone No : </div></div><div style="float: left;margin-left:60px;">helpdesk@quadsel.in<div style="font-size:13px;margin-left:30px;">044-28205767</div></div></div></td>
		<td height="40px"><div style="float: right;margin-top:1px;"><div style="float: left;font-weight:bold;">GST NO : <div style="float: left;margin-left:60px;font-weight:normal;">33AAACQ0129P1ZG</div></div></td>	  
		</tr>
		<tr style="border :1px  solid  black;font-size:13px;"> 
		<td><b>Quote.NO : </b>'. $QuoteNo.'<br/><br/>
		
		<b>Date : </b>'. $quote_date.' 
		
		</td>
		<td><b>Ref.No.  : </b>'. $row['quote_no'].'<br/><br/>
		<b>Currency : </b>'. $currency .'
		</td>
		<td><p style="margin-top:-23px;"><b>AcctManager : </b>'. $row['emp_name'].'</p>
		</td>
	 
	  </tr>
	  
	  <tr style="border:1px solid black;border-top-style: hidden;font-size:13px;">
	  <td colspan="3" style="font-size:13px;"><b><u>Client Name & Details : </u></b><br/><br/>
	  <b> Address : </b>'. $row['address1'].','. $row['address2'].',<br/>'. $row['area'].','. $row['town_city'].','. $row['pincode'].',<br/>'. $row['district'].','. $row['state'].','. $row['country'].'</b><br/><br/>
	  <b>Mobile No : </b>'. $row['mobile_no1'].','. $row['mobile_no2'].'<br/><br/>
	  <b>Dear Sir,</b><br/>
		<b> As per your requirement, please find attached below our proposal</b>
	 </td>
	  </tr>
 <table id="dataTable" width="710px"  border="1" style="font-size:13px;border-collapse:collapse;border: 1px solid !important;" class="table border m_b_0px"> 
		 <TR>
			<th>SLNO.</th>
		   <th>SPECIFICATION</th>
		   <th>QTY</th>
		    <th>UNIT</th>
		   <th>UNIT RATE</th>
		   <TH formula="cost*qty" summary="sum">AMOUNT</TH>
		   <th colspan="2">Logistic</th>
		   <th colspan="2">Engineer</th>
		   <th colspan="2">Margin</th>
		   <th>Total Items</th>
		 </TR> ';
		 $query= $con->query("SELECT a.id as costsheet_id,a.*,b.*,e.* from cost_sheet_entry a 
				 inner join client_master b on(b.id=a.client_id) 
				 inner join staff_master e ON e.candid_id=a.candid_id
				 where a.status ='3' and a.cost_sheet_no='$cost_sheet_no' order by a.id desc"); 
		 
		 $sum_total="";
		 $cnt=1;
			 while($quote = $query->fetch(PDO::FETCH_ASSOC)){
		  
			            $net_amt    = $quote['net_amt'];
						//$gst_per    = $quote['gst_per'];
						$gst_amt    = $quote['gst_amt'];
						$grand_total= $quote['grand_amt'];
				 
					//$sum_total+= $quote['total_price'];
					$gst    = $quote['gst_per'];
					$withgst     = ($net_amt)*($gst/100);
					$grand_total = round($withgst+$net_amt);
					
					 
					
					if($gst =='18') {     $SGST_cal  = ($net_amt)*(9/100); 
					}elseif($gst =='28'){ $SGST_cal  = ($net_amt)*(14/100); 
					}else{ $SGST_cal = ($net_amt)*(0/100); }
					
					 if($gst =='18') {     $CGST_cal  = ($net_amt)*(9/100); 
					}elseif($gst =='28'){ $CGST_cal  = ($net_amt)*(14/100); 
					}else{ $CGST_cal = ($net_amt)*(0/100); }
					
					if($gst =='18') {  
					   $sgst_per =  "9 %"; 
					}elseif($gst =='28'){
					   $sgst_per =  "14%"; 
					}
					
					if($gst =='18') {  
					   $cgst_per =  "9 %"; 
					}elseif($gst =='28'){
					   $cgst_per =  "14%"; 
					}
						
					 $tax_amount = $SGST_cal + $CGST_cal;
		 
		 $output .= '<TR>
		   <TD>'. $cnt.'. </TD>
		   <TD> '. $quote['specification'].'</TD>
		   <TD>'. $quote['qty'].'</TD>
		   <TD> '.$quote['unit'].'</TD>
		   <TD> '. $quote['unit_rate'].'</TD>
		   <TD> '. $quote['total_price'].'</TD>
		   
		    <TD> '. $quote['log_per'].'</TD>
			<TD> '. $quote['log_amt'].'</TD>
			<TD> '. $quote['eng_per'].'</TD>
			<TD> '. $quote['eng_amt'].'</TD>
			<TD> '. $quote['com_per'].'</TD>	
		    <TD> '. $quote['com_amt'].'</TD>
		    <TD> '. $quote['total_amt'].'</TD>
				
			
			<input type="hidden" readonly="readonly" id="costsheet_id1" name ="costsheet_id[]" value ="'. $quote['costsheet_id'].'">
		 </TR>';
		  $cnt=$cnt+1; 
		  } 
		 $output .= '<TR>
		   <TH colspan="6" style="text-align:right;">SUB TOTAL </TH>
		   <TH colspan="7">'.$net_amt.'</TH>
		 </TR>
		 <TR>
			<TH colspan="6" style="text-align:right;">Add GST @ '. $gst_per.' %</TH>
			<TH colspan="7">'.$gst_amt.'</TH> 
		 </TR>
		 <TR>
		   <TH colspan="6" style="text-align:right;">GRAND TOTAL </TH> 
		   <TH colspan="7">'.$grand_total.'</TH>
		 </TR>
	   </table>
	 
 </TABLE>
 <div style="border-left: 1px solid black; border-right: 1px solid black;border-bottom: 1px solid black;min-width:708px;">
	<div>
	<u><b>Tax Summary</b></u>
	</div>
 <br/>
    <div style="margin-left:400px;">
		<u><b> Tax Details :   </b></u><br/>
		SGST  &nbsp;&nbsp;&nbsp;&nbsp; '. $sgst_per.'  &nbsp;&nbsp;&nbsp;&nbsp; '. $SGST_cal.'
				<br/>
				CGST  &nbsp;&nbsp;&nbsp;&nbsp; '. $cgst_per.'  &nbsp;&nbsp;&nbsp;&nbsp; '. $CGST_cal.'<br/>
				.............................................................. <br/>
			<b> Tax Amount  : '. $tax_amount.'<b/><br/>
				.............................................................. <br/>
	      <br/>
	</div>
	<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
</div>
';
 
			if(($row['business_id'] == '1')OR($row['business_id'] =='2')OR($row['business_id'] =='3')){
				 if($quote_type =='1'){ 
					$stmt = $con->query("select * from doller_vendor_mastor where vendor_type = '$quote_type' ");
					 //echo "select * from doller_vendor_mastor where vendor_type = '$quote_type' ";
					 while ($row1 = $stmt->fetch()) {
						$bank_name = $row1['account_name'];
						$account_no = $row1['account_no'];
						$ifsc_code = $row1['ifsc_code'];
						$vender_id = $row1['id'];
						
					} 
				 }else{
					  $stmt = $con->query("select * from doller_vendor_mastor where vendor_type = '$quote_type' ");
					 //echo "select * from doller_vendor_mastor where vendor_type = '$quote_type' ";
					 while ($row1 = $stmt->fetch()) {
						//$rows[] = $row;
					} 
				 }
			}
			$query1=  $con->prepare("select designation_name from designation_master where id ='$design_id'");
				  //echo "select designation_name from designation_master where id ='$design_id'";
						$query1->execute(); 
						$row1 = $query1->fetch();
			
	 $output .= ' 
		 <div style="text-align:left;">
		   <img src="../../Recruitment/image/userlog/bluebase.png" alt="quadsel">
		 </div>
		 <div style="text-align:center;font-weight:bold;">QUOTATION</div><br/>
<div style="margin-top: -300px;font-size:13px;min-width:708px;min-height:400px;border-top: 1px solid black;border-left: 1px solid black; border-right: 1px solid black;border-bottom: 1px solid black;">
		 <u><b>Terms and Condition</b></u>
<br/>
		 <div style="width: 100%;margin-left: 3%;margin-top:10px;">
			<div style="width: 20%; height: auto; float: left;"> 
			VALIDITY :
			</div>
			<div style="margin-left: 20%; height: auto;"> 
			ONE WEEK FROM THE DATE OF QUOTE. PRICES PREVAILING AT THE TIME OF SUPPLY & BILLING WILL ONLY APPLY.
			</div>
	    </div>
<br/>
		<div style="width: 100%;margin-left: 3%;">
			<div style="width: 20%; height: auto; float: left;"> 
			PAYMENT :
			</div>
			<div style="margin-left: 20%; height: auto;"> 
			100% IN ADVANCE ALONG WITH FORMAL PURCHASE ORDER.<br/>
			PAYMENTS SHOULD BE MADE EITHER BY CHEQUE, DD, RTGS AND NEFT IN FAVOUR OF QUADSEL SYSTEMS PVT LTD, PAYABLE AT CHENNAI. CASH PAYMENTS WILL BE NULL & VOID.<br/>
			</div>
	    </div>
<br/>
		
		<div style="width: 100%;margin-left: 3%;">
			<div style="width: 50%; height: auto; float: left;"> 
			BANK DETAILS FOR NEFT / RTGS / IMPS 
			</div>
		<div style="margin-left: 50%; height: auto;"> 
		</div>
		</div>

<br/>
        <div style="width: 100%;margin-left: 3%;">
			<div style="width: 20%; height: auto; float: left;"> 
			BANK NAME : 
			</div>
			<div style="margin-left: 20%; height: auto;"> 
			'.$bank_name.'
			</div>
	    </div>

<br/>

		<div style="width: 100%;margin-left: 3%;">
			<div style="width: 20%; height: auto; float: left;"> 
			CURRENT A/C NO :
			</div>
			<div style="margin-left: 20%; height: auto;"> 
			'.$account_no.'
			</div>
		</div>

<br/>

		<div style="width: 100%;margin-left: 3%;">
			<div style="width: 20%; height: auto; float: left;"> 
			IFSC CODE : 
			</div>
			<div style="margin-left: 20%; height: auto;"> 
			'.$ifsc_code.'
			</div>
		</div>

<br/>

		<div style="width: 100%;margin-left: 3%;">
		<div style="width: 20%; height: auto; float: left;"> 
		IMPORTANT :
		</div>
		<div style="margin-left: 20%; height: auto;"> 
		YOUR PO SHOULD BE IN FAVOUR OF QUADSEL SYSTEMS PVT LTD., “QUADSEL TOWERS”, Old No.80, New No.118, Manickam Lane, Anna Salai, Guindy, Chennai – 600 032. INDIA.
		</div>
		</div>

<br/>

		<div style="width: 100%;margin-left: 3%;">
		<div style="width: 20%; height: auto; float: left;"> 
		DELIVERY :
		</div>
		<div style="margin-left: 20%; height: auto;"> 
		AS FOR THE OME WITHIN 1 - 2 WEEKS , WITHIN 2 - 3 WEEKS , WITHIN 3 - 4 WEEKS, WITHIN 4 - 5 WEEKS  FROM THE DATE OF RECEIPT OF PAYMENT.</b><br/>
				 SHIPPING COSTS WILL BE LEVIED IN FINAL INVOICE AS MAY BECOME APPLICABLE.
		</div>
		</div>

<br/>

		<div style="width: 100%;margin-left: 3%;">
		<div style="width: 20%; height: auto; float: left;"> 
		WARRANTY :
		</div>
		<div style="margin-left: 20%; height: auto;"> 
		AS MENTIONED ABOVE.
		</div>
		</div>

<br/>

		<div style="width: 100%;margin-left: 3%;">
		<div style="width: 20%; height: auto; float: left;"> 
		PAYMENT TERMS :
		</div>
		<div style="margin-left: 20%; height: auto;"> 
		100% PAYMENT IN ADVANCE
		</div>
		</div>

<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
		<div style="width: 100%;border-top: 1px solid black;border-bottom: 1px solid black;height:100px;">
			<div style="width: 50%; height: 100px; float: left;border-right: 1px solid black;"> 
				<div style="min-height:30px"><br/><br/>
				</div>
				<div style="border-top: 1px solid black;min-height:30px;margin-top:10px;">
				<p style="margin-left:20px;">'. $get_amount= AmountInWords($grand_total).'</p>
				</div>
			</div>
			<div style="height: auto;"> 
			
			<div style="width: 50%;margin-top:10px;">
				<div style="width: 85%; height: 70px; float: left; background: white;"> 
				<div> Amount  : </div>
				<div style="margin-top:12px;"> Tax  : </div>
				<div style="margin-top:12px;"> Net Amount   : </div>
				</div>
				<div style="float: left; height: 70px; background: white;"> 
				<div> '. $withgst.' </div>
				<div style="margin-top:12px;"> '. $tax_amount.' </div>
				<div style="margin-top:12px;"> '. round ($grand_total).' </div>
				</div>
		    </div>

			</div>

        </div>
		<div style="margin-left:65%;justify-content: center;">
		<br/>
		<div style="font-weight:bold;">'. $row['emp_name'].'</div>
		<div style="font-weight:bold;">'. $row1['designation_name'].'</div>
		<div style="font-weight:bold;">Mobile No : '. $row['mobile_no'].'</div>
		<div style="font-weight:bold;">Email Id : '. $row['email_id'].'</div>
		<br/>
		</div>
		</div>
</div>';    
	  return $output;
	 }
   
} 
for($i=0;$i<$count;$i++)
{  
//$costsheetid=$costsheet_id[$i];
	
	$quote_query = $con->query("SELECT a.id as costsheet_id,a.*,b.*,e.*,f.*,g.*,h.* from cost_sheet_entry a 
		 inner join client_master b on(b.id=a.client_id) 
		 inner join product_services f on (f.id = a.business_id)
		INNER JOIN staff_master e ON e.candid_id=a.candid_id 
		inner join z_user_master g ON (g.candidate_id = e.id)
		inner join quote_generate h on(h.cost_sheet_no=a.cost_sheet_no)
		where a.id='$costsheet_id'  and a.status ='3' ");
/* 	echo "SELECT a.id as costsheet_id,a.*,b.*,e.*,f.*,g.*,h.* from cost_sheet_entry a 
		 inner join client_master b on(b.id=a.client_id) 
		 inner join `product/services` f on (f.id = a.business_id)
		INNER JOIN staff_master e ON e.candid_id=a.candid_id 
		inner join z_user_master g ON (g.candidate_id = e.id)
		inner join quote_generate h on(h.cost_sheet_id=a.id)
		where a.id='$costsheet_id'  and a.status ='3' "; */
	$quote_query->execute(); 
	$row        = $quote_query->fetch();
		
	
	 $SENDMAIL       = $row['email_id1'];echo "<br/>";
	 $client_name    = $row['client_name'];echo "<br/>";
     $cost_sheet_no  = $row['cost_sheet_no'];echo "<br/>";
	 $enquiry_id     = $row['enquiry_id'];echo "<br/>";
     $QuoteNo        = $row['quote_no'];echo "<br/>";
    //$CHECKMAIL ='umadevidevi284@gmail.com';
    //$cname ='client';
	$user_id =$_SESSION['userid'];
	echo $candidateid=$_SESSION['candidateid'];	
	$class_quote = new fetch_data();
	$class_quote->fetch_quote_data($con,$costsheet_id,$client_name,$QuoteNo);  

	
	$file_name = md5(rand()) . '.pdf';
	$html_code = '<link rel="stylesheet" href="bootstrap.min.css">';
	
	
	$html_code .=  $class_quote->fetch_quote_data($con,$costsheet_id,$client_name,$QuoteNo);
	//$grabzIt->SaveTo("images/result.jpg");
	$pdf = new Pdf();
	$pdf->setPaper('A4', 'portrait');
	$pdf->load_html($html_code);
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
	$mail->Username = 'umadevi.v@bluebase.in';					//Sets SMTP username
	$mail->Password = 'naveen@uma';					//Sets SMTP password
	$mail->SMTPSecure = 'ssl';							//Sets connection prefix. Options are "", "ssl" or "tls"
	$mail->From = 'umadevi.v@bluebase.in';			//Sets the From email address for the message
	 $mail->FromName = 'Test';			//Sets the From name of the message
	 $mail->AddAddress('umadevidevi284@gmail.com',$client_name);		//Adds a "To" address
		
	$mail->WordWrap = 50;							//Sets word wrapping on the body of the message to a given number of characters
	$mail->IsHTML(true);							//Sets message type to HTML				
	$mail->AddAttachment($file_name);     				//Adds an attachment from a path on the filesystem
    $mail->Subject = 'Quote / Proposal ';			//Sets the Subject of the message
	$mail->Body = 'Please Find Quote / Proposal Report in attach PDF File.';				//An HTML or plain text message body
	
	/* if($mail->Send())								//Send an Email. Return true on success or false on error
	{  
     	echo "Success";
		$message = '<label class="text-success">Quote Details has been send successfully...</label>';echo $message;
	    $update_query = $con->query("update quotation_entry set flag ='1' , modified_by ='$user_id',modified_on =NOW() WHERE quote_no= '$QuoteNo'");  
		echo "update quotation_entry set flag ='1' , modified_by ='$user_id',modified_on =NOW() WHERE quote_no= '$QuoteNo'";
	} */
	if(!$mail->send()) {
       echo 'Message could not be sent.';
       echo 'Mailer Error: ' . $mail->ErrorInfo;
	   echo "0";
   } 
    else {
        $message = '<label class="text-success">Quote Details has been send Successfully...</label>';
	    $update_query = $con->query("update quote_generate set status ='2', modified_by ='$candidateid',modified_on =NOW() WHERE quote_no= '$QuoteNo'");  
		$update_query = $con->query("update cost_sheet_entry set status ='4', modified_by ='$candidateid',modified_on =NOW() WHERE cost_sheet_no= '$cost_sheet_no'");  
		$insert_query2= $con->query("Update enquiry set status='7' where id='$enquiry_id'");
		//echo "update quote_generate set status ='2', modified_by ='$candidateid',modified_on =NOW() WHERE quote_no= '$QuoteNo'";
		//echo "update cost_sheet_entry set status ='4', modified_by ='$candidateid',modified_on =NOW() WHERE cost_sheet_no= '$cost_sheet_no'";
	
	}
	unlink($file_name);

	 $class_quote->fetch_quote_data($con,$costsheet_id,$client_name,$QuoteNo);
}	
     $mail->clearAttachments();
?>