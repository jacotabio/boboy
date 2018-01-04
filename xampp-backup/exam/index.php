<?php
include 'library/config.php';
include 'classes/class.settings.php';
include 'classes/class.users.php';
include 'classes/class.products.php';
include 'classes/class.reports.php';
include 'classes/class.transactions.php';

$product = new Products();
$report = new Reports();
$settings = new Settings();
$user = new Users();
$transaction = new Transactions();


if(!$user->get_session()){
	header("location: login.php");
}

if (isset($_GET['message'])) {
    print '<script type="text/javascript">alert("' . $_GET['message'] . '");</script>';
}
$module = (isset($_GET['mod']) && $_GET['mod'] != '') ? $_GET['mod'] : '';
$sub = (isset($_GET['sub']) && $_GET['sub'] != '') ? $_GET['sub'] : '';
$process = (isset($_GET['pro']) && $_GET['pro'] != '') ? $_GET['pro'] : '';
$prodID = (isset($_GET['prodID']) && $_GET['prodID'] != '') ? $_GET['prodID'] : '';
?>
<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="cache-control" content="no-cache">
	<title>OCTAVE</title>
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:400,700" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/style.css">
    
    <script type="text/javascript" src="js/jquery-1.6.1.min.js"></script> 
    <script type="text/javascript" src="js/popup.js"></script> 
    <script type="text/javascript" src="js/deletePrompt.js"></script>
x`
</head>
<body>
<div id="navigation">
	<ul>
        <li><a class="navi-logo" href="index.php"><img src="img/supersmall.png"/></a></li>
		<li><a href="index.php?mod=dashboard">Menu</a></li>
        <li class="last"><a href="index.php?mod=dashboard&sub=settings"><?php echo $fname = $_SESSION['userfname'];?> <?php echo $lname = $_SESSION['userlname'];?></a></li>
	</ul>
</div>
<div class="main">
  <?php
    switch($module){
    	case 'dashboard':
    		require_once 'dashboard/index.php';
    	break;
    }
  ?>
</div>
</body>
</html>
