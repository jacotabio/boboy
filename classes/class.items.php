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

    public function pdo_select($id){
      $query = $this->db->prepare("SELECT * FROM items WHERE item_id = :id");
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
      $query = $this->db->prepare("SELECT * FROM items,brands WHERE brands.brand_id = items.brand_id AND brand_status = 0 OR brands.brand_id = items.brand_id AND item_status = 0");
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
      $query = $this->db->prepare("SELECT brand_name FROM brands WHERE brand_id = ?");
      $query->bindParam(1,$id);
      $query->execute();
      $row = $query->fetch(PDO::FETCH_ASSOC);
      $value = $row['brand_name'];
      return $value;
    }

    public function get_item_name($id){
      $query = $this->db->prepare("SELECT item_name FROM items WHERE item_id = ?");
      $query->bindParam(1,$id);
      $query->execute();
      $row = $query->fetch(PDO::FETCH_ASSOC);
      $value = $row['item_name'];
      return $value;
    }

    public function check_item_status($id){
      $query = $this->db->prepare("SELECT item_status FROM items WHERE item_id = ?");
      $query->bindParam(1,$id);
      $query->execute();
      $row = $query->fetch(PDO::FETCH_ASSOC);
      $value = $row['item_status'];
      return $value;
    }

    public function get_shop_items(){
      $query = $this->db->prepare("SELECT * FROM items,brands WHERE item_status = '1' AND brand_status = '1' AND items.brand_id = brands.brand_id");
      $query->execute();
      while($row = $query->fetch(PDO::FETCH_ASSOC)){
        $list[] = $row;
      }
      if(!empty($list)){
        return $list;
      }
    }

    public function get_shop_items_search($search){
      $query = $this->db->prepare("SELECT * FROM items,brands WHERE item_name LIKE ? AND items.brand_id = brands.brand_id AND brand_status = '1'");
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
      $query = $this->db->prepare("SELECT * FROM items WHERE item_name LIKE ? AND brand_id = ?");
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
      $query = $this->db->prepare("SELECT * FROM items,brands WHERE brands.brand_id = ? AND item_status = '1' AND brands.brand_id = items.brand_id AND brand_status = '1'");
      $query->bindParam(1,$id);
      $query->execute();
      while($row = $query->fetch(PDO::FETCH_ASSOC)){
        $list[] = $row;
      }
      if(!empty($list)){
        return $list;
      }
    }

    public function check_availability($id){
      $query = $this->db->prepare("SELECT item_name FROM items,brands WHERE item_status = '1' AND item_id = ? AND items.brand_id = brands.brand_id AND brand_status = '1'");
      $query->bindParam(1,$id);
      $query->execute();
      $row = $query->fetch(PDO::FETCH_ASSOC);
      $value = $row['item_name'];
      return $value;
    }

    public function get_home_items(){
      $query = $this->db->prepare("SELECT * FROM items");
      $query->execute();
      while($row = $query->fetch(PDO::FETCH_ASSOC)){
        $list[] = $row;
      }
      if(!empty($list)){
        return $list;
      }
    }

    public function get_item_and_brand($id,$bid){
      $query = $this->db->prepare("SELECT * FROM items WHERE item_id = ? AND brand_id = ? AND item_status = '1'");
      $query->bindParam(1,$id);
      $query->bindParam(2,$bid);
      $query->execute();
      while($row = $query->fetch(PDO::FETCH_ASSOC)){
        $list[] = $row;
      }
      if(!empty($list)){
        return $list;
      }
    }

    public function create_order($usr_id,$address,$contact){
      $query = $this->db->prepare("INSERT INTO orders(created_at,usr_id,delivery_address,contact_number) VALUES(NOW(),?,?,?)");
      $query->bindParam(1,$usr_id);
      $query->bindParam(2,$address);
      $query->bindParam(3,$contact);
      $query->execute();
      return $this->db->lastInsertId();
    }

    public function insert_order($oid,$item,$qty,$subtotal,$usr){
      $query = $this->db->prepare("INSERT INTO oitem(order_id,item_id,oi_qty,oi_subtotal,usr_id) VALUES(?,?,?,?,?)");
      $query->bindParam(1,$oid);
      $query->bindParam(2,$item);
      $query->bindParam(3,$qty);
      $query->bindParam(4,$subtotal);
      $query->bindParam(5,$usr);
      return $query->execute();
    }

    public function get_item($id){
      $query = $this->db->prepare("SELECT * FROM items,brands WHERE item_id = ? AND item_status = '1' AND items.brand_id = brands.brand_id AND brand_status = '1'");
      $query->bindParam(1,$id);
      $query->execute();
      while($row = $query->fetch(PDO::FETCH_ASSOC)){
        $list[] = $row;
      }
      if(!empty($list)){
        return $list;
      }
    }

    public function get_itemview($id,$bid){
      $query = $this->db->prepare("SELECT * FROM items WHERE item_id = ? AND brand_id = ?");
      $query->bindParam(1,$id);
      $query->bindParam(2,$bid);
      $query->execute();
      while($row = $query->fetch(PDO::FETCH_ASSOC)){
        $list[] = $row;
      }
      if(!empty($list)){
        return $list;
      }
    }

    public function change_img($image,$iid){
      $query = $this->db->prepare("UPDATE items SET item_img = ? WHERE item_id = ?");
      $query->bindParam(1,$image);
      $query->bindParam(2,$iid);
      return $query->execute();
    }

    public function my_items($bid){
      $query = $this->db->prepare("SELECT * FROM items WHERE brand_id = ?");
      $query->bindParam(1,$bid);
      $query->execute();
      while($row = $query->fetch(PDO::FETCH_ASSOC)){
        $list[] = $row;
      }
      if(!empty($list)){
        return $list;
      }
    }

    public function insert_order_total($oid,$value){
      $query = $this->db->prepare("UPDATE orders SET order_total = ? WHERE order_id = ?");
      $query->bindParam(1,$value);
      $query->bindParam(2,$oid);
      return $query->execute();
    }

    public function empty_cart($usr){
      $query = $this->db->prepare("DELETE FROM cart WHERE usr_id = ?");
      $query->bindParam(1,$usr);
      return $query->execute();
    }

    public function check_before_remove($id){
      $query = $this->db->prepare("SELECT * FROM cart WHERE cart_id = ?");
      $query->bindParam(1,$id);
      $query->execute();
      $row = $query->fetch(PDO::FETCH_ASSOC);
      return $row;
    }

    public function remove_from_cart($id){
      $query = $this->db->prepare("DELETE FROM cart WHERE cart_id = ?");
      $query->bindParam(1,$id);
      return $query->execute();
    }

    public function cart_sum_total($id){
      $query = $this->db->prepare("SELECT SUM(subtotal) AS total FROM cart WHERE usr_id = ?");
      $query->bindParam(1,$id);
      $query->execute();
      $row = $query->fetch(PDO::FETCH_ASSOC);
      return $row['total'];
    }
    public function get_cart($id){
      $query = $this->db->prepare("SELECT * FROM cart,items WHERE usr_id = ? AND cart.item_id = items.item_id AND item_status = '1'");
      $query->bindParam(1,$id);
      $query->execute();
      while($row = $query->fetch(PDO::FETCH_ASSOC)){
        $list[] = $row;
      }
      if(!empty($list)){
        return $list;
      }
    }

    public function check_user_cart($uid,$iid){
      $query = $this->db->prepare("SELECT *,COUNT(item_id) AS counted FROM cart WHERE usr_id = ? AND item_id = ?");
      $query->bindParam(1,$uid);
      $query->bindParam(2,$iid);
      $query->execute();
      while($row = $query->fetch(PDO::FETCH_ASSOC)){
        $list[] = $row;
      }
      return $list;
    }

    public function insert_to_cart($uid,$iid,$qty,$subtotal){
      $query = $this->db->prepare("INSERT INTO cart(item_id,item_qty,subtotal,usr_id) VALUES(?,?,?,?)");
      $query->bindParam(1,$iid);
      $query->bindParam(2,$qty);
      $query->bindParam(3,$subtotal);
      $query->bindParam(4,$uid);
      return $query->execute();
    }

    public function update_to_cart($uid,$iid,$qty,$subtotal){
      $query = $this->db->prepare("UPDATE cart SET item_qty = ?, subtotal = ? WHERE usr_id = ? AND item_id = ?");
      $query->bindParam(1,$qty);
      $query->bindParam(2,$subtotal);
      $query->bindParam(3,$uid);
      $query->bindParam(4,$iid);
      return $query->execute();
    }

    public function count_cart($id){
      $query = $this->db->prepare("SELECT COUNT(cart_id) as total FROM cart WHERE usr_id = ?");
      $query->bindParam(1,$id);
      $query->execute();
      $row = $query->fetch(PDO::FETCH_ASSOC);
      $value = $row['total'];
      return $value;
    }
  
    public function update_item($name,$desc,$price,$status,$iid,$bid){
      $query = $this->db->prepare("UPDATE items SET item_name = ?, item_description = ?, item_price = ?, item_status = ? WHERE item_id = ? AND brand_id = ?");
      $query->bindParam(1,$name);
      $query->bindParam(2,$desc);
      $query->bindParam(3,$price);
      $query->bindParam(4,$status);
      $query->bindParam(5,$iid);
      $query->bindParam(6,$bid);
      return $query->execute();
    }

    public function delete_item($id,$bid){
      $query = $this->db->prepare("DELETE FROM items WHERE item_id = ? AND brand_id = ?");
      $query->bindParam(1,$id);
      $query->bindParam(2,$bid);
      return $query->execute();
    }

    public function insert_item($name,$desc,$price,$status,$bid){
      $query = $this->db->prepare("INSERT INTO items(brand_id,item_name,item_description,item_price,item_status,created_at) VALUES(?,?,?,?,?,NOW())");
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
      $query = $this->db->prepare("SELECT * FROM items WHERE item_name LIKE ?");
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
      $query = $this->db->prepare("SELECT * FROM items WHERE item_name LIKE ?");
      $val = '%'.$search.'%';
      $query->bindParam(1,$val);
      $query->execute();
      
      while ($row = $query->fetch(PDO::FETCH_ASSOC)){
        $list[] = $row;
      }
      if(!empty($list)){
        return $list;
      }
      $db = null;
    }
}