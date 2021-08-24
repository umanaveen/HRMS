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
$row = $stmt->fetch();
 
?>
<style>
.table {
    width: 85% !important;
    max-width: 85% !important;
}
</style>
 <div class="card card-info">
	 
		   <div class="form-group row">
			 <div class="col-sm-12"><p><b> To : <?php echo $row['client_name']; ?></b></p></div>
	       </div>
		   <div class="form-group row">
			 <div class="col-sm-12"><p><b> Address : <?php echo $row['address1']; ?>,<?php echo $row['address2']; ?>,<br/><?php echo $row['area']; ?>,<?php echo $row['town_city']; ?>,<?php echo $row['pincode']; ?>,<br/><?php echo $row['district']; ?>,<?php echo $row['state']; ?>,<?php echo $row['country']; ?></b></p></div>
	       </div>
		   
		 <!-- <div class="form-group row">
				<div class="col-sm-8">
				 <?php if($row['business_id'] =='1'){
						  $pro_ser_type = "Product";
					   }else if($row['business_id'] =='2'){
						  $pro_ser_type = "Service";
					   }else if($row['business_id'] =='3'){
						  $pro_ser_type = "Solution";
					   }					   
				 ?>
				</div>
				<div class="col-sm-2"></div>
			<div class="col-sm-2">
				<select class="form-control" id="quote_type" name="quote_type"> <!--onchange="showDiv(this)"-->
					<!--<option value="">Choose Quote Type</option>
					<option value="1">INR</option>
					<option value="2">$</option>
				</select>
			</div>
		  </div> -->
     
	<form method="POST" action="HRMS/BusinessProcess/quotation/quotation_approve_update.php" enctype="multipart/form-data">
     
	  <TABLE id="dataTable" width="350px" border="1" style="border-collapse:collapse;" class="table table-bordered">
	     <h4 align="center"><b><u>PROPOSAL</u></b></h4> 
		<div class="col-sm-10" style="text-align:right;">
	       <input type="submit" class="btn btn-success" id="save" name="save" value="Approve Quote">&nbsp;&nbsp;&nbsp;
		   <input type="button" class="btn btn-primary" style="float: right;" id="save" name="save" onclick="return back()"  value="Back"><br/><br/>
        </div>
		<div class="col-sm-2" style="text-align:right;"></div>
		 
		<TR>
		
		  <!--<TH>
			<INPUT type="checkbox" name="select-all" id="select-all" onclick="toggle(this);">
		  </TH> -->
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
		
		 $sum_total+=$quote['amount'];
		  ?>
		<TR>
		  <TD><?php echo $cnt;?>. </TD>
		  <TD> <?php echo $quote['specification']; ?></TD>
		  <TD><?php echo $quote['qty']; ?></TD>
		  <TD> <?php echo $quote['unit_rate']; ?></TD>
		  <TD> <?php echo $quote['amount']; ?></TD>
		   <input type="hidden" readonly="readonly" id="quote_id1" name ="quote_id[]" value ="<?php echo $quote['quote_id'];?>">
		</TR>
		
			<?php
	  $cnt=$cnt+1;
      }
      ?>
	    <TR>
		    <TH colspan="4" style="text-align:right;">SUB TOTAL </TH>
		    <TH><?php  echo $sum_total;?></TH>
		</TR>
		<TR>
		   <TH colspan="4" style="text-align:right;">Add GST @ <?php echo $gst = $row['gst_percentage'];?> </TH>
		   <TH><?php echo $withgst = ($sum_total)*($gst/100);?></TH> 
		</TR>
		<TR><TH colspan="4" style="text-align:right;">GRAND TOTAL </TH> <Th><?php echo round($grand_total = $withgst+$sum_total); ?></TH></TR>
		
		  
		  
	
	  </TABLE>
	
      </br>
	  <div class="card-body">
	    <table class="table table-bordered">
		 <tr><th colspan="2"  style="text-align:center;">TERMS & CONDITIONS</th></tr>
		  <tr>
		    <th>VALIDITY</th>
			<th>ONE WEEK FROM THE DATE OF QUOTE. PRICES PREVAILING AT THE TIME OF SUPPLY & BILLING WILL ONLY APPLY.</th>
		  </tr>
		  <tr>
		    <th>PAYMENT</th>
			<td><b>100% IN ADVANCE ALONG WITH FORMAL PURCHASE ORDER.<br/></b>
			PAYMENTS SHOULD BE MADE EITHER BY CHEQUE, DD, RTGS AND NEFT IN FAVOUR OF QUADSEL SYSTEMS PVT LTD, PAYABLE AT CHENNAI. CASH PAYMENTS WILL BE NULL & VOID.<br/>
			<b>1BANK DETAILS FOR NEFT / RTGS / IMPS <div id="items">
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
		</table>
		</div>
		<br/><br/>
	   <div class="form-group row">
			<div class="col-sm-12"><p><b> For QUADSEL SYSTEMS PVT. LTD.,</b></p></div> 
			
	  </div>
	  <div class="form-group row">
	    <p><b><div class="col-sm-2">Employee Name :  <?php echo $row['name'];?></b></p></div>
	  </div><b>
		    <div class="form-group row">
			    <div class="col-sm-12">Designation : <?php echo $row['position'];?></div>
			</div>
			 <div class="form-group row">
				  <div class="col-sm-12">Mobile No : <?php echo $row['mobile_num'];?></div>
			</div>
			 <div class="form-group row">
				  <div class="col-sm-12">Email Id : <?php echo $row['email_id'];?>
				  <input type="hidden" id="candid_id" readonly></div>
				 
			</div></b>
		   
	</form>	  
	<!-- Sub Total: <input type="text" readonly="readonly" id="total"><br><input type="submit" value="Create Invoice">-->
  </div>
			
<script>

	function back()

	{
		Quotation_view()

	}

/* function quotation_approve()
{
	
	var field=1;

	var quote_id   = document.getElementById("quote_id1").value;
	alert(quote_id)
	$.ajax({
		type:'GET',
		
		data:'field='+field+'&quote_id='+quote_id,
		
		url:'HRMS/BusinessProcess/quotation/quotation_approve_update.php',
		success:function(data)
		{
			alert("Approved Successfully");
		    Quotation;
		}       
	});
} */

</script>