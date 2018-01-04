<?php 
include 'library/config.php';
include 'classes/class.users.php';

$user = new Users();

$email = $_GET['email'];
$password = $_GET['password'];

$register = $user->new_user($email,$password);

if($register){
	echo "{\"register\":[{\"check\":\"true\"}]}";
}else{
	echo "{\"register\":[{\"check\":\"false\"}]}";
}