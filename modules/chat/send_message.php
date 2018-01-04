<?php
include '../../library/config.php';
include '../../classes/class.chats.php';

$chat = new Chats();

if(isset($_POST['user_id'])){
  if($chat->send_message($_POST['user_id'],$_SESSION['brand_id'],$_POST['chat-input-message'],$_SESSION['usr_auth'])){
    echo "message_sent";
  }else{
    echo "message_failed";
  }
}
if(isset($_POST['brand_id'])){
  if($chat->send_message($_SESSION['usr_id'],$_POST['brand_id'],$_POST['chat-input-message'],$_SESSION['usr_auth'])){
    echo "message_sent";
  }else{
    echo "message_failed";
  }
}
?>