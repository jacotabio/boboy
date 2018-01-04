<?php
include '../library/config.php';
include '../classes/class.settings.php';
include '../classes/class.users.php';

$action = isset($_GET['action']) ? $_GET['action'] : '';

switch($action){
	case 'usernew': usernew();
		break;
	case 'changesettings': change_settings();
		break;
}

function change_settings(){
		$companyname = ucwords($_POST['companyname']);
		$address = $_POST['address'];
		$version = $_POST['version'];
		$copyright = $_POST['copyright'];
		$settings = new Settings();
		$settings->set_settings($companyname,$address,$version,$copyright);
		header("location: ../index.php?mod=settings&sub=system&pro=display");
		exit;
}
	
function usernew(){
	$lastname = ucwords($_POST['lastname']);
	$firstname = ucwords($_POST['firstname']);
	$access = $_POST['access'];
	$userid = $_POST['userid'];
	$password = $_POST['password'];
	$confirm = $_POST['copassword'];

	if($password == $confirm){
		$users = new Users();
		$users->new_user($userid,$access,$password,$lastname,$firstname);
		header("location: ../index.php?mod=settings&sub=users&pro=list");
		exit;
	}else{
		header("location: ../index.php?mod=settings&sub=users&pro=new");
		echo "Passwords do not match. Please try again.";
		exit;
	}
}
