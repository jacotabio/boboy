<?php
include '../library/config.php';
include '../classes/class.settings.php';
include '../classes/class.users.php';

$action = isset($_GET['action']) ? $_GET['action'] : '';

switch($action){
	case 'usernew': usernew();
		break;
}

	
function usernew(){
	$userid = $_POST['userid'];
	$password = $_POST['password'];
	$confirm = $_POST['copassword'];
	$firstname = ucwords($_POST['firstname']);
	$lastname = ucwords($_POST['lastname']);
	$access = $_POST['access'];

	if($password == $confirm){
		$users = new Users();
		$users->new_user($userid,$password,$firstname,$lastname,$access);
		header("location: ../index.php?mod=settings&sub=users&pro=list");
		exit;
	}else{
		header("location: ../index.php?mod=settings&sub=users&pro=new");
		echo "Passwords do not match. Please try again.";
		exit;
	}
}
