<?php 
require '../../connect.php';
$asset_id=$_REQUEST['id'];
$asset=$_REQUEST['asset'];
$asset_type=$_REQUEST['asset_type'];

$sql=$con->prepare("select * from assets_form_detail where asset='$asset' and asset_type='$asset_type' and asset_name='$asset_id' order by id desc limit 1");
$sql->execute();
$cou=$sql->rowCount();
$sqlfet=$sql->fetch();
 $asset_no=$sqlfet['asset_no'];

$asset=$con->query("select * from assets_master where id='$asset_id'");
$asfet=$asset->fetch();
$prefix=$asfet['prefix_code'];
if($cou==0)
{	
$no=$prefix."-".'0001';	
echo $no;
}
else
{
	$num=$asset_no+1;
	$len=strlen($num);
	if($len==1)
	{
		echo $no=$prefix."-".'000'.$num;
	}
	elseif($len==2)
	{
		echo $no=$prefix."-".'00'.$num;
	}
	elseif($len==3)
	{
		echo $no=$prefix."-".'0'.$num;
	}
	elseif($len==4)
	{
		echo $no=$prefix."-".$num;
	}
	
	
}

?>