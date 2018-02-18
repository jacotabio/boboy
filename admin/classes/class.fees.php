<?php
class Fees{
  public $db;
  
  public function __construct(){
    try{
    $this->db = new PDO("mysql:host=".DB_SERVER.";dbname=".DB_DATABASE, DB_USERNAME, DB_PASSWORD, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
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

  public function update_fee($amount){
  	$sth = $this->db->prepare("UPDATE fees SET fee_price = ? WHERE fee_id = 1");
  	$sth->bindParam(1,$amount);
  	return $sth->execute();
  }
  
}