<?php
session_start();
include 'databaseController.php';
include '../view/login.php';
include '../view/dashboard.php';
$db = new Database();
$login = new Login();
$dashboard = new Dashboard();
if(isset($_POST["login"])){
	$email = $_POST["email"];
	$password = $_POST["password"];
	
	$selectQuery = "SELECT email, full_name FROM admin WHERE email = '$email' AND password = '$password' ";
	
	$result = $db->getAll($selectQuery);
	if(!$result){
		$array = array("ip"=>"The email or password you entered is incorrect!");
		$login->displayLogin($array);
	} else {
		$_SESSION["current_user"] = $result[0];
		$_SESSION["name"] = $result[1];
		
		
		$dashboard->displayDashBoard();
	}
}

?>