<?php
require('../connect.php');

$api = constant("URL").'Accounts/API/accounts_view.php';

echo $api;
?>

<div id="container">
<div>
<input class="btn btn-primary" type="button" value="Add" onclick = "show_form()">
</div>
<div class="table-responsive" id="table_view">
</div>
<div class="table-responsive" id="form_view">
</div>
</div>


<script>
function show_form()
{

}

$(document).ready(function ()
{
	showProductsJS();
});

function load(url) 
{
    return new Promise(function (resolve, reject) {
    const request = new XMLHttpRequest();
    request.onreadystatechange = function (e) {
    if (this.readyState === 4) {
    if (this.status == 200) {
    resolve(this.response);
    } else {
    reject(this.status);
    }
    }
    }
    request.open('GET', url, true);
    request.send();
    });
}

var api_url = "<?php echo $api; ?>";

function showProductsJS() {
load(api_url)
.then(
response => {
        
        const result = JSON.parse(response);
        let tab = `<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
        <th>id</th>
        <th>Type</th>
        <th>Description</th>
        <th>Actions</th>
        </thead>
        <tbody>`;

        for(let r of result.types)
        {
            tab += `<tr>
            <td>${r.id}</td>
            <td>${r.type}</td>
            <td>${r.description}</td>
            <td><input class="btn btn-success" type="button" value="edit" onclick="data_edit(${r.id})"></td>
            </tr>`;
        }
        document.getElementById("table_view").innerHTML = tab;
},
error => msg.innerHTML = `Error getting the message, HTTP status: ${error}`
);
}


function data_edit(v)
{
    alert(v);
}

</script>
</body>
</html>