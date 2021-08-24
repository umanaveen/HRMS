<?php
require ("../../../connect.php");
$id=$_REQUEST['id'];
$stmt = $con->prepare("SELECT * FROM employee_permission_master
where employee_permission_master.id='$id'"); 

$stmt->execute(); 
$row = $stmt->fetch();
?>
 <div class="card card-info">
              <div class="card-header">  
              <center><h3 class="card-title"><b>Permission Details </b></h3></center>
			<a onclick="return back_permission()" style="float: right;" data-toggle="modal" class="btn btn-danger"></i>Back</a>
              </div>
			  <br>
			  <br>
			  <br>
              <!-- /.card-header -->
              <!-- form start -->
<form role="form" name="" action="" method="post" enctype="multipart/type">
         
                <div class="card-body">
				  <div class="form-group row">
                    <label for="inputname" class="col-sm-2 col-form-label">Employee Type</label>
                    <div class="col-sm-4">
					 <input type="hidden" class="form-control" id="get_id" name="get_id" value="<?php echo  $id; ?>">
					 <?php if($row['employee_type']==1) {
						 ?>
                      <input type="text" class="form-control" name="Employee" id="Employee" value="Onroll Employee" readonly>
					 <?php } else if($row['employee_type']==2) {  ?>
					 <input type="text" class="form-control" name="Employee" id="Employee" value="Apprentices" readonly>
					 <?php } else if($row['employee_type']==3) {?>
					  <input type="text" class="form-control" name="Employee" id="Employee" value="Contract Labour" readonly>
					 <?php } ?>
                  </div>
				  </div>
				  
				   <div class="form-group row">
                    <label for="inputdob" class="col-sm-2 col-form-label">Woosu employee Master</label>
                    <div class="col-sm-4">
                      <input type="text" class="form-control" name="Woosu" id="Woosu" value="<?php echo  $row['emp_code'];?>"readonly>
                    </div>
                  </div>
				
				
				
				  <div class="form-group row">
                    <label for="inputnumber" class="col-sm-2 col-form-label">Permission Date</label>
                    <div class="col-sm-4">
                      <input type="text" class="form-control" name="permission_date" id="permission_date" value="<?php echo  $row['permission_date'];?>"readonly>
                    </div>
                  </div>
				  
				    <div class="form-group row">
                    <label for="inputnumber" class="col-sm-2 col-form-label">From Time</label>
                    <div class="col-sm-4">
                      <input type="text" class="form-control" name="from_time" id="from_time" value="<?php echo  $row['from_time'];?>"readonly>
                    </div>
                  </div>
				  
			
		   <div class="form-group row">
                    <label for="inputnumber" class="col-sm-2 col-form-label">To Time</label>
                    <div class="col-sm-4">
                      <input type="text" class="form-control" name="to_time" id="to_time" value="<?php echo  $row['to_time'];?>"readonly>
                    </div>
                  </div>
				  <center>
				  <?php if ( $row['approve_status']==1){
	?>
 <input type="button" class="btn btn-success btn-lg"" id="save" name="save" onclick="approved()" value="Approve">

<input type="button" class="btn btn-danger btn-lg"" id="save" name="save" onclick="rejected()" value="Rejected">
<?php }
?>
</center>
              </form>
			   
			
			  
            </div>
			
			<script>
	
		
 function approved()
    {
    var id=$('#get_id').val();
	//alert(id);
 var data = $('form').serialize();
    $.ajax({
    type:'GET',
    data:"id="+id,data,
	
      url:"payroll/permission/approval.php",
    success:function(data)
    {
      if(data==1)
      { 
        alert('Not');
      }
      else
      {
        alert("Approved Successfully");
		employee_permission()
      }
      }           
    });
    }
	function rejected()
    {
    var id=$('#get_id').val();
	//alert(id);
 var data = $('form').serialize();
    $.ajax({
    type:'GET',
    data:"id="+id,data,
	
      url:"payroll/permission/rejected.php",
    success:function(data)
    {
      if(data==1)
      { 
        alert('Not');
      }
      else
      {
        alert("Rejected Successfully");
		employee_permission()
      }
      }           
    });
    }

   
	
function back_permission()
{
    $.ajax({
    type:"POST",
    url:"payroll/permission/permission.php",
    success:function(data){
      $("#main_content").html(data);
    }
  })
}
	</script>