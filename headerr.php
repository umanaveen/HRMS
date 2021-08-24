 <?php
$username=$_SESSION['username'];
?>
 <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light" style="background-color:white">
    <!-- Left navbar links -->
	<ul class="navbar-nav">
	<li class="nav-item">
	<a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
	</li>
	</ul>
    <!-- Right navbar links -->
	<ul class="navbar-nav ml-auto">
	<li class="dropdown">
	<a class="dropdown-toggle" data-toggle="dropdown" href="#">
	<i class="fa fa-user fa-fw"></i>  
	<b style="color:blue;text-align:center;"><?php echo $username;?></b>
	<b class="caret"></b>
	</a>
	<ul class="dropdown-menu dropdown-user">
	<li><a href="login/login.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
	</li>
	</ul>
	</li>
	</ul>
	
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->