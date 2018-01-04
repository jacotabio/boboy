<?php
include '../../library/config.php';
include '../../classes/class.users.php';

$user = new Users();
$email = $_POST['email'];
$password = $_POST['password'];

$email = stripslashes($email);
$password = stripslashes($password);

$login = $user->check_login($email,$password);
if($login){
  echo "login_success";
}else{
  echo "login_failed";
}
?>