<?php
class Brands{
  public $db;
  
  public function __construct(){
    $this->db = new mysqli(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
    if(mysqli_connect_errno()){
      echo "Database connection error.";
      exit;
    }
  }

  public function get_brands(){
    $sql = "SELECT * FROM brands";
    $result = mysqli_query($this->db,$sql);
    while($row = mysqli_fetch_array($result)){
      $list[] = $row;
    }
    if(!empty($list)){
      return $list;
    }
  }

  public function change_brand_status($bid,$status,$checker){
    $db = new PDO("mysql:host=localhost;dbname=db_sleepnotgo", "root", "");
    $query = $db->prepare("UPDATE brands SET brand_status = ?, update_checker = ? WHERE brand_id = ?");
    $query->bindParam(1,$status);
    $query->bindParam(2,$checker);
    $query->bindParam(3,$bid);
    $query->execute();
  }
  
  public function realtime_brand_checker(){
    $db = new PDO("mysql:host=localhost;dbname=db_sleepnotgo", "root", "");
    $query = $db->prepare("SELECT * FROM brands WHERE update_checker = 1");
    $query->execute();

    while($row = $query->fetch(PDO::FETCH_ASSOC)){
      $list[] = $row;
    }
    if(!empty($list)){
      return $list;
    }
    $db = null;
  }


  public function get_all_brand_status(){
    $db = new PDO("mysql:host=localhost;dbname=db_sleepnotgo", "root", "");
    $query = $db->prepare("SELECT * FROM brands");
    $query->execute();

    while($row = $query->fetch(PDO::FETCH_ASSOC)){
      $list[] = $row;
    }
    if(!empty($list)){
      return $list;
    }
    $db = null;
  }

  
  public function get_brand_status($id){
    $db = new PDO("mysql:host=localhost;dbname=db_sleepnotgo", "root", "");
    $query = $db->prepare("SELECT brand_status FROM brands WHERE brand_id = ?");
    $query->bindParam(1,$id);
    $query->execute();

    $row = $query->fetch(PDO::FETCH_ASSOC);
    $value = $row['brand_status'];
    return $value;
  }

  public function add_brand($value){
    $sql = "INSERT INTO brands(brand_name) VALUES('$value')";
    $result = mysqli_query($this->db,$sql) or die(mysql_error() . "Cannot Insert Data");
    return $this->db->insert_id;
  }
}