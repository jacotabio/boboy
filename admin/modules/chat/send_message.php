<?php
include '../../library/config.php';
include '../../classes/class.chats.php';

$chat = new Chats();

if(isset($_POST['brand_id'])){
  function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
  function array_map_r( $func, $arr ){
    $newArr = array();

    foreach( $arr as $key => $value )
    {
        $newArr[ $key ] = ( is_array( $value ) ? array_map_r( $func, $value ) : ( is_array($func) ? call_user_func_array($func, $value) : $func( $value ) ) );
    }
    return $newArr;
  } 
  $sanitized_data = array_map_r('strip_tags', $_POST);
  
  $msg = test_input($_POST['chat-input-message']);

  if($chat->send_message($_SESSION['admin_id'],$_POST['brand_id'],$msg)){
    echo "message_sent";
  }else{
    echo "message_failed";
  }
}
?>