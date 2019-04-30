<?php
class view_records{
	public function display_view_records($data, $which){
	?>
		<html>
		<head>
			<meta charset="utf-8">
    		<meta http-equiv="X-UA-Compatible" content="IE=edge">
    		<meta name="viewport" content="width=device-width, initial-scale=1">
    		<!-- Bootstrap -->
    		<link href="../css/bootstrap.min.css" rel="stylesheet">
			<title>View Records</title>
		
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
			<div class="container">
				<div class="jumbotron">
					<div class="row">
						<form class="form-horizontal" role="form" action="../controller/dashboard_controller.php" method="GET">
							<div class="col-sm-offset-6 col-lg-6">
								<br /><br />
								<div class="input-group">
									<input type="hidden" name="which" value="<?php echo $which; ?>"/>
									<input type="text" class="form-control" id="inputEmail3" placeholder="Please enter the artifact name you want to search!" name = "search" value="<?php echo $_GET['search']; ?>">
									<span class="input-group-btn">
										<button class="btn btn-primary" type="submit" name="go">Go!</a>
									</span>
								</div>
							</div>
						</form>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12">
						<table class="table table-striped table-hover">
							<caption><h3>List of <?php echo $which; ?> Artifacts in the Museum</h3></caption>
							<div class="row">
								<thead>
									<tr>
										<th>
											Artifact Name
										</th>
										<th>
											High quality image
										</th>
										<th>
											Low quality image
										</th>
										<th>
											Description
										</th>
										<?php if(strcmp($which, "Active")==0) {?>
										<th colspan="2">
											Actions
										</th>
										<?php 
										}
										?>
									</tr>
								</thead>
							</div>
							<div class="row" >
								<tbody>
									<?php 
										if($data==null){
									?>
											<tr>
												<td colspan="5">
													<div  class="alert alert-warning">
														<?php
														if(strcmp($which, "Active")==0){ 
														?>
														Sorry! no artifacts found, please go to the <a href="../controller/dashboard_controller.php?add">Add Records</a> section and add the artifact(s) first! You will then see the artifacts listed over here!
														<?php
														} else{
														?>
														Sorry! There are no arcieved records at the moment!
														<?php
														}
														?>
													</div>
												</td>
											</tr>
									<?php
										}
										else {
											foreach ($data as $key => $value) {
											?>
												<tr>
											<?php
												$id = "";
												foreach ($value as $inner_key => $inner_value) {
													if(strcmp($inner_key, "hpath")==0 || strcmp($inner_key, "lpath")==0){
														//$val = explode("multimedia", $inner_value);
													?>
														<td><img src="<?php echo $inner_value; ?>" height="50" width="50"/></td>
													<?php
													} else if(strcmp($inner_key, "id")==0){
														$id = $inner_value;
													}
													else {
														if(strcmp($inner_key, "path")!=0){
															?>
																<td><?php echo $inner_value; ?></td>
															<?php
														}
													}
												}
												?>
												<?php if(strcmp($which, "Active")==0) {?>
													<td><a  class="btn btn-primary" role="button" href="../controller/dashboard_controller.php?which=<?php echo $which; ?>&edit=<?php echo $id; ?>&source=view" ><span class="glyphicon glyphicon-pencil"></span> Update</a></td>
													<td><a  onClick="return confirm('Are you sure you want to permanently delete this artifact?')" class="btn btn-danger" role="button" href="../controller/dashboard_controller.php?which=<?php echo $which; ?>&delete=<?php echo $id; ?>"><span class="glyphicon glyphicon-floppy-remove"> Delete</a></td>
												<?php 
												}
												?>
												
												</tr>	
											<?php
											}
										}
									?>
									
								</tbody>
							</div>
						</table>
					</div>
				</div>
			</div>
			
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    		<!-- Include all compiled plugins (below), or include individual files as needed -->
    		<script src="../js/bootstrap.min.js"></script>
		</body>
		</html>
	<?php
	}
}
?>
