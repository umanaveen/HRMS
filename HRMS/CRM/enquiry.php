
<?php
require '../../connect.php';
require '../../user.php';
$candidateid=$_SESSION['candidateid'];
$userrole=$_SESSION['userrole'];
?>

<div  class="card card-primary">
              <div class="card-header">
                <h3 class="card-title"><font size="5">Enquiry List</font></h3>
			<a onclick="return add_enquree()"  style="float: right;" data-toggle="modal" class="btn btn-dark"><i class="fa fa-plus"></i>  New Enquiry</a>
              </div>
  
 <div class="card-body">
			  
    <table id="example1" class="table table-bordered table-striped">
    
    <thead>
	  <th>#</th>
      <th>Call Type</th>
      <th>Date</th>
      <th>Client</th>
      <th>Location</th>
      <th>Contact Number</th>
      <th>Follow Up Date </th>
	  <th>Employee</th>
      <th>Status </th>
	  <th>Action</th>
    </thead>
      <tbody>
      <?php
$candidateid=$_SESSION['candidateid'];
$userrole=$_SESSION['userrole'];

	 if($userrole=='ROLE-007' ){
		 $datas=$con->query("SELECT enquiry.id as enquiry_id,enquiry.status as enquiry_status,enquiry.mail as enquiry_mailid,enquiry.*,calls_master.*,z_department_master.*,candidate_form_details.*  FROM `enquiry`
	   left JOIN calls_master ON enquiry.Call_type=calls_master.id
	  left join z_department_master ON enquiry.Department=z_department_master.id
	  left JOIN candidate_form_details ON enquiry.employee=candidate_form_details.id  where enquiry.employee='$candidateid' ORDER BY enquiry.id DESC");
	 } else {
      $datas=$con->query("SELECT enquiry.id as enquiry_id,enquiry.status as enquiry_status,enquiry.mail as enquiry_mailid,enquiry.*,calls_master.*,z_department_master.*,candidate_form_details.*  FROM `enquiry`
	   left JOIN calls_master ON enquiry.Call_type=calls_master.id
	  left join z_department_master ON enquiry.Department=z_department_master.id
	  left JOIN candidate_form_details ON enquiry.employee=candidate_form_details.id ORDER BY enquiry.id DESC");
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

echo '<span style="color:brown;text-align:center;"><b>Generated Cost Sheet</b></span>';
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
		<button class="btn btn-info" data-id="<?php echo $enquiry['enquiry_id']; ?>" onclick="ctc_view(<?php echo $enquiry['enquiry_id']; ?>)"><i class="fa fa-eye"></i></button>
				
<?php if($enquiry['enquiry_status']==1){
?>				
<button class="btn btn-danger" data-id="<?php echo $enquiry['enquiry_id']; ?>" onclick="enquiry_edit(<?php echo $enquiry['enquiry_id']; ?>)"><i class="fa fa-edit"></i>Edit</button>
			<?php } ?>
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
</script>
<script>

		function add_enquree()
    {
    $.ajax({
    type:"POST",
    url:"HRMS/CRM/enquiry_add.php",
    success:function(data){
    $("#main_content").html(data);
    }
    })
  }
  
  function client_masterss(v){
	//  alert(v);
	$.ajax({
	type:"POST",
	url:"HRMS/CRM/client_insert.php?id="+v,
	success:function(data)
	{
		$("#main_content").html(data);
	}
	})
}
 function ctc_view(v){
	  //alert(v);
	$.ajax({
	type:"POST",
	url:"HRMS/CRM/enquiry_view.php?id="+v,
	success:function(data)
	{
		$("#main_content").html(data);
	}
	})
}
 function enquiry_edit(v){
	  //alert(v);
	$.ajax({
	type:"POST",
	url:"HRMS/CRM/enquiry_edit.php?id="+v,
	success:function(data)
	{
		$("#main_content").html(data);
	}
	})
}
    </script>
