<?php
include '../../library/config.php';
include '../../classes/class.users.php';
include '../../classes/class.brands.php';

$brand = new Brands();
$user = new Users();

//print_r($_POST);

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

function array_map_r( $func, $arr )
{
    $newArr = array();

    foreach( $arr as $key => $value )
    {
        $newArr[ $key ] = ( is_array( $value ) ? array_map_r( $func, $value ) : ( is_array($func) ? call_user_func_array($func, $value) : $func( $value ) ) );
    }

    return $newArr;
}
//$sanitized_data =array_map_r('strip_tags', $_POST);

// CREATE ARRAY FOR VALIDATION PURPOSES


$arr = array();

$name = test_input($_POST['name']);
$email = test_input($_POST['email']);
$password = test_input($_POST['password']);
$copassword = test_input($_POST['co-password']);
$address = test_input($_POST['address']);
$phone = test_input($_POST['contact']);

if($password != $copassword){
  $arr['pwd-match'] = 0;
}else{
  $arr['pwd-match'] = 1;
}
if (!preg_match("/^[a-zA-Z '-.]*$/",$name) || $name == "" || $name == null) {
  $arr['name-reg'] = 0;
}else{
  $arr['name-reg'] = 1;
}
if(!preg_match('/^[a-z0-9._-]+@[a-z0-9.-]+\.[a-z]{2,3}$/', $email) || $email == "" || $email == null) {
  $arr['email-reg'] = 0;
}else{
  $arr['email-reg'] = 1;
}
if(!preg_match("/^[a-zA-Z0-9]{6,}$/",$password) || $password == "" || $password == null){
  $arr['pwd-reg'] = 0;
}else{
  $arr['pwd-reg'] = 1;
}
if(!preg_match("/^[a-zA-Z 0-9.,()#]*$/",$address) || $address == "" || $address == null){
  $arr['address-reg'] = 0;
}else{
  $arr['address-reg'] = 1;
}
if(!preg_match("/^[0-9]{11,11}$/", $phone) || $phone == "" || $phone == null){
  $arr['phone-reg'] = 0;
}else{
  $arr['phone-reg'] = 1;
}

$i = 0;
foreach($arr as $_a){
  if($_a == 0){
    $i++;
  }
}
if($i != 0){
  $arr['code'] = "failed";
  echo json_encode($arr);
}else{
  $arr['code'] = "validated";
  $chk_email = $user->chk_email_exists($_POST['email']);
  if($chk_email == 1){
    $arr['email-reg'] = 0;
    $arr['email-exists'] = 0;
  }else{
    if($usr_id = $user->register_credentials($name,$email,md5($password),$address,$phone)){
      $arr['code'] = "user_registered";
    }else{
      $arr['code'] = "register_failed";
    }
  }
  echo json_encode($arr);
}

/* FOR BRAND REGISTRATION CODE
if($usr_id = $user->register_credentials($name,$email,md5($password),$address,$phone)){
  if($sanitized_data['auth-type'] == 2){
    $brand_id = $brand->add_brand($sanitized_data['name']);
    if($user->place_brand_id($brand_id,$usr_id)){
      echo "brand_registered";
    }
  }else{
    echo "user_registered";
  }
  exit;
}else{
  echo "register_failed";
  exit;
}
*/

?>