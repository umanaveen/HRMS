<?php
require("../../../configuration.php");
require("../../../user.php");

	$ledgerSql="SELECT 
				l.code,l.name,
					a.type
			 FROM
				ledger l
			 LEFT JOIN
				accounts a
			 ON
				a.id=l.accounts_id";
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AdminLTE 2 | Invoice</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="/UCO/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/UCO/dist/css/AdminLTE.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body onLoad="window.print();">
   
   	<table class="table table-striped" id="tblLedger" style="font-family:'Times New Roman', Times, serif;">
				<caption><center>Ledger Information</center></caption>
			<thead>
				 <tr>
                        <th>#</th>
                        <th>Code</th>
						<th>Name</th>
						<th>Category</th>
                 </tr>
			</thead>
				
			<tbody>
				<?php
					$ledgerRow=mysql_query($ledgerSql);
					$i=1;
					while($ledgerRes=mysql_fetch_array($ledgerRow))
					{
				?>
						<tr>
							<td><?php echo $i++;?></td>
							<td><?php echo $ledgerRes[0];?></td>
							<td><?php echo $ledgerRes[1];?></td>
							<td><?php echo $ledgerRes[2];?></td>
						</tr>
				<?php
					}
				?>
			</tbody>	
				
			 <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Code</th>
						<th>Name</th>
						<th>Category</th>
                    </tr>
             </tfoot>
	</table>
           
    <script src="/UCO/dist/js/app.min.js"></script>
  </body>
</html>

