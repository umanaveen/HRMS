

<?php
require '../../connect.php';
require '../../user.php';
$candidateid=$_SESSION['candidateid'];
$userrole=$_SESSION['userrole'];
?>

<div  class="card card-primary">
              <div class="card-header">
                <h3 class="card-title"><font size="5">Client List</font></h3>
		
			
              </div>
              <!-- /.card-header -->
              <div class="card-body">
			  
       <table class="dataTables-example table table-striped table-bordered table-hover"  id="example1">
    
      <thead>
	  <th>#</th>
     <th>Client_name</th>
	 <th>Organization_name</th>
	 <th>Client_designation</th>
	 <th>Mobile_no</th>
	 <th>Email_id</th>
	<th>Status</th>
<th>Action</th>
      </thead>
      <tbody>
      <?php
	  $datas=$con->query("SELECT * FROM `client_master`");
	 $cnt=1;
      while($enquiry = $datas->fetch(PDO::FETCH_ASSOC))
	  {
		  ?>
      <tr>
	  <td><?php echo $cnt;?>.</td>
      <td><?php echo $enquiry['client_name'];?>.</td>
	  <td><?php echo $enquiry['org_name'];?>.</td>
	  <td><?php echo $enquiry['designation'];?>.</td>
	   <td><?php echo $enquiry['mobile_no1'];?>.</td>
	  <td><?php echo $enquiry['email_id1'];?>.</td>
	<td><?php if($enquiry['status']==1)
		{

echo '<span style="color:blue;text-align:center;"><b>Pending</b></span>';
}
if($enquiry['status']==2)
{

echo '<span style="color:green;text-align:center;"><b>Approved</b></span>';
}
if($enquiry['status']==3)
{

echo '<span style="color:red;text-align:center;"><b>Rejected</b></span>';
}
		?></td>
	<td>				
		<button class="btn btn-info" data-id="<?php echo $enquiry['id']; ?>" onclick="client_masterss(<?php echo $enquiry['id']; ?>)"><i class="fa fa-eye"></i></button>
				

	</td>
      </tr>
      <?php
	  $cnt=$cnt+1;
      }
      ?>
      </tbody>
       </table>
				
              </div>
              <!-- /.card-body -->
            </div>
<script>
	$(document).ready(function() {
		$('.dataTables-example').DataTable({
				responsive: true
		});
	});
</script>
<script>
	
  function client_masterss(v){
	//  alert(v);
	$.ajax({
	type:"POST",
	url:"HRMS/CRM/client_insert_approval.php?id="+v,
	success:function(data)
	{
		$(".content").html(data);
	}
	})
}

function back_ctc()
	{
		enquiry()
	}
    </script>
