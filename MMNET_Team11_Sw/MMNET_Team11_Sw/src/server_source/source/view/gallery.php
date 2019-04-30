<?php
class gallery{
	function open_gallery($content){
	?>
		<html>
			<head>
				<meta charset="utf-8">
				<meta http-equiv="X-UA-Compatible" content="IE=edge">
				<meta name="viewport" content="width=device-width, initial-scale=1">
		
				<!-- Bootstrap -->
				<link href="../css/bootstrap.min.css" rel="stylesheet">
				<title>Gallery</title>
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
					      	<li><a href="../controller/dashboard_controller.php?home">Home</a></li>
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
						   <li class="active"><a href="../controller/dashboard_controller.php?gallery">Gallery</a></li>
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
				<div class="container">
					<div class="jumbotron">
						<?php
						if($content!=null){
							$column_count = 1;
							for($i=0;$i<count($content);$i++) {
								$val = explode("multimedia", $content[$i]['path']);
								if($column_count%4==0 || $column_count==1){
								?>
									<div class="row">
								<?php
								}
								?>
								<div class="col-lg-3 col-sm-6" id="gallery_column">
									<div class="thumbnail">
										<img src="<?php echo $content[$i]['path']; ?>" data-src="holder.js/300x200" alt="... "  width = "100" height="100">
										<div class="caption">
									        <h3><?php echo $content[$i]['name']; ?></h3>
									        <p><?php echo $content[$i]['desc']; ?></p>
									        <p><a href="../controller/dashboard_controller.php?edit=<?php echo $content[$i]['id']; ?>&source=gallery" class="btn btn-primary" role="button">Update</a></p>
									   	</div>
									</div>
								</div>
								<?php
								if($column_count%4==0){
								?>
									</div>
								<?php	
								$column_count = $column_count + 1;
								}
							}
						}
						else {
						?>
							<br />
							<div class="row">
								<div class="col-lg-12">
									<div class="alert alert-warning">Alert! There is no artifact  for the gallery view. You Need to add artifacts first in the <a href="../controller/dashboard_controller.php?add">Add Record</a> section. Then you shall see an image gallery of the artifacts over here.</div>
								</div>
							</div>
						<?php
						}
						?>
					</div>
				</div>
				<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
				<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
				<!-- Include all compiled plugins (below), or include individual files as needed -->
				<script src="../js/bootstrap.min.js"></script>
                            
				<script src="../js/thumbnail_height.js"></script>
				<script>
				    $().ready(function () {
				        // Ensure equal heights on thumbnail boxes
				        $('.thumbnail').equalHeights();
				        $('img').equalHeights();
				    });
				</script>
			</body>
		</html>
	<?php
	}
}
?>