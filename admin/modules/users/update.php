<?php
include '../../library/config.php';
include '../../classes/class.users.php';

$user = new Users();

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
if(!preg_match('/^(?!(?:(?:\x22?\x5C[\x00-\x7E]\x22?)|(?:\x22?[^\x5C\x22]\x22?)){255,})(?!(?:(?:\x22?\x5C[\x00-\x7E]\x22?)|(?:\x22?[^\x5C\x22]\x22?)){65,}@)(?:(?:[\x21\x23-\x27\x2A\x2B\x2D\x2F-\x39\x3D\x3F\x5E-\x7E]+)|(?:\x22(?:[\x01-\x08\x0B\x0C\x0E-\x1F\x21\x23-\x5B\x5D-\x7F]|(?:\x5C[\x00-\x7F]))*\x22))(?:\.(?:(?:[\x21\x23-\x27\x2A\x2B\x2D\x2F-\x39\x3D\x3F\x5E-\x7E]+)|(?:\x22(?:[\x01-\x08\x0B\x0C\x0E-\x1F\x21\x23-\x5B\x5D-\x7F]|(?:\x5C[\x00-\x7F]))*\x22)))*@(?:(?:(?!.*[^.]{64,})(?:(?:(?:xn--)?[a-z0-9]+(?:-[a-z0-9]+)*\.){1,126}){1,}(?:(?:[a-z][a-z0-9]*)|(?:(?:xn--)[a-z0-9]+))(?:-[a-z0-9]+)*)|(?:\[(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){7})|(?:(?!(?:.*[a-f0-9][:\]]){7,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?)))|(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){5}:)|(?:(?!(?:.*[a-f0-9]:){5,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3}:)?)))?(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))(?:\.(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))){3}))\]))$/iD', $email) || $email == "" || $email == null) {
	$arr['email-input'] = 0;
}else{
	$arr['email-input'] = 1;
}
if(!preg_match("/^[0-9]{11,11}$/", $phone) || $phone == "" || $phone == null){
	$arr['phone-input'] = 0;
}else{
	$arr['phone-input'] = 1;
}
if(!preg_match("/^[a-zA-Z 0-9.,()#]*$/",$address) || $address == "" || $address == null){
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
	$arr['code'] = "input_passed";
	echo json_encode($arr);
}