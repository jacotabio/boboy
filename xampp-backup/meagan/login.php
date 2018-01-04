<?php
include 'library/config.php';
include 'classes/class.users.php';

$user = new Users();
if($user->get_session()){
	header('location: index.php');
}
if(isset($_REQUEST['submit'])){
	extract($_REQUEST);
	$login = $user->check_login($userid,md5($password));
	if($login){
		header('location: index.php');
}else{
		echo 'Wrong Username or Password';
	}
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>RMS</title>
  <link rel="stylesheet" type="text/css" href="css/login.css">
</head>
<body>
<div id="bg"> </div>
	<img src="Logo.png" alt="Logo">
<div id="title" >
	<h1> Restaurant Management System </h1>
	<h2> Login Page </h2>
</div>
<div id="loginbox">
    <form id="login" action="" method="POST" name="login">
    <div class="row">
        <div class="login">
          <input id="userid" name="userid" type="input" class="validate" autocomplete="off" placeholder="username">
        </div>
    </div>
    <div class="row">
        <div class="login">
          <input id="password" name="password" type="password" class="validate" autocomplete="off" placeholder="password">
        </div>
    </div>
        <input type="submit" name="submit" value="Log In"/>
    </form>      
</div>
</body>
</html>
