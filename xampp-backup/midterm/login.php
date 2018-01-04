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
		echo '<div class="wrong">Wrong Username or Password</div>';
	}	
}
?>
<!DOCTYPE html>
<head>
  <title>Login</title>
  <link rel="stylesheet" type="text/css" href="css/stylesheet.css">
</head>
<body id="login-body">
<form id="login">
<h3>Login Page</h3>
    <div class="col30">
    <label class="labelstyle">User ID</label></br>
      <input id="userid" name="userid" type="number" class="validate" autocomplete="off">
      
    </div>
    <div class="col30">
    <label class="labelstyle">Password</label></br>
      <input id="password" name="password" type="password" class="validate" autocomplete="off">
      
    </div>
    <button type="submit" name="submit" value="Login">Login</button>
  </form>
</html>
</body>