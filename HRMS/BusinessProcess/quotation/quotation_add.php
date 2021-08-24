<?php
require '../../../connect.php';
include("../../../user.php");
$enquiry_id=$_REQUEST['id'];
$stmt = $con->prepare("SELECT a.list,b.mapping_id FROM Enquiry a join `product/services` b on (b.id = a.list) WHERE a.id='$enquiry_id'"); 

$stmt->execute(); 
$row = $stmt->fetch();

?>

 <div class="card card-info">
	  <div class="card-header">
	     <h3><center>Quote/Proposal Entry Details</center></h3>
		  <div class="form-group row">
		    <div class="col-sm-8">
			 <?php if($row['mapping_id'] =='1'){
				      $pro_ser_type = "Product";
			       }else if($row['mapping_id'] =='2'){
				      $pro_ser_type = "Service";
			       }else if($row['mapping_id'] =='2'){
					  $pro_ser_type = "Solution";
				   }					   
			 ?>
	          <input type="text" class="form-control" id="pro_ser_id" name="pro_ser_id" value=" <?php echo $pro_ser_type; ?>" readonly>
			   <input type="hidden" class="form-control" id="mapping_id" name="mapping_id" value=" <?php echo $row['mapping_id']; ?>" readonly>
			</div>
				<div class="col-sm-2">
				<select class="form-control" id="client_id" name="client_id"> <!--onchange="showDiv(this)"-->
					<option> --- Select Client Name ---</option>
					<?php $query = $con->query("SELECT * FROM client_master");
						  while ($row_fetch = $query->fetch()) {?>
					<option value="<?php echo $row_fetch['id']; ?>"><?php echo $row_fetch['client_name']; ?> </option>
					<?php } ?>
				</select>
			</div>
			<div class="col-sm-2">
				<select class="form-control" id="quote_type" name="quote_type"> <!--onchange="showDiv(this)"-->
					<option value="">Choose Quote Type</option>
					<option value="1">INR</option>
					<option value="2">$</option>
				</select>
			</div>
		  </div>
     </div>
	<form action="" method="post" enctype="multipart/form-data">

	  <TABLE id="dataTable" width="350px" border="1" style="border-collapse:collapse;" class="table table-bordered">
		<TR>
		  <TH>
			<INPUT type="checkbox" name="select-all" id="select-all" onclick="toggle(this);">
		  </TH> 
		  <th>SPECIFICATION</th>
		  <th>QTY</th>
		  <th>UNIT RATE</th>
		  <TH formula="cost*qty" summary="sum">Amount</TH>
		  <TH>ACTION</TH>
		</TR>
		<TR>
		  <TD>
			<INPUT type="checkbox" name="chk[]">
		  </TD>
		  <TD>
			<INPUT type="text" id="item1" name="item[]" class="form-control"> </TD>
		  <TD>
			<INPUT type="text" id="qty1" name="qty[]" onchange="totalIt()" class="form-control"> </TD>
		  
		  <TD>
			<INPUT type="text" id="cost1" name="cost[]" onchange="totalIt()" class="form-control"> </TD>
		  <TD>
			<INPUT type="text" id="price1" name="price[]" readonly="readonly" value="0.00" class="form-control"> </TD>
		<td>
		 <INPUT type="button" class="btn btn-success" value="Add " onclick="addRow('dataTable')" />
	     <INPUT type="button" class="btn btn-danger" value="Delete Item(s)" onclick="deleteRow('dataTable')" />
		</td>
		</TR>
	  </TABLE>
	<div class="col-sm-6">
	   <select class="form-control" id="gst" name="gst" >
			<option value="">----- Choose GST % -----</option>
			<option value="18">18 %</option>
			<option value="28">28 %</option>
		</select>
	</div>
   <div class="col-sm-2">
	 <input type="button" class="btn btn-success" id="save" name="save" onclick="quotation_insert()"  value="Save"><br/><br/>
   </div>
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
			    <div class="col-sm-2">BANK NAME :</div>
				<div class="col-sm-1"><input type="text" id="bank_name" style ="border:none;" readonly>
				<input type="hidden" id="vendor_id" readonly></div>
				
			</div>
			<div class="form-group row">
			     <div class="col-sm-2">CURRENT A/C NO :</div>
				 <div class="col-sm-1"><input type="text" id="acc_no" style ="border:none;" readonly></div>
			</div>
			
			<div class="form-group row">
			     <div class="col-sm-2">IFSC CODE :</div>
				 <div class="col-sm-1"><input type="text" id="ifsc_code" style ="border:none;" readonly></div>
			</div>
			</b>
            </td>
		  </tr>
		  <tr id="hidden_div1">
		    <th >IMPORTANT</th>
			<td>YOUR PO SHOULD BE IN FAVOUR OF QUADSEL SYSTEMS PVT LTD., “QUADSEL TOWERS”, Old No.80, New No.118, Manickam Lane, Anna Salai, Guindy, Chennai – 600 032. INDIA.</td>
		  </tr>
		   <tr id="hidden_div2">
		    <th>IMPORTANT</th>
			<td>YOUR PO SHOULD BE IN FAVOUR OF QUADSEL SYSTEMS PVT LTD., “BLUE BASE SOFTWARE”, Old No.80, New No.118, Manickam Lane, Anna Salai, Guindy, Chennai – 600 032. INDIA.</td>
		  </tr>
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
	    <div class="col-sm-2"><p><b> Employee Name </b></p></div>  
        <p><b>
		<div class="col-sm-2">
		 <select id="emp_id" name="emp_id" >
		 <option> --- Select Employee Name ---</option>
			<?php $query = $con->query("SELECT * FROM staff_master");
				  while ($row_fetch = $query->fetch()) {?>
			<option value="<?php echo $row_fetch['id']; ?>"><?php echo $row_fetch['emp_name']; ?> </option>
			<?php } ?>
        </select>
        </b></p>
		</div>
	</div><b>
		    <div class="form-group row">
			    <div class="col-sm-12"><input type="text" id="designation" style ="border:none;" readonly></div>
			</div>
			 <div class="form-group row">
				  <div class="col-sm-12"><input type="text" id="tel_no" style ="border:none ;" readonly></div>
			</div>
			 <div class="form-group row">
				  <div class="col-sm-12"><input type="text" id="email_id" style ="border:none;" readonly> 
				  <input type="hidden" id="candid_id" readonly></div>
				 
			</div></b>
		
	</form>	  
	<!-- Sub Total: <input type="text" readonly="readonly" id="total"><br><input type="submit" value="Create Invoice">-->
  </div>
			
<script>

$("#quote_type").change(function(e){
	 var Quote_type       = $(this).val();
	 var product_service  = document.getElementById("mapping_id").value;
	$.ajax({
		type:'GET',
		data:'Quote_type='+Quote_type+'&product_service='+product_service,
		url:'HRMS/BusinessProcess/quotation/getbank_details.php',
		dataType: 'json',
		success:function(data)
		{
		if(data != null){ //alert(data);
			$.each(data, function(index, element) {
				$('#vendor_id').val(element.id);
				$('#bank_name').val(element.account_name);
				$('#acc_no').val(element.account_no);
				$('#ifsc_code').val(element.ifsc_code);
			});
		}
		}
		
	})
	
});




function quotation_insert()
{
	var field=1;
	var data = $('form').serialize();
	//var quote_type  = document.getElementById("quote_type").value;
	var quote_type    = document.getElementById("quote_type").value;
	var mapping_id  = document.getElementById("mapping_id").value;
	var candid_id   = document.getElementById("candid_id").value;
	var vendor_id   = document.getElementById("vendor_id").value;
	var client_id   = document.getElementById("client_id").value;
	alert(client_id)
	$.ajax({
		type:'GET',
		//data:"field="+field, data,
		data:'field='+field+'&data='+data+'&quote_type='+quote_type+'&mapping_id='+mapping_id+'&candid_id='+candid_id+'&vendor_id='+vendor_id+'&client_id='+client_id,
		url:'HRMS/BusinessProcess/quotation/quotation_insert.php',
		success:function(data)
		{
			alert("Entry Successfully");
		    Quotation;
		}       
	});
}

$("#emp_id").change(function(e){
	var value = $(this).val();
	//alert(value);
	//$('#designation').val('');
	$.ajax({
		
		type:"POST",
		url:"HRMS/BusinessProcess/quotation/getemp_details.php?id=" +value, 
		dataType: 'json',
		success:function(data)
		{
		if(data != null){ //alert(data);
			$.each(data, function(index, element) {
				$('#designation').val(element.position);
				$('#tel_no').val(element.mobile_num);
				$('#email_id').val(element.email_id);
			    $('#candid_id').val(element.candid_id);
			});
		}
		}
	})
	
});


	
		
 function change_status()
    {
    var id=$('#get_id').val();
	alert(id);
    var data = $('form').serialize();
		$.ajax({
		type:'GET',
		data:"id="+id,data,
		url:'HRMS/CRM/change_status.php',
		success:function(data)
		{
		  if(data==1)
		  { 
			alert('Not');
		  }
		  else
		  {
			alert("Update Successfully");
		 enquiry()
		  }
		  }           
		});
    }
	
	</script>

<!-------Calculation Part JAVASCRIPT--------->
<script>
  function calc(idx) {
    var price = parseFloat(document.getElementById("cost" + idx).value) *
      parseFloat(document.getElementById("qty" + idx).value);
    //alert(idx+":"+price);  
    document.getElementById("price" + idx).value = isNaN(price) ? "0.00" : price.toFixed(2);
    //document.getElementById("total") = totalIt;
  }

  function totalIt() {
    var qtys = document.getElementsByName("qty[]");
    var total = 0;
    for (var i = 1; i <= qtys.length; i++) {
      calc(i);
      var price = parseFloat(document.getElementById("price" + i).value);
      total += isNaN(price) ? 0 : price;
    }
    document.getElementById("total").value = isNaN(total) ? "0.00" : total.toFixed(2);
  }

  window.onload = function() {
    document.getElementsByName("qty[]")[0].onkeyup = function() {
      calc(1)
    };
    document.getElementsByName("cost[]")[0].onkeyup = function() {
      calc(1)
    };
  }

  var rowCount = 0;

  function addRow(tableID) {

    var table = document.getElementById(tableID);

    var rowCount = table.rows.length;
    var row = table.insertRow(rowCount);

    var cell1 = row.insertCell(0);
    var element1 = document.createElement("input");
    element1.type = "checkbox";
    element1.name = "chk[]";
	element1.class = "form-control";
    cell1.appendChild(element1);


    var cell3 = row.insertCell(1);
    var element3 = document.createElement("input");
    element3.type = "text";
    element3.name = "item[]";
	element3.class = "form-control";
    element3.id = "item" + rowCount;
    cell3.appendChild(element3);
	
    var cell4 = row.insertCell(2);
    var element4 = document.createElement("input");
    element4.type = "text";
	element4.class = "form-control";
    element4.name = "qty[]";
    element4.id = "qty" + rowCount;
    element4.onkeyup = totalIt;
	
    cell4.appendChild(element4);

   

    var cell5 = row.insertCell(3);
    var element5 = document.createElement("input");
    element5.type = "text";
    element5.name = "cost[]";
    element5.id = "cost" + rowCount;
    element5.onkeyup = totalIt;
    cell5.appendChild(element5);

    var cell6 = row.insertCell(4);
    var element6 = document.createElement("input");
    element6.type = "text";
    element6.name = "price[]";
    element6.id = "price" + rowCount;
    element6.value = "0.00";
    $(element6).attr("readonly", "true");
    cell6.appendChild(element6);

  }

  function deleteRow(tableID) {
    try {
      var table = document.getElementById(tableID);
      var rowCount = table.rows.length;

      document.getElementById("select-all").checked = false;

      for (var i = 1; i < rowCount; i++) {
        var row = table.rows[i];
        var chkbox = row.cells[0].childNodes[0];
        if (null != chkbox && true == chkbox.checked) {
          table.deleteRow(i);
          rowCount--;
          i--;
        }


      }
    } catch (e) {
      alert(e);
    }
  }

</script>
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.js"></script>
<script>
  $("input").blur(function() {
    if ($(this).attr("data-selected-all")) {
      //Remove atribute to allow select all again on focus        
      $(this).removeAttr("data-selected-all");
    }
  });
  
   $("input").click(function() {
    if (!$(this).attr("data-selected-all")) {
      try {
        $(this).selectionStart = 0;
        $(this).selectionEnd = $(this).value.length + 1;
        //add atribute allowing normal selecting post focus
        $(this).attr("data-selected-all", true);
      } catch (err) {
        $(this).select();
        //add atribute allowing normal selecting post focus
        $(this).attr("data-selected-all", true);
      }
    }
  });

  function toggle(source) {
    var checkboxes = document.querySelectorAll('input[type="checkbox"]');
    for (var i = 0; i < checkboxes.length; i++) {
      if (checkboxes[i] != source)
        checkboxes[i].checked = source.checked;
    }
  }

</script>
<script>

<script type="text/javascript">
function showDiv(id){
	alert()
   if(id.value==2){
    document.getElementById('hidden_div2').style.display = "block";
	document.getElementById('hidden_div1').style.display = "none";
   } else{
    //document.getElementById('hidden_div1').style.display = "block";
	document.getElementById('hidden_div2').style.display = "none";
   }
} 
</script>
<style>
#hidden_div2 {
  display: none;
}
</style>
<script>
$("#gst").change(function(e){
	var value = $(this).val();
	alert(value);
	//$('#designation').val('');
	
	$.ajax({
		
		type:"POST",
		url:"HRMS/BusinessProcess/quotation/getemp_details.php?id=" +value, 
		dataType: 'json',
		success:function(data)
		{
		if(data != null){ //alert(data);
			$.each(data, function(index, element) {
				$('#designation').val(element.position);
				$('#tel_no').val(element.mobile_num);
				$('#email_id').val(element.email_id);
			
			});
		}
		}
		
	})
	
});
</script>