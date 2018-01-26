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
  }

  public function get_brandname($id){
    $query = $this->db->prepare("SELECT brand_name FROM brands WHERE brand_id = ?");
    $query->bindParam(1,$id);
    $query->execute();
    $row = $query->fetch(PDO::FETCH_ASSOC);
    return $row['brand_name'];
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
  }

}