<?php
include '../view/forgot_password.php';
include 'databaseController.php';
$fp = new forgot_password();
$db = new Database();
if(isset($_GET['fp'])){
	$fp->display_forgot_password(null, null);
}
if(isset($_GET['new_password'])){
	
}
if(isset($_POST['submit'])){
	$message = array();
	$error = array();
	$email = trim($_POST['email']);
	$query = "SELECT * FROM admin WHERE email='$email'";
	
	$num_rows = $db->getRowCount($query);
	echo $num_rows;
	if(!$num_rows){
		$message['success'] = "";
		$error['wrong_email'] = "[Attention:] Sorry! That email doesn't exist!";
		$fp->display_forgot_password(null, $error);
	}
	if($num_rows > 0){
		$to = $email;
		$subject = "Password Reset";
		$code = rand(100000, 1000000);
		$link = $_SERVER['DOCUMENT_ROOT']."/multimedia/controller/fp_controller.php?new_password&code=$code&email=$email";
		$body = "
			<html>
				<head>
					<meta charset='utf-8'>
    				<meta http-equiv='X-UA-Compatible' content='IE=edge'>
    				<meta name='viewport' content='width=device-width, initial-scale=1'>

    				<!-- Bootstrap -->
   					<link href='../css/bootstrap.min.css' rel='stylesheet'>
				</head>
				<body>
					<div class='panel panel-primary'>
						<div class='panel-heading'>
							Password Reset
						</div>
						<div class='panel-body'>
							<div class='row'>
								<div class='col-lg-12'>
									This is an automated email. Please DO NOT reply to this message!
								</div>
							</div>
							<div class='row'>
								<div class='col-lg-12'>
									Please Click the link below or paste into your browser!
								</div>
							</div>
							<div class='row'>
								<div class='col-lg-12'>".
									"https://".$link.
								"</div>
							</div>
						</div>
					</div>
					<script src='https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js'></script>
    				<!-- Include all compiled plugins (below), or include individual files as needed -->
    				<script src='../js/bootstrap.min.js'></script>
				</body>
			</html>
		";
		
		$query = "UPDATE admin SET password_reset=$code WHERE email='$email'";
		$status = $db->update($query);
		if($status){
			mail($to, "agapae4zak@gmail.com", $body);
			$error['wrong_email'] = "";
			$message['success'] = "Please check your email, a password reset link is sent to $email";
			$fp->display_forgot_password($message, null);
		}
	} else {
		
	}
}
?>