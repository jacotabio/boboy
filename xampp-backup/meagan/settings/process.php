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
	$lastname = strtoupper($_POST['lastname']);
	$firstname = strtoupper($_POST['firstname']);
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
		exit;
	}
}
