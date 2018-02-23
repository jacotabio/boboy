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
  	$sth = $this->db->prepare("SELECT brands.brand_id,brand_name,usr_email,usr_address,usr_contact,CASE WHEN brand_status = 1 THEN 'Online' WHEN brand_status = 0 THEN 'Offline' END AS status,CASE WHEN usr_status = 0 THEN 'Banned' ELSE '-' END AS banned FROM brands,users WHERE brands.brand_id = users.brand_id AND is_hidden = 0");
  	$sth->execute();
  	while($row = $sth->fetch(PDO::FETCH_ASSOC)){
  		$list[] = $row;
  	}
  	if(!empty($list)){
  		return $list;
  	}
  }

  public function register_brand($brandname,$email,$password,$address,$phone){
    $chk = $this->db->prepare("SELECT COUNT(brands.brand_id) AS total FROM brands,users WHERE brand_name = ? AND usr_name = ? AND brands.brand_id = users.brand_id AND usr_email = ?");
    $chk->bindParam(1,$brandname);
    $chk->bindParam(2,$brandname);
    $chk->bindParam(3,$email);
    $chk->execute();

    $row = $chk->fetch(PDO::FETCH_ASSOC);
    if($row['total'] == 0){
      $sth = $this->db->prepare("INSERT INTO users(usr_name,usr_email,usr_password,usr_address,usr_contact,usr_auth,usr_status) VALUES(?,?,?,?,?,2,1)");
      $sth->bindParam(1,$brandname);
      $sth->bindParam(2,$email);
      $sth->bindParam(3,$password);
      $sth->bindParam(4,$address);
      $sth->bindParam(5,$phone);
      $sth->execute();
      $usr_id = $this->db->lastInsertId();

      $br = $this->db->prepare("INSERT INTO brands(brand_name,brand_status) VALUES(?,0)");
      $br->bindParam(1,$brandname);
      $br->execute();
      $brand_id = $this->db->lastInsertId();

      $place = $this->db->prepare("UPDATE users SET brand_id = ? WHERE usr_id = ?");
      $place->bindParam(1,$brand_id);
      $place->bindParam(2,$usr_id);
      return $place->execute();
    }else{
      return false;
    }
  }

  public function ban_account($id){
    $sth = $this->db->prepare("UPDATE users SET usr_status = 0 WHERE usr_status = 1 AND brand_id = ?");
    $sth->bindParam(1,$id);
    $sth->execute();

    $query = $this->db->prepare("DELETE cart FROM cart INNER JOIN items ON cart.item_id = items.item_id WHERE brand_id = ?");
    $query->bindParam(1,$id);
    return $query->execute();
  }

  public function unban_account($id){
    $sth = $this->db->prepare("UPDATE users SET usr_status = 1 WHERE usr_status = 0 AND brand_id = ?");
    $sth->bindParam(1,$id);
    return $sth->execute();
  }

  public function update_password($id,$password){
    $sth = $this->db->prepare("UPDATE users SET usr_password = ? WHERE brand_id = ?");
    $sth->bindParam(1,$password);
    $sth->bindParam(2,$id);
    return $sth->execute();
  }

  public function update_brand($id,$name,$email,$phone,$address){
    $sth = $this->db->prepare("UPDATE users SET usr_name = ?, usr_email = ?,usr_contact = ?, usr_address = ? WHERE brand_id = ?");
    $sth->bindParam(1,$name);
    $sth->bindParam(2,$email);
    $sth->bindParam(3,$phone);
    $sth->bindParam(4,$address);
    $sth->bindParam(5,$id);
    $sth->execute();

    $sth2 = $this->db->prepare("UPDATE brands SET brand_name = ? WHERE brand_id = ?");
    $sth2->bindParam(1,$name);
    $sth2->bindParam(2,$id);
    return $sth2->execute();
  }

  public function get_brand_name($id){
    $query = $this->db->prepare("SELECT brand_name FROM brands,users WHERE brands.brand_id = ? AND brands.brand_id = users.brand_id AND is_hidden = 0");
    $query->bindParam(1,$id);
    $query->execute();
    $row = $query->fetch(PDO::FETCH_ASSOC);
    return $row['brand_name'];
  }

  public function delete_brand($id){
  	$sth = $this->db->prepare("UPDATE users SET is_hidden = 1 WHERE is_hidden = 0 AND brand_id = ?");
  	$sth->bindParam(1,$id);
  	return $sth->execute();
  }

  public function get_brand_details($id){
    $sth = $this->db->prepare("SELECT * FROM brands,users WHERE brands.brand_id = ? AND brands.brand_id = users.brand_id AND is_hidden = 0");
    $sth->bindParam(1,$id);
    $sth->execute();

    $row = $sth->fetch(PDO::FETCH_ASSOC);
    return $row;
  }
}