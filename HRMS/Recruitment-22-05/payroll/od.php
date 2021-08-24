<?php
require '../../connect.php';
?>
<div class="content-wrapper" style="padding-left: 50px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>OD</h1>
          </div>
          <div class="col-sm-6">
		  <a onclick="return add_od()" style="float: right;" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus"></i> ADD</a>
          </div>
        </div>
      </div><!-- /.container-fluid -->
	</section>
    <!-- Main content -->
    <section class="content">
    <div class="container-fluid">
    <div class="row">
    <div class="col-md-12">
    <!-- Profile Image -->
    <div class="card card-primary card-outline">
    <div class="card-body box-profile">
    <table id="example1" class="table table-bordered">
    <thead>
      <th>S.No</th>
      <th>Emp Code</th>
      <th>Emp Name</th>
     <th>Date </th>
	<th>Customer Name</th>
	<th>Location</th>
	<th>Purpose</th>
	
	<th>Action</th>
      </thead>
      <tbody>
      <?php
      $holiday=$con->query("SELECT manual_att.id AS manualid,manual_att.emp_id as manemp_id,manual_att.customer_name,manual_att.location,manual_att.date,manual_att.purpose,employee_master.id as emp_id,employee_master.code,employee_master.pf_number,employee_master.name,employee_master.dob,employee_master.department,employee_master.division,employee_master.section,employee_master.mail,employee_master.address1,employee_master.address2,employee_master.status FROM `manual_att` INNER JOIN employee_master on manual_att.emp_id=employee_master.id");
     $cnt=1;
      while($holiday_master = $holiday->fetch(PDO::FETCH_ASSOC))
      {
     
      ?>
      <tr>
	  <td><?php echo $cnt;?>.</td>
      <td><?php echo $holiday_master['code']; ?></td>
      <td><?php echo $holiday_master['name']; ?></td>
      <td><?php echo $holiday_master['date']; ?></td>
	   <td><?php echo $holiday_master['customer_name']; ?></td>
	    <td><?php echo $holiday_master['location']; ?></td>
		    <td><?php echo $holiday_master['purpose']; ?></td>

	  

     <td>
				
							<button class="btn btn-success btn-sm edit btn-flat" data-id="<?php echo $holiday_master['manualid']; ?>" onclick="od_edit(<?php echo $holiday_master['manualid']; ?>)"><i class="fa fa-edit"></i> Edit</button>
							
												</td>
      </tr>
      <?php
	  $cnt=$cnt+1;
      }
      ?>
      </tbody>
      </table>
    
<!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
</div>

<script>
		function add_od()
    {
    $.ajax({
    type:"POST",
    url:"Recruitment/payroll/od_add.php",
    success:function(data){
    $(".content").html(data);
    }
    })
  }
  function od_edit(v){
	$.ajax({
	type:"POST",
	url:"Recruitment/payroll/od_edit.php?id="+v,
	success:function(data)
	{
		$(".content").html(data);
	}
	})
}
</script>