<?php
include '../../library/config.php';
include '../../classes/class.fees.php';

$fee = new Fees();

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
$amount = test_input($_POST['amount']);

if(!preg_match("/^(?<=^| )\d+(\.\d+)?(?=$| )*$/", $amount) || $amount == "" || $amount == null){
    echo "invalid";
}else{
    if($fee->update_fee($amount)){
        echo "update_success";
    }
}