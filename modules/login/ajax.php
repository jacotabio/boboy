<?php
include '../../library/config.php';
include '../../classes/class.users.php';

$user = new Users();
$email = $_POST['email'];
$password = $_POST['password'];

$email = stripslashes($email);
$password = stripslashes($password);

$login = $user->check_login($email,md5($password));

if($login == "login_success"){
  echo "login_success";
}else if($login == 1){
	echo "user_banned";
}else{
  echo "login_failed";
}
?>