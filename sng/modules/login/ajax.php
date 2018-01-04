<?php
include '../../library/config.php';
include '../../classes/class.users.php';

$user = new Users();

$login = $user->check_login($_POST['email'],md5($_POST['password']));
if($login){
  echo "login_success";
}else{
  echo "login_failed";
}
?>