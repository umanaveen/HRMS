<?php
//require '../../connect.php';
//session_start();
//define('DB_SERVER','localhost');
//define('DB_USER','root');
//define('DB_PASS' ,'Best2020Know');
//define('DB_NAME', 'hrs');
class DB_con
{
 function __construct()
 {
$this->dbh = new pdo ('mysql:host=localhost;dbname=hrs','root','Best2020Know');
//$this->dbh=$con;
// Check connection
if (mysqli_connect_errno())
{
echo "Failed to connect to MySQL: " . mysqli_connect_error();
 }
 }
 public function fetchdata($cid)
 {
	 $sql="select * from candidate_form_details c left join company_master cm on c.company_name=cm.id join designation_master d on c.position=d.id join z_department_master dm on c.department=dm.id where c.id='$cid' order by c.id desc limit 1";
	 
 $result=$this->dbh->query($sql);
 return $result;
 }
 
 public function insert_data($cid,$round,$qn_name,$allocate_person)
 {
	 
	 if($qn_name=='undefined')
	 {
		$ins="insert into candidate_round_details(candid_id,round_id,person_id,status) values('$cid','$round','$allocate_person','1')";
		
		$upd="update candidate_form_details set status=3 where id='$cid'";
		$result=$this->dbh->query($ins);
		$uresult=$this->dbh->query($upd);
		return $qn_name;
	}
	else
	{
		$ins="insert into candidate_round_details(candid_id,round_id,qn_id,staus) values('$cid','$round',$qn_name,'1')";
		$upd="update candidate_form_details set status=4 where id='$cid'";
		$result=$this->dbh->query($ins);
	 	$uresult=$this->dbh->query($upd);
		return $result;
	}
	 
 }
 
}
?>