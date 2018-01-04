<?php
include '../library/config.php';
include '../classes/class.settings.php';
include '../classes/class.users.php';
include '../classes/class.products.php';

$action = isset($_GET['action']) ? $_GET['action'] : '';

switch ($action) {
	case 'addproduct':
		process_new_product();
		break;
	case 'updateproduct': 
		process_update_product();
		break;
	case 'deleteproduct':
		process_delete_product();
	case 'edituser':
		process_edit_user();
		break;
	case 'searchproduct':
		process_search_product();
		break;
}

function process_new_product(){
	$product_name = $_POST['form_pname'];
	$product_desc = $_POST['form_pdesc'];
	$quantity = $_POST['form_pquantity'];
	$price = $_POST['form_pprice'];

	$product = new Products();
	$product->new_product($product_name,$product_desc,$quantity,$price);
	header("location: ../index.php?mod=dashboard&sub=products");
	exit;
}
funtction process_delete_product(){
	
}
function process_search_product(){
	if(isset($_GET['searchval']) && $_GET['searchval']='all')
	{
		$searchvalue = '';	
	}
	else{
		$searchvalue = $_POST['searchvalue'];
	}
	$product = new Products();
	$product->search_product($searchvalue);
	header("location: ../index.php?mod=dashboard&sub=products&search=$searchvalue");
	exit;
}
function process_update_product(){
	$prodName = $_POST['prodName'];
	$prodDesc = $_POST['prodDesc'];
	$prodQty = $_POST['prodQty'];
	$prodPrice = $_POST['prodPrice'];
	$prodID = $_GET['prodID'];
	$product = new Products();
	$product->update_product($prodID,$prodName,$prodDesc,$prodQty,$prodPrice);
	header("location: ../index.php?mod=dashboard&sub=products");	
}

function process_edit_user(){
	$edit_fname = ucwords($_POST['form_edit_fname']);
	$edit_lname = ucwords($_POST['form_edit_lname']);
	$edit_currentpassword = $_POST['form_edit_currentpassword'];
	$edit_newpassword = $_POST['form_edit_newpassword'];
	$edit_confirm = $_POST['form_edit_confirm'];

	if($edit_newpassword == $edit_confirm){
		$user = new Users();
		$user->edit_user($edit_fname,$edit_lname,$edit_newpassword);
		unset($_SESSION['login']);
		session_destroy();
		$user->check_login();
		$message = "Saved changes successfully!";
		header("location: ../index.php?mod=dashboard&sub=settings&message=" . urlencode($message));
		exit;
	}else{
		$message = "Passwords do not match. Please try again.";
		header("location: ../index.php?mod=dashboard&sub=settings&message=" . urlencode($message));
		exit;
	}
}