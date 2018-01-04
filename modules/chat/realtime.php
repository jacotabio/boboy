<?php
include '../../library/config.php';
include '../../classes/class.chats.php';
include '../../classes/class.users.php';
include '../../classes/class.brands.php';

$chat = new Chats();
$user = new Users();
$brand = new Brands();

  $array=array();
  $rows=array();

  $container_arr = array();
  $id;
  
  if($_SESSION['usr_auth'] == 1){
    $id = $_SESSION['usr_id'];
    $load = $chat->user_all_convo($id);
    foreach ($load[1] as $key) {
      $data['title'] = $key['usr_name'];
      $data['msg'] = $key['msg'];
      $data['icon'] = $key['usr_img'];
      $data['msg_id'] = $key['msg_id'];
      $rows[] = $data;
    }
  }
  if($_SESSION['usr_auth'] == 2){
    $id = $_SESSION['brand_id'];
    $load = $chat->brand_all_convo($id);
    foreach ($load[1] as $key) {
      $data['title'] = $key['usr_name'];
      $data['msg'] = $key['msg'];
      $data['icon'] = $key['usr_img'];
      $data['msg_id'] = $key['msg_id'];
      $rows[] = $data;
    }
  }

  $array['notif'] = $rows;
  $array['count'] = $load[2];
  $array['result'] = $load[0];
  echo json_encode($array);

if(isset($_POST['update_notif'])){
  //echo $_POST['update_notif'];
  $chat->updateNotif($_POST['update_notif']);
}
  
