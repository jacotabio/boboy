<?php
include '../../library/config.php';
include '../../classes/class.items.php';
include '../../classes/class.users.php';

$user = new Users();
$item = new Items();

if($user->get_session()){
  if($_SESSION['usr_auth'] == 1){
    $avail = $item->check_availability($_POST['item_id']);
    if($avail){
      $subtotal = $_POST['item_price'] * $_POST['order_qty'];

      // Check current items in cart
      $check_cart = $item->check_user_cart($_SESSION['usr_id'],$_POST['item_id']);
      foreach($check_cart as $foo);

      // Cart condition
      if($foo['counted'] == 1){
        $new_subtotal = $foo['subtotal'] + $subtotal;
        $new_qty = $foo['item_qty'] + $_POST['order_qty'];
        
        if($item->update_to_cart($_SESSION['usr_id'],$_POST['item_id'],$new_qty,$new_subtotal)){
          echo "cart_updated";
        }else{
          echo "update_failed";
        }
      }else{
        if($item->insert_to_cart($_SESSION['usr_id'],$_POST['item_id'],$_POST['order_qty'],$subtotal)){
          echo "cart_inserted";
        }else{
          echo "insert_failed";
        }
      }
    }else{
      echo "item_unavailable";
    }
  }else{
    echo "session_brand";
  }
}else{
  echo "no_session";
}