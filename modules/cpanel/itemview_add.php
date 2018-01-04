<?php
include '../../library/config.php';
include '../../classes/class.items.php';
include '../../classes/class.users.php';
include '../../classes/class.brands.php';
include '../../classes/class.auth.php';

$item = new Items();
$user = new Users();
$brand = new Brands();
$auth = new Auth();

function array_map_r( $func, $arr )
{
    $newArr = array();

    foreach( $arr as $key => $value )
    {
        $newArr[ $key ] = ( is_array( $value ) ? array_map_r( $func, $value ) : ( is_array($func) ? call_user_func_array($func, $value) : $func( $value ) ) );
    }

    return $newArr;
} 
$sanitized_data = array_map_r('strip_tags', $_POST);

// Clean input name and description
$clean_name = str_replace(array('(',')','"',';'),'',$sanitized_data['add-item-name']);
$clean_desc = str_replace(array('(',')','"',';'),'',$sanitized_data['add-item-desc']);


if($item_id = $item->insert_item($clean_name,$clean_desc,$sanitized_data['add-item-price'],$sanitized_data['add-item-status'],$_SESSION['brand_id'])){
  echo "insert_success";
}

// Check if user wants to upload
if (file_exists($_FILES['add-item-file']['tmp_name']) || is_uploaded_file($_FILES['add-item-file']['tmp_name'])) 
{
  $name = $_FILES['add-item-file']['name'];
  $target_dir = "../../img/upload/";
  $target_file = $target_dir . basename($_FILES["add-item-file"]["name"]);
  $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
  $extensions_arr = array("jpg","jpeg","png","gif");

  // Check extension
  if(in_array($imageFileType,$extensions_arr)){
   $item->change_img($name,$item_id);
   move_uploaded_file($_FILES['add-item-file']['tmp_name'],$target_dir.$name);
  }
}