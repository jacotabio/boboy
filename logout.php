<?php
	require 'library/config.php';
	unset($_SESSION['usr_login']);
	unset($_SESSION['usr_id']);
	unset($_SESSION['usr_name']);
	unset($_SESSION['usr_auth']);
	unset($_SESSION['brand_id']);
	header('location: /');
	exit;