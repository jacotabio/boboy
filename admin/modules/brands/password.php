<?php
include '../../library/config.php';
include '../../classes/class.brands.php';

$brand = new Brands();

$arr = array();

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

$password = test_input($_POST['password']);

if(!preg_match("/^[a-zA-Z0-9]{6,}$/",$password) || $password == "" || $password == null){
  $arr['code'] = "validation_failed";
}else{
	// proceed update password
	if($brand->update_password($_POST['brand_id'],md5($password))){
		$arr['code'] = "update_success";
	}else{
  		$arr['code'] = "update_failed";
  	}
}
echo json_encode($arr);