<?php
include '../library/config.php';
include '../classes/class.settings.php';
include '../classes/class.users.php';
include '../classes/class.food.php';

$action = isset($_GET['action']) ? $_GET['action'] : '';

switch($action){
	case 'newdish': new_dish();
		break;
	case 'newtype': new_type();
		break;
	case 'assign': assign_ing();
		break;
	case 'delete': delete_ing();
		break;
}

function delete_ing(){
	$id = isset($_GET['id']) ? $_GET['id'] : '';
	$rec_id = isset($_GET['recid']) ? $_GET['recid'] : '';
	$food = new Food();
	$food->delete_ing($rec_id);
	header("location: ../index.php?mod=food&sub=dishmanagement&pro=profile&id=$id");
	exit;
}

function assign_ing(){
	$pro_id = isset($_GET['id']) ? $_GET['id'] : '';
	$ing_id = $_POST['ing'];
	$ing_qty = $_POST['qty'];
	$food = new Food();
	$food->assign_ing($ing_id,$pro_id,$ing_qty);
	$id = $_GET['id'];
	header("location: ../index.php?mod=food&sub=dishmanagement&pro=profile&id=$id");
	exit;
}

function new_dish(){
	$pro_name = strtoupper($_POST['pname']);
	$pro_desc = strtoupper($_POST['pdesc']);
	$pro_type = $_POST['ptype'];
	$pro_price = $_POST['pprice'];
	$food = new Food();
	$food->new_food($pro_name,$pro_desc,$pro_type,$pro_price);
	header("location: ../index.php?mod=food&sub=dishmanagement&pro=foodlistings");
	exit;
}

function new_type(){
	$pro_type = ucwords($_POST['ptypename']);
	$food = new Food();
	$food->new_type($pro_type);
	header("location: ../index.php?mod=food&sub=foodmenusettings&pro=foodtypelistings");
	exit;
}