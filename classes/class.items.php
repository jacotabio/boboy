<?php
class Items{
  public $db;
  
    public function __construct(){
      $this->db = new mysqli(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
      if(mysqli_connect_errno()){
        echo "Database connection error.";
        exit;
      }
    }

    public function count_items(){
      $sql = "SELECT * FROM ";
    }

    public function pdo_select($id){
      $db = new PDO("mysql:host=localhost;dbname=db_sleepnotgo", "root", "");
      $query = $db->prepare("SELECT * FROM items WHERE item_id = :id");
      $query->bindParam(":id",$id);
      $query->execute();
      
      while ($row = $query->fetch(PDO::FETCH_ASSOC))
      {
        $list[] = $row;
      }
      return $list;
      $db = null;
    }

    public function get_unavailable_items(){
      $db = new PDO("mysql:host=localhost;dbname=db_sleepnotgo", "root", "");
      $query = $db->prepare("SELECT * FROM items,brands WHERE brands.brand_id = items.brand_id AND brand_status = 0 OR brands.brand_id = items.brand_id AND item_status = 0");
      $query->execute();
      
      while ($row = $query->fetch(PDO::FETCH_ASSOC))
      {
        $list[] = $row;
      }
      if(!empty($list)){
        return $list;
      }
      $db = null;
    }

    

    public function get_item_brand($id){
      $sql = "SELECT brand_name FROM brands WHERE brand_id = '$id'";
      $result = mysqli_query($this->db,$sql);
      $row = mysqli_fetch_assoc($result);
      $value = $row['brand_name'];
      return $value;
    }

    public function get_item_name($id){
      $sql = "SELECT item_name FROM items WHERE item_id = '$id'";
      $result = mysqli_query($this->db,$sql);
      $row = mysqli_fetch_assoc($result);
      $value = $row['item_name'];
      return $value;
    }

    public function check_item_status($id){
      $sql = "SELECT item_status FROM items WHERE item_id = '$id'";
      $result = mysqli_query($this->db,$sql);
      $row = mysqli_fetch_assoc($result);
      $value = $row['item_status'];
      return $value;
    }

    public function get_shop_items(){
      $sql = "SELECT * FROM items,brands WHERE item_status = '1' AND brand_status = '1' AND items.brand_id = brands.brand_id";
      $result = mysqli_query($this->db,$sql);
      while($row = mysqli_fetch_array($result)){
        $list[] = $row;
      }
      if(!empty($list)){
        return $list;
      }
    }

    public function get_shop_items_search($search){
      $db = new PDO("mysql:host=localhost;dbname=db_sleepnotgo", "root", "");
      $query = $db->prepare("SELECT * FROM items,brands WHERE item_name LIKE ? AND items.brand_id = brands.brand_id AND brand_status = '1'");
      $val = '%'.$search.'%';
      $query->bindParam(1,$val);
      $query->execute();
      
      while ($row = $query->fetch(PDO::FETCH_ASSOC))
      {
        $list[] = $row;
      }
      if(!empty($list)){
        return $list;
      }
      $db = null;
    }

    public function get_shop_items_search_and_brand($search,$bid){
      $db = new PDO("mysql:host=localhost;dbname=db_sleepnotgo", "root", "");
      $query = $db->prepare("SELECT * FROM items WHERE item_name LIKE ? AND brand_id = ?");
      $val = '%'.$search.'%';
      $query->bindParam(1,$val);
      $query->bindParam(2,$bid);
      $query->execute();
      
      while ($row = $query->fetch(PDO::FETCH_ASSOC))
      {
        $list[] = $row;
      }
      if(!empty($list)){
        return $list;
      }
      $db = null;
    }

    public function get_shop_items_by_brand($id){
      $sql = "SELECT * FROM items,brands WHERE brands.brand_id = '$id' AND item_status = '1' AND brands.brand_id = items.brand_id AND brand_status = '1'";
      $result = mysqli_query($this->db,$sql);
      while($row = mysqli_fetch_array($result)){
        $list[] = $row;
      }
      if(!empty($list)){
        return $list;
      }
    }

    public function check_availability($id){
      $sql = "SELECT item_name FROM items,brands WHERE item_status = '1' AND item_id = '$id' AND items.brand_id = brands.brand_id AND brand_status = '1'";
      $result = mysqli_query($this->db,$sql);
      $row = mysqli_fetch_assoc($result);
      $value = $row['item_name'];
      return $value;
    }

    public function get_home_items(){
      $sql = "SELECT * FROM items";
      $result = mysqli_query($this->db,$sql);
      while($row = mysqli_fetch_array($result)){
        $list[] = $row;
      }
      if(!empty($list)){
        return $list;
      }
    }

    public function get_item_and_brand($id,$bid){
      $sql = "SELECT * FROM items WHERE item_id = '$id' AND brand_id = '$bid' AND item_status = '1'";
      $result = mysqli_query($this->db,$sql);
      while($row = mysqli_fetch_array($result)){
        $list[] = $row;
      }
      if(!empty($list)){
        return $list;
      }
    }

    public function create_order($usr_id,$address,$contact){
      $db = new PDO("mysql:host=localhost;dbname=db_sleepnotgo", "root", "");
      $query = $db->prepare("INSERT INTO orders(created_at,usr_id,delivery_address,contact_number) VALUES(NOW(),?,?,?)");
      $query->bindParam(1,$usr_id);
      $query->bindParam(2,$address);
      $query->bindParam(3,$contact);
      $query->execute();
      return $db->lastInsertId();
    }

    public function insert_order($oid,$item,$qty,$subtotal,$usr){
      $sql = "INSERT INTO oitem(order_id,item_id,oi_qty,oi_subtotal,usr_id) VALUES('$oid','$item','$qty','$subtotal','$usr')";
      $result = mysqli_query($this->db,$sql) or die(mysqli_error() . "Cannot Insert Data");
      return $result;
    }

    public function get_item($id){
      $sql = "SELECT * FROM items,brands WHERE item_id = '$id' AND item_status = '1' AND items.brand_id = brands.brand_id AND brand_status = '1'";
      $result = mysqli_query($this->db,$sql);
      while($row = mysqli_fetch_array($result)){
        $list[] = $row;
      }
      if(!empty($list)){
        return $list;
      }
    }

    public function get_itemview($id,$bid){
      $sql = "SELECT * FROM items WHERE item_id = '$id' AND brand_id = '$bid'";
      $result = mysqli_query($this->db,$sql);
      while($row = mysqli_fetch_array($result)){
        $list[] = $row;
      }
      if(!empty($list)){
        return $list;
      }
    }

    public function change_img($image,$iid){
      $sql = "UPDATE items SET item_img = '".$image."' WHERE item_id = '$iid'";
      $result = mysqli_query($this->db,$sql) or die(mysql_error() . "Cannot Update Data");
      return $result;
    }

    public function my_items($bid){
      $sql = "SELECT * FROM items WHERE brand_id = '$bid'";
      $result = mysqli_query($this->db,$sql);
      while($row = mysqli_fetch_array($result)){
        $list[] = $row;
      }
      if(!empty($list)){
        return $list;
      }
    }

    public function insert_order_total($oid,$value){
      $sql = "UPDATE orders SET order_total = '$value' WHERE order_id = '$oid'";
      $result = mysqli_query($this->db,$sql) or die(mysqli_error() . "Cannot Update Data");
      return $result;
    }

    public function empty_cart($usr){
      $sql = "DELETE FROM cart WHERE usr_id = '$usr'";
      $result = mysqli_query($this->db,$sql) or die(mysqli_error() . "Cannot Delete Data");
      return $result;
    }

    public function check_before_remove($id){
      $sql = "SELECT * FROM cart WHERE cart_id = '$id'";
      $result = mysqli_query($this->db,$sql);
      $row = mysqli_fetch_assoc($result);
      return $row;
    }

    public function remove_from_cart($id){
      $sql = "DELETE FROM cart WHERE cart_id = '$id'";
      $result = mysqli_query($this->db,$sql) or die(error() . "Cannot Delete Data");
      return $result;
    }

    public function cart_sum_total($id){
      $sql = "SELECT SUM(subtotal) AS total FROM cart WHERE usr_id = '$id'";
      $result = mysqli_query($this->db,$sql);
      $row = mysqli_fetch_assoc($result);
      $value = $row['total'];
      return $value;
    }
    public function get_cart($id){
      $sql = "SELECT * FROM cart,items WHERE usr_id = '$id' AND cart.item_id = items.item_id AND item_status = '1'";
      $result = mysqli_query($this->db,$sql);
      while($row = mysqli_fetch_array($result)){
        $list[] = $row;
      }
      if(!empty($list)){
        return $list;
      }
    }

    public function check_user_cart($uid,$iid){
      $sql = "SELECT *,COUNT(item_id) AS counted FROM cart WHERE usr_id = '$uid' AND item_id = '$iid'";
      $result = mysqli_query($this->db,$sql);
      while($row = mysqli_fetch_array($result)){
        $list[] = $row;
      }
      return $list;
    }

    public function insert_to_cart($uid,$iid,$qty,$subtotal){
      
      $sql = "INSERT INTO cart(item_id,item_qty,subtotal,usr_id) VALUES('$iid','$qty','$subtotal','$uid')";
      $result = mysqli_query($this->db,$sql) or die(error() . "Cannot Insert Data");
      return $result;
    }

    public function update_to_cart($uid,$iid,$qty,$subtotal){
      $sql = "UPDATE cart SET item_qty = '$qty', subtotal = '$subtotal' WHERE usr_id = '$uid' AND item_id = '$iid'";
      $result = mysqli_query($this->db,$sql) or die(error() . "Cannot Update Data");
      return $result;
    }

    public function count_cart($id){
      $sql = "SELECT COUNT(cart_id) as total FROM cart WHERE usr_id = '$id'";
      $result = mysqli_query($this->db,$sql);
      $row = mysqli_fetch_assoc($result);
      $value = $row['total'];
      return $value;
    }
  
    public function update_item($name,$desc,$price,$status,$iid,$bid){
      $db = new PDO("mysql:host=localhost;dbname=db_sleepnotgo", "root", "");
      $query = $db->prepare("UPDATE items SET item_name = ?, item_description = ?, item_price = ?, item_status = ? WHERE item_id = ? AND brand_id = ?");
      $query->bindParam(1,$name);
      $query->bindParam(2,$desc);
      $query->bindParam(3,$price);
      $query->bindParam(4,$status);
      $query->bindParam(5,$iid);
      $query->bindParam(6,$bid);
      return $query->execute();
    }

    public function delete_item($id,$bid){
      $sql = "DELETE FROM items WHERE item_id = '$id' AND brand_id = '$bid'";
      $result = mysqli_query($this->db,$sql) or die(error() . "Cannot Delete Data");
      return $result;
    }

    public function insert_item($name,$desc,$price,$status,$bid){
      $db = new PDO("mysql:host=localhost;dbname=db_sleepnotgo", "root", "");
      $query = $db->prepare("INSERT INTO items(brand_id,item_name,item_description,item_price,item_status,created_at) VALUES(?,?,?,?,?,NOW())");
      $query->bindParam(1,$bid);
      $query->bindParam(2,$name);
      $query->bindParam(3,$desc);
      $query->bindParam(4,$price);
      $query->bindParam(5,$status);
      $query->execute();
      return $db->lastInsertId();
      $db = null;
    }

    public function search_items($search){
      $db = new PDO("mysql:host=localhost;dbname=db_sleepnotgo", "root", "");
      $query = $db->prepare("SELECT * FROM items WHERE item_name LIKE ?");
      $val = '%'.$search.'%';
      $query->bindParam(1,$val);
      $query->execute();
      
      while ($row = $query->fetch(PDO::FETCH_ASSOC))
      {
        $list[] = $row;
      }
      if(!empty($list)){
        return $list;
      }
      $db = null;
    }
    
    public function shop_search_and_brand($search,$bid){
      $db = new PDO("mysql:host=localhost;dbname=db_sleepnotgo", "root", "");
      $query = $db->prepare("SELECT * FROM items WHERE item_name LIKE ?");
      $val = '%'.$search.'%';
      $query->bindParam(1,$val);
      $query->execute();
      
      while ($row = $query->fetch(PDO::FETCH_ASSOC))
      {
        $list[] = $row;
      }
      if(!empty($list)){
        return $list;
      }
      $db = null;
    }
}