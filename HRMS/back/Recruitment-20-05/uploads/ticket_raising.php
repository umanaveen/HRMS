<?php
require '../../connect.php';
include("../../user.php");
//$rolemaster_id=$_SESSION['rolemaster_id'];
//echo "$rolemaster_id";
?>
<div class="card card-info">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
       
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">
           

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Folders</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
            <div class="card-body p-0">
                <ul class="nav nav-pills flex-column">
                  <li class="nav-item active">
				  	<a onclick="raisingadd()" class="nav-link">
                
                      <i class="fas fa-inbox"></i> New Tickets
                      <!--<span class="badge bg-primary float-right">12</span>-->
                    </a>
                  </li>
                  <li class="nav-item">
				  
                  <a onclick="tickets_send()" class="nav-link">
                      <i class="far fa-envelope"></i> Send
                    </a>
                  </li>
				  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="fas fa-filter"></i> Received
                    <!--  <span class="badge bg-warning float-right">65</span>-->
                    </a>
                  </li>
                  <li class="nav-item">
                  <a onclick="tickets_send()" class="nav-link">
                      <i class="far fa-file-alt"></i> Drafts
                    </a>
                  </li>
                  
                 
                </ul>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
            
            <!-- /.card -->
          </div>
          <!-- /.col -->
		  
          <div class="col-md-9">
		   <form class="form-horizontal" method="POST" action="Tickets/Ticket_raising/submit.php" enctype="multipart/form-data">
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h3 class="card-title">Compose New Tickets</h3>
              </div>
              <!-- /.card-header -->
			 
         
              <div class="card-body">
			  <div class="form-group row">
                   
                   
                      <select class="form-control" name="project" id="project">
					  
					  <option value="">SELECT PROJECT</option>
					  <?php
					  $query=$con->query("SELECT * FROM  masters_client");
					  $query->execute(); 
$row = $query->fetch();
$client_id=$row['client_id'];

$sql=$con->query("SELECT * FROM masters_project where client_id='$client_id'");
      $i=1;
      while($cmp = $sql->fetch(PDO::FETCH_ASSOC))
      {
		  ?>
		  <option value="<?php echo $cmp['id'];?>"><?php echo $cmp['Project_name'];?></option>
		  <?php
	  }
		  ?>
					  </select>
                   
                  </div>
				    <div class="form-group row">
                    
                    
                     <select class="form-control" name="hod" id="hod">
					
</select>
                    
                  </div>
               
                <div class="form-group">
					<input type="hidden" class="form-control" id="get_client_id" name="get_client_id" value="<?php echo  $row['client_id']; ?>">
                  <input class="form-control" name="subject" placeholder="Subject:">
                </div>
                <div class="form-group">
                    <textarea id="decription" name="decription" class="form-control" style="height:300px">
                     
                     
                   
                    </textarea>
                </div>
                <div class="form-group">
                 
              
        <h2>Upload File</h2>
		
       
        <input type="file" name="image">
   
                </div>
              </div>
             
			
              <div class="card-footer">
                <div class="float-right">
                  <button type="button" class="btn btn-default"><i class="fas fa-pencil-alt"></i> Draft</button>
				   <button type="submit" name="submit" class="btn btn-primary"><i class="far fa-envelope"></i> Send</button>
                 
                </div>
                <button type="button" class="btn btn-default" onclick="raisingadd()"><i class="fas fa-times" ></i> Discard</button>
              </div>
              
            </div>
             </form>
          </div>
    
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  


<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });

   
  
  $(function () {
    //Add text editor
    $('#decription').summernote()
  })
  $(document).ready(function() {
$('#project').on('change', function() {

var project_id = this.value;
alert(project_id);
$.ajax({
url: "Tickets/Ticket_raising/find_hod.php",
type: "POST",
data: {
project_id: project_id
},
cache: false,
success: function(result){
$("#hod").html(result);


}
});
});

});
function raisingadd()
	{
		$.ajax({
		type:"POST",
		url:"Tickets/Ticket_raising/ticket_raising.php",
		success:function(data){
		$("#main_content").html(data);
		}
		})
	}
	function tickets_send()
	{
		$.ajax({
		type:"POST",
		url:"Tickets/Ticket_raising/tickets_send.php",
		success:function(data){
		$("#main_content").html(data);
		}
		})
	}
</script>

