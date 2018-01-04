<?php
include 'library/config.php';
include 'classes/class.users.php';
include 'classes/class.settings.php';
include 'classes/class.donations.php';

$donations = new Donations();
$settings = new Settings();
$user = new Users();
if(!$user->get_session()){
	header("location: login.php");
}
$module = (isset($_GET['mod']) && $_GET['mod'] != '') ? $_GET['mod'] : '';
$sub = (isset($_GET['sub']) && $_GET['sub'] != '') ? $_GET['sub'] : '';
$process = (isset($_GET['pro']) && $_GET['pro'] != '') ? $_GET['pro'] : '';
$sID = (isset($_GET['sID']) && $_GET['sID'] != '') ? $_GET['sID'] : '';

if(isset($_GET['n'])){
	echo '<script>alert("User already existasdasd!");</script>';
}

?>
<!DOCTYPE html>
<html>
<head>
<title>Midterm</title>
<link rel="stylesheet" type="text/css" href="css/stylesheet.css">
<link rel="script" type="text/javascript" src="js/javascript.js">
<script type="text/javascript" src="js/javascript.js"></script>
<script type="text/javascript" src="js/popup.js"></script> 
<script type="text/javascript" src="js/jquery-1.6.1.min.js"></script> 
</head>
<body>
<div id="container">
	<div id="navi">

		<ul>
		<a href="index.php"><img src="img/logo.png"/></a>
			<li><a href="logout.php">Logout</a></li>
			<?php
			if($_SESSION['access'] == 201){
			?>
			<li><a href="index.php?mod=settings">Settings</a></li>
			<?php
			}
			?>
			<li><a href="index.php?mod=donations">Donations</a></li>

		</ul>
	</div>
	<div class="main">
	<?php
		switch($module){
	        case 'settings':
	            require_once 'settings/index.php';
				break;
			case 'donations':
				require_once 'donations/index.php';
				break;
			default:
				require_once 'index_splash.php';
				break;
	    }
	?>
	</div>
</div>
</body>
</html>