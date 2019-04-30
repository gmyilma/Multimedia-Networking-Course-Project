<?php
session_start();
class Dashboard{
	public function displayDashBoard(){
	?>
		<html>
		<head>
			<meta charset="utf-8">
    		<meta http-equiv="X-UA-Compatible" content="IE=edge">
    		<meta name="viewport" content="width=device-width, initial-scale=1">
    		<!-- Bootstrap -->
    		<link href="../css/bootstrap.min.css" rel="stylesheet">
    		<title>Dashboard</title>
		</head>
		<body>
			<header>
				<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
				  <div class="container">
				    <!-- Brand and toggle get grouped for better mobile display -->
				    <div class="navbar-header">
				      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
				        <span class="sr-only">Toggle navigation</span>
				        <span class="icon-bar"></span>
				        <span class="icon-bar"></span>
				        <span class="icon-bar"></span>
				      </button>
				      <a class="navbar-brand" href="#">Dashboard Management System</a>
				    </div>
				
				    <!-- Collect the nav links, forms, and other content for toggling -->
				    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				      <ul class="nav navbar-nav navbar-left">
				      	<li class="active"><a href="../controller/dashboard_controller.php?home">Home</a></li>
				        <li><a href="../controller/dashboard_controller.php?add">Add Records</a></li>
				        <li>
					        <ul class="nav navbar-nav navbar-right">
						        <li><a class="dropdown-toggle" data-toggle="dropdown">View<b class="caret"></b> </a>
							      	<ul class="dropdown-menu">
							            <li><a href="../controller/dashboard_controller.php?view">Active Records</a></li>
							            <li class="divider"></li>
							            <li><a href="../controller/dashboard_controller.php?view_archieve">Archieved Records</a></li>
							        </ul>
							    </li>
						   </ul>
						</li>
					   <li><a href="../controller/dashboard_controller.php?gallery">Gallery</a></li>
				      </ul>
				      <ul class="nav navbar-nav navbar-right">
					        <li><a class="dropdown-toggle" data-toggle="dropdown"><?php echo $_SESSION["name"]."'s"; ?> Account <b class="caret"></b> </a>
						      	<ul class="dropdown-menu">
						            <li><a href="../controller/dashboard_controller.php?change_password">Change Password</a></li>
						            <li class="divider"></li>
						            <li><a href="../controller/dashboard_controller.php?logout">Log out</a></li>
						        </ul>
						    </li>
					   </ul>
				    </div><!-- /.navbar-collapse -->
				  </div><!-- /.container-fluid -->
				</nav>
			</header>
			<br /><br />
			<div class="container">
				<div class="jumbotron" style="margin-bottom: 0px;padding: 300px;background-image: url(../img/bg.jpg);background-position: 0% 25%;background-size: cover;background-repeat: no-repeat;color: white;text-shadow: black 0.3em 0.3em 0.3em;">
				</div>
			</div>
			
			<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    		<!-- Include all compiled plugins (below), or include individual files as needed -->
    		<script src="../js/bootstrap.min.js"></script>
		</body>
		</html>
	<?php
	}
}
?>
