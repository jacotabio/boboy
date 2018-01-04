<?php
include("templates/header.htm");

if(!empty($_GET['action'])){
  $action = $_GET['action'];
  $action = basename($action);
  if(!file_exists("templates/$action.htm")){
    $action = "index";
  }
  if($action == 'header' || $action == 'footer'){
    $action = "index";
  }
  include("templates/$action.htm");
}else{
  include("templates/index.htm");
}

include("templates/footer.htm");
