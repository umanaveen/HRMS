<?php 
require '../../connect.php';
include('../../user.php');
//$user_id=$_SESSION['userid'];
/* if(isset($_REQUEST['save']))
{
	$uploadDir = 'invoice/';
	
	$asset=$_REQUEST['asset'];
$asset_type=$_REQUEST['asset_type'];
$asset_name=$_REQUEST['asset_name'];
$assets_no=$_REQUEST['assets_no'];
$exp=explode('-',$assets_no);
$prefix=$exp[0];
$ass_no=$exp[1];
$brand=$_REQUEST['brand'];
$vendor=$_REQUEST['vendor'];
$pdate=$_REQUEST['pdate'];
$serial=$_REQUEST['serial'];
$config=$_REQUEST['config'];
$Warranty=$_REQUEST['Warranty'];
$hsn_code=$_REQUEST['hsn_code'];
$part_no=$_REQUEST['part_no'];
$in_hand=$_REQUEST['in_hand'];
$new=$_REQUEST['new'];
$asset_value=$_REQUEST['asset_value'];
$invoice_no=$_REQUEST['invoice_no'];
$location=$_REQUEST['location'];
$files3 = $_FILES["files3"];



		

   $uploadedFile = ''; 
                   
              // File upload path  
			              foreach($files3['name'] as $key=>$val)
			{
                $fileName = basename($files3['name'][$key]);  
                $targetFilePath = $uploadDir . $fileName;  
                  
                // Check whether file type is valid  
                 $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);  
                
                    // Upload file to server  
                    if(move_uploaded_file($files3["tmp_name"][$key], $targetFilePath)){  
                        $uploadedFile .= $fileName.','; 
                    
                }
			}
			
		$ins=$con->query("insert into assets_form_detail(`asset`, `asset_type`, `prefix`, `asset_no`, `asset_name`, `brand_name`, `vendor_name`, `p_date`, `Serial_no`, `config`, `warranty`, `hsn_code`, `part_no`, `asset_value`, `location`, `stock_in_hand`, `new_stock`, `status`, `created_by`, `created_on`)values('$asset','$asset_type','$prefix','$ass_no','$asset_name','$brand','$vendor','$pdate','$serial','$config','$Warranty','$hsn_code','$part_no','$asset_value','$location','$in_hand','$new',1,'$user_id',now())");	
			
	echo "insert into assets_form_detail(`asset`, `asset_type`, `prefix`, `asset_no`, `asset_name`, `brand_name`, `vendor_name`, `p_date`, `Serial_no`, `config`, `warranty`, `hsn_code`, `part_no`, `asset_value`, `location`, `stock_in_hand`, `new_stock`, `status`, `created_by`, `created_on`)values('$asset','$asset_type','$prefix','$ass_no','$asset_name','$brand','$vendor','$pdate','$serial','$config','$Warranty','$hsn_code','$part_no','$asset_value','$location','$in_hand','$new',1'$user_id',,now())";

} */
?>

<?php 

$user_id=$_SESSION['userid'];
if(isset($_REQUEST['save']))
{
	$uploadDir = 'invoice/';
	
	$asset=$_REQUEST['asset'];
$asset_type=$_REQUEST['asset_type'];
$asset_name=$_REQUEST['asset_name'];
$get_asset_name=$_REQUEST['get_asset_name'];
$assets_no=$_REQUEST['assets_no'];
$exp=explode('-',$assets_no);
$prefix=$exp[0];
$ass_no=$exp[1];
$brand=$_REQUEST['brand'];
$vendor=$_REQUEST['vendor'];
$pdate=$_REQUEST['pdate'];
$serial=$_REQUEST['serial'];
$config=$_REQUEST['config'];
$Warranty=$_REQUEST['Warranty'];
$hsn_code=$_REQUEST['hsn_code'];
$part_no=$_REQUEST['part_no'];
//$in_hand=$_REQUEST['in_hand'];
//$new=$_REQUEST['new'];
$asset_value=$_REQUEST['asset_value'];
$invoice_no=$_REQUEST['invoice_no'];
$location=$_REQUEST['location'];
$files3 = $_FILES["file3"];

if($asset=="Internal Asset")
{
	$sql_asset=$get_asset_name;
}
else
{
	$sql_asset=$asset_name;
}

		

   $uploadedFile = ''; 
                   
              // File upload path  
			              foreach($files3['name'] as $key=>$val)
			{
                $fileName = basename($files3['name'][$key]);  
                $targetFilePath = $uploadDir . $fileName;  
                  
                // Check whether file type is valid  
                 $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);  
                
                    // Upload file to server  
                    if(move_uploaded_file($files3["tmp_name"][$key], $targetFilePath)){  
                        $uploadedFile .= $fileName.','; 
                    
                }
			}
			
		$ins=$con->query("insert into assets_form_detail(`asset`, `asset_type`, `prefix`, `asset_no`, `asset_name`, `brand_name`, `vendor_name`, `p_date`, `Serial_no`, `config`, `warranty`, `hsn_code`, `part_no`, `asset_value`, `location`,`invoice_no`,`invoice`, `status`, `created_by`, `created_on`)values('$asset','$asset_type','$prefix','$ass_no','$sql_asset','$brand','$vendor','$pdate','$serial','$config','$Warranty','$hsn_code','$part_no','$asset_value','$location','$invoice_no','$fileName',1,'$user_id',now())");	
		
		echo "insert into assets_form_detail(`asset`, `asset_type`, `prefix`, `asset_no`, `asset_name`, `brand_name`, `vendor_name`, `p_date`, `Serial_no`, `config`, `warranty`, `hsn_code`, `part_no`, `asset_value`, `location`,`invoice_no`,`invoice`, `status`, `created_by`, `created_on`)values('$asset','$asset_type','$prefix','$ass_no','$sql_asset','$brand','$vendor','$pdate','$serial','$config','$Warranty','$hsn_code','$part_no','$asset_value','$location','$invoice_no','$fileName',1,'$user_id',now())";
			
	/* echo "insert into assets_form_detail(`asset`, `asset_type`, `prefix`, `asset_no`, `asset_name`, `brand_name`, `vendor_name`, `p_date`, `Serial_no`, `config`, `warranty`, `hsn_code`, `part_no`, `asset_value`, `location`, `stock_in_hand`, `new_stock`, `status`, `created_by`, `created_on`)values('$asset','$asset_type','$prefix','$ass_no','$asset_name','$brand','$vendor','$pdate','$serial','$config','$Warranty','$hsn_code','$part_no','$asset_value','$location','$in_hand','$new',1'$user_id',,now())"; */
	
	if($ins)
{
	echo "<script>alert(' Inserted Updated');</script>";
	header("location:/HRMS/index.php");
}

}
?>