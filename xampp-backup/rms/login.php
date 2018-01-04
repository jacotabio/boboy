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
<html>
<head>
  <title>RMS</title>
  <link rel="stylesheet" type="text/css" href="css/login.css">
</head>
<body>
<hgroup>
  	<h1>Login</h1>
 </hgroup>
  <form>
    <div class="group-userid">
      <input id="userid" name="userid" type="number" class="validate" autocomplete="off"><span class="highlight"></span><span class="bar"></span>
      <label>User ID</label>
    </div>
    <div class="group-password">
      <input id="password" name="password" type="password" class="validate" autocomplete="off"><span class="highlight"></span><span class="bar"></span>
      <label>Password</label>
    </div>
    <button class="button buttonBlue" type="submit" name="submit" value="Log In">Sign in
      <div class="ripples buttonRipples"><span class="ripplesCircle"></span></div>
    </button>
  </form>
  <footer id="footer-design">
	<p>All Rights Reserved</p>
	<p>2016</p>
  </footer>
</body>
</html>

