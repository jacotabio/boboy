<?php
	require 'library/config.php';
	unset($_SESSION['usr_login']);
	session_destroy();
	header('location: index.php');
	exit;