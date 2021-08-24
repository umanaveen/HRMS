<?php

require '../../connect.php';
include("../../user.php");
require '../../PHPMailer/PHPMailerAutoload.php';
require 'class/class.phpmailer.php';
include ('pdf.php');
$userrole=$_SESSION['userrole'];
$candidateid=$_REQUEST['id'];
 $approved_desig=$_REQUEST['desig'];
 $approved_ctc=$_REQUEST['ctc'];
 $joining_date=$_REQUEST['jdate'];

 $upd=$con->query("update z_user_master set user_group_code='ROLE-013' where candidate_id='$candidateid' and user_group_code='ROLE-011'");
/* echo "update z_user_master set user_group_code='ROLE-013' where candidate_id='$candidateid' and status='16'"; */
$ins=$con->query("update candidate_form_details set final_designation='$approved_desig',approved_ctc='$approved_ctc',joining_date='$joining_date',status='19' where id='$candidateid'");

echo "update candidate_form_details set final_designation='$approved_desig',approved_ctc='$approved_ctc',joining_date='$joining_date',status='19' where id='$candidateid'";
//echo "update candidate_form_details set status='19' where id='$candidateid'"; 
if($ins)
{
	echo 0;
}
else
{
	echo 1;
}




$number =$approved_ctc;
   $no = floor($number);
   $point = round($number - $no, 2) * 100;
   $hundred = null;
   $digits_1 = strlen($no);
   $i = 0;
   $str = array();
   $words = array('0' => '', '1' => 'one', '2' => 'two',
    '3' => 'three', '4' => 'four', '5' => 'five', '6' => 'six',
    '7' => 'seven', '8' => 'eight', '9' => 'nine',
    '10' => 'ten', '11' => 'eleven', '12' => 'twelve',
    '13' => 'thirteen', '14' => 'fourteen',
    '15' => 'fifteen', '16' => 'sixteen', '17' => 'seventeen',
    '18' => 'eighteen', '19' =>'nineteen', '20' => 'twenty',
    '30' => 'thirty', '40' => 'forty', '50' => 'fifty',
    '60' => 'sixty', '70' => 'seventy',
    '80' => 'eighty', '90' => 'ninety');
   $digits = array('', 'hundred', 'thousand', 'lakh', 'crore');
   while ($i < $digits_1) {
     $divider = ($i == 2) ? 10 : 100;
     $number = floor($no % $divider);
     $no = floor($no / $divider);
     $i += ($divider == 10) ? 1 : 2;
     if ($number) {
        $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
        $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
        $str [] = ($number < 21) ? $words[$number] .
            " " . $digits[$counter] . $plural . " " . $hundred
            :
            $words[floor($number / 10) * 10]
            . " " . $words[$number % 10] . " "
            . $digits[$counter] . $plural . " " . $hundred;
     } else $str[] = null;
  }
  $str = array_reverse($str);
  $result = implode('', $str);
  $points = ($point) ?
    "." . $words[$point / 10] . " " . 
          $words[$point = $point % 10] : '';
  $final_res= $result . "rupees  ";

?>
<?php 
$desig_sel=$con->query("select * from designation_master where id='$approved_desig'");
$des_fet=$desig_sel->fetch();
$des_name=$des_fet['designation_name'];
if($des_name=="Trainee")
{

  $staff_query= $con->query("select c.*,d.designation_name as position,u.user_name,u.password,u.full_name from candidate_form_details c join designation_master d on c.final_designation=d.id join z_user_master u on c.id=u.candidate_id where c.id='$candidateid' "); 
$staff_query->execute(); 
	$row        = $staff_query->fetch();	
	$FULLNAME       =  $row['first_name'];
    $SENDMAIL       = $row['mail'];
    $position       = $row['position'];
    $USERNAME       = $row['user_name'];
    $PASSWORD  ="Welcome@123";
   
   //$iterdate=date('Y-m-d H:i:s', strtotime('interview_date'));
 // echo  $iterdate= date("F j, Y, g:i a", $interview_date);
  //echo "hii".$interview_date;
  
  $dt = new DateTime($joining_date);
echo $joindate=$dt->format('M j Y');


	$mail = new PHPMailer;	
	$mail->SMTPDebug = 3; 
	$mail->IsSMTP(true);								//Sets Mailer to send message using SMTP
	$mail->Host = 'smtp.zoho.com';		//Sets the SMTP hosts of your Email hosting, this for Godaddy
	$mail->Port = '465';								//Sets the default SMTP server port
	$mail->SMTPAuth = true;							//Sets SMTP authentication. Utilizes the Username and Password variables
	$mail->Username = 'rajeshwari@bluebase.in';					//Sets SMTP username
	$mail->Password = 'June@2906#';					//Sets SMTP password
	$mail->SMTPSecure = 'ssl';							//Sets connection prefix. Options are "", "ssl" or "tls"
	$mail->From = 'rajeshwari@bluebase.in';			//Sets the From email address for the message
	 $mail->FromName = 'Bluebase';			//Sets the From name of the message
	 echo $mail->AddAddress($SENDMAIL, $FULLNAME);		//Adds a "To" address
		
	$mail->WordWrap = 50;							//Sets word wrapping on the body of the message to a given number of characters
	$mail->IsHTML(true);							//Sets message type to HTML				
	 				//Adds an attachment from a path on the filesystem
	$mail->Subject = 'Provisional Offer Letter';			//Sets the Subject of the message
					//An HTML or plain text message body
	
	$mail->Body = "Dear \r\n".$FULLNAME.""." ,"."\r\n\r\n<br/><br/>";	
	$mail->Body .= "We are happy to welcome you on board with Bluebase."."\r\n\r\n<br/><br/></br>";	
	
	$mail->Body .= "In continue of your interview process,we are pleased to offer you the position of ".$position." with six months probation as per company policy and expected you to commence your employment with us on from ".$joindate." ,"."\r\n\r\n<br/><br/><br/>";
	
	$mail->Body .= "You are requested to confirm your acceptance for the above with immediate effect."."\r\n\r\n<br/><br/></br>";	
	
	$mail->Body .= "Upload the documents and complete the joining formalities with the link and credentials given blow:"."\r\n\r\n<br/><br/>";

	$mail->Body .= "Url : http://115.243.95.118:8081/hrms/"."\r\n\r\n<br/><br/>";	
	$mail->Body    .= "USERNAME : ".$USERNAME."\r\n\r\n<br/>"; 
	$mail->Body   .= "PASSWORD : ".$PASSWORD."\r\n\r\n<br/><br/><br/>";  	
	
	$mail->Body .= "On satisfactory recipt of the above decuments,the management will accept your employment and issue the offer letter."."\r\n\r\n<br/></br>";		
	
	$mail->Body .= "This provisional offer letter is valid for the period of 48hrs from the time you receive the mail.If you fail to reply/confirm your acceptance,we presume that you are not interested to take up your assignment with us."."\r\n\r\n<br/><br/></br>";
	
	$mail->Body   .= "Regards"."\r\n\r\n<br/>";
	$mail->Body   .= "Rajeshwari"."\r\n\r\n<br/>";
	$mail->Body   .= "+91 98414 16638"."\r\n\r\n<br/>";
	
	if(!$mail->send()) {
       echo 'Message could not be sent.';
       echo 'Mailer Error: ' . $mail->ErrorInfo;
	   echo "0";
   } 
    else {
        $message = '<label class="text-success">UserName and PassWord has been send successfully...</label>';echo $message;
	   // $update_query = $con->query("update quotation_entry set flag ='1' , modified_by ='$user_id',modified_on =NOW() WHERE quote_no= '$QuoteNo'");  
		//echo "update quotation_entry set flag ='1' , modified_by ='$user_id',modified_on =NOW() WHERE quote_no= '$QuoteNo'";
	
	} 

}
else{
 

  $staff_query= $con->query("select c.*,d.designation_name as position,u.user_name,u.password,u.full_name from candidate_form_details c join designation_master d on c.final_designation=d.id join z_user_master u on c.id=u.candidate_id where c.id='$candidateid' "); 
$staff_query->execute(); 
	$row        = $staff_query->fetch();	
	$FULLNAME       =  $row['first_name'];
    $SENDMAIL       = $row['mail'];
    $position       = $row['position'];
    $USERNAME       = $row['user_name'];
    $PASSWORD  ="Welcome@123";
   
   //$iterdate=date('Y-m-d H:i:s', strtotime('interview_date'));
 // echo  $iterdate= date("F j, Y, g:i a", $interview_date);
  //echo "hii".$interview_date;
  
  $dt = new DateTime($joining_date);
echo $joindate=$dt->format('M j Y');


	$mail = new PHPMailer;	
	$mail->SMTPDebug = 3; 
	$mail->IsSMTP(true);								//Sets Mailer to send message using SMTP
	$mail->Host = 'smtp.zoho.com';		//Sets the SMTP hosts of your Email hosting, this for Godaddy
	$mail->Port = '465';								//Sets the default SMTP server port
	$mail->SMTPAuth = true;							//Sets SMTP authentication. Utilizes the Username and Password variables
	$mail->Username = 'rajeshwari@bluebase.in';					//Sets SMTP username
	$mail->Password = 'June@2906#';					//Sets SMTP password
	$mail->SMTPSecure = 'ssl';							//Sets connection prefix. Options are "", "ssl" or "tls"
	$mail->From = 'rajeshwari@bluebase.in';			//Sets the From email address for the message
	 $mail->FromName = 'Bluebase';			//Sets the From name of the message
	 echo $mail->AddAddress($SENDMAIL, $FULLNAME);		//Adds a "To" address
		
	$mail->WordWrap = 50;							//Sets word wrapping on the body of the message to a given number of characters
	$mail->IsHTML(true);							//Sets message type to HTML				
	 				//Adds an attachment from a path on the filesystem
	$mail->Subject = 'Provisional Offer Letter';			//Sets the Subject of the message
					//An HTML or plain text message body
	
	$mail->Body = "Dear \r\n".$FULLNAME.""." ,"."\r\n\r\n<br/><br/>";	
	$mail->Body .= "We are happy to welcome you on board with Bluebase."."\r\n\r\n<br/><br/></br>";	
	$mail->Body .= "In continue of your interview process,we are pleased to offer you the position of ".$position." with CTC ".$approved_ctc."/- (".$final_res.")as per company policy and expected you to commence your employment with us on from ".$joindate." ,"."\r\n\r\n<br/>";
	$mail->Body .= "You are requested to confirm your acceptance for the above with immediate effect."."\r\n\r\n<br/><br/></br>";	
	
	$mail->Body .= "Upload the documents and complete the joining formalities with the link and credentials given blow:"."\r\n\r\n<br/><br/>";

	$mail->Body .= "Url : http://115.243.95.118:8081/hrms/"."\r\n\r\n<br/><br/>";	
	$mail->Body    .= "USERNAME : ".$USERNAME."\r\n\r\n<br/>"; 
	$mail->Body   .= "PASSWORD : ".$PASSWORD."\r\n\r\n<br/><br/><br/>";  	
	$mail->Body .= "On satisfactory recipt of the above decuments,the management will accept your employment and issue the offer letter."."\r\n\r\n<br/></br>";		
	$mail->Body .= "This provisional offer letter is valid for the period of 48hrs from the time you receive the mail.If you fail to reply/confirm your acceptance,we presume that you are not interested to take up your assignment with us."."\r\n\r\n<br/><br/></br>";
	$mail->Body   .= "Regards"."\r\n\r\n<br/>";
	$mail->Body   .= "Rajeshwari"."\r\n\r\n<br/>";
	$mail->Body   .= "+91 98414 16638"."\r\n\r\n<br/>";
	
	if(!$mail->send()) {
       echo 'Message could not be sent.';
       echo 'Mailer Error: ' . $mail->ErrorInfo;
	   echo "0";
   } 
    else {
        $message = '<label class="text-success">UserName and PassWord has been send successfully...</label>';echo $message;
	   // $update_query = $con->query("update quotation_entry set flag ='1' , modified_by ='$user_id',modified_on =NOW() WHERE quote_no= '$QuoteNo'");  
		//echo "update quotation_entry set flag ='1' , modified_by ='$user_id',modified_on =NOW() WHERE quote_no= '$QuoteNo'";
	
	} 

}
?>