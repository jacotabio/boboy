<?php
include 'library/config.php';
include 'classes/class.users.php';
$user = new Users();
if($user->get_session()){
	header('location: index.php');
}

if(isset($_REQUEST['submit'])){
  extract($_REQUEST);
  $login = $user->check_login($username,md5($password));
  if($login){
    header('location: index.php');
  }
  else{
    echo '<div class="wrong">Wrong Username or Password</div>';
  }
}

?>
<!DOCTYPE html>
<html>
<head>
  <title>TrendPort - Login</title>
  <link rel="stylesheet" type="text/css" href="css/login.css">
</head>
<body>
<div id="container">
  <form>
    <div class="group-login">
      <input class="input-text" name="username" type="text" class="validate" autocomplete="off" placeholder="Username" required>
    </div>
    <div class="group-login">
      <input class="input-text" name="password" type="password" class="validate" autocomplete="off" placeholder="Password" required>
    </div>
    <button class="input-button" type="submit" name="submit" value="Log In">Log in</button>
  </form>   
  <a class="register" style="margin-top: 20px;"href="register.php">Create an account?</a>
</div>
</body>
</html>

