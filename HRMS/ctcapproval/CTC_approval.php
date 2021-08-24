<?php
require '../../connect.php';
?>
<div class="container-fluid">

<div class="card mb-3">
<div class="card-header">
<i class="fa fa-table"></i> CTC APPROVAL

<a onclick="home()" style="float: right;" data-toggle="modal" class="btn btn-primary">Back</a>
<input type="button" style="float:right;margin-right:30px;" class="btn btn-warning" name="print" onclick="printDiv('printableArea')"  title="print"  value="Print"> &nbsp;
</div>
<div class="card-body" id="printableArea">
<form method="POST" action="" enctype="multipart/type">
<table class="table table-bordered">
<tr>
<td><center><img src="../../Recruitment/image/userlog/bluebase.png" alt="quadsel" style="width:100px;height:50px;"></center></td>
<td colspan="5"><center><b>Bluebase Software services Pvt Ltd</b></center></td>
</tr>
<tr rowspan="6">
<td >Candidate Name:</td>
<td colspan="5">
<select class="form-control" id="candidate_name" name="candidate_name" placeholder="Employee" onchange="leave_check(this.value)">
<option value=""> CHOOSE Employeee </option>
<?php $stmt = $con->query("SELECT name FROM emp_personal_details");
while ($row1 = $stmt->fetch()) {?>
 <option value="<?php echo $row1['name']; ?>"> <?php echo $row1['name']; ?> </option>
<?php } ?>
</select>
</td>
</tr>
<tr rowspan="6">
<td >Candidate Present CTC:</td>
<td colspan="5"><input type="text" class="form-control" id="pctc" name="pctc" autocomplete="off"></td>
</tr>
<tr rowspan="6">
<td>Candidate Expected CTC:</td>
<td colspan="5"><input type="text" class="form-control" id="ectc" name="ectc" autocomplete="off"></td>
</tr>
<tr>
<td>CTC Offered:</td>
<td colspan="1"><input type="text" class="form-control" id="ctc_offer" name="ctc_offer" autocomplete="off"></td>

<td>Offered Take home:</td>
<td colspan="1"><input type="text" class="form-control" id="take_home" name="take_home" autocomplete="off"></td>
</tr>
<tr>
<td>Offered Designation:</td>
<td colspan="5"><input type="text" class="form-control" id="designation" name="designation" autocomplete="off"></td>
</tr>
<tr>
<td>Department Head Approval:</td>
<td colspan="5"><input type="text" class="form-control" id="head_approval" name="head_approval" autocomplete="off"></td>
</tr>
<tr>
<td>Department director Approval:</td>
<td colspan="5"><input type="text" class="form-control" id="director_approval" name="director_approval" autocomplete="off"></td>
</tr>
<tr>
<td>CUG</td>
<td colspan="5"><input type="text" class="form-control" id="CUG" name="CUG" autocomplete="off"></td>
</tr>
<tr>
<td>Mail ID</td>
<td colspan="5"><input type="text" class="form-control" id="mail" name="mail" autocomplete="off"></td>
</tr>
<tr>
<!--td>Target</td>
<td colspan="5"><input type="text" class="form-control" id="target" name="target" autocomplete="off"></td>
</tr-->
<tr>
<td>System</td>
<td colspan="5"><input type="text" class="form-control" id="system" name="system" autocomplete="off"></td>
</tr>
<tr>
<td>Seating</td>
<td colspan="5"><input type="text" class="form-control" id="seating" name="seating" autocomplete="off"></td>
</tr>
</table>
<input type="button" class="btn btn-primary btn-md"  style="float:right;" name="save" onclick="	ctc_entry()" value="save"> 
</form>
</div>
</div>
</div>
<script> 
function printDiv(divName)
{
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;
    document.body.innerHTML = printContents;
	window.print();
	document.body.innerHTML = originalContents;
}
</script> 
<script>
function home()
    {
	 var id=0;
	$.ajax({
    type:'GET',
    data:"id="+id,
    url:'HRMS/ctcapproval/CTC_view.php',
    success:function(data)
    {
		 $("#main_content").html(data);
	}
	 });
    }
    function ctc_entry()
    {
    var id=0;
    var data = $('form').serialize();
    $.ajax({
    type:'GET',
    data:"id="+id, data,
    url:'HRMS/ctcapproval/approval_submit.php',
    success:function(data)
    {
      if(data==1)
      { 
        alert('Entry Successfully');
        ctc_approval();
      }
      else
      {
        alert("Entry Unsuccessfull");
		ctc_approval();
      }
      
    }       
    });
    }
    </script>