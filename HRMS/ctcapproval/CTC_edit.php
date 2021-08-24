<?php
require '../../connect.php';
 $id=$_REQUEST['id'];

$stmt = $con->prepare("SELECT cfd.first_name,zdm.dept_name,cfd.position,d.designation_name FROM `final_technical_team_details` md  join candidate_form_details cfd on md.candidate_id=cfd.id join z_department_master zdm on zdm.id=cfd.department join designation_master d on cfd.position=d.id  where cfd.id='$id'"); 
$stmt->execute(); 
$row = $stmt->fetch();

?>
<div class="container-fluid">
<div class="card mb-3">
<div class="card-header">
<i class="fa fa-table"></i> CTC APPROVAL
<a onclick="return back_ctc()" style="float: right;" data-toggle="modal" class="btn btn-primary">Back</a>
<input type="button" style="float:right;margin-right:30px;" class="btn btn-warning" name="print" onclick="printDiv('printableArea')"  title="print"  value="Print"> &nbsp;
</a>
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
<input type="hidden" class="form-control" id="id" name="id" value="<?php echo  $id; ?>" autocomplete="off">
<input type="text" class="form-control" id="candidate_name" name="candidate_name" value="<?php echo  $row[0]; ?>" autocomplete="off" readonly></td>
</tr>
<tr rowspan="6">
<td >Department:</td>
<td colspan="5"><input type="text" class="form-control" id="pctc" name="pctc" value="<?php echo  $row[1]; ?>" autocomplete="off" readonly></td>
</tr>
<tr rowspan="6">
<td>Position:</td>
<td colspan="5"><input type="text" class="form-control" id="ectc" name="ectc" value="<?php echo  $row[2]; ?>" autocomplete="off" readonly></td>
</tr>
<tr rowspan="6">
<td>Candidate CTC:</td>
<td colspan="5"><input type="text" class="form-control" id="cctc" name="cctc" value="<?php echo  $row[3]; ?>" autocomplete="off" readonly></td>
</tr>
<tr rowspan="6">
<td>Candidate Expected CTC:</td>
<td colspan="5"><input type="text" class="form-control" id="ectc" name="ectc" value="<?php echo  $row[4]; ?>" autocomplete="off" readonly></td>
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
<td colspan="5"><input type="text" class="form-control" id="cug" name="cug" autocomplete="off"></td>
</tr>
<tr>
<td>Mail ID</td>
<td colspan="5"><input type="text" class="form-control" id="mail" name="mail" autocomplete="off"></td>
</tr> 
<tr>
<td>System</td>
<td colspan="5"><input type="text" class="form-control" id="system" name="system" autocomplete="off"></td>
</tr>
<tr>
<td>Seating</td>
<td colspan="5"><input type="text" class="form-control" id="seating" name="seating" autocomplete="off"></td>
</tr>
</table>
<input type="button" class="btn btn-primary btn-md"  style="float:right;" name="Update" onclick="ctc_update()" value="Approve"> 
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
	function back_ctc()
	{
		$.ajax({
		type:"POST",
		url:"HRMS/ctcapproval/CTC_view.php",
		success:function(data){
		$("#main_content").html(data);
		}
		})
	}
    function ctc_update()
    {
    var id=<?php echo $id; ?>;
    var data = $('form').serialize();
    $.ajax({
    type:'GET',
    data:"id="+id, data,
    url:'HRMS/ctcapproval/approval_update.php',
    success:function(data)
    {
      if(data==1)
      { 
        alert('Update Successfully');
        ctc_approval();
      }
      else
      {
        alert("No Data choose");
		ctc_approval();
      }
      
    }       
    });
    }
    </script>