<?php
require '../../connect.php';
include("../../user.php");
$userrole=$_SESSION['userrole'];
?>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="HRMS/birthday_wishes/index.css">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap">
  <link href="HRMS/birthday_wishes/css/emoji.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

			  <div class="row" style="margin-left: 50px;">          
		  <?php 
		 $sql=$con->query("select emp_name from staff_master limit 5");
		
		 for($i=0;$i<=4;$i++)
		  {
			  $i=0;
while( $fet=$sql->fetch())
{	
			 ?>
    <div class="column" style="border-radius: 20px;width: min-content;">
      <div class="card" style="background-color: aliceblue;">
        <h3 align="center" style="margin-top: -45px;font-style: italic;color: darkblue;"><i class="fa fa-birthday-cake"
            style="color: salmon;"></i>
          &nbsp;&nbsp;&nbsp;&nbsp;<?php echo $fet['emp_name'];?>
        </h3>
        <div class="image" style="max-height: 150px;margin-top: -10px;overflow-y: hidden;overflow-x: hidden;">
          <img src="HRMS/birthday_wishes/img/kalai.jpg">
          <!-- https://cdn.pixabay.com/photo/2018/01/09/03/49/the-natural-scenery-3070808_1280 -->
        </div>
        <div class="title">
          <h5>
            Happy Birthday(31/5/2021)</h4>
        </div>
        <div class="des" style="margin-top: -20px;">
          <div class="text-left">
            <p class="lead emoji-picker-container" style="max-width: 150px;">
			<input type="hidden" name="emp_no" id="emp_no<?php echo $i;?>" value="<?php echo $fet['emp_name']; ?>">
              <textarea id="output<?php echo $i; ?>" class="form-control textarea-control" rows="3" placeholder="Comments"
                data-emojiable="true"></textarea><i style="color: #12b9b9;" class="material-icons"
                onclick="changeText<?php echo $i;?>()">send</i>
            </p>
          </div>
          <h5 style="margin-top: -10px;font-style: italic;margin-left: -100px;"><u>Comments</u></h5>
          <div style="margin-top: -15px;max-height: 105px;overflow-y: scroll;margin-left: -10px;">
            <h6 style="font-weight: lighter;" align="left"><b>Aathi </b>: Happy BirthDay 🎂😄 </h4>
            <h6 style="font-weight: lighter;"><b>Preethi </b>: Many more Happy Returns of the Day ðŸŽ‚ </h4>
            <h6 style="font-weight: lighter;"><b>Surya </b>: Happy BirthDay Kalai 🎂😄 </h4>
            <h6 style="font-weight: lighter;"><b>Priya </b>: Happy BirthDay 🎂😄 </h4>
            <h6 style="font-weight: lighter;"><b>Suman </b>: Happy BirthDay 🎂😄 </h4>
            <h6 style="font-weight: lighter;"><b>Saravanan </b>: Happy BirthDay 🎂😄 </h4>
            <h6 style="font-weight: lighter;"><b>Subi </b>: Happy BirthDay 🎂😄 </h4>
            <h6 style="font-weight: lighter;"><b>Keerthi </b>: Happy BirthDay 🎂😄 </h4>
          </div>
        </div>
      </div>
    </div>

		<?php	 
$i++;		
		  }
		  }
		  ?>
		  
		  </div>
      
 <script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
  <script src="HRMS/birthday_wishes/js/config.js"></script>
  <script src="HRMS/birthday_wishes/js/util.js"></script>
  <script src="HRMS/birthday_wishes/js/jquery.emojiarea.js"></script>
  <script src="HRMS/birthday_wishes/js/emoji-picker.js"></script>

  <script>
    $(function () {
      window.emojiPicker = new EmojiPicker({
        emojiable_selector: '[data-emojiable=true]',
        assetsPath: 'HRMS/birthday_wishes/img/',
        popupButtonClasses: 'fa fa-smile-o',
        position: 'top-start'
      }); window.emojiPicker.discover();
    });
  </script>

  <script>
    function changeText0() {
      //document.getElementById("output").value = "";
	  var mes=$('#output0').val();
	  var emp_no=$('#emp_no0').val();
      alert('Wishes Successfully sent');
	  alert(mes);
	  $.ajax({
		  type:'GET',
		  url:'insert_wishes.php',
		  data:'message='+mes+'&emp_no='+emp_no,
		  success:function(data)
		  {
			  
		  }
		  
	  });
	  
    }
  </script>