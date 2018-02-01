<?php
include '../../library/config.php';
include '../../classes/class.brands.php';

$brand = new Brands();

if(isset($_POST['delete_brand'])){
	if($brand->delete_brand($_POST['brand_id'])){
		echo "delete_success";
	}else{
		echo "delete_failed";
	}
}