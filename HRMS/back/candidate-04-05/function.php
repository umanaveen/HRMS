<?php

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
 public function fetchdata($resource_id)
 {
	 $sql="SELECT d.designation_name,z.dept_name,r.first_name,r.last_name,r.gender,r.mobile,r.mail,r.aadhar_no,r.degree,r.employement_status,r.position  FROM resource_form_detail r join designation_master d on r.position=d.id join z_department_master z on d.dep_id=z.id where r.id='$resource_id'";
	 
 $result=$this->dbh->query($sql);
 return $result;
 }
 
 public function insert_data($cid,$round_type,$qn,$person,$status)
 {
	 if($qn== " ")
	 {
		$ins="insert into candidate_round_details(candid_id,round_id,person_id) values('$cid','$round_type','$person')";
		$result=$this->dbh->query($sql);
		return $result;
	}
	else
	{
		$ins="insert into candidate_round_details(candid_id,round_id,qn_id) values('$cid','$round_type',$qn)";
	 $result=$this->dbh->query($sql);
		return $result;
	}
	 
 }
 
}
?>