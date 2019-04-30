<?php
class forgot_password{
	public function display_forgot_password($message, $error){
		?>
			<html>
				<head>
					<meta charset="utf-8">
    				<meta http-equiv="X-UA-Compatible" content="IE=edge">
    				<meta name="viewport" content="width=device-width, initial-scale=1">

    				<!-- Bootstrap -->
   					<link href="../css/bootstrap.min.css" rel="stylesheet">
					<title>Forgot Password</title>
				</head>
				<body>
					<form class="form-horizontal" role="form" action="../controller/fp_controller.php" method="post">
						<div class="panel panel-primary">
							<div class="panel-heading">
								Password Recovery
							</div>
			  				<div class="panel-body">
			  					<ul class="list-group">
									  	<li class="list-group-item list-group-item-info">
									  		Please enter the email address that you used to register below and we will send you a password reset link. Remember the link will expire after an hour so!
										</li>
								</ul>
								<div class="row">
									<div class="col-lg-12">
										<div class="form-group">
											<label for="email" class="col-sm-2 control-label">Email</label>
											<div class="col-sm-10">
												<input type="email" class="form-control" id="email" placeholder="Please enter your email here!" name = "email" value="<?php echo $_POST['email']; ?>">
									    		<?php if($error!=null && strcmp($error['wrong_email'], "")!=0) echo $error['wrong_email']; ?>
									  			<?php if($message!=null && strcmp($message['success'], "")!=0) echo $message['success']; ?>
									    	</div>
									    </div>
								  	</div>
								</div>
								<div class="row">
								  	<div class="col-sm-12">
								  		<div class="col-sm-offset-2 col-sm-10">
									  		<button class="btn btn-primary" type="submit" name="submit">Submit!</button>
									  		<a class="btn btn-default" href="../view/index.php">Cancel!</a>
								  		</div>
								  	</div>
								</div>
							</div>
						</div>
					</form>
					<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    				<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    				<!-- Include all compiled plugins (below), or include individual files as needed -->
    				<script src="../js/bootstrap.min.js"></script>
    				<script src="../js/jquery.validate.js"></script>
    				<script src="../js/validation.js"></script>
				</body>
			</html>
		<?php
	}
}
?>