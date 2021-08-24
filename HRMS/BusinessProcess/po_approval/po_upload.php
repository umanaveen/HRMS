<?php
require '../../../connect.php';
require '../../../user.php';
$candidateid=$_SESSION['candidateid'];
$userrole=$_SESSION['userrole'];
?>
<style>
#page-wrapper{
	margin-left: 117px !important;
}
.btn-warning{
	padding-top: 0px !important;
}

.btn-warning{
	background-color: #337ab7 !important;
    border-color: #337ab7 !important;
}
.btn-success{
	background-color: #5cb85c !important;
    border-color: #5cb85c !important;
}
.page-header{
	border-bottom: 3px solid #eee !important;
}
</style>
 <div  class="card card-primary">
              <div class="card-header">
                <h3 class="card-title"><font size="5">PO Upload List</font></h3>
		
			
              </div>
              <!-- /.card-header -->
              <div class="card-body">

<table id="dataTable" class="table table-bordered table-striped">
      <thead>
	  <th>#</th>
      <th>Call Type</th>
      <th>Date</th>
      <th>Client</th>
      <th>Location</th>
      <th>Contact Number</th>
     
      
     <th>Foll UP Date </th>
	
	
	<th>Employee</th>
	<th width="20%">Status</th>
	<<th width="20%">Action</th>
      </thead>
      <tbody>
      <?php
$candidateid=$_SESSION['candidateid'];
$userrole=$_SESSION['userrole'];

	 if($userrole=='ROLE-007' ){
		 $datas=$con->query("SELECT enquiry.status as enquiry_status,enquiry.id as enquiry_id,enquiry.mail as enquiry_mailid,enquiry.*,calls_master.*,z_department_master.*,candidate_form_details.*  FROM `enquiry`
	   INNER JOIN calls_master ON enquiry.Call_type=calls_master.id
	  INNER join z_department_master ON enquiry.Department=z_department_master.id
	  INNER JOIN candidate_form_details ON enquiry.employee=candidate_form_details.id  where enquiry.employee='$candidateid' and enquiry.status='7'");
	

	} else {
      $datas=$con->query("SELECT enquiry.status as enquiry_status, enquiry.id as enquiry_id,enquiry.mail as enquiry_mailid,enquiry.*,calls_master.*,z_department_master.*,candidate_form_details.*  FROM `enquiry`
	   INNER JOIN calls_master ON enquiry.Call_type=calls_master.id
	  INNER join z_department_master ON enquiry.Department=z_department_master.id
	  INNER JOIN candidate_form_details ON enquiry.employee=candidate_form_details.id
	  where  enquiry.status='7'");
	 }
	 
	 
     $cnt=1;
      while($enquiry = $datas->fetch(PDO::FETCH_ASSOC))
	  {
		  ?>
      <tr>
	  <td><?php echo $cnt;?>.</td>
      <td><?php echo $enquiry['name']; ?></td>
      <td><?php echo $enquiry['date']; ?></td>
      <td><?php echo $enquiry['Company_name']; ?></td>
      <td><?php echo $enquiry['Location']; ?></td>
      <td><?php echo $enquiry['Mobile']; ?></td>
    
     
	    <td><?php echo $enquiry['Follup']; ?></td>
		
		 
	   
	    <td><?php echo $enquiry['first_name']; ?></td>
		 <td><?php if($enquiry['enquiry_status']==1)
		{

echo '<span style="color:green;text-align:center;"><b>Enquiry Added</b></span>';
}
if($enquiry['enquiry_status']==2)
{

echo '<span style="color:Blue;text-align:center;"><b>Generated Lead</b></span>';
}
if($enquiry['enquiry_status']==3)
{

echo '<span style="color:brown;text-align:center;"><b>pending cost sheet generation</b></span>';
}
if($enquiry['enquiry_status']==4)
	
{
echo '<span style="color:green;text-align:center;"><b>Generated For Cost Sheet Approval</b></span>';
}
if($enquiry['enquiry_status']==5)
	
{
echo '<span style="color:blue;text-align:center;"><b> Cost Sheet Approved</b></span>';
}
if($enquiry['enquiry_status']==6)
	{
echo '<span style="color:red;text-align:center;"><b> Cost Sheet Rejected</b></span>';
}
if($enquiry['enquiry_status']==7)
	{
echo '<span style="color:Green;text-align:center;"><b> Quotation Generated </b></span>';
}
		?></td>
		 <td>  
	
	<button class="btn btn-info" data-id="<?php echo $enquiry['enquiry_id']; ?>" onclick="po_add(<?php echo $enquiry['enquiry_id']; ?>)"><i class="fa fa-eye"></i></button>
	</td>
      </tr>
      <?php
	  $cnt=$cnt+1;
      }
      ?>
      </tbody>
      </table>

      </div>
<!-- /.card -->
      </div>
    

<script>
            $(document).ready(function() {
                $('.dataTables-example').DataTable({
                        responsive: true
                });
            });
        </script>
<script>
	
  
 
function po_add(v){
	  //alert(v);
	$.ajax({
	type:"POST",
	url:"HRMS/BusinessProcess/po_approval/po_add.php?id="+v,
	success:function(data)
	{
		$("#main_content").html(data);
	}
	})
}
</script>