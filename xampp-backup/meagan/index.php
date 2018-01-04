<?php
include 'library/config.php';
include 'classes/class.settings.php';
include 'classes/class.users.php';

$user = new Users();
if(!$user->get_session()){
	header("location: login.php");
}

$module = (isset($_GET['mod']) && $_GET['mod'] != '') ? $_GET['mod'] : '';
$sub = (isset($_GET['sub']) && $_GET['sub'] != '') ? $_GET['sub'] : '';
$process = (isset($_GET['pro']) && $_GET['pro'] != '') ? $_GET['pro'] : '';

$settings = new Settings();

?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="cache-control" content="no-cache">
    <title></title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/stylesheet.css">
</head>
<body>
<div id="navigation">
    <ul>
      <li><a href="index.php"><?php echo file_get_contents("svg/home.svg");?></a></li>
      <li><a href="index.php?mod=food">Food Items</a></li>
      <li><a href="index.php?mod=inventory">Inventory</a></li>
      <li><a href="index.php?mod=reports">Reports</a></li>
      <li><a href="index.php?mod=sales">Sales</a></li>
      <li><a href="index.php?mod=orders">Table and Orders</a></li>
      <li><a href="index.php?mod=settings">Settings</a></li>
      <li><input type="search" class="search" name="search" placeholder="Search"/></li>
      <li><a href="logout.php">Log Out</a></li>
    </ul>

</div>
<div class="main">
  <?php
    switch($module){
        case 'settings':
            require_once 'settings/index.php';
        break;
    }
  ?>
</div>
</body>
</html>
