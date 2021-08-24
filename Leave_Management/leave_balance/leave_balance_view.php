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
	const api_url = "http://192.168.200.89:8081/hrms/Leave_Management/api/leave_balance.php";
	
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
					<th>staff_id</th>
					<th>Employee Code</th>
					<th>Employee name</th>
					<th>payroll Month</th>
					<th>Casual_Leave</th>
					<th>Sick_Leave</th>
					<th>Privilege_Leave</th>
					</thead>
					<tbody>`;
				
				
				
				for(let r of data.records)
                {
                    tab += `<tr>
                    <td>${r.staff_id}</td>
                    <td>${r.emp_code}</td>
                    <td>${r.emp_name}</td>
                    <td>${r.payroll_month}</td>
                    <td>${r.Casual_Leave}</td>
                    <td>${r.Sick_Leave}</td>
                    <td>${r.Privilege_Leave}</td>
                    </tr>`
					
				}
                // Setting innerHTML as tab variable
                document.getElementById("table_view").innerHTML = tab;

	}
}
</script>