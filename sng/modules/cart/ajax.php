<?php
include '../../library/config.php';
include '../../classes/class.items.php';

$item = new Items();

if(isset($_POST['remove_cart'])){
  if($item->check_before_remove($_POST['remove_id'])){
    if($item->remove_from_cart($_POST['remove_id'])){
      echo "remove_success";
    }else{
      echo "remove_failed";
    }
  }else{
    echo "check_error";
  }
}