
<style>
.navbar-brand{
	font-size: 24px !important;
}
</style>
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
                <div class="navbar-header">
                    <a class="navbar-brand" href="">BBvision</a>
                </div>

                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <ul class="nav navbar-nav navbar-left navbar-top-links">
                    <li><a href="#"></a></li>
                </ul>

				<ul class="nav navbar-right navbar-top-links">
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
                <!-- /.navbar-top-links -->

                <div class="navbar-default sidebar" role="navigation">
                    
					<?php
 require('sidebar.php');
 ?>
                </div>
            </nav>