  <?php
  if(isset($_REQUEST['edu_save']))
  {
$chk=$_REQUEST['chk'];
echo "count".$siz=count($chk);
$candidateid=$_REQUEST['cid'];
$examination_passed=explode(",",$_REQUEST['pass']);
$instute=explode(",",$_REQUEST['ins']);
$degree=explode(",",$_REQUEST['degrees']);
$field=explode(",",$_REQUEST['field']);
$passing=explode(",",$_REQUEST['passing']);
$percentage=explode(",",$_REQUEST['percent']);
echo $attachment=explode(",",$_REQUEST['attach']);
print_r($attachment);
var_dump($attachment);
echo "hii". $size_of_attachment=sizeof($attachment);

  }
	  
  ?>