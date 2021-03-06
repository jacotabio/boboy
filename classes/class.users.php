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

    public function account_details($id){
      $sth = $this->db->prepare("SELECT * FROM users WHERE usr_id = ?");
      $sth->bindParam(1,$id);
      $sth->execute();

      while($row = $sth->fetch(PDO::FETCH_ASSOC)){
        $list[] = $row;
      }
      if(!empty($list)){
        return $list;
      }else{
        return false;
      }
      $this->db = null;
      
    }

    public function check_account($id){
      $sth = $this->db->prepare("SELECT usr_status, is_hidden FROM users WHERE usr_id = ?");
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

    public function update_password($val,$uid){
      $sth = $this->db->prepare("UPDATE users SET usr_password = ? WHERE usr_id = ?");
      $sth->bindParam(1,$val);
      $sth->bindParam(2,$uid);
      return $sth->execute();
      $this->db = null;
    }
    public function check_password($val,$uid){
      $sth = $this->db->prepare("SELECT usr_password FROM users WHERE usr_id = ?");
      $sth->bindParam(1,$uid);
      $sth->execute();
      $oldpass = $sth->fetch(PDO::FETCH_ASSOC);
      if($val == $oldpass['usr_password']){
        return true;
      }else{
        return false;
      }
      $this->db = null;
    }
    public function account_update($name,$email,$phone,$address,$id){
      $chk = $this->db->prepare("SELECT COUNT(usr_id) AS total FROM users WHERE usr_email = ?");
      $chk->bindParam(1,$email);
      $chk->execute();

      $row = $chk->fetch(PDO::FETCH_ASSOC);
      if($row['total'] == 0){
        $sth = $this->db->prepare("UPDATE users SET usr_name = :name, usr_email = :email, usr_contact = :phone, usr_address = :address WHERE usr_id = :id");
        $sth->bindParam("name",$name);
        $sth->bindParam("email",$email);
        $sth->bindParam("phone",$phone);
        $sth->bindParam("address",$address);
        $sth->bindParam("id",$id);
        $_SESSION['usr_name'] = $name;
        return $sth->execute();
      }else{
        return false;

      }
      $this->db = null;
    }

    public function brand_update($name,$email,$phone,$address,$id,$bid){
      $chk = $this->db->prepare("SELECT COUNT(brands.brand_id) AS total FROM brands,users WHERE usr_email = ? AND brands.brand_id = users.brand_id");
      $chk->bindParam(1,$email);
      $chk->execute();

      $row = $chk->fetch(PDO::FETCH_ASSOC);
      if($row['total'] == 0){
        $sth = $this->db->prepare("UPDATE users SET usr_name = :name, usr_email = :email, usr_contact = :phone, usr_address = :address WHERE usr_id = :id");
        $sth->bindParam("name",$name);
        $sth->bindParam("email",$email);
        $sth->bindParam("phone",$phone);
        $sth->bindParam("address",$address);
        $sth->bindParam("id",$id);
        $sth->execute();

        $sth3 = $this->db->prepare("UPDATE brands SET brand_name = ? WHERE brand_id = ?");
        $sth3->bindParam(1,$name);
        $sth3->bindParam(2,$bid);
        $_SESSION['usr_name'] = $name;
        return $sth3->execute();
      }else{
        return false;
      }
      $this->db = null;
    }

    public function get_session(){
      if(isset($_SESSION['usr_login']) && $_SESSION['usr_login'] == true){
        return true;
      }
      else{
        return false;
      }
      $this->db = null;
    }

    public function chk_email_exists($str){
      $query = $this->db->prepare("SELECT * FROM users WHERE usr_email = ?");
      $query->bindParam(1,$str);
      $query->execute();
      return $query->rowCount();
      $this->db = null;
    }

    public function remove_cart_unavailable($bid){
      $query = $this->db->prepare("DELETE cart FROM cart INNER JOIN items ON cart.item_id = items.item_id WHERE brand_id = ?");
      $query->bindParam(1,$bid);
      return $query->execute();
      $this->db = null;
    }

    public function get_name($id){
      $query = $this->db->prepare("SELECT usr_name FROM users WHERE usr_id = ?");
      $query->bindParam(1,$id);
      $query->execute();
      $row = $query->fetch(PDO::FETCH_ASSOC);
      return $row['usr_name'];
      $this->db = null;
      
    }
    public function get_brand_name($id){
      $query = $this->db->prepare("SELECT usr_name FROM users WHERE brand_id = ?");
      $query->bindParam(1,$id);
      $query->execute();
      $row = $query->fetch(PDO::FETCH_ASSOC);
      return $row['usr_name'];
      $this->db = null;
      
    }

    public function user_contact_info($id){
      $query = $this->db->prepare("SELECT usr_address,usr_contact FROM users WHERE usr_id = ?");
      $query->bindParam(1,$id);
      $query->execute();
      $row = $query->fetch(PDO::FETCH_ASSOC);
      return $row;
      $this->db = null;
    }

    public function register_credentials($name,$email,$pwd,$address,$phone){
      $auth = "1";
      $status = "1";
      $query = $this->db->prepare("INSERT INTO users(usr_name,usr_email,usr_password,usr_auth,usr_status,usr_address,usr_contact) VALUES(?,?,?,?,?,?,?)");
      $query->bindParam(1,$name);
      $query->bindParam(2,$email);
      $query->bindParam(3,$pwd);
      $query->bindParam(4,$auth);
      $query->bindParam(5,$status);
      $query->bindParam(6,$address);
      $query->bindParam(7,$phone);
      $query->execute();
      return $this->db->lastInsertId();
      $this->db = null;
    }

    public function place_brand_id($bid,$uid){
      $query = $this->db->prepare("UPDATE users SET brand_id = ? WHERE usr_id = ?");
      $query->bindParam(1,$bid);
      $query->bindParam(2,$uid);
      return $query->execute();
      $this->db = null;
    }

    public function check_login($email,$password){
      $query = $this->db->prepare("SELECT *,
                                  CASE
                                    WHEN usr_status = 0 THEN '1'
                                    WHEN usr_status = 1 THEN '0'
                                  END AS usr_banned
                                FROM users 
                                WHERE usr_email = ? AND usr_password = ? AND is_hidden = 0 AND admin = 0");
      $query->bindParam(1,$email);
      $query->bindParam(2,$password);
      $query->execute();
      $userdata = $query->fetch(PDO::FETCH_ASSOC);
      $count = $query->rowCount();
      
      if($userdata['usr_banned'] == 0 && $count == 1){
        //return "1 record found and user not banned";
        $_SESSION['usr_login']=true;
        $_SESSION['usr_id']=$userdata['usr_id'];
        $_SESSION['usr_name']=$userdata['usr_name'];
        $_SESSION['usr_auth']=$userdata['usr_auth'];
        $_SESSION['brand_id']=$userdata['brand_id'];
        return "login_success";
      }else{
        return $userdata['usr_banned'];
      }
      $this->db = null;
    }

}