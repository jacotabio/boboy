<?php
$module = (isset($_GET['mod']) && $_GET['mod'] != '') ? $_GET['mod'] : '';
?>
<!DOCTYPE html>
<html>
<head>
	<title>Sungem Pharma</title>
	<link rel="stylesheet" type="text/css" href="css/stylesheet.css">
	<link rel="stylesheet" type="text/css" href="css/responsive.css" media="screen and (max-width: 1260px)">
</head>
<body>
	<script type="text/javascript">
		function btngreen(){
			document.getElementById("navigation").style.backgroundColor = "rgba(25,137,38,1)";	
		}
</script>
	<div id="main-container">
		<!--Naigation-->
		<div id="Splash-pic">
			<div id="navigation">
				<div id="logo"><a href="index.php">Sungem <strong>Pharma</strong></a></div>
				<ul>
					<li><a href="index.php">HOME</a></li>
					<li><a>PRODUCTS</a></li>
					<li><a onclick="btngreen()" href="index.php?mod=ordering" >ORDERING</a></li>
					<li><a onclick="btngreen()" href="index.php?mod=about">ABOUT US</a></li>
					<li><a onclick="btngreen()" href="index.php?mod=contact">CONTACT US</a></li>
					<li><a onclick="btngreen()" href="index.php?mod=login">LOGIN</a></li>
				</ul>
			</div>
		<!--body-->
		<div id="main">
		<?php
		switch($module){
			case 'about':
				require_once 'about/index.php';
				break;
			case 'login':
				require_once 'login/login.php';
				break;
			case 'ordering':
				require_once 'order/index.php';
				break;
			case 'contact':
				require_once 'contact/index.php';
				break;
			case 'register':
				require_once 'register/register.php';
				break;
			default:
				require_once 'home/home.php';
		}
		?>
		</div>
		</div>
	</div>

</body>
</html>