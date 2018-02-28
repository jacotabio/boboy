<?php
class Users{
  public $db;

  public function __construct(){
    try{
    $this->db = new PDO("mysql:host=".DB_SERVER.";dbname=".DB_DATABASE, DB_USERNAME, DB_PASSWORD, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
    }catch(PDOException $e){
      echo "Connection failed: " . $e->getMessage();
      exit;
    }
  }

  public function get_session(){
      if(isset($_SESSION['admin_login']) && $_SESSION['admin_login'] == true){
        return true;
      }
      else{
        return false;
      }
      $this->db = null;
  }

  public function update_customer($id,$name,$email,$phone,$address,$status){
    $sth = $this->db->prepare("UPDATE users SET usr_name = ?, usr_email = ?,usr_contact = ?, usr_address = ?, usr_status = ? WHERE usr_id = ?");
    $sth->bindParam(1,$name);
    $sth->bindParam(2,$email);
    $sth->bindParam(3,$phone);
    $sth->bindParam(4,$address);
    $sth->bindParam(5,$status);
    $sth->bindParam(6,$id);
    return $sth->execute();
    $this->db = null;
  }

  public function update_password($id,$password){
    $sth = $this->db->prepare("UPDATE users SET usr_password = ? WHERE usr_id = ?");
    $sth->bindParam(1,$password);
    $sth->bindParam(2,$id);
    return $sth->execute();
    $this->db = null;
  }

  public function get_user_details($id){
    $sth = $this->db->prepare("SELECT * FROM users WHERE usr_id = ? AND usr_auth = 1 AND is_hidden = 0");
    $sth->bindParam(1,$id);
    $sth->execute();

    $row = $sth->fetch(PDO::FETCH_ASSOC);
    return $row;
    $this->db = null;
  }

  public function get_customers(){
    $sth = $this->db->prepare("SELECT usr_id,usr_name,usr_email,usr_address,usr_contact,CASE WHEN usr_status = 0 THEN 'Deactivated' ELSE 'Activated' END AS usr_status FROM users WHERE usr_auth = 1 AND is_hidden = 0");
    $sth->execute();
    while($row = $sth->fetch(PDO::FETCH_ASSOC)){
      $list[] = $row;
    }
    if(!empty($list)){
      return $list;
    }
    $this->db = null;
  }

  public function get_customer_name($id){
    $query = $this->db->prepare("SELECT usr_name FROM users WHERE usr_id = ? AND admin = 0 AND is_hidden = 0");
    $query->bindParam(1,$id);
    $query->execute();
    $row = $query->fetch(PDO::FETCH_ASSOC);
    return $row['usr_name'];
    $this->db = null;
  }

  public function delete_customer($id){
    $sth = $this->db->prepare("UPDATE users SET is_hidden = 1 WHERE usr_id = ? AND is_hidden = 0");
    $sth->bindParam(1,$id);
    return $sth->execute();
    $this->db = null;
  }

  public function get_brandname($id){
    $query = $this->db->prepare("SELECT brand_name FROM brands WHERE brand_id = ?");
    $query->bindParam(1,$id);
    $query->execute();
    $row = $query->fetch(PDO::FETCH_ASSOC);
    return $row['brand_name'];
    $this->db = null;
  }

  public function check_login($username,$password){
    $password = md5($password);

    $query = $this->db->prepare("SELECT * FROM users WHERE
    usr_name = ? AND usr_password = ? AND admin = 1");
    $query->bindParam(1,$username);
    $query->bindParam(2,$password);
    $query->execute();

    $result = $query->fetch(PDO::FETCH_ASSOC);
    $count = $query->rowCount();
    if($count == 1){
            $_SESSION['admin_login']=true;
            $_SESSION['admin_id']=$result['usr_id'];
            $_SESSION['admin_name']=$result['usr_name'];
      return true;
    }
    else{
      return false;
    }
    $this->db = null;
  }

}