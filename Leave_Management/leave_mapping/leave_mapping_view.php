<?php
require '../../connect.php';

?>
<div class="card mb-3" id="salary_structure_view">
<div class="card-header">
<i class="fa fa-table"></i>  Salary Structure 
<input type="button" style="float:right;" class="btn btn-warning" name="new" value="ADD" onclick="salary_structure_add()">
</div>
<div class="card-body">
<div class="table-responsive" id="table_view">
</div>
</div>
</div>
<script>

$(document).ready(function (){
	showProductsJS();
});

function showProductsJS()
{
	// api url
	const api_url = "http://192.168.200.89:8081/hrms/Leave_Management/api/leave_master_mapp_read.php";
	
	// Defining async function
	async function getapi(url)
	{
		//Storing responce
		const responce = await fetch(url);
		
		// Storing data in form of JSON
		var data = await responce.json();
		
		console.log(data);
		
		show(data);
	}
	
	getapi(api_url);
	
	function show(data)
	{
		let tab = `<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
					<thead>
					<th>Id</th>
					<th>leave_id</th>
					<th>from_date</th>
					<th>to_date</th>
					<th>days_per_month</th>
					<th>days_per_year</th>
					<th>is_cummulative</th>
					<th>status</th>
					<th>Action</th>
					</thead>
					<tbody>`;
			
				for(let r of data.records)
                {
                    tab += `<tr>
                    <td>${r.id}</td>
                    <td>${r.leave_id}</td>
                    <td>${r.from_date}</td>
                    <td>${r.to_date}</td>
                    <td>${r.days_per_month}</td>
                    <td>${r.days_per_year}</td>
                    <td>${r.is_cummulative}</td>
                    <td>${r.status}</td>
                    </tr>`
                }
                // Setting innerHTML as tab variable
                document.getElementById("table_view").innerHTML = tab;

	}
}
</script>