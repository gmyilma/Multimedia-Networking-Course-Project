<?php
class Registration{
	public function displayRegistration($message){
?>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
   	<link href="../css/bootstrap.min.css" rel="stylesheet">
	<title>Registration</title>
</head>
<body>
	
	<div class="panel panel-primary">
		  <div class="panel-heading">
			    Account Registration Section
		  </div>
			<div class="container">
			  	<div class="jumbotron">
			  		<form action = "../controller/registration_controller.php" method="post" id="registrationform" class="form-horizontal" role="form" >
			  		<div class="row">
			  			<div class="col-lg-9">
					  		<div class="form-group">
					  			<?php if($message!=null && $message['notification']!=null) {?>
							    
								    <ul class="list-group">
										<li class="list-group-item list-group-item-danger"><?php echo $message["notification"]; ?></li>
									</ul>
								<?php } ?>
		    					<label for="fullName" class="col-lg-3 control-label">Full Name</label>
							    <div class="col-lg-9">
							      <input type="text" class="form-control" placeholder="Please enter your full name here!" name="fullName" id="fullName" value="<?php echo $_POST['fullName']; ?>">
							    </div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-9">
					    	<div class="form-group">
		    					<label for="email" class="col-lg-3 control-label">Email</label>
							    <div class="col-lg-9">
							      <input type="email" class="form-control" id="email" placeholder="Please enter your email here!" name = "email" value="<?php echo $_POST['email']; ?>">
							    </div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-9">
							<div class="form-group">
							    <label for="password" class="col-lg-3 control-label">Password</label>
							    <div class="col-lg-9">
							      <input type="password" class="form-control" id="password" placeholder="Please enter your password here" name = "password">
							    </div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-9">
							<div class="form-group">
							    <label for="cPassword" class="col-lg-3 control-label">Confirm Password</label>
							    <div class="col-lg-9">
							      <input type="password" class="form-control" id="cPassword" placeholder="Please enter your password again here" name = "cPassword">
							    </div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-9">
							<div class="form-group">
							    <div class="col-lg-offset-3 col-lg-9">
							      <button type="submit" class="btn btn-primary" name="submit">Register</button>
							      <a href="../view/index.php" class="btn btn-default">Cancel</a>
							    </div>
							</div>
						</div>
					</div>
					</form>
			  	</div>
			</div>
			<br /><br /><br /><br /><br /><br /><br /><br /><br />
			<div class="panel-footer">
			  	
			</div>
		</div>
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/jquery.validate.js"></script>
    <script src="../js/validation_reg.js"></script>
</body>
</html>
<?php
}

}
?>