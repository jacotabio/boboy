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
  	$sth = $this->db->prepare("SELECT brands.brand_id,brand_name,usr_email,usr_address,usr_contact,CASE WHEN brand_status = 1 THEN 'Online' WHEN brand_status = 0 THEN 'Offline' END AS status FROM brands,users WHERE brands.brand_id = users.brand_id AND usr_status = 1");
  	$sth->execute();
  	while($row = $sth->fetch(PDO::FETCH_ASSOC)){
  		$list[] = $row;
  	}
  	if(!empty($list)){
  		return $list;
  	}
  }

  public function get_brand_name($id){
    $query = $this->db->prepare("SELECT brand_name FROM brands,users WHERE brands.brand_id = ? AND brands.brand_id = users.brand_id AND usr_status = 1");
    $query->bindParam(1,$id);
    $query->execute();
    $row = $query->fetch(PDO::FETCH_ASSOC);
    return $row['brand_name'];
  }

  public function delete_brand($id){
  	$sth = $this->db->prepare("UPDATE users SET usr_status = 0 WHERE usr_status = 1 AND brand_id = ?");
  	$sth->bindParam(1,$id);
  	return $sth->execute();
  }

  public function get_brand_details($id){
    $sth = $this->db->prepare("SELECT * FROM brands,users WHERE brands.brand_id = ? AND brands.brand_id = users.brand_id AND usr_status = 1");
    $sth->bindParam(1,$id);
    $sth->execute();

    $row = $sth->fetch(PDO::FETCH_ASSOC);
    return $row;
  }
}