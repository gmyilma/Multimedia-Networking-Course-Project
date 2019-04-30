<?php
include 'databaseController.php';
include '../view/register.php';
$register = new Registration();
$db = new Database();

if(isset($_GET["reg"])){
	$register->displayRegistration(null);
}
if(isset($_POST["submit"])){
	$form_data = array();
	$fullName = $_POST["fullName"];
	$email = $_POST["email"];
	$pass = $_POST["password"];
	$cPass = $_POST["cPassword"];
	$form_data["fullName"] = $fullName;
	$form_data["email"] = $email;
	$form_data["password"] = $pass;
	$form_data["cPassword"] = $cPass;
	$validationResult = array();
	$message = array();
	
	$insertQuery = "INSERT INTO admin VALUES ('$fullName', '$email', '$pass', '')";
	$status = $db->add($insertQuery);
	if($status){
		$message["notification"] = "[MESSAGE:]Registration completed successfully!";
		$register->displayRegistration($message);
	} else {
		$message["notification"] = "[MESSAGE:]Registration IS NOT completed successfully!";
		$register->displayRegistration($message);
	}
}
?>