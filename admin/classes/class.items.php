<?php
class Items{
  public $db;
  
  public function __construct(){
    try{
    $this->db = new PDO("mysql:host=".DB_SERVER.";dbname=".DB_DATABASE, DB_USERNAME, DB_PASSWORD, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
    }catch(PDOException $e){
      echo "Connection failed: " . $e->getMessage();
      exit;
    }
  }

  public function get_items(){
    $sth = $this->db->prepare("SELECT * FROM items,brands,users WHERE item_status = 1 AND brands.brand_id = items.brand_id AND brand_status = 1 AND users.brand_id = brands.brand_id AND usr_status = 1 AND is_hidden = 0");
    $sth->execute();

    while($row = $sth->fetch(PDO::FETCH_ASSOC)){
      $list[] = $row;
    }
    if(!empty($list)){
      return $list;  
    }
  }

  public function insert_oitem($oid,$iid,$qty,$subtotal,$uid){
    $sth = $this->db->prepare("INSERT INTO oitem(order_id,item_id,oi_qty,oi_subtotal,usr_id) VALUES(?,?,?,?,?)");
    $sth->bindParam(1,$oid);
    $sth->bindParam(2,$iid);
    $sth->bindParam(3,$qty);
    $sth->bindParam(4,$subtotal);
    $sth->bindParam(5,$uid);
    $sth->execute();
  }

  public function empty_cart(){
    $sth = $this->db->prepare("DELETE FROM cart WHERE usr_id = 1");
    return $sth->execute();
  }

  public function get_cart(){
    // Remove unavailable items on load
    $query = $this->db->prepare("DELETE T1 FROM cart AS T1 INNER JOIN items AS T2 WHERE T1.item_id = T2.item_id AND T2.item_status = 0 AND T1.usr_id = 1");
    $query->execute();

    $sth = $this->db->prepare("SELECT cart_id,cart.item_id,item_name,item_qty,cart.usr_id,SUM(item_price * item_qty) AS subtotal FROM cart,items,users,brands WHERE items.item_id = cart.item_id AND items.brand_id = brands.brand_id AND users.brand_id = brands.brand_id AND usr_status = 1 AND cart.usr_id = 1 AND item_status = 1 GROUP BY cart_id");
    $sth->execute();
    while($row = $sth->fetch(PDO::FETCH_ASSOC)){
      $list[] = $row;
    }
    if(!empty($list) && $row['subtotal'] == null){
      return $list;
    }
  }

  public function remove_cart($id){
    $sth = $this->db->prepare("DELETE FROM cart WHERE cart_id = ?");
    $sth->bindParam(1,$id);
    return $sth->execute();
  }

  public function cart_total(){
    $sth = $this->db->prepare("SELECT IFNULL(SUM(item_qty * item_price),0) AS total FROM cart,items WHERE items.item_id = cart.item_id AND usr_id = 1");
    $sth->execute();
    $row = $sth->fetch(PDO::FETCH_ASSOC);
    return $row['total'];
  }
}