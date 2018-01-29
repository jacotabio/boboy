<?php
include '../../library/config.php';
include '../../classes/class.users.php';

$user = new Users();

$ret = $user->get_customers();

if($ret){
  $array = array();
  foreach($ret as $r){
    array_push($array,array("usr_id"=>$r['usr_id'],"name"=>$r['usr_name'],"email"=>$r['usr_email'],"address"=>$r['usr_address'],"contact"=>$r['usr_contact'],"status"=>$r['usr_status']));
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