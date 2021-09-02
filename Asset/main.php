<?php
require '../connect.php';
?>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head> 
<div class="container-fluid">
	<div class="col-lg-12">
		<div class="row">
			

			<!-- Table Panel -->
				<div class="card">
					<div class="card-body">
						<table class="table table-bordered table-hover">
							<thead>
								<tr><th class="text-center">#</th>
									<th class="text-center">purchase_date</th>
									<th class="text-center">warranty</th>
									<th class="text-center">serial_no</th>
									<th class="text-center">hsn_code</th>
									<th class="text-center">product_no</th>
									<th class="text-center">model</th>
									<th class="text-center">brand</th>
									<th class="text-center">invoice_no</th>
									<th class="text-center">invoice_files</th>
									<th class="text-center">qr_code</th>
									<th class="text-center">status</th>
								</tr>
							</thead>
							<tbody>
								<?php 
								$i = 1;
								$asset_inward = $con->query("SELECT id, purchase_date, warranty, serial_no, hsn_code, product_no, model, brand, invoice_no, invoice_files, qr_code, status FROM asset_inward_master");
								while($row=$asset_inward->fetch(PDO::FETCH_ASSOC)):
								?>
								<tr>
									<td class="text-center"><?php echo $i++ ?></td>									
									<td class="">
										 <p> <b><?php echo $row['purchase_date'] ?></b></p>
									</td><td class="">
										 <p> <b><?php echo $row['warranty'] ?></b></p>
									</td><td class="">
										 <p> <b><?php echo $row['serial_no'] ?></b></p>
									</td><td class="">
										 <p> <b><?php echo $row['hsn_code'] ?></b></p>
									</td><td class="">
										 <p> <b><?php echo $row['product_no'] ?></b></p>
									</td><td class="">
										 <p> <b><?php echo $row['model'] ?></b></p>
									</td><td class="">
										 <p> <b><?php echo $row['brand'] ?></b></p>
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
			<form action="" id="manage-inward" enctype="multipart/form-data">
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
								<label class="control-label">warranty</label>
								<input type="text" name="warranty" id="" class="form-control">
							</div>							
					</div>
					<div class="card-body">
							<div class="form-group">
								<label class="control-label">serial_no</label>
								<input type="text" name="serial_no" id="" class="form-control">
							</div>							
					</div>
					<div class="card-body">
							<div class="form-group">
								<label class="control-label">hsn_code</label>
								<input type="text" name="hsn_code" id="" class="form-control">
							</div>							
					</div>
					<div class="card-body">
							<div class="form-group">
								<label class="control-label">product_no</label>
								<input type="text" name="product_no" id="" class="form-control">
							</div>							
					</div>
					<div class="card-body">
							<div class="form-group">
								<label class="control-label">model</label>
								<input type="text" name="model" id="" class="form-control">
							</div>							
					</div>
					<div class="card-body">
							<div class="form-group">
								<label class="control-label">brand</label>
								<input type="text" name="brand" id="" class="form-control">
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
								<input class="input-file" name="invoice_files" id="fileInput" type="file" name="file">
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
<script>
	function _reset(){
		$('[name="id"]').val('');
		$('#manage-inward').get(0).reset();
	}

</script>
<script>
$('#manage-inward').submit(function(e){	
	var form = $('form')[0]; // You need to use standard javascript object here
	var formData = new FormData(form);
	
	// Attach file
	formData.append('image', $('input[type=file]')[0].files[0]); 
	
	e.preventDefault()
	$.ajax({
		url:'Asset/ajax.php?action=save_inward',
		data: formData,
		method: 'POST',
		type: 'POST',
		cache: false,
		contentType: false,		// NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
		processData: false,		// NEEDED, DON'T OMIT THIS
		success:function(data){
			alert(data);
			
			if(data == 1)
			{
				asset_inward()
			}
		}
	})
})
</script>
<script src="Asset/jquery.min.js"></script>
<script type="text/javascript" src="Asset/jquery-te-1.4.0.min.js" charset="utf-8"></script>