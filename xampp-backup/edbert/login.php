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
	}
	else{
    $message = "Username or password does not match.";
    echo "<script type='text/javascript'>alert('$message');</script>";
  }
}
		?>
<!DOCTYPE html>
<html>
<head>
  <title>Gardo - Login </title>
  <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:400,700" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="css/login.css">
</head>
<body>
<div id="container">
  	<h2>Welcome</h2>
  <form>
    <div class="group-login">
      <input class="input-text" min="0" name="userid" type="number" class="validate" autocomplete="off" placeholder="User ID">
    </div>
    <div class="group-login">
      <input class="input-text" name="password" type="password" class="validate" autocomplete="off" placeholder="Password">
    </div>
    <button class="input-button" type="submit" name="submit" value="Log In">Log in</button>
  </form>   
  <a class="register" href="register.php">Create an account?</a>
</div>
</body>
</html>

