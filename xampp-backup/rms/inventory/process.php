<?php
include '../library/config.php';
include '../classes/class.settings.php';
include '../classes/class.users.php';
include '../classes/class.food.php';
include '../classes/class.order.php';
include '../classes/class.sales.php';
include '../classes/class.inventory.php';

$action = isset($_GET['action']) ? $_GET['action'] : '';

switch($action){
	case 'ing': new_ingredient();
		break;
	case 'unt': new_unit();
		break;
}

function new_ingredient(){
	$ing_name = strtoupper($_POST['ing_name']);
	$ing_qty = $_POST['ing_qty'];
	$ing_unit = $_POST['ing_unit'];
	$inventory = new Inventory();
	$inventory->new_ingredient($ing_name,$ing_qty,$ing_unit);
	header("location: ../index.php?mod=inventory&sub=ingredients&pro=new");
	exit;
}

function new_unit(){
	$unt_name = strtoupper($_POST['unt_name']);
	$unt_symbol = $_POST['unt_symbol'];
	$inventory = new Inventory();
	$inventory->new_unit($unt_name,$unt_symbol);
	header("location: ../index.php?mod=inventory&sub=ingredients&pro=unit");
	exit;
}
