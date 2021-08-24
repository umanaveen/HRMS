<?php
require '../../../connect.php';
require '../../../user.php';
$candidateid=$_SESSION['candidateid'];
$userrole=$_SESSION['userrole'];
?>
<div class="content-wrapper" style="padding-left: 50px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Quotation /Proposal View</h1>
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
    <div class="card-body">
    <table id="example1" class="table table-bordered table-striped">
      <thead>
	  <th>#</th>
      <th>Product/Service  </th>
      <th>Quote Type</th>
      <th>Vendor Name</th>
	  <th>Client Name</th>
      <th>Employee Name</th>
	  <th>Action</th>
      </thead>
      <tbody>
      <?php
$candidateid=$_SESSION['candidateid'];
$userrole=$_SESSION['userrole'];


		 $datas=$con->query("SELECT a.id as quote_id,a.*,b.*,c.*,e.* from quotation_entry a 
		 inner join client_master b on(b.id=a.client_id) 
		 inner join doller_vendor_mastor c on(c.id=a.vendor_id)
		 inner join emp_personal_details e on(e.emp_id=a.candid_id) where a.status ='1' limit 1") ;
		
	  
     $cnt=1;
      while($data = $datas->fetch(PDO::FETCH_ASSOC))
	  {
		  ?>
      <tr>
	  <td><?php echo $cnt;?>.</td>
      <td><?php
	  if($data['business_id'] =='1'){ echo "Product"; 
	  }elseif($data['business_id'] =='2'){ echo "Service";
	  }elseif($data['business_id'] =='3'){ echo "Solution";
	  }
	  ?></td>
      <td><?php if($data['vendor_id']=='1'){ echo "INR"; }else{ echo "Doller";}?></td>
      <td><?php echo $data['vendor_name']; ?></td>
      <td><?php echo $data['client_name']; ?></td>
	  <td><?php echo $data['name']; ?></td>
	  <td>  
	     <button class="btn btn-info" data-id="<?php echo $data['vendor_id']; ?>" onclick="quote_proposal_view(<?php echo $data['vendor_id']; ?>)">
	     <i class="fa fa-eye"></i></button>
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




function quote_proposal_view(v){
	  //alert(v);
	$.ajax({
	type:"POST",
	url:"HRMS/BusinessProcess/quotation/quotation_approve.php?id="+v,
	success:function(data)
	{
		$(".content").html(data);
	}
	})
}
function back_ctc()
	{
		Quotation_view()
	}
    </script>
</script>