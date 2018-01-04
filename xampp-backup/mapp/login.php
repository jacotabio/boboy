<?php 
include 'library/config.php';
include 'classes/class.users.php';

$user = new Users();

$email = $_GET['email'];
$password = $_GET['password'];

$login = $user->check_login($email,md5($password));
$id = $user->get_user_id($email,md5($password));

if($login){
	echo "{\"login\":[{\"check\":\"true\",\"user_id\":\"$id\"}]}";
}else{
	echo "{\"login\":[{\"check\":\"false\"}]}";
}