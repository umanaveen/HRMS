<?php
require '../../connect.php';
require '../../user.php';
$candidateid=$_REQUEST['get_emp_id'];
$id=$_REQUEST['get_id'];
$row_query = "SELECT * FROM cost_sheet_entry ";

 $query = $con->query($row_query);
 $query->execute();
 $count = $query->rowCount();

 $row_val = $query->fetch();
 
	if($count == 0)
	{   
		$char = 'BBCS';
	//financial year	
	$month =01;
	$current_month = date('m');
	if ($current_month >= '01' && $current_month < '04'){

	   if ($month >= '01' && $month < '04'){
		   $nextyear = substr(date('Y'),-2);
	   } 

	   if ($month >= '04'){
		   $nextyear = substr(date('Y')-1,-2);
	   }
	} 

	if ($current_month >= '04'){
	   if ($month >= '04'){
		   $nextyear = substr(date('Y'),-2);
	   }

	   if ($month < '04'){
		   $nextyear = substr(date('Y')+1,-2);
	   }
	}
	
	 $nextyear; echo "<br/>";
    //current year
	 $curyear = substr(date('Y'),-2); echo "<br/>";
	 $finyear = $curyear.'-'.$nextyear; echo "<br/>";
	 $char_str = 'A';
    $seq = 00001;
    $costsheetno = sprintf("%05d", $seq);
       $cost_number = $char.''.$costsheetno.'/'.$finyear.'/'.$char_str ;
	
}else{	 
 $row_query = "SELECT * FROM cost_sheet_entry ORDER BY id DESC ";

 $query2 = $con->query($row_query);
 $query2->execute();
 $count = $query2->rowCount();
 $row = $query2->fetch();
 // $row['cost_sheet_no'];echo "<br/>";
	 if (!empty($row['cost_sheet_no'])) {
		
		$splite_val = explode("/",$row['cost_sheet_no']); 	
		 $no   =  $splite_val [0];echo "<br/>";
		 $char =  $splite_val [2];
	     $newchar= $char;
			$month =01;
			$current_month = date('m');
			if ($current_month >= '01' && $current_month < '04'){

			if ($month >= '01' && $month < '04'){
			   $nextyear = substr(date('Y'),-2);
			} 

			if ($month >= '04'){
			   $nextyear = substr(date('Y')-1,-2);
			}
			} 

			if ($current_month >= '04'){
			if ($month >= '04'){
			   $nextyear = substr(date('Y'),-2);
			}

			if ($month < '04'){
			   $nextyear = substr(date('Y')+1,-2);
			}
			}

			 $nextyear; 
			//current year
			 $curyear = substr(date('Y'),-2); echo "<br/>";
			 $finyear = $curyear.'-'.$nextyear; echo "<br/>";
			
			
			$find_f = substr($row['cost_sheet_no'], 0, 6);echo "<br/>";
	        $find_fs = substr($row['cost_sheet_no'], 7, 4);echo "<br/>";
	    $bussiness_type ; echo "<br/>";
	 // echo  $a = sprintf("%05d", $find_fs);echo "<br/>";
	   $final_cost_no = str_pad($find_fs + 1, 5, 0, STR_PAD_LEFT); echo "<br/>";
	   $cost_number = $char.''.$final_cost_no.'/'.$finyear.'/'.$newchar;
			
	 } 
}

$proposal=$_REQUEST['proposal'];
$Client=$_REQUEST['Client'];
$date=$_REQUEST['date'];
$Version=$_REQUEST['Version'];
$emp_id=$_REQUEST['emp_id'];
$email_id=$_REQUEST['email_id'];
$tel_no=$_REQUEST['tel_no'];
$scope=$_REQUEST['scope'];
$Proposal_statement=$_REQUEST['Proposal_statement'];
$Conditions=$_REQUEST['Conditions'];

$sql=$con->query("INSERT INTO `quotation`(`Enquire_id`,`cost_sheet_number`, `proposal`, `Client`, `Date`, `Version`, `emp_id`, `email_id`, `tel_no`, `scope`, `Proposal_statement`, `Conditions`,`created_by`) VALUES ('$id','$cost_number','$proposal','$Client','$date','$Version','$emp_id','$email_id','$tel_no','$scope','$Proposal_statement','$Conditions','$candidateid')");   

echo "INSERT INTO `quotation`(`Enquire_id`,`cost_sheet_number`, `proposal`, `Client`, `Date`, `Version`, `emp_id`, `email_id`, `tel_no`, `scope`, `Proposal_statement`, `Conditions`,`created_by`) VALUES ('$id','$cost_number','$proposal','$Client','$date','$Version','$emp_id','$email_id','$tel_no','$scope','$Proposal_statement','$Conditions','$candidateid')";

$candidateid=$_REQUEST['get_emp_id'];
$phase=$_REQUEST['phase'];
$phase_count=count($phase);
$item=$_REQUEST['item'];
$cost=$_REQUEST['cost'];
$price=$_REQUEST['price'];
for($i=0;$i<$phase_count;$i++)
{
$phases= $phase[$i];
$items= $item[$i];
 $costs= $cost[$i];
 $prices= $price[$i];
$sql1=$con->query("insert into `cost_sheet_entry`(`enquiry_id`, `Phases`, `Specification`, `day`, `Amount`,`created_by`)  
values('$id','$phases','$items','$costs','$prices','$candidateid')");   
echo "insert into `cost_sheet_entry`(`enquiry_id`, `Phases`, `Specification`, `day`, `Amount`,`created_by`)  
values('$id','$phases','$items','$costs','$prices','$candidateid')";
 }
$priceTotal=$_REQUEST['priceTotal'];

$count_priceTotals=count($priceTotal);
for($i=0;$i<$count_priceTotals;$i++)
{
$sd=$i+1;
$priceTotals= $priceTotal[$i];
$sql2=$con->query("INSERT INTO `cost_totl`(`enquiries_id`, `Phases`, `total`) VALUES ('$id','$sd','$priceTotals')");   
echo "INSERT INTO `cost_totl`(`enquiry_id`, `Phases`, `total`) VALUES ('$id','$i','$priceTotals')";
}
$flag = 2;

	$update_sql=$con->query("UPDATE `enquiry` SET `flag`='$flag' WHERE id='$id'"); 
?>






