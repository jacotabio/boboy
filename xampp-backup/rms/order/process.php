<?php
include '../library/config.php';
include '../classes/class.settings.php';
include '../classes/class.users.php';
include '../classes/class.food.php';
include '../classes/class.order.php';

$action = isset($_GET['action']) ? $_GET['action'] : '';

switch($action){
	case 'newtable': new_table();
		break;
	case 'neworderstatus': new_orderstatus();
		break;
}

function new_table(){
	$tablecode = strtoupper($_POST['tablecode']);
	$order = new Order();
	$order->new_table($tablecode);
	header("location: ../index.php?mod=order&sub=tablemanagement&pro=newtable");
	exit;
}

function new_orderstatus(){
	$orderstatus = strtoupper($_POST['statusname']);
	$order = new Order();
	$order->new_orderstatus($orderstatus);
	header("location: ../index.php?mod=order&sub=tablemanagement&pro=neworderstatus");
	exit;
}