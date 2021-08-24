<!DOCTYPR html>
<html lang="en">
    <head>
	
        <meta charset="UTF-8">
		<link href="vendor/emoji-picker/lib/css/emoji.css" rel="stylesheet">
		<link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
	<!--link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/4.3.1/solar/bootstrap.min.css"-->
	<!--script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script-->
	<script src='inputEmoji.js'></script>
	<script>
		$(function () {
			$('textarea').emoji({place: 'after'});
		})
	</script>
<script type="text/javascript"><!--
google_ad_client = "ca-pub-2783044520727903";
/* jQuery_demo */
google_ad_slot = "2780937993";
google_ad_width = 728;
google_ad_height = 90;
//-->
</script>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-36251023-1']);
  _gaq.push(['_setDomainName', 'jqueryscript.net']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
<script type="text/javascript"
src="https://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>
        <title>Birthday Gift</title>
        
        <!-- Link CSS Style.css file-->
        
        <link rel="stylesheet" href="css/style.css">
		<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<script src="vendor/emoji-picker/lib/js/config.js"></script>
<script src="vendor/emoji-picker/lib/js/util.js"></script>
<script src="vendor/emoji-picker/lib/js/jquery.emojiarea.js"></script>
<script src="vendor/emoji-picker/lib/js/emoji-picker.js"></script>
        
    </head>
	<style>
	#main_content{
		background: ##57597336 !important;
		margin-left: -14px !important;
	}
	.row{
		margin-left: 16px !important;
	}
	
	</style>
    <body>
        <div class='moon'>
            <div class='crater1'></div>
            <div class='crater2'></div>
            <div class='crater3'></div>
        </div>
        
        <canvas id="canvas"></canvas>
        
        <div id="sea"></div>
        <div id="beach"></div>
		<align="left">
        <img src="https://www.happybirthdaymsg.com/wp-content/uploads/2016/01/happy-birthday-image-9.jpg" alt="Happy-Birthday-Cake" id="cake" style="width: 450px;margin-top: -160px;margin-left: 100px;"
		/>
        
								 <?php
	require '../../../connect.php';
     $emp_sql=$con->query("SELECT first_name,dob FROM candidate_form_details WHERE MONTH(dob) = MONTH(NOW()) AND DAY(dob) = DAY(NOW())");
	  $emp_sql=$con->query("SELECT * FROM candidate_form_details WHERE DATE_ADD(dob, INTERVAL YEAR(CURDATE())-YEAR(dob) + IF(DAYOFYEAR(CURDATE()) > DAYOFYEAR(dob),1,0) YEAR) BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 7 DAY)");
      $i=1;
      while($emp_res = $emp_sql->fetch(PDO::FETCH_ASSOC))
      {
       ?>
      <tr>
    <br>
	<align="center" style="width: 18px; margin-left: 170px; font-weight: bold;"> 
      <td><?php echo $emp_res['first_name']; ?></td>
	  <td><?php echo $emp_res['dob']; ?></td>
	  <td><?php echo $emp_res['comments']; ?></td>
	  </br>
	  	  <!--td><!--?php echo "Happy Birthday".$emp_res['first_name'].""; ?--></td-->
	  <td>
	  </tr>
	 <?php
	  $i++;
      }
      ?>
	<br>
        <div class="content-wrapper" id="main_content">
								<div class="output-container">
		<!--h2>How to Insert Emoji using PHP in Comments</h2-->

		<div class="comment-form-container">
			<form id="frm-comment">
				

				<div class="input-row">
					<p class="emoji-picker-container">
						<textarea class="input-field" data-emojiable="true" data-emoji-input="unicode" type="text" name="comment" id="comment" placeholder="Comments Please" style="width: 450px; margin-left: 115px;"></textarea>
					</p>
				</div>
				</br>

				<div>
					<input type="button" class="btn btn-primary btn-md" onclick="comment_add()" id="submitButton"
						value="Submit" style="float:left; margin-left: 500px;/>


  <!--div id="video"--></div>

  </div>
  </div>      
      </div>      
    </form>  
    </body>
</html>
        <script src="js/index.js"></script>
		<script>
		function comment_add()
{
  $.ajax({
    type:"POST",
    url:"/HRMS/HRMS/Recruitment/birthday_list/comment_add.php",
    success:function(data){
      $("#main_content").html(data);
    }
  })
}

		</script>
      