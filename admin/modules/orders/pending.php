<?php
include '../../library/config.php';
include '../../classes/class.orders.php';

$order = new Orders();

$ret = $order->pending_orders();

$array = array();

foreach($ret as $r){
  $date = new DateTime($r['created_at']);
  $result = $date->format('m/d/Y g:i A');
  array_push($array,array("order_id"=>$r['order_id'],"datetime"=>$result,"customer"=>$r['usr_name'],"price"=>$r['order_total'],"status"=>$r['order_status']));
}

echo json_encode(array("data"=>$array));
//echo '{"data":[{"order_id":"123","datetime":"today","customer":"John Carlo","price":"123.00","status":"Processing"}]}';