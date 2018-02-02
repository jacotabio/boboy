<?php
include '../../library/config.php';
include '../../classes/class.brands.php';

$brand = new Brands();

if(isset($_POST['ban'])){
	if($brand->ban_account($_POST['brand_id'])){
		echo "ban_success";
	}else{
		echo "ban_failed";
	}
}

if(isset($_POST['unban'])){
	if($brand->unban_account($_POST['brand_id'])){
		echo "unban_success";
	}else{
		echo "unban_failed";
	}
}