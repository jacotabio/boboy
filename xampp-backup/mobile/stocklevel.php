<?php
include 'library/config.php';
include 'classes/class.stocklevel.php';

$sli= new Stocklevel();

if(isset($_GET['action'])){
   switch($_GET['action']){
      case 'getlist':{
          echo "{\"clients\":".json_encode($sli->get_client_stock($_GET['medrep_id']))."}"; 
       }
       break;
   } 
}
?>