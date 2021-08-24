<?php
require'../../../connect.php';

$id=$_REQUEST['id'];
$staff_id=$_REQUEST['staff'];
$staff_code=$_REQUEST['staff_code'];
$staff_name=$_REQUEST['staff_name'];
$applied_date=$_REQUEST['applied_date'];
$adate=date('d-M-Y',strtotime($applied_date));
$notice=$_REQUEST['notice'];
$ldate=date('d-M-Y',strtotime($notice));
$date=date('d-M-Y');
?>
<style>


</style>
<section class="wage_content"></section>
<section class="content" id="content">
	<div class="container-fluid">
	 <div class="row">
	  <div class="card-body">
     <form action="" method="post" enctype="multipart/form-data">   
    <div class="col-sm-12">
	<div class="col-sm-12"  style="text-align:left;">
	  
	</div>
	<div class="col-sm-12 row2"  style="text-align:right;">
	  
	 
	  <!--a onclick="return back()" style="float: right;" data-toggle="modal" class="btn btn-primary"></i>Back</a--> &nbsp;&nbsp;
	  <?php /* if($row ['flag']==0){ ?>
	    
	  <?php }elseif($row ['flag']==1) { ?>
	   <input type="button" class="btn btn-success" id="save" name="save" onclick="quote_rewise()"  value="Rewise Quote">
	  <?php } */ ?>
	   <!--input type="print" class="btn btn-success" id="print" name="print" onclick="PrintDiv()"  value="print"-->
	    <input type="button" value="print" onclick="PrintDiv();" />
	   &nbsp;<br/><br/>
	</div>
	<div class="col-sm-12 row2"  id="divToPrint">
	 <table width="1000px" class="col-md-12" style="font-size:30px;margin-top:100px;" > 
	    <tbody>
		
		<tr class="col-sm-12 row2"> 
		  <td class="col-sm-4"><b>REF : </b><?php echo $staff_code;?></td>
		  
		  <td class="col-sm-4 "><b>Date : </b><?php echo $date;?></td>
		</tr>
		</tbody>
		 </table>
		 <table width="1000px" class="col-md-12" style="font-size:30px;margin-top:100px;" >
		  <tbody>
		  
		<tr><td style="font-size:34px;"><h4 ><b><u><center>Relieving Letter</center></u></b></h4></td> </tr>		 
		<tr > 
		   <td><b>Dear <?php echo $staff_name;?> , </b><br /><br/> </td>
		 </tr>
		 <tr>
		  <td> &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp; We are in reciept of your mail dated  <?php echo $adate;?> and the same has been approved by our Management.Consequently,you are relieved from the service on the closing hours of <?php echo $ldate;?>.		 
		  </td>		   
		</tr>
		<tr>
		<td>
		By a copy of this letter,we are advising Accounts Department,to settle your accounts accordingly. <br/><br/><br/> 
		</td>
		</tr>
		<tr>
		<td>We wish you all the best in future endeavors.<br/><br/><br/></td>
		</tr>
		<tr>
		<td><b>For Bluebase Software Services Pvt Ltd,<br/><br/></b></b></td>
		</tr>
		<tr>
		<td><b>MANAGER-HR.</b></td>
		</tr>
		<tbody>
		</table>
		</div>
		<script type="text/javascript">     
    function PrintDiv() {    
       var divToPrint = document.getElementById('divToPrint');
       var popupWin = window.open('', '_blank', 'top=0,left=0,height=100%,width=auto');
       popupWin.document.open();
       popupWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
        popupWin.document.close();
            }
 </script>