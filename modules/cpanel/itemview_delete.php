<?php
include '../../library/config.php';
include '../../classes/class.items.php';


$item = new Items();



if(isset($_POST['delete_id'])){
  if($item->delete_item($_POST['delete_id'],$_SESSION['brand_id'])){
    echo "delete_success";
  }
}