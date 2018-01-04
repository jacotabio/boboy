<?php
class Fees{
  public $db;
  
  public function __construct(){
    try{
    $this->db = new PDO("mysql:host=localhost;dbname=db_sleepnotgo", "root", "", array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
    }catch(PDOException $e){
      echo "Connection failed: " . $e->getMessage();
      exit;
    }
  }

  public function get_service_fee(){
    $query = $this->db->prepare("SELECT fee_price FROM fees WHERE fee_id = 1");
    $query->execute();

    $row = $query->fetch(PDO::FETCH_ASSOC);
    return $row['fee_price'];
  }
  
}