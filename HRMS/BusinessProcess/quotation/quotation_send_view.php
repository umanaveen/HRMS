<?php
require '../../../connect.php';
include("../../../user.php");
$vendor_id=$_REQUEST['id'];

$stmt= $con->query("SELECT a.id as quote_id,a.*,b.*,c.*,e.* from quotation_entry a 
		 inner join client_master b on(b.id=a.client_id) 
		 inner join doller_vendor_mastor c on(c.id=a.vendor_id)
		 inner join emp_personal_details e on(e.emp_id=a.candid_id) where a.status ='1' and a.vendor_id='$vendor_id'");
/* echo "SELECT a.id as quote_id,a.*,b.*,c.*,e.* from quotation_entry a 
		 inner join client_master b on(b.id=a.client_id) 
		 inner join doller_vendor_mastor c on(c.id=a.vendor_id)
		 inner join emp_personal_details e on(e.emp_id=a.candid_id) where a.status ='1' and a.vendor_id='$vendor_id'"; */


$stmt->execute(); 
$row        = $stmt->fetch();
$company_id = $row['company_id'];

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
</style>
<div class="card-body">

    <div class="col-sm-12">
	<div class="col-sm-6"  style="text-align:left;">
	   <img src="../../Recruitment/image/userlog/bluebase.png" alt="quadsel" style="width:100px;height:50px;">
	  
	</div>
	<div class="col-sm-6"  style="text-align:right;">
	  <input type ="hidden" name="vendor_id" id ="vendor_id" value="<?php echo $vendor_id; ?>">
	   
	 
	   <input type="button" class="btn btn-success" id="save" name="save" onclick="mail_send()"  value="Send Mail"><br/><br/>
	</div>
    <h4 align="center"><b><u>QUOTATION</u></b></h4> 
	<div class="col-sm-12 row1">
		<div class="col-sm-12"><p><h4> <b>
		<?php if($company_id ==1){
				echo "Bluebase Software Services Pvt Ltd";
			  } else {
				echo "Bluebase Software services Pvt Ltd";
			  }
		?>
		</b></h4></p>
		</div>
		<div class="col-sm-12"><p><b>New No 118, Annasalai, Manikkam Lane,<br/>
			 Guindy, Chennai, Tamil Nadu,-600032 </b></p>
		 </div>
		 <div class="col-sm-12 " >&nbsp;&nbsp;</div>
		 <div class="col-sm-6"><b>E-Mail : </b></div>
		 <div class="col-sm-6"><b>GST NO : </b></div>
		 <div class="col-sm-6"><b>PHONE NO : </b></div>
		 <div class="col-sm-6"><b>PAN : </b></div>
		 <div class="col-sm-6"><b> </b></div>
		 <div class="col-sm-6"><b>CIN No : </b></div>
	</div> 
	<div class="col-sm-12 row1">
		 <div class="col-sm-4"><b>Quot. NO : </b></div>
		 <div class="col-sm-4"><b>Ref. No.  : </b></div>
		 <div class="col-sm-4"><b>Acct Manager : </b></div>
		 <div class="col-sm-4"><b>Date : </b></div>
		 <div class="col-sm-4"><b>Currency : </b></div>
	</div>

	<div class="col-sm-12 row1">
	   <div class="col-sm-12"><p><b><u>Client Name & Details </u></b></p></div>
	   <div class="col-sm-12"><p><b><?php echo $row['client_name']; ?></b></p></div>
	   <div class="col-sm-12"><p><b> Address : <?php echo $row['address1']; ?>,<?php echo $row['address2']; ?>,<br/><?php echo $row['area']; ?>,<?php echo $row['town_city']; ?>,<?php echo $row['pincode']; ?>,<br/><?php echo $row['district']; ?>,<?php echo $row['state']; ?>,<?php echo $row['country']; ?></b></p></div>
	   <div class="col-sm-12"><p><b>Mobile No : <?php echo $row['mobile_no1']; ?>,<?php echo $row['mobile_no2']; ?></b></p></div>
	   <div class="col-sm-12"><p><b>Dear Sir,<br/>
	  As per your requirement, please find attached below our proposal for HP 280 Pro G6 Desktops</b></p></div>
	</div>

	<div class="col-sm-12 row1"><br/>
		 <TABLE id="dataTable" width="350px" border="1" style="border-collapse:collapse;" class="table table-bordered"> 
			<TR>
			   <th>SLNO.</th>
			  <th>SPECIFICATION</th>
			  <th>QTY</th>
			  <th>UNIT RATE</th>
			  <TH formula="cost*qty" summary="sum">AMOUNT</TH>
			</TR>
			<?php  
			$query= $con->query("SELECT a.id as quote_id,a.*,b.*,c.*,e.* from quotation_entry a 
			 inner join client_master b on(b.id=a.client_id) 
			 inner join doller_vendor_mastor c on(c.id=a.vendor_id)
			 inner join emp_personal_details e on(e.emp_id=a.candid_id) where a.status ='1' and a.vendor_id='$vendor_id'"); 
			$sum_total="";
			$cnt=1;
				while($quote = $query->fetch(PDO::FETCH_ASSOC)){
			 
			    $sum_total+= $quote['amount'];
				$gst         = $row['gst_percentage'];
				$withgst     = ($sum_total)*($gst/100);
				$grand_total = round($withgst+$sum_total);
				
			    if($gst =='18') {     $SGST_cal  = ($sum_total)*(9/100); 
				}elseif($gst =='28'){ $SGST_cal  = ($sum_total)*(14/100); 
				}else{ $SGST_cal = ($sum_total)*(0/100); }
			    
				 if($gst =='18') {     $CGST_cal  = ($sum_total)*(9/100); 
				}elseif($gst =='28'){ $CGST_cal  = ($sum_total)*(14/100); 
				}else{ $CGST_cal = ($sum_total)*(0/100); }
				 $tax_amount = $SGST_cal + $CGST_cal;
			?>
			<TR>
			  <TD><?php echo $cnt;?>. </TD>
			  <TD> <?php echo $quote['specification']; ?></TD>
			  <TD><?php echo $quote['qty']; ?></TD>
			  <TD> <?php echo $quote['unit_rate']; ?></TD>
			  <TD> <?php echo $quote['amount']; ?></TD>
			   <input type="hidden" readonly="readonly" id="quote_id1" name ="quote_id[]" value ="<?php echo $quote['quote_id'];?>">
			</TR>
		    <?php $cnt=$cnt+1; } ?>
			<TR>
			  <TH colspan="4" style="text-align:right;">SUB TOTAL </TH>
		      <TH><?php  echo $sum_total;?></TH>
			</TR>
			<TR>
			   <TH colspan="4" style="text-align:right;">Add GST @ <?php echo $gst;?> %</TH>
			   <TH><?php echo $withgst ;?></TH> 
			</TR>
			<TR>
			  <TH colspan="4" style="text-align:right;">GRAND TOTAL </TH> 
			  <TH><?php echo round($grand_total); ?></TH>
			</TR>
		  </TABLE>
	</div>

	<div class="col-sm-12 row1">  
	<div class="col-sm-12"><br/></div>
	  <div class="col-sm-6 " style="text-align:left;"><u><b>Tax Summary</b></u></div> 
	  <div class="col-sm-6" style="text-align:center;">
			<u><b>Tax Details : &nbsp;&nbsp; </b></u><br/>
			SGST  &nbsp;&nbsp;&nbsp;&nbsp;  <?php if($gst =='18') {  echo "9 %";   ?> &nbsp;&nbsp;&nbsp;&nbsp;
			<?php 
			echo "$SGST_cal"; }elseif($gst =='28'){ echo "14 %" ; echo "$SGST_cal"; }else{ echo "0 %"; echo "$SGST_cal"; }?>  
			<br/>
			CGST  &nbsp;&nbsp;&nbsp;&nbsp;
			 <?php if($gst =='18') {  echo "9 %";  ?> &nbsp;&nbsp;&nbsp;&nbsp;
			<?php  echo "$CGST_cal"; }elseif($gst =='28'){ echo "14 %" ; echo "$CGST_cal"; }else{ echo "0 %"; echo "CGST_cal"; }?> <br/>
			.............................................................. <br/>
			 <b> Tax Amount  : <?php echo  $tax_amount ?><b/><br/>
			.............................................................. <br/>
			<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
			<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
	 </div>	  
	</div>
<!--</diV>-->
    <div class="col-sm-12 row1">E. & O.E</div>
    <div class="col-sm-12 row1"><br/>
        <TABLE id="dataTable" width="350px" border="1" style="border-collapse:collapse;" class="table table-bordered">
		  <tr>
		    <th colspan="2"  style="text-align:center;">TERMS & CONDITIONS</th>
		  </tr>
		  <tr>
		    <th>VALIDITY</th>
			<th>ONE WEEK FROM THE DATE OF QUOTE. PRICES PREVAILING AT THE TIME OF SUPPLY & BILLING WILL ONLY APPLY.</th>
		  </tr>
		  <tr>
		    <th>PAYMENT</th>
			<td><b>100% IN ADVANCE ALONG WITH FORMAL PURCHASE ORDER.<br/></b>
			PAYMENTS SHOULD BE MADE EITHER BY CHEQUE, DD, RTGS AND NEFT IN FAVOUR OF QUADSEL SYSTEMS PVT LTD, PAYABLE AT CHENNAI. CASH PAYMENTS WILL BE NULL & VOID.<br/>
			<b>1BANK DETAILS FOR NEFT / RTGS / IMPS 
			<div class="form-group row">
			    <div class="col-sm-3">BANK NAME :</div>
				<div class="col-sm-3"><?php echo $row['account_name'];?></div>
			</div>
			<div class="form-group row">
			    <div class="col-sm-3">CURRENT A/C NO :</div>
				<div class="col-sm-3"><?php echo $row['account_no'];?></div>
			</div>
			<div class="form-group row">
			    <div class="col-sm-3">IFSC CODE :</div>
				<div class="col-sm-3"><?php echo $row['ifsc_code'];?></div>
			</div>
			</b>
            </td>
		  </tr>
		  <tr id="hidden_div1">
		    <th >IMPORTANT</th>
			<td>YOUR PO SHOULD BE IN FAVOUR OF QUADSEL SYSTEMS PVT LTD., “QUADSEL TOWERS”, Old No.80, New No.118, Manickam Lane, Anna Salai, Guindy, Chennai – 600 032. INDIA.</td>
		  </tr>
		   <!--<tr id="hidden_div2">
		    <th>IMPORTANT</th>
			<td>YOUR PO SHOULD BE IN FAVOUR OF QUADSEL SYSTEMS PVT LTD., “BLUE BASE SOFTWARE”, Old No.80, New No.118, Manickam Lane, Anna Salai, Guindy, Chennai – 600 032. INDIA.</td>
		  </tr>-->
		  <tr>
		    <th>DELIVERY</th>
			<td><b>AS FOR THE OME WITHIN ONE TO TWO WEEKS , WITHIN TWO TO THREE WEEKS , WITHIN THREE TO FOUR WEEKS, WITHIN FOUR TO FIVE WEEKS  FROM THE DATE OF RECEIPT OF PAYMENT.</b><br/>
			SHIPPING COSTS WILL BE LEVIED IN FINAL INVOICE AS MAY BECOME APPLICABLE.</td>
		  </tr>
		  <tr>
		    <th>WARRANTY</th>
			<td>AS MENTIONED ABOVE.<br/></td>
		  </tr>
		   <tr>
		    <th>PAYMENT TERMS : </th>
			<td>100% PAYMENT IN ADVANCE<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
		  </tr>
		  <TR>
			<TH style="text-align:center;" ><?php echo $get_amount= AmountInWords($grand_total); ?></TH>
			<TH style="text-align:left;">Amount  :  <?php echo $withgst;?> <br/><br/>
			Tax  :  <?php echo $tax_amount;?> <br/><br/>
			Net Amount   :  <?php echo round ($grand_total);?> <br/>
			</TH>
		  </TR>
		  <TR>
		    <TH colspan= '2'><br/></TH>
		  </TR>
        </TABLE>
    </div>
   <div class="col-sm-12 row1">E. & O.E</div>
 
</div>

<script>

	function back()

	{
		Quotation_view()

	}
function mail_send()
{
	
	var data  = $('form').serialize();
	var id    = document.getElementById("vendor_id").value;
    
	$.ajax({
	type:'GET',
	data:"id="+id, 
	url:"HRMS/BusinessProcess/quotation/quotation_mail_post.php",
	success:function(data)
	{      
		alert("Mail Sended Successfully");
		//vendor_master()
				  
	}       
	});
}

</script>