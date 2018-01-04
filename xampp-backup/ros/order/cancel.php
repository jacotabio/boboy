<?php
include '../library/config.php';
include '../classes/class.order.php';
include '../classes/class.table.php';
$subid = (isset($_GET['sub']) && $_GET['sub'] != '') ? $_GET['sub'] : '';

$order = new Order();
$table = new Table();

$order->close_order($subid);
$table->set_status($subid,1);
$table->set_server($subid,0);

header('location: ../index.php');
exit;