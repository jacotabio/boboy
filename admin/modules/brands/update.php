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
$fullname = test_input($_POST['fullname']);
$email = test_input($_POST['email']);
$phone = test_input($_POST['phone']);
$address = test_input($_POST['address']);

if (!preg_match("/^[a-zA-Z '-.]*$/",$fullname) || $fullname == "" || $fullname == null) {
	$arr['name-input'] = 0;
}else{
	$arr['name-input'] = 1;
}
if(!preg_match('/^[a-z0-9._-]+@[a-z0-9.-]+\.[a-z]{2,3}$/', $email) || $email == "" || $email == null) {
	$arr['email-input'] = 0;
}else{
	$arr['email-input'] = 1;
}
if(!preg_match("/^[0-9]{11,11}$/", $phone) || $phone == "" || $phone == null){
	$arr['phone-input'] = 0;
}else{
	$arr['phone-input'] = 1;
}
if(!preg_match("/^[a-zA-Z 0-9-._,()#]*$/",$address) || $address == "" || $address == null){
	$arr['address-input'] = 0;
}else{
	$arr['address-input'] = 1;
}

$i = 0;
foreach($arr as $_a){
	if($_a == 0){
	  $i++;
	}
}
if($i != 0){
	// validation failed
	$arr['code'] = "input_failed";
	echo json_encode($arr);
}else{
	// proceed update data
	if($brand->update_brand($_POST['brand_id'],$fullname,$email,$phone,$address)){
		$arr['code'] = "update_success";
	}else{
		$arr['code'] = "update_failed";
	}
	echo json_encode($arr);
}