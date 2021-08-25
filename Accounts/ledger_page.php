<?php
require('../connect.php');

$api = constant("URL").'Accounts/API/accounts_ledger_view.php';

echo $api;
?>

<div id="container">
<div class="table-responsive" id="table_view">
</div>
</div>
<script>

var api_url = "<?php echo $api; ?>";

$(document).ready(function (){
	showProductsJS();
});


function load(url) 
{
    return new Promise(function (resolve, reject) 
    {
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

function showProductsJS() {
load(api_url)
.then(
response => {
const result = JSON.parse(response);

let tab = `<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
<thead>
<th>id</th>
<th>code</th>
<th>Name</th>
<th>accounts_id</th>
<th>pl_group_id</th>
<th>bs_group_id</th>
</thead>
<tbody>`;



for(let r of result.types)
{
tab += `<tr>
<td>${r.id}</td>
<td>${r.code}</td>
<td>${r.name}</td>
<td>${r.accounts_id}</td>
<td>${r.pl_group_id}</td>
<td>${r.bs_group_id}</td>
</tr>`

}
document.getElementById("table_view").innerHTML = tab;
},
error => msg.innerHTML = `Error getting the message, HTTP status: ${error}`
);
}

</script>
</body>
</html>