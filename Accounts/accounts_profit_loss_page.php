<?php
require('../connect.php');

$api = constant("URL").'Accounts/API/accounts_profit_loss_view.php';

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

function showProductsJS() {
load(api_url)
.then(
response => {
        
        const result = JSON.parse(response);
        let tab = `<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
        <th>id</th>
        <th>name</th>
        <th>order_by</th>
        <th>type</th>
        <th>flag_id</th>
        </thead>
        <tbody>`;

        for(let r of result.types)
        {
            tab += `<tr>
            <td>${r.id}</td>
            <td>${r.name}</td>
            <td>${r.order_by}</td>
            <td>${r.type}</td>
            <td>${r.flag_id}</td>
            </tr>`;
        }
        document.getElementById("table_view").innerHTML = tab;
},
error => msg.innerHTML = `Error getting the message, HTTP status: ${error}`
);
}

</script>
</body>
</html>