<?php
require '../../connect.php';
$position=$_REQUEST['position'];
$candidate_name=$_REQUEST['candidate_name']; // emp no 
$father_name=$_REQUEST['father_name'];
$dob=date('Y-m-d',strtotime($_REQUEST['dob']));
$address=$_REQUEST['address'];
$paddress=$_REQUEST['paddress'];
$phone=$_REQUEST['phone'];
$mail=$_REQUEST['mail'];
$adharnumber=$_REQUEST['adharnumber'];
$adharcard=$_REQUEST['adharcard'];
$pannumber=$_REQUEST['pannumber'];
$pancard=$_REQUEST['pancard'];
$voternumber=$_REQUEST['voternumber'];
$votercard=$_REQUEST['votercard'];
$resume=$_REQUEST['resume'];
$examination_passed_1=$_REQUEST['examination_passed[]'];
$instute_1=$_REQUEST['instute[]'];
$degree_1=$_REQUEST['degree[]'];
$field_1=$_REQUEST['field[]'];
$passing_1=$_REQUEST['passing[]'];
$percentage_1=$_REQUEST['percentage[]'];
$attachment_1=$_REQUEST['attachment[]'];
$certifcatename_1=$_REQUEST['certifcatename[]'];
$certifcatnumber_1=$_REQUEST['certifcatnumber[]'];
$validityfrom_1=$_REQUEST['validityfrom[]'];
$validityto_1=$_REQUEST['validityto[]'];
$certifcatefile_1=$_REQUEST['certifcatefile[]'];
$organization_1=$_REQUEST['organization[]'];
$designation_1=$_REQUEST['designation[]'];
$from_1=$_REQUEST['from[]'];
$to_1=$_REQUEST['to[]'];
$yearofexperience_1=$_REQUEST['yearofexperience[]'];
$overallexp=$_REQUEST['overallexp'];
$reference=$_REQUEST['reference'];
$interview_date=$_REQUEST['interview_date'];
$now=date('Y-m-d');
$status=1;

$statement = $con->prepare('INSERT INTO x_table_recruitment(position,candidate_name,father_name,dob,Paddress,phone,mail,adharnumber,adharcard,pannumber,pancard,voternumber,votercard,resume,Examination_passed_1,instute_1,degree_1,field_1,passing_1,percentage_1,attachment_1,certifcatename_1,certifcatnumber_1,validityfrom_1,validityto_1,certifcatefile_1,organization_1,Designation_1,From_1,to_1,yearofexperience_1,overallexp,reference,signature,interview_date,status,now)VALUES (:position, :candidate_name, :father_name, :dob, :paddress, :phone, :mail, :adharnumber, :adharcard, :pannumber, :pancard, :voternumber, :votercard, :resume, :examination_passed[], :instute[], :degree[], :field[], :passing[], :percentage[], :attachment[], :certifcatename[], :certifcatnumber[], :validityfrom[], :validityto[], :certifcatefile[], :organization[], :designation[], :from[], :to[], :yearofexperience[], :overallexp, :reference, :signature, :interview_date, :status, :now)');
$statement->execute([
    'position' => $position,
	'candidate_name' => $candidate_name,
    'father_name' => $father_name,
    'dob' => $dob,
    'paddress' => $paddress,
    'phone' => $phone,
    'mail' => $mail,
    'adharnumber' => $adharnumber,
    'adharcard' => $adharcard,
    'pannumber' => $pannumber,
    'pancard' => $pancard,
    'voternumber' => $voternumber,
    'votercard' => $votercard, 
    'resume' => $resume,
    'examination_passed[]' => $examination_passed_1,
    'instute[]' => $instute_1,
    'degree[]' => $degree_1,
    'field[]' => $field_1,
    'passing[]' => $passing_1,
    'percentage[]' => $percentage_1,
    'attachment[]' => $attachment_1,
    'certifcatename[]' => $certifcatename_1,
    'certifcatnumber[]' => $certifcatnumber_1,
    'validityfrom[]' => $validityfrom_1,
    'validityto[]' => $validityto_1,
    'certifcatefile[]' => $certifcatefile_1,
    'organization[]' => $organization_1,
    'designation[]' => $designation_1,
    'from[]' => $from_1,
	'to[]' => $to_1,
	'yearofexperience[]' => $yearofexperience_1,
    'overallexp' => $overallexp,
    'reference' => $reference,
    'signature' => $signature,
    'interview_date' => $interview_date,
    'status' => $status,
    'now' => $now
]); 
if($statement)
{
	echo 0;
}
else
{
	echo 1;
} 
?>