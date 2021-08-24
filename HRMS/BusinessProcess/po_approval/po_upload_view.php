<?php
require '../../../connect.php';
include("../../../user.php");
$id=$_REQUEST['id'];
$stmt = $con->prepare("SELECT * FROM quote_generate where id='$id'"); 

$stmt->execute(); 
$row = $stmt->fetch();
?>
 <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">PO Upload Details </h3>
			<a onclick="return back_ctc()" style="float: right;" data-toggle="modal" class="btn btn-primary"></i>Back</a>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
<form id="fupForm12" class="form-horizontal" method="POST" enctype="multipart/form-data">
         
                <div class="card-body">
				  <div class="form-group row">
                    <label for="inputname" class="col-sm-2 col-form-label">Quote No</label>
                    <div class="col-sm-4">
			          <input type="hidden" class="form-control" id="get_id" name="get_id" value="<?php echo  $row['id']; ?>">

                      <input type="text" class="form-control" name="quote_no" id="quote_no" value="<?php echo  $row['quote_no'];?>"readonly>
                  </div>
				  </div>
				  
				   <div class="form-group row">
                    <label for="inputdob" class="col-sm-2 col-form-label">Quote Date</label>
                    <div class="col-sm-4">
                      <input type="text" class="form-control" name="quote_date" id="quote_date" value="<?php echo  $row['quote_date'];?>"readonly>
                    </div>
                  </div>

				  <div class="form-group row">
                    <label for="inputnumber" class="col-sm-2 col-form-label">Cost Sheet No</label>
                    <div class="col-sm-4">
                      <input type="text" class="form-control" name="cost_sheet_no" id="cost_sheet_no" value="<?php echo  $row['cost_sheet_no'];?>"readonly>
                    </div>
                  </div>
				
				
				  <div class="form-group row">
                    <label for="inputnumber" class="col-sm-2 col-form-label">PO Upload</label>
                    <div class="col-sm-4">
				<input type="file" class="form-control" id="attachment_1" name="attachment[]"  />
                    </div>
                  </div>
				  
				   <div class="form-group row">
                    <label for="inputnumber" class="col-sm-2 col-form-label">PO Date</label>
                    <div class="col-sm-4">
                      <input type="date" class="form-control" name="po_date" id="po_date" >
                    </div>
                  </div>
				 
			<input type="submit" name="submit" class="btn btn-success submitBtn" value="UPDATE"/>
              </form>
			   
			
			  
            </div>
			
	<!--script>
function back_ctc(v){
	  //alert(v);
	$.ajax({
	type:"POST",
	url:"Qvision/BusinessProcess/po_upload/po_upload.php?id="+v,
	success:function(data)
	{
		$(".content").html(data);
	}
	})
}	

var date = new Date();
var day = date.getDate();
var month = date.getMonth() + 1;
var year = date.getFullYear();

if (month < 10) month = "0" + month;
if (day < 10) day = "0" + day;

var today = year + "-" + month + "-" + day;

document.getElementById("po_date").value = today;

function po_upload_submit(){
	   var data = $('form').serialize();
	$.ajax({
	type:"GET",
	data:"id="+id,data,
	url:"Qvision/Qvision/BusinessProcess/po_upload/po_upload_view/po_upload_submit.php",
	success:function(data)
	{
		$(".content").html(data);
	}
	})
}
</script-->
<script>
/* $(document).ready(function(){
    // Submit form data via Ajax
    $("#po_upload").on('submit', function(e){
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: '/Qvision/Qvision/BusinessProcess/po_approval/po_upload_submit.php',
            data: new FormData(this),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData:false,
           
            success: function(response){
      if(response==0)
      { 
        alert('Certification Details form entry Successfully Completed.Then fill out the Employement details');
        application();
      }
      else
      {
        alert("Entry Unsuccessfull");
		application();
      }
      
    }   
        });
    });
	
    // File type validation
    var match = ['application/pdf', 'application/msword', 'application/vnd.ms-office', 'image/jpeg', 'image/png', 'image/jpg'];
    $("#file").change(function() {
        for(i=0;i<this.files.length;i++){
            var file = this.files[i];
            var fileType = file.type;
			
            if(!((fileType == match[0]) || (fileType == match[1]) || (fileType == match[2]) || (fileType == match[3]) || (fileType == match[4]) || (fileType == match[5]))){
                alert('Sorry, only PDF, DOC, JPG, JPEG, & PNG files are allowed to upload.');
                $("#file").val('');
                return false;
            }
        }
    });
}); */
$(document).ready(function(){
    // Submit form data via Ajax
    $("#fupForm12").on('submit', function(e){
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: '/Qvision/Qvision/BusinessProcess/po_approval/po_upload_submit.php',
            data: new FormData(this),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData:false,
           
            success: function(response){
      if(response==0)
      { 
        alert('Uploaded successfully');
        po_upload();
      }
      else
      {
        alert("Uploaded failed");
		po_upload();
      }
      
    }   
        });
    });
	
    // File type validation
    var match = ['application/pdf', 'application/msword', 'application/vnd.ms-office', 'image/jpeg', 'image/png', 'image/jpg'];
    $("#file").change(function() {
        for(i=0;i<this.files.length;i++){
            var file = this.files[i];
            var fileType = file.type;
			
            if(!((fileType == match[0]) || (fileType == match[1]) || (fileType == match[2]) || (fileType == match[3]) || (fileType == match[4]) || (fileType == match[5]))){
                alert('Sorry, only PDF, DOC, JPG, JPEG, & PNG files are allowed to upload.');
                $("#file").val('');
                return false;
            }
        }
    });
});
</script>