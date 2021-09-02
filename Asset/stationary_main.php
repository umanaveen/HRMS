<?php
require '../connect.php';
?>
<head>
<style>	
	td{
		vertical-align: middle !important;
	}
	td p{
		margin: unset
	}
	img{
		max-width:100px;
		max-height: :150px;
	}
</style>
</head> 
<div class="container-fluid">
	<div class="col-lg-12">
	<div class="row">
	<!-- Table Panel -->
	<div class="card">
		<div class="card-body">
			<table class="table table-bordered table-hover">
			<thead>
			<tr>
			<th class="text-center">#</th>
			<th class="text-center">purchase_date</th>
			<th class="text-center">Stationary</th>
			<th class="text-center">Count</th>
			<th class="text-center">invoice_no</th>
			<th class="text-center">invoice_files</th>
			<th class="text-center">qr_code</th>
			<th class="text-center">status</th>
			<th class="text-center">Actions</th>
			</tr>
			</thead>
			<tbody>
			<?php 
			$i = 1;
			$asset_inward = $con->query("SELECT id, purchase_date, stationary_id, no_of_count, invoice_no, invoice_files, qr_code, status FROM asset_stationary_inward_master");
			while($row=$asset_inward->fetch(PDO::FETCH_ASSOC)):
			?>
			<tr>
			<td class="text-center"><?php echo $i++ ?></td>									
			<td class="">
				 <p> <b><?php echo $row['purchase_date'] ?></b></p>
			</td><td class="">
				 <p> <b><?php echo $row['stationary_id'] ?></b></p>
			</td><td class="">
				 <p> <b><?php echo $row['no_of_count'] ?></b></p>
			</td><td class="">
				 <p> <b><?php echo $row['invoice_no'] ?></b></p>
			</td><td class="">
				 <p> <b><?php echo $row['invoice_files'] ?></b></p>
			</td><td class="">
				 <p> <b><?php echo $row['qr_code'] ?></b></p>
			</td><td class="">
				 <p> <b><?php echo $row['status'] ?></b></p>
			</td>
			<td class="text-center">
			<button class="btn btn-sm btn-success view_department" type="button" data-id="<?php echo $row['id'] ?>">View</button>
			<button class="btn btn-sm btn-primary edit_department" type="button" data-id="<?php echo $row['id'] ?>">Edit</button>
			<button class="btn btn-sm btn-danger delete_department" type="button" data-id="<?php echo $row['id'] ?>">Delete</button>
			</td>
			</tr>
			<?php endwhile; ?>
			</tbody>
			</table>
		</div>
	</div>
	<!-- Table Panel -->
	</div>
	</div>
	<!-- FORM Panel -->
	<div class="col-md-6">
	<form action="" id="stationary-inward" enctype="multipart/form-data">
	<div class="card">
	<div class="card-header">
	Asset Inward
	</div>
	<div class="card-body">
	<input type="hidden" name="id">
	<div class="form-group">
		<label class="control-label">Purchase Date</label>
		<input type="date" name="purchase_date" id="" class="form-control">
	</div>
	</div>
	<div class="card-body">
	<div class="form-group">
		<label class="control-label">Stationary</label>
		<input type="text" name="stationary_id" id="" class="form-control">
	</div>							
	</div>
	<div class="card-body">
	<div class="form-group">
		<label class="control-label">Number of Counts</label>
		<input type="text" name="no_of_count" id="" class="form-control">
	</div>							
	</div>
	<div class="card-body">
	<div class="form-group">
		<label class="control-label">invoice_no</label>
		<input type="text" name="invoice_no" id="" class="form-control">
	</div>							
	</div>
	<div class="card-body">
	<!-- File Upload --> 
	<div class="form-group">
		<label class="control-label">invoice_files</label>
		<input type="file" class="form-control" id="file" name="file" required />
	</div>							
	</div>
	<div class="card-body">
	<div class="form-group">
		<label class="control-label">qr_code</label>
		<input type="text" name="qr_code" id="" class="form-control">
	</div>							
	</div>					
	<div class="card-footer">
	<div class="row">
	<div class="col-md-12">
		<button class="btn btn-sm btn-primary col-sm-3 offset-md-3">Save</button>
		<button class="btn btn-sm btn-default col-sm-3" type="button" onclick="_reset()"> Cancel</button>
	</div>
	</div>
	</div>
	</div>
	</form>
	</div>
	<!-- FORM Panel -->
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="Asset/jquery.min.js"></script>
<script type="text/javascript" src="Asset/jquery-te-1.4.0.min.js" charset="utf-8"></script>

<script>
	function _reset(){
		$('[name="id"]').val('');
		$('#stationary-inward').get(0).reset();
	}

</script>
<script>

// File type validation
$("#file").change(function() {
    var file = this.files[0];
    var fileType = file.type;
    var match = ['application/pdf', 'application/msword', 'application/vnd.ms-office', 'image/jpeg', 'image/png', 'image/jpg'];
    if(!((fileType == match[0]) || (fileType == match[1]) || (fileType == match[2]) || (fileType == match[3]) || (fileType == match[4]) || (fileType == match[5]))){
        alert('Sorry, only PDF, DOC, JPG, JPEG, & PNG files are allowed to upload.');
        $("#file").val('');
        return false;
    }
});


$('#stationary-inward').submit(function(e)
{
	var form = $('form')[0]; // You need to use standard javascript object here
	var formData = new FormData(form);
	
	// Attach file
	formData.append('image', $('input[type=file]')[0].files[0]); 
	
	e.preventDefault()
	$.ajax({
		url:'Asset/ajax.php?action=stationary_inward',
		data: formData,
		method: 'POST',
		type: 'POST',
		cache: false,
		contentType: false,		// NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
		processData: false,		// NEEDED, DON'T OMIT THIS
		success:function(data){			
			if(data == 1)
			{
				alert('Stationary Added Succesfully');
			}
		}
	})
})
</script>
