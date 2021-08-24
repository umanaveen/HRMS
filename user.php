<?php 
session_start();
if (!isset($_SESSION['username'])) 
{
    header("Location: login/login.php");
}
else
{
  $now = time(); // Checking the time now when home page starts.
   if ($now > $_SESSION['expire']) 
    {
      // header('Location:../login/lockscreen.php'); 
    }
   else
	{
		//Starting this else one [else1]
	}
}
?>