<?php
include 'library/config.php';
include 'classes/class.users.php';
include 'classes/class.products.php';

$user = new Users();
$product = new Products();

if(isset($_REQUEST['login'])){
extract($_REQUEST);
$login = $user->check_login($username,md5($password));
if($login){
header('location: index.php');
}
else{
header('location: index.php?mod=login&auth=error');
} 
}

$module = (isset($_GET['mod']) && $_GET['mod'] != '') ? $_GET['mod'] : '';
$action = (isset($_GET['action']) && $_GET['action'] != '') ? $_GET['action'] : '';

?>
<!DOCTYPE html>
<html>
<head>
<title>Sungem Pharma</title>
<link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
<link rel="icon" href="img/favicon.ico" type="image/x-icon">
<link rel="stylesheet" type="text/css" href="css/stylesheet.css">
<link rel="stylesheet" type="text/css" href="css/responsive.css" media="screen and (max-width: 1260px)">
<link href="css/jquery.dataTables.css" rel="stylesheet">
<link href="css/bootstrap.min.css" rel="stylesheet">
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="js/jquery.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>
<script src="js/dataTables.bootstrap.min.js"></script>
<script src="js/jquery.dataTables.min.js"></script>
<script src="js/javascript.js"></script>

<!-- Embed Roboto Font -->
<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,600,700,900" rel="stylesheet">

</head>
<body>
<div id="main-container">
<!--Navigation-->
<div id="Splash-pic">
<div id="hidden"><ul>

<li><a class="logo" href="index.php"><img src="img/sungem-logo.png" height="21px"/>&nbsp;Sungem <strong>Pharma</strong></a></li>
<!--<li><a class="burger" href="#">&#9776;</a></li>-->
<li><button id="burgers">&#9776;</button></li>
<li><button id="cross">&#735;</button></li>
</ul></div>
<div id="navi">
<ul>
<li><a class="logo" href="index.php"><img src="img/sungem-logo.png" height="21px"/> Sungem <strong>Pharma</strong></a></li>
<?php
if($user->get_session()){?>
<li id="cart-item-counter"><a class="cart-icon" href="index.php?mod=viewcart"><?php echo file_get_contents("img/shopping-cart.svg");?> <?php echo $product->count_cart($_SESSION['c_userid']);?> items</a></li>
<?php
}
?>
<li><a href="index.php?mod=about">About</a></li>
<li><a href="index.php?mod=ordering">How to Order</a></li>
<li><a href="index.php?mod=products&cat=all">Products</a></li>
<li><a href="index.php">Home</a></li>
</ul>
<h5>Welcome, <?php if($user->get_session()){?><a href="index.php?mod=profile"><?php echo $_SESSION['c_userfullname'];?></a> | <a href="logout.php">Log Out</a><?php }else{?>Guest | <a href="index.php?mod=login">Login</a><?php }?></a></h5>

</div>

<!--body-->
<div class="background-material">
<div id="main">
  <div id="hidden-menu">
    <ul>
      <li><a href="index.php">Home</a></li>
      <li><a href="index.php?mod=products&cat=all">Products</a></li>
      <li><a href="index.php?mod=ordering">How to Order</a></li>
      <li><a href="index.php?mod=about">About</a></li>
      <?php
      if($user->get_session()){
      ?>
       <li id="hiddencartcounter"><a  class="cart-icon" href="index.php?mod=viewcart"><?php echo file_get_contents("img/shopping-cart.svg");?> <?php echo $product->count_cart_hidden($_SESSION['c_userid']);?> items</a></li>
      <?php
      }else{?>
     
      <?php
      }
      ?>
    </ul>
  </div>
  <?php
  switch($module){
  case 'profile':
    require_once 'profile/index.php';
    break;
  case 'viewcart':
    require_once 'cart/cart.php';
    break;
  case 'about':
    require_once 'about/index.php';
    break;
  case 'login':
    require_once 'login/login.php';
    break;
  case 'products':
    require_once 'products/index.php';
      break;
  case 'ordering':
    require_once 'order/index.php';
    break;
  case 'register':
    require_once 'register/register.php';
    break;
  default:
    require_once 'home/home.php';
    break;
  }
  ?>
</div>
<div class="footer">
<div class="footer-content">
<div id="footer-content-main-left">
            <?php
            if(!$user->get_session()){
            ?>
              <div id="footer-not-aclient-yet">Not a client of Sungem yet?</div>
              <a href="index.php?mod=register">Sign up now</a>
              <?php
              }else{
              ?>
              <div id="footer-not-aclient-yet">Hello,  <?php echo $_SESSION['c_userfullname'];?>.</div>
              <a href="index.php?mod=profile">View  Profile</a>
              <?php
              } 
              ?>
              <div id="name-title-footer" class="logo"><img src="img/sungem-logo.png" height="30px"/>&nbsp; 2017 Sungem Pharma</div>
         </div>
  <div id="footer-content-main-mid">
    <div id="footer-address-title">Address</div>
           <div id="footer-address">Four M Bldg; Seaoil, Brgy. Sum-ag, Bacolod City</div>
           <div id="footer-contact">Contact us</div>
           <div id="contact-content-footer">
              SungemPharma@gmail.com</br>
             (+63) 948 - 483 - 0931</br>
             (034) 704 - 3633</br>
           </div>

  </div>
  <div id="footer-content-main-right">
    <!--
    <div id="footer-menu">
               <div class="divider-menu">
               <a href="index.php">HOME</a></br>
               <a href="index.php?mod=products&cat=all">PRODUCTS</a></br>
               <?php 
                if(!$user->get_session()){
               ?>
               <a href="index.php?mod=login">LOGIN</a>
               <?php
             }else{}
               ?>
               </div>
               
               <div class="divider-menu">
               <a href="index.php?mod=ordering">HOW TO ORDER</a></br>
                <a href="index.php?mod=about">ABOUT US</a></br>
               </div>
            </div>-->
        <div id="footer-address-title">Inquiry</div>
        <form name="inquiry" id="inquiry" method="post" action="mailto:aldearickyofficial@gmail.com" enctype="text/plain">
          <input type="text" placeholder="Full Name" class="w-100 inquiry-input" autocomplete="off" id="FullName" name="FullName" required/>
          <!--<input type="text" placeholder="Last Name" class="w-100 inquiry-input" autocomplete="off" id="LastName" name="LastName" required/>
        </form>-->
        <input type="text" placeholder="Email Address" class="w-100 inquiry-input" autocomplete="off" id="Email" name="Email" required/>
        </form>
        <textarea name="comment" form="inquiry" placeholder="Type your concerns here." class="w-100 inquiry-input-textarea" required></textarea>

        <input type="submit" class="inquiry-button" id="val" name="submit" value="SEND"/>
        </form>

  </div>
</div>
</div>
</div>
</div>
</div>
</body>
</html>
<script type="text/javascript">
function btngreen(){
document.getElementById("navigation").style.backgroundColor = "rgba(25,137,38,1)";  
}
function login_error(){
document.getElementById('login-error').style.
}
</script>