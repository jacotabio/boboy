<?php
include 'library/config.php';
include 'classes/class.topic.php';
include 'classes/class.users.php';

$user = new Users();
$topic = new Topic();

if(!$user->get_session()){
	header("location: login.php");
}

$module = (isset($_GET['mod']) && $_GET['mod'] != '') ? $_GET['mod'] : '';
$sub = (isset($_GET['sub']) && $_GET['sub'] != '') ? $_GET['sub'] : '';
$process = (isset($_GET['pro']) && $_GET['pro'] != '') ? $_GET['pro'] : '';
?>
<!DOCTYPE html>
<html>
<head>
	<title>TrendPort - Headlines by Netizens</title>
	<link rel="stylesheet" type="text/css" href="css/stylesheet.css">
</head>
<body>
<div id="navi">
	<ul>
		<li><a class="logo" href="index.php">TrendPort</a></li>
		<li><a href="logout.php">Logout</a></li>
		<li><a href="index.php?mod=profile">Profile</a></li>
		<li><a href="index.php?mod=create">Create</a></li>
		<li><a href="index.php">Feed</a></li>
	</ul>
</div>
<div class="main">
<?php
if(isset($_GET['topic'])){
	require_once 'view_topic.php';
}else{
	switch($module){
		default:
			require_once 'feed.php';
			break;
		case 'create':
			require_once 'create.php';
			break;
		case 'profile':
			require_once 'profile.php';
			break;
	}
}
?>
</div>
<div class="footer">
	<div class="content">
		All Rights Reserved 2017
	</div>
</div>
</body>
</html>