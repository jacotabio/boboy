<?php
include 'library/config.php';
include 'classes/class.users.php';
include 'classes/class.items.php';
include 'classes/class.auth.php';
include 'classes/class.brands.php';
include 'classes/class.orders.php';

$module = (isset($_GET['mod']) && $_GET['mod'] != '') ? $_GET['mod'] : '';
$t = (isset($_GET['t']) && $_GET['t'] != '') ? $_GET['t'] : '';
$action = (isset($_GET['action']) && $_GET['action'] != '') ? $_GET['action'] : '';

$user = new Users();
$item = new Items();
$auth = new Auth();
$brand = new Brands();
$order = new Orders();
// Global variables
$brandname = "Boboy";
$currency = "₱";
?>
<!DOCTYPE html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="John Carlo H. Octabio">
    <link rel="icon" href="favicon.ico">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="custom.css" rel="stylesheet" type="text/css">
    <link href="css/step-wizard.css" rel="stylesheet" type="text/css">
    <link href="css/bootstrap-theme.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,600,700" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
    <title><?php echo $brandname;?> - <?php if(isset($_SESSION['usr_auth']) && $_SESSION['usr_auth'] == 1 || !isset($_SESSION['usr_auth'])){?>Coffee Delivery Service<?php }else{ echo $_SESSION['usr_name'];}?></title>
    <!-- Bootstrap core CSS -->
    
    <link href="css/dataTables.material.min.css" rel="stylesheet">
    <link href="css/material.min.css" rel="stylesheet">
    <link href="css/bootstrap-switch.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/spinner.css" rel="stylesheet" type="text/css">
    <link href="css/chat.css" rel="stylesheet" type="text/css">
  </head>
  <body>
    <nav id="nav-id" class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <div style="margin-left: 24px;">
            <?php
            if(isset($_SESSION['usr_auth']) && $_SESSION['usr_auth'] == 1 || !isset($_SESSION['usr_auth'])){
            ?>
            <a class="navbar-brand" href="/" style="margin-top:0;padding-top:12px;"><img src="img/logo.png" height="25px"></a>
            <?php
            }else{?>
            <a class="navbar-brand" href="/?mod=cpanel" style="margin-top:0;padding-top:12px;"><img src="img/logo.png" height="25px"></a>
            <?php
            }
            ?>
          </div>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav navbar-right">
            <?php
            if(isset($_SESSION['usr_auth']) && $_SESSION['usr_auth'] == 1 || !isset($_SESSION['usr_auth'])){
            ?>
            <li class=<?php if($module==null){ echo "active";}else{ echo '';}?>><a href="/" class="uppercase">Home</a></li>
            <?php 
            }
            if(isset($_SESSION['usr_auth']) && $_SESSION['usr_auth'] == 1 || !isset($_SESSION['usr_auth'])){
            ?>
            <li class=<?php if($module=="shop"){ echo "active";}else{ echo '';}?>><a href="/?mod=shop" class="uppercase">Shop</a></li>
            <?php
            }
            if($user->get_session()){?>
              <?php 
              if($_SESSION['usr_auth'] == 1){
              ?>
              <li class="<?php if($module==cart){ echo "active";}else{ echo '';}?>">
                <a class="uppercase" href="/?mod=cart"><span class="glyphicon glyphicon-shopping-cart"></span>&nbsp;<span class="badge" style="background-color:red;border:none;box-shadow:none;"><?php echo $item->count_cart($_SESSION['usr_id'])?></span></a>
              </li>
              <?php
              }
              ?>
              <li class="dropdown">
                <a class="dropdown-toggle" style="font-size:14px;font-weight:400;" data-toggle="dropdown" href=""><?php 
                if($_SESSION['usr_auth']==2){
                  if($brand->get_brand_status($_SESSION['brand_id'])==1){?>
                    <span id="status-indicator" class="green">&#9679;</span>
                  <?php
                  }else{?>
                    <span id="status-indicator" class="orange">&#9679;</span>
                  <?php 
                  }
                  if($_SESSION['usr_auth'] == 2){
                    echo $_SESSION['usr_name'];
                  }
                }else{?>
                  <span class="glyphicon glyphicon-user"></span>
                <?php
                }?>
                <span class="caret"></span></a>
                <ul class="dropdown-menu" style="background-color: #f7f7f7;">
                  <?php
                  if($_SESSION['usr_auth'] == 1){
                  ?>
                  <li class="dropdown-header" style="color: rgba(0,0,0,0.8); font-weight: 500; font-size: 14px;"><?php echo $_SESSION['usr_name'];?></li>
                  <li class="divider"></li>
                  <?php
                  }
                  ?>
                  <li class="dropdown-header">Account</li>
                  <?php
                  if($_SESSION['usr_auth'] == 1){
                  ?>
                  <li style=""><a href="/?mod=profile">My Profile</a></li>
                  <?php
                  }else{?>
                    <li style=""><a href="/?mod=cpanel">Control Panel</a></li>
                  <?php
                  }
                  ?>
                  <li><a id="btn-logout"  href="/logout.php">Logout</a></li>
                </ul>
              </li>
            <?php
            }else{?>
              <li><a class="uppercase" href="" data-toggle="modal" data-target="#modal-login">Login</a></li>
            <?php
            }
            ?>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
      <?php
      $url_str = substr($_SERVER['REQUEST_URI'], 5);
      if(isset($_GET['mod'])){
      ?>
      <div class="nav-helper">
        <div class="container">
          <a class="shop-directory" href="/?mod=<?php echo $_GET['mod'];?>"><?php echo ucfirst($_GET['mod']);?></a>/<?php if($_GET['mod'] == "shop"){if(isset($_GET['brand'])){?>
                <a class="shop-directory" href="/?mod=shop&brand=<?php echo $_GET['brand'];?>">
                <?php
                echo $item->get_item_brand($_GET['brand']);
                ?>
                </a>
                <?php
                if(isset($_GET['item'])&&isset($_GET['brand'])){?>/<a class="shop-directory" href="<?php echo $url_str;?>">
                      <?php
                        $dir_name = $item->get_item_and_brand($_GET['item'],$_GET['brand']);
                        if($dir_name){
                          foreach($dir_name as $o);
                          echo $o['item_name'];
                        }
                      ?>
                  </a><?php
                }
                ?>
              <?php
              }else{?><a class="shop-directory" href="/?mod=shop"> <?php echo "All";?></a><?php
                if(isset($_GET['item'])){
                  $s = $item->check_item_status($_GET['item']);
                  if($s == 1){?>/<a class="shop-directory" href="<?php echo $url_str;?>">
                      <?php
                        echo $item->get_item_name($_GET['item']);
                      ?>
                  </a>
                <?php
                  }
                }
              }
            }else if($_GET['mod']=="cpanel"){
              if(isset($_GET['t'])){?>
                <a class="shop-directory" href="/?mod=cpanel&t=<?php echo $_GET['t'];?>"><?php echo ucfirst($_GET['t']);?></a><?php if(isset($_GET['q'])){?>/<a class="shop-directory" href='<?php echo $url_str;?>'><?php echo $item->get_item_name($_GET['q']);?></a>
            <?php 
                }
              }
            }
            ?></div></div><?php
      }
      ?>
    </nav>
    <div class=""><?php
      if($module == null){?>
        <div class="header-wrapper">
        <?php
        require_once 'modules/home/header.php';
        ?>
        </div>
      <?php
      }
      ?>
      <div class="main"><?php
        switch($module){
          case 'login':
            require_once 'modules/login/index.php';
            break;
          case 'shop':
            require_once 'modules/shop/index.php';
            break;
          case 'profile':
            if($_SESSION['usr_auth'] == 1){
              require_once 'modules/profile/index.php';
            }else{
              header('location: /');
            }
            break;
          case 'register':
            require_once 'modules/register/index.php';
            break;
          case 'cpanel':
            if($_SESSION['usr_auth'] == 2){
              require_once 'modules/cpanel/index.php';
              break;
            }else{
              header('location: /');
              break;
            }
            break;
          case 'cart':
            if($_SESSION['usr_auth'] == 1){
              require_once 'modules/cart/index.php';
              break;
            }else{
              header('location: /');
              break;
            }
            break;
          default:
            require_once 'modules/home/index.php';
            break;
        }
      ?>
      </div><!-- /.container -->
    </div>

    <!-- Footer Content Goes Here -->
    <footer id="myFooter">
        <div class="container">

        </div>
        <div class="second-bar">
           <div class="container">
                <span style="width: 10px;">Copyright 2017</span>
                <div class="" style="margin:0;padding:0;">
                    <a href="#" target="_blank" class="twitter"><i class="fa fa-twitter"></i></a>
                    <a href="https://www.facebook.com/iamsleepnot/" target="_blank" class="facebook"><i class="fa fa-facebook"></i></a>
                    <a href="https://www.instagram.com/iamsleepnot/" target="_blank" class="instagram"><i class="fa fa-instagram"></i></a>
                </div>
            </div>
        </div>
    </footer>

    <?php
    require_once 'modules/modals/login_modal.php';
    require_once 'modules/modals/remove_cart.php';
    require_once 'modules/modals/item_modal.php';
    require_once 'modules/modals/ui_modals.php';
    ?>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/jquery.js"></script>
    <script src="js/datatables.min.js"></script>
    <script src="js/dataTables.material.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/custom.js"></script>
  </body>
</html>