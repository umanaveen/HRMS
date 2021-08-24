<?php 
require '../../../connect.php';
include("../../../user.php");
$userid=$_SESSION['userid'];
$jid=$_REQUEST['jid'];
$upd=$con->query("update jobdescription_form_details set status=3 where id='$jid'");

$aloupd=$con->query("update jd_allocation set status=2 where jd_id='$jid'");
?>