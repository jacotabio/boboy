<?php
include '../../library/config.php';
include '../../classes/class.users.php';
include '../../classes/class.brands.php';

$user = new Users();
$brand = new Brands();

if(isset($_SESSION['usr_auth'])){
	if($_SESSION['usr_auth'] == 1){
		$_c = $user->check_account($_SESSION['usr_id']);
		if($_c == "deleted"){
			unset($_SESSION['usr_login']);
			unset($_SESSION['usr_id']);
			unset($_SESSION['usr_name']);
			unset($_SESSION['usr_auth']);
			unset($_SESSION['brand_id']);
			echo $_c;
		}else if($_c == "disabled"){
			unset($_SESSION['usr_login']);
			unset($_SESSION['usr_id']);
			unset($_SESSION['usr_name']);
			unset($_SESSION['usr_auth']);
			unset($_SESSION['brand_id']);
			echo $_c;
		}
	}
	if($_SESSION['usr_auth'] == 2){
		$_c = $brand->check_account($_SESSION['brand_id']);
		if($_c == "deleted"){
			unset($_SESSION['usr_login']);
			unset($_SESSION['usr_id']);
			unset($_SESSION['usr_name']);
			unset($_SESSION['usr_auth']);
			unset($_SESSION['brand_id']);
			echo $_c;
		}else if($_c == "disabled"){
			unset($_SESSION['usr_login']);
			unset($_SESSION['usr_id']);
			unset($_SESSION['usr_name']);
			unset($_SESSION['usr_auth']);
			unset($_SESSION['brand_id']);
			echo $_c;
		}
	}
}
