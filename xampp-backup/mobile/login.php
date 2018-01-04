<?php
include 'library/config.php';
include 'classes/class.users.php';

$users = new Users();

$username = $_GET['username'];
$password = $_GET['password'];
$access = $_GET['access'];

if($access=="admin"){
	$result = $users->check_admin_login($username,md5($password));
}else if($access=="medrep"){
	$result = $users->check_medrep_login($username,md5($password));
}

$response = array();

if($result==false){
	$code = "login_failed";
	$message = "Username and Password does not match";
	array_push($response, array("code"=>$code,"message"=>$message,"name"=>"null","userid"=>"null"));
	echo json_encode($response);
}else{
	$code = "login_success";
	$message = "You are now logged in";
	if($access=="admin"){
		$value = $users->get_admin_info($username,md5($password));
	array_push($response, array("code"=>$code,"message"=>$message,"name"=>$value['usr_firstname']." ".$value['usr_lastname'],"userid"=>$value['usr_id'],"acc_photo"=>$value['acc_photo']));
	}else if($access=="medrep"){
		$value = $users->get_medrep_info($username,md5($password));
	array_push($response, array("code"=>$code,"message"=>$message,"name"=>$value['mr_firstname']." ".$value['mr_lastname'],"userid"=>$value['medrep_id'],"acc_photo"=>$value['acc_photo']));
	}
	echo json_encode($response);
}
		
?>