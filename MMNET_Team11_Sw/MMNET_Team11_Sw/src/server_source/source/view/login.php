<?php
class Login{
	public function displayLogin($error){
	?>
		<html>
			<head>
				<meta charset="utf-8">
    			<meta http-equiv="X-UA-Compatible" content="IE=edge">
    			<meta name="viewport" content="width=device-width, initial-scale=1">
    			

    			<!-- Bootstrap -->
    			<link href="../css/bootstrap.min.css" rel="stylesheet">
    			<title>Login</title>
			</head>
		<body>
			
		<form class="form-horizontal" role="form" action = "../controller/login_controller.php" method="post" >
			
			<div class="panel panel-primary">
				<div class="panel-heading">Dashboard Management System</div>
				<br /><br /><br />
			  	
			  	<div class="container">
			  		<div class="jumbotron">
			  			<?php
						if(count($error) > 0){
							?>
								<div class="row">
									<div class="col-lg-12">
										<div class="col-sm-offset-2 col-lg-10">
											<ul class="list-group">
											  <li class="list-group-item list-group-item-danger"><?php echo $error["ip"]; ?></li>
											</ul>
										</div>
									</div>
								</div>
							<?php
						}
					?>
			  			<div class="row">
			  				<div class="col-lg-12">
			  					<div class="form-group">
			    					<label for="inputEmail3" class="col-sm-2 control-label">Email</label>
								    <div class="col-sm-10">
								      <input type="email" class="form-control" id="inputEmail3" placeholder="Please Enter Your Email Here!" name = "email" value="<?php echo $_POST['email']; ?>">
								    </div>
								</div>
			  				</div>
			  			</div>
			  			<div class="row">
			  				<div class="col-lg-12">
			  					<div class="form-group">
								    <label for="inputPassword3" class="col-sm-2 control-label">Password</label>
								    <div class="col-sm-10">
								      <input type="password" class="form-control" id="inputPassword3" placeholder="Please Enter Your Password Here!" name = "password">
								    </div>
								</div>
			  				</div>
			  			</div>
			  			<div class="row">
			  				<div class="col-lg-12">
			  					<div class="form-group">
								    <div class="col-sm-offset-2 col-sm-10">
								      <div class="checkbox">
								        <label>
								          <input type="checkbox"> Remember me
								        </label>
								      </div>
								    </div>
								</div>
			  				</div>
			  			</div>
			  			<div class="row">
			  				<div class="col-lg-12">
			  					<div class="form-group">
								    <div class="col-sm-offset-2 col-sm-10">
								      <button type="submit" class="btn btn-primary" name="login">Sign in</button>
								    </div>
								</div>
			  				</div>
			  			</div>
					  	<div class="row">
					  		<div class="col-lg-12">
						  		<div class="col-sm-offset-2 col-lg-10">
						  			<div class="list-group">
										  <li class="list-group-item list-group-item-warning">
											Having trouble with loging in? May be you aren't registered or you forgot your password!
										  </li>
									  
										  <a href="../controller/registration_controller.php?reg" class="list-group-item">Register</a>
										  <a href="../controller/fp_controller.php?fp" class="list-group-item">Forgot Password? Click Here</a>
									</div>
						  		</div>
						  	</div>
					  	</div>
					  </div>
					  <br /><br />
					</div>
			  	</div>
			  	
			  <div class="panel-footer">
			  	

			  </div>
			</div>
		</form>
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