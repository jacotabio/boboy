<?php
class Brands{
  public $db;
  
  public function __construct(){
    try{
    $this->db = new PDO("mysql:host=".DB_SERVER.";dbname=".DB_DATABASE, DB_USERNAME, DB_PASSWORD, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
    }catch(PDOException $e){
      echo "Connection failed: " . $e->getMessage();
      exit;
    }
  }

  public function get_brands(){
    $query = $this->db->prepare("SELECT * FROM brands,users WHERE brands.brand_id = users.brand_id AND usr_status = 1 AND is_hidden = 0");
    $query->execute();
    while($row = $query->fetch(PDO::FETCH_ASSOC)){
      $list[] = $row;
    }
    if(!empty($list)){
      return $list;
    }
    $this->db = null;
  }

  public function change_brand_status($bid,$status,$checker){
    $query = $this->db->prepare("UPDATE brands SET brand_status = ?, update_checker = ? WHERE brand_id = ?");
    $query->bindParam(1,$status);
    $query->bindParam(2,$checker);
    $query->bindParam(3,$bid);
    $query->execute();
    $this->db = null;
  }

  public function offline_status($bid){
    $sth = $this->db->prepare("UPDATE brands SET brand_status = 0 WHERE brand_id = ?");
    $sth->bindParam(1,$bid);
    return $sth->execute();
    $this->db = null;
  }

  public function check_account($id){
      $sth = $this->db->prepare("SELECT usr_status, is_hidden FROM users WHERE brand_id = ?");
      $sth->bindParam(1,$id);
      $sth->execute();
      $row = $sth->fetch(PDO::FETCH_ASSOC);

      if($row['is_hidden'] == 1){
        return "deleted";
      }else if($row['usr_status'] == 0){
        return "disabled";
      }
      $this->db = null;
  }
  
  public function realtime_brand_checker(){
    $query = $this->db->prepare("SELECT * FROM brands WHERE update_checker = 1 AND is_hidden = 0");
    $query->execute();

    while($row = $query->fetch(PDO::FETCH_ASSOC)){
      $list[] = $row;
    }
    if(!empty($list)){
      return $list;
    }
    $this->db = null;
  }


  public function get_all_brand_status(){
    $query = $this->db->prepare("SELECT * FROM brands,users WHERE brands.brand_id = users.brand_id AND usr_status = 1 AND is_hidden = 0");
    $query->execute();

    while($row = $query->fetch(PDO::FETCH_ASSOC)){
      $list[] = $row;
    }
    if(!empty($list)){
      return $list;
    }
    $this->db = null;
  }

  
  public function get_brand_status($id){
    $query = $this->db->prepare("SELECT brand_status FROM brands WHERE brand_id = ?");
    $query->bindParam(1,$id);
    $query->execute();

    $row = $query->fetch(PDO::FETCH_ASSOC);
    $value = $row['brand_status'];
    return $value;
  }

  public function add_brand($value){
    $query = $this->db->prepare("INSERT INTO brands(brand_name) VALUES(?)");
    $query->bindParam(1,$value);
    $query->execute();
    return $this->db->lastInsertId();
    $this->db = null;
  }
}