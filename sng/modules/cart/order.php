<?php
include '../../library/config.php';
include '../../classes/class.items.php';

$item = new Items();

if(isset($_POST['submit_order'])){
  $get = $item->get_cart($_SESSION['usr_id']);
  if($get){
    $order_id = $item->create_order($_SESSION['usr_id']);
    foreach($get as $g){
      $fixed_usr = $g['usr_id'];
      $item->insert_order($order_id,$g['item_id'],$g['item_qty'],$g['subtotal'],$g['usr_id']);
    }
    $item->insert_order_total($order_id,$item->cart_sum_total($fixed_usr));
    $item->empty_cart($fixed_usr);
    echo "order_success";
    exit;
  }else{
    echo "empty_cart";
  }
}