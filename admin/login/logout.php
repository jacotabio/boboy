<?php
	require '../library/config.php';
	unset($_SESSION['admin_login']);
	unset($_SESSION['admin_id']);
	unset($_SESSION['admin_name']);
	//session_destroy();
	header('location: /admin/login/login.php');
	exit;