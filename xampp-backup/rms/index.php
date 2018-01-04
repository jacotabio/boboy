<?php
include 'library/config.php';
include 'classes/class.settings.php';
include 'classes/class.users.php';
include 'classes/class.food.php';
include 'classes/class.order.php';
include 'classes/class.sales.php';
include 'classes/class.inventory.php';

$sales = new Sales();
$user = new Users();
$inventory = new Inventory();
if(!$user->get_session()){
	header("location: login.php");
}

$module = (isset($_GET['mod']) && $_GET['mod'] != '') ? $_GET['mod'] : '';
$sub = (isset($_GET['sub']) && $_GET['sub'] != '') ? $_GET['sub'] : '';
$process = (isset($_GET['pro']) && $_GET['pro'] != '') ? $_GET['pro'] : '';

$settings = new Settings();
$food = new Food();
$order = new Order();
?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="cache-control" content="no-cache">
    <title></title>
    <script src="jquery-3.1.1.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/stylesheet.css">
    <link rel="stylesheet" type="text/css" href="css/modal.css">
</head>
<body>
<div id="navigation">
    <ul>
      <li><a href="index.php"><?php echo file_get_contents("svg/home.svg");?></a></li>
      <li><a href="index.php?mod=food">Food Items</a></li>
      <li><a href="index.php?mod=inventory">Inventory</a></li>
      <li><a href="index.php?mod=reports">Reports</a></li>
      <li><a href="index.php?mod=sales">Sales</a></li>
      <li><a href="index.php?mod=order">Table and Orders</a></li>
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
		case 'food':
			require_once 'food/index.php';
			break;
		case 'inventory':
			require_once 'inventory/index.php';
			break;
		case 'reports':
			require_once 'reports/index.php';
			break;
		case 'sales':
			require_once 'sales/index.php';
			break;
		case 'order':
			require_once 'order/index.php';
			break;
    }
  ?>
</div>
</body>
</html>
