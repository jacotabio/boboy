<?php
include '../library/config.php';
include '../classes/class.delivery.php';

$delivery= new Delivery();
$response = array();

array_push($response, array("delivery_count"=>"0")); 
echo json_encode($response); 
?>