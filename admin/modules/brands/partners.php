<?php
include '../../library/config.php';
include '../../classes/class.brands.php';

$brand = new Brands();

$ret = $brand->get_brands();

if($ret){
  $array = array();
  foreach($ret as $r){
    array_push($array,array("brand_id"=>$r['brand_id'],"name"=>$r['brand_name'],"email"=>$r['usr_email'],"address"=>$r['usr_address'],"contact"=>$r['usr_contact'],"status"=>$r['status'],"banned"=>$r['banned']));
  }
  echo json_encode(array("data"=>$array));
}else{
  echo '{
    "sEcho": 1,
    "iTotalRecords": "0",
    "iTotalDisplayRecords": "0",
    "aaData": []
  }';
}
//echo '{"data":[{"order_id":"123","datetime":"today","customer":"John Carlo","price":"123.00","status":"Processing"}]}';