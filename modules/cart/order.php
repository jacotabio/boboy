<?php
include '../../library/config.php';
include '../../classes/class.items.php';
include '../../classes/class.users.php';

$item = new Items();
$user = new Users();

if(isset($_POST['submit_order'])){
  
  function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

  /*
  if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
    echo "name_invalid"; 
    exit;
  }

  $email = test_input($_POST["email"]);
  if (!preg_match("/^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$/",$email)) {
    echo "email_invalid"; 
    exit;
  }*/

  $jsonArray = array();

  function array_map_r( $func, $arr ){
      $newArr = array();

      foreach( $arr as $key => $value )
      {
          $newArr[ $key ] = ( is_array( $value ) ? array_map_r( $func, $value ) : ( is_array($func) ? call_user_func_array($func, $value) : $func( $value ) ) );
      }
      return $newArr;
  } 
  $sanitized_data = array_map_r('strip_tags', $_POST);

    $cinfo = $user->user_contact_info($_SESSION['usr_id']);

    if($_POST['radio-address'] == 2){
      $address = test_input($sanitized_data['textarea-custom']);
    }else{
      $address = $cinfo['usr_address'];
    }
    if($_POST['radio-contact'] == 2){
      $contact = test_input($sanitized_data['custom-number']);
    }else{
      $contact = $cinfo['usr_contact'];
    }
    
    $get = $item->get_cart($_SESSION['usr_id']);
    if($get){
      $order_id = $item->create_order($_SESSION['usr_id'],$address,$contact);
      foreach($get as $g){
        $fixed_usr = $g['usr_id'];
        $item->insert_order($order_id,$g['item_id'],$g['item_qty'],$g['subtotal'],$g['usr_id']);
      }
      $item->insert_order_total($order_id,$item->cart_sum_total($fixed_usr));
      $item->empty_cart($fixed_usr);

      
      $jsonArray['code'] = "order_success";
      $jsonArray['order_id'] = $order_id;
      echo json_encode($jsonArray);
      exit;
    }else{
      $jsonArray['code'] = "empty_cart";
      echo json_encode($jsonArray);
    }
}