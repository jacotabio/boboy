
<?php
include 'library/config.php';
include 'classes/class.table.php';
include 'classes/class.product.php';
include 'classes/class.order.php';
include 'classes/class.users.php';
$module = (isset($_GET['mod']) && $_GET['mod'] != '') ? $_GET['mod'] : '';
$sub = (isset($_GET['sub']) && $_GET['sub'] != '') ? $_GET['sub'] : '';
$process = (isset($_GET['pro']) && $_GET['pro'] != '') ? $_GET['pro'] : '';
$id = (isset($_GET['id']) && $_GET['id'] != '') ? $_GET['id'] : '';
$table = new Table();
$product = new Product();
$order = new Order();
$users = new Users();
?>
<!DOCTYPE html>
<html>
<head>
   
    <title>ROS</title>
    <link rel="stylesheet" type="text/css" href="css/stylesheet.css">
    <script src="js/script.js" type="text/javascript"></script>
    
</head>
<body>
<div id="navigation">
    <ul>
      <li><a href="index.php"><?php echo file_get_contents("svg/home.svg");?></a></li>
      
      <li><a href="">Log Out</a></li>
    </ul>
    
</div>
<div class="main">
  <?php
    switch($module){
        case 'order':
            require_once 'order/index.php';
        break;
        default:
            require_once 'main.php';
        break;
    }
  ?>
</div>
</body>
</html>