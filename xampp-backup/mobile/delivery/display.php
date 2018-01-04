<?php
include '../library/config.php';
include '../classes/class.delivery.php';

$delivery= new Delivery();
$response = array();

if(isset($_POST['action'])){
   switch($_POST['action']){
      case 'getlist':{
      	$delivery_list = $delivery->get_delivery($_POST['medrep_id']);
      	foreach($delivery_list as $values){
        	array_push($response, array("delivery_id"=>$values['delivery_id'],"client_name"=>$values['client_name'],"order_id"=>$values['order_id'],"client_address"=>$values['address']));	
      	}
		echo json_encode($response); 
       }
       break;
   } 
}
?>