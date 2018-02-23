<?php
include '../../library/config.php';
include '../../classes/class.brands.php';

$brand = new Brands();

//print_r($_POST);

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

$arr = array();

$brandname = test_input($_POST['brandname']);
$email = test_input($_POST['email']);
$phone = test_input($_POST['phone']);
$address = test_input($_POST['address']);


if (!preg_match("/^[a-z0-9A-Z '-.]*$/",$brandname) || $brandname == "" || $brandname == null) {
	$arr['brandname-input'] = 0;
}else{
	$arr['brandname-input'] = 1;
}
if(!preg_match('/^[a-z0-9._-]+@[a-z0-9.-]+\.[a-z]{2,3}$/', $email) || $email == "" || $email == null) {
	$arr['email-input'] = 0;
}else{
	$arr['email-input'] = 1;
}
if(!preg_match("/^[0-9-()]*$/", $phone) || $phone == "" || $phone == null){
	$arr['phone-input'] = 0;
}else{
	$arr['phone-input'] = 1;
}
if(!preg_match("/^[a-zA-Z 0-9-._,()#]*$/",$address) || $address == "" || $address == null){
	$arr['address-input'] = 0;
}else{
	$arr['address-input'] = 1;
}
if(!preg_match("/^[a-zA-Z0-9]{6,}$/",$_POST['password']) || $_POST['password'] == "" || $_POST['password'] == null){
 	$arr['password-input'] = 0;
}else{
	$arr['password-input'] = 1;
}

$i = 0;

foreach($arr as $_a){
	if($_a == 0){
	  $i++;
	}
}

if($i != 0){
	// validation failed
	$arr['code'] = "validation_failed";
	echo json_encode($arr);
}else{
	// validation passed
	if($usr_id = $brand->register_brand($brandname,$email,md5($_POST['password']),$address,$phone)){
		$arr['code'] = "register_success";
	}else{
		$arr['code'] = "brand_exists";
	  //exit;
	}
	echo json_encode($arr);
}