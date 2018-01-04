<?php
include '../library/config.php';
include '../classes/class.users.php';

$user = new Users();

$username = $_POST['username'];
$password = $_POST['password'];

$username = stripslashes($username);
$password = stripslashes($password);

$login = $user->check_login($username,$password);
if($login){
  echo "login_success";
}else{
  echo "login_failed";
}
