<?php
class Users{
  public $db;
  
    public function __construct(){
      $this->db = new mysqli(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
      if(mysqli_connect_errno()){
        echo "Database connection error.";
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
      $sql = "SELECT * FROM users WHERE usr_email = '$str'";
      $result = mysqli_query($this->db,$sql);
      $count = $result->num_rows;
      return $count;
    }

    public function remove_cart_unavailable($bid){
      $db = new PDO("mysql:host=localhost;dbname=db_sleepnotgo", "root", "");
      $query = $db->prepare("DELETE cart FROM cart INNER JOIN items ON cart.item_id = items.item_id WHERE brand_id = ?");
      $query->bindParam(1,$bid);
      return $query->execute();
    }

    public function get_name($id){
      $db = new PDO("mysql:host=localhost;dbname=db_sleepnotgo", "root", "");
      $query = $db->prepare("SELECT usr_name FROM users WHERE usr_id = ?");
      $query->bindParam(1,$id);
      $query->execute();
      $row = $query->fetch(PDO::FETCH_ASSOC);
      return $row['usr_name'];
      
    }
    public function get_brand_name($id){
      $db = new PDO("mysql:host=localhost;dbname=db_sleepnotgo", "root", "");
      $query = $db->prepare("SELECT usr_name FROM users WHERE brand_id = ?");
      $query->bindParam(1,$id);
      $query->execute();
      $row = $query->fetch(PDO::FETCH_ASSOC);
      return $row['usr_name'];
      
    }

    public function user_contact_info($id){
      $db = new PDO("mysql:host=localhost;dbname=db_sleepnotgo", "root", "");
      $query = $db->prepare("SELECT usr_address,usr_contact FROM users WHERE usr_id = ?");
      $query->bindParam(1,$id);
      $query->execute();
      $row = $query->fetch(PDO::FETCH_ASSOC);
      return $row;
      
    }

    public function register_credentials($name,$email,$pwd,$auth,$status){
      $sql = "INSERT INTO users(usr_name,usr_email,usr_password,usr_auth,usr_status) VALUES('$name','$email','$pwd','$auth','$status')";
      $result = mysqli_query($this->db,$sql) or die(error() . "Cannot Insert Data");
      return $this->db->insert_id;
    }

    public function place_brand_id($bid,$uid){
      $sql = "UPDATE users SET brand_id = '$bid' WHERE usr_id = '$uid'";
      $result = mysqli_query($this->db,$sql) or die(mysql_error() . "Cannot Update Data");
      return $result;
    }

    public function check_login($email,$password){
      $email = mysqli_real_escape_string($this->db,$email);
      $password = md5(mysqli_real_escape_string($this->db,$password));
      $sql = "SELECT * FROM users WHERE
      usr_email='$email' AND usr_password='$password'";
      $result=mysqli_query($this->db,$sql);
      $userdata=mysqli_fetch_array($result);
      $count = $result->num_rows;
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