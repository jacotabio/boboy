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
      if(isset($_SESSION['usr_login']) && $_SESSION['usr_login'] == true){
        return true;
      }
      else{
        return false;
      }
    }

    public function chk_email_exists($str){
      $query = $this->db->prepare("SELECT * FROM users WHERE usr_email = ?");
      $query->bindParam(1,$str);
      $query->execute();
      return $query->rowCount();
    }

    public function remove_cart_unavailable($bid){
      $query = $this->db->prepare("DELETE cart FROM cart INNER JOIN items ON cart.item_id = items.item_id WHERE brand_id = ?");
      $query->bindParam(1,$bid);
      return $query->execute();
    }

    public function get_name($id){
      $query = $this->db->prepare("SELECT usr_name FROM users WHERE usr_id = ?");
      $query->bindParam(1,$id);
      $query->execute();
      $row = $query->fetch(PDO::FETCH_ASSOC);
      return $row['usr_name'];
      
    }
    public function get_brand_name($id){
      $query = $this->db->prepare("SELECT usr_name FROM users WHERE brand_id = ?");
      $query->bindParam(1,$id);
      $query->execute();
      $row = $query->fetch(PDO::FETCH_ASSOC);
      return $row['usr_name'];
      
    }

    public function user_contact_info($id){
      $query = $this->db->prepare("SELECT usr_address,usr_contact FROM users WHERE usr_id = ?");
      $query->bindParam(1,$id);
      $query->execute();
      $row = $query->fetch(PDO::FETCH_ASSOC);
      return $row;
    }

    public function register_credentials($name,$email,$pwd,$auth,$status){
      $query = $this->db->prepare("INSERT INTO users(usr_name,usr_email,usr_password,usr_auth,usr_status) VALUES(?,?,?,?,?)");
      $query->bindParam(1,$name);
      $query->bindParam(2,$email);
      $query->bindParam(3,$pwd);
      $query->bindParam(4,$auth);
      $query->bindParam(5,$status);
      $query->execute();
      return $this->db->lastInsertId();
    }

    public function place_brand_id($bid,$uid){
      $query = $this->db->prepare("UPDATE users SET brand_id = ? WHERE usr_id = ?");
      $query->bindParam(1,$bid);
      $query->bindParam(2,$uid);
      return $query->execute();
    }

    public function check_login($email,$password){
      $query = $this->db->prepare("SELECT * FROM users WHERE
      usr_email = ? AND usr_password = ?");
      $query->bindParam(1,$email);
      $query->bindParam(2,$password);
      $query->execute();
      $userdata = $query->fetch(PDO::FETCH_ASSOC);
      $count = $query->rowCount();
      if($count == 1){
              $_SESSION['usr_login']=true;
              $_SESSION['usr_id']=$userdata['usr_id'];
              $_SESSION['usr_name']=$userdata['usr_name'];
              $_SESSION['usr_auth']=$userdata['usr_auth'];
              $_SESSION['brand_id']=$userdata['brand_id'];
        return true;
      }
      else{
        return false;
      }
    }

}