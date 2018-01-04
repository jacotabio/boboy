<?php
include '../../library/config.php';
include '../../classes/class.users.php';
include '../../classes/class.brands.php';

$brand = new Brands();
$user = new Users();

$name = test_input($_POST["name"]);
if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
  echo "name_invalid"; 
  exit;
}

$email = test_input($_POST["email"]);
if (!preg_match("/^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$/",$email)) {
  echo "email_invalid"; 
  exit;
}

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
$sanitized_data =array_map_r('strip_tags', $_POST);


if($_POST['password_confirm']!=$_POST['password']){
  echo "non_match_password";
  exit;
}else{
  $chk_email = $user->chk_email_exists($_POST['email']);
  if($chk_email == 1){
    echo "email_exists";
    exit;
  }else{
    if($usr_id = $user->register_credentials($sanitized_data['name'],$sanitized_data['email'],md5($sanitized_data['password']),$sanitized_data['auth-type'],0)){
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
  }
}

?>