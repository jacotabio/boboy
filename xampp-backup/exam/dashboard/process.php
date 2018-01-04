<?php
include '../library/config.php';
include '../classes/class.settings.php';
include '../classes/class.users.php';
include '../classes/class.products.php';
include '../classes/class.reports.php';
include '../classes/class.transactions.php';

$action = isset($_GET['action']) ? $_GET['action'] : '';

switch ($action) {
	case 'searchproduct':
		process_search_product();
		break;
	case 'addproduct':
		process_new_product();
		break;
	case 'updateproduct': 
		process_update_product();
		break;
	case 'deleteproduct':
		process_delete_product();
		break;
	case 'newuser':
		process_new_user();
		break;
	case 'edituser':
		process_edit_user();
		break;
	case 'addToCart':
		process_add_cart();
		break;
	case 'receiveItems':
		process_receive_items();
		break;
	case 'purchaseorder':
		process_add_order();
		break;
	case 'report':
		process_generate_report();
		break;
}

function process_new_product(){
	$product_name = $_POST['form_pname'];
	$product_desc = $_POST['form_pdesc'];
	$quantity = $_POST['form_pquantity'];
	$price = $_POST['form_pprice'];

	$product = new Products();
	$transaction = new Transactions();
	$product->new_product($product_name,$product_desc,$quantity,$price);
	$ID = $product->prod_last();
	foreach($ID as $prodID){
		$prodID = $prodID['p_id'];
	}
	$transaction->insert_receive($prodID,$product_name,$product_desc,$quantity,$price);
	header("location: ../index.php?mod=dashboard&sub=products");
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

function process_delete_product(){
	$prodID = $_GET['prodID'];
	$product = new Products();
	$product->delete_product($prodID);
	header("location: ../index.php?mod=dashboard&sub=products");
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
	if(isset($_GET['mode']) && $_GET['mode']!='')
	{
		switch($_GET['mode']){
			case 'product':
				header("location: ../index.php?mod=dashboard&sub=products&search=$searchvalue");
				break;
			case 'purchase':
				header("location: ../index.php?mod=dashboard&sub=purchase&search=$searchvalue");
				break;
			case 'receive':
				header("location: ../index.php?mod=dashboard&sub=receive&search=$searchvalue");
				break;
		}
	}
	exit;
}


function process_new_user(){
	$lastname = ucwords($_POST['register_lastname']);
	$firstname = ucwords($_POST['register_firstname']);
	$access = $_POST['register_access'];
	$userid = $_POST['register_userid'];
	$password = $_POST['register_password'];
	$confirm = $_POST['register_copassword'];

	if($password == $confirm){
		$users = new Users();
		$result = $users->new_user($userid,$access,$password,$lastname,$firstname);
		if($result==0){
			$message = "User ID already exists";
			header("location: ../register.php?&message=" . urlencode($message));
			exit;
		}else{
			$message = "Sign Up Successful!";
			header("location: ../login.php?&message=" . urlencode($message));
			exit;
		}
	}else{
		$message = "Passwords do not match. Please try again.";
		header("location: ../register.php?&message=" . urlencode($message));
		exit;
	}
}

function process_edit_user(){
	$edit_fname = ucwords($_POST['form_edit_fname']);
	$edit_lname = ucwords($_POST['form_edit_lname']);
	$edit_rawpassword = $_POST['form_edit_currentpassword'];
	$edit_currentpassword = md5($edit_rawpassword);
	$edit_newpassword = $_POST['form_edit_newpassword'];
	$edit_confirm = $_POST['form_edit_confirm'];

	if($edit_currentpassword == $_SESSION['current_password']){
		if($edit_newpassword == $edit_confirm){
			$user = new Users();
			$user->edit_user($edit_fname,$edit_lname,$edit_newpassword);
			unset($_SESSION['login']);
			session_destroy();
			$message = "Saved changes successfully!";
		}else{
			$message = "Passwords do not match. Please try again.";
		}
	}else{
		$message = "Incorrect password. Please try again.";
	}
	header("location: ../index.php?mod=dashboard&sub=settings&message=" . urlencode($message));
	exit;
}

//RECEIVE ITEMS
function process_receive_items(){
	$quantity = $_GET['quantity'];
	$prodID = $_GET['prodID'];
	$pName= $_POST['pName'];
	$pDesc= $_POST['pDesc'];
	$pPrice= $_POST['pPrice'];	
	$product = new Products();
	$transaction = new Transactions();
	$product->add_quantity($prodID,$quantity);
	$transaction->insert_receive($prodID,$pName,$pDesc,$quantity,$pPrice);
	header("location: ../index.php?mod=dashboard&sub=receive");	
}

//ADD TO ORDER LIST (CART)
function process_add_order(){
	if(!function_exists('array_column')){
	function array_column(array $input, $columnKey, $indexKey=null){
		$array = array();
		foreach($input as $value){
			if(!array_key_exists($columnKey, $value)){
				trigger_error("Key \"$columnKey\" does not exist in array");
				return false;
			}
			if(is_null($indexKey)){
				$array[] = $value[$columnKey];
			}
			else{
				if(!array_key_exists($indexKey, $value)){
					trigger_error("Key \"$indexKey\" does not exist in array");
					return false;
				}
				if(! is_scalar($value[$indexKey])){
					trigger_error("Key \"$indexKey\" does not contain scalar value");
					return false;
				}
				$array[$value[$indexKey]]=$value[$columnKey];
			}
		}
		return $array;
	}
}
if(isset($_POST["add"])){
	if(isset($_SESSION["cart"]))
	{
		$item_array_id = array_column($_SESSION["cart"], "product_id");
		if(!in_array($_GET["id"], $item_array_id)){
			$count = count($_SESSION["cart"]);
			$item_array = array(
			'product_id'=>$_GET["id"],
			'item_name'=>$_POST["hidden_name"],
			'product_price'=>$_POST["hidden_price"],
			'item_quantity'=>$_POST["quantity"]
			);
			$_SESSION["cart"][$count] = $item_array;
		}
		else{
		?><script>alert("Products already added to cart");</script>
		  <script>window.location.assign("../index.php?mod=dashboard&sub=purchase");</script>
		<?php
		
		}
		
	}
	else{
		$item_array = array(
		'product_id'=>$_GET["id"],
		'item_name'=>$_POST["hidden_name"],
		'product_price'=>$_POST["hidden_price"],
		'item_quantity'=>$_POST["quantity"]
		);
		$_SESSION["cart"][0] = $item_array;
	}
	header("location: ../index.php?mod=dashboard&sub=purchase");
}
if(isset($_GET["subaction"])){
		switch($_GET["subaction"]){
			case 'delete':
			foreach($_SESSION["cart"] as $keys => $values){
				if($values["product_id"]==$_GET["id"]){
					unset($_SESSION["cart"][$keys]);
					?><script>alert("Removed successfully.");</script>
					<script>window.location.assign("../index.php?mod=dashboard&sub=purchase");</script>
					<?php
				}
			}
			break;
			
			case 'clear':
				unset($_SESSION['cart']);
				?><script>alert("List cleared!");</script>
				<script>window.location.assign("../index.php?mod=dashboard&sub=purchase");</script>
				<?php
				break;
				
			case 'purchase':
				$transaction = new Transactions();
				$po_id = $_GET['po_id'];
				if(!empty($_SESSION["cart"])){
				foreach($_SESSION['cart'] as $keys => $values){
					$transaction->purchase($values['product_id'], $values['item_quantity']);
					$transaction->insertPO($po_id, $values['product_id'], $values['item_name'], $values['item_quantity'], $values['product_price'],$values['item_quantity']*$values['product_price'] );
				}
				?><script>alert("Purchase Successful");</script>
				  <?php unset($_SESSION['cart']); ?>
				  <script>window.location.assign("../index.php?mod=dashboard&sub=purchase");</script>
				<?php 
				}
				else{
					?><script>alert("EMPTY ORDERS");</script>
					<script>window.location="../index.php?mod=dashboard&sub=purchase";</script>
				<?php 
				
				}
			break;
		}
	}
}

//GENERATE REPORTS
function process_generate_report(){
	$cat = isset($_GET['cat']) ? $_GET['cat'] : '';
	switch($cat){
		case 'product':
		$reports = new Reports();
		$reports->generate_report($cat, $dateTo,$dateFrom);
	}
}
?>