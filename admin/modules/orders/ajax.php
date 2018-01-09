<?php
include '../../library/config.php';
include '../../classes/class.orders.php';

$order = new Orders();

if(isset($_POST['order_summary'])){
	$ret = array();
	$data = $order->get_order_summary($_POST['order_id']);
	echo json_encode($data);
}