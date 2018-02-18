<?php
	require 'library/config.php';
	include 'classes/class.brands.php';
	$brand = new Brands();
	$brand->offline_status($_SESSION['brand_id']);
	unset($_SESSION['usr_login']);
	unset($_SESSION['usr_id']);
	unset($_SESSION['usr_name']);
	unset($_SESSION['usr_auth']);
	unset($_SESSION['brand_id']);
	header('location: /');