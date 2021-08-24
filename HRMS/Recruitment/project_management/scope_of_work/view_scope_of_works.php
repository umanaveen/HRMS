<?php
require '../../../../connect.php';
 $id=$_REQUEST['id'];
$stmt = $con->prepare("select * from project_management a LEFT JOIN client_master b on a.client=b.id where a.project_id='$id'");
//echo "select * from project_management a LEFT JOIN client_master b on a.client=b.id where a.project_id='$id'";
$stmt->execute(); 
$row = $stmt->fetch();
//$sid=$row['emp_name'];
//$pid=$row['dep_id'];
?>
<div class="container-fluid">
<div class="card mb-3">
<div class="card-header">
<a onclick="return back()" style="float: right;" data-toggle="modal" class="btn btn-danger"></i>Back</a>
<button value="print" class="btn btn-primary" style="float: right;" onclick="printDiv('printableArea')">print</button> 

</div>
<div class="card-body" id="printableArea">
<form role="form" name="" action="HRMS/Recruitment/project_management/scope_of_work/update_scope_of_work.php" method="post" enctype="multipart/type">

<table class="table table-bordered">
	
	<tr id="new">
		<td><center><b><u>SCOPE OF WORK</u></b></center></br>
		<?php echo $row['scope_of_project'];  ?></td>  
	</tr>
</table>
</form>

<script>
		function back()
    {
		
    $.ajax({
    type:"POST",
    url:"/HRMS/HRMS/Recruitment/project_management/scope_of_work/scope_of_work_list.php",
    success:function(data){
    $("#main_content").html(data);
    }
    })
  }
  
	  function printDiv(divName) 
	  {
		var printContents = document.getElementById(divName).innerHTML;
		var originalContents = document.body.innerHTML;
		var htmlToPrint = '' +
			'<style type="text/css">' +
			'table th, table td {' +
			'border:2px solid #000;' +
			
			'}' +
			'</style>';
			htmlToPrint += printContents;
			var printWindow = window.open('', 'PRINT','height=400,width=600');
			printWindow.document.write(htmlToPrint);
			printWindow.print();
			printWindow.close();
	}
  
  /* $(function () {
//Add text editor
$('#scope_of_project').summernote()
}) */
  </script>