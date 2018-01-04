<?php
include '../library/config.php';
include '../classes/class.order.php';
include '../classes/class.table.php';
$tabid = (isset($_GET['sub']) && $_GET['sub'] != '') ? $_GET['sub'] : '';
$ostid = (isset($_GET['ostid']) && $_GET['ostid'] != '') ? $_GET['ostid'] : '';
$name = (isset($_GET['name']) && $_GET['name'] != '') ? $_GET['name'] : '';
$usrid = (isset($_GET['user']) && $_GET['user'] != '') ? $_GET['user'] : '';
$count = (isset($_GET['count']) && $_GET['count'] != '') ? $_GET['count'] : '';

$order = new Order();
$table = new Table();

$order->pay_order($name,$count,$ostid,$tabid,$usrid);
$oid = $order->get_new_oid();

$list = $order->get_orderpertable($tabid);
foreach($list as $value){
	$order->insert_item($value['pro_id'],$value['ord_qty'],$value['pro_price'],$oid,$tabid,$usrid);
}

$order->set_oitamount($oid);
$order->close_order($tabid);
$table->set_status($tabid,1);
$table->set_server($tabid,0);

header('location: ../index.php');
exit;